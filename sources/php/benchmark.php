<?php
// Copyright (c) Isaac Gouy 2004-2008

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_common.php');
require_once(LIB);

// DATA ///////////////////////////////////////////

list($Incl,$Excl) = ReadIncludeExclude();
$Tests = ReadUniqueArrays('test.csv',$Incl);
uasort($Tests, 'CompareTestName');

$Langs = ReadUniqueArrays('lang.csv',$Incl);
uasort($Langs, 'CompareLangName');


if (isset($HTTP_GET_VARS['test'])
      && strlen($HTTP_GET_VARS['test']) && (strlen($HTTP_GET_VARS['test']) <= NAME_LEN)){
   $X = $HTTP_GET_VARS['test'];
   if (ereg("^[a-z]+$",$X) && (isset($Tests[$X]) || $X == 'all')){ $T = $X; }
}
if (!isset($T)){ $T = 'nbody'; }


if (isset($HTTP_GET_VARS['lang'])
      && strlen($HTTP_GET_VARS['lang']) && (strlen($HTTP_GET_VARS['lang']) <= NAME_LEN)){
   $X = $HTTP_GET_VARS['lang'];
   if (ereg("^[a-z0-9]+$",$X) && (isset($Langs[$X]) || $X == 'all')){ $L = $X; }
}
if (!isset($L)){ $L = 'all'; }


if (isset($HTTP_GET_VARS['lang2'])
      && strlen($HTTP_GET_VARS['lang2']) && (strlen($HTTP_GET_VARS['lang2']) <= NAME_LEN)){
   $X = $HTTP_GET_VARS['lang2'];
   if (ereg("^[a-z0-9]+$",$X) && (isset($Langs[$X]))){ $L2 = $X; }
}
if (!isset($L2)){
   if ($L=='all'){ $L2 = $L; }
   else { $L2 = $Langs[$L][LANG_COMPARE]; }
}


if (isset($HTTP_GET_VARS['id']) && strlen($HTTP_GET_VARS['id']) == 1){
   $X = $HTTP_GET_VARS['id'];
   if (ereg("^[0-9]$",$X)){ $I = $X; }
}
if (!isset($I)){ $I = -1; }


$MetaKeywords = '';

// PAGES ///////////////////////////////////////////////////
// There are 4 kinds of test/lang combination
// - all tests all languages - Scorecard
// - all tests one language  - Head to Head | Ranking
// - one test all languages  - Benchmark
// - one test one language   - Program

$Page = & new Template(LIB_PATH);
$Body = & new Template(LIB_PATH);

if ($T=='all'){
   if ($L=='all'){    // Scorecard
      $PageId = 'scorecard';
      $S = 'mean';

      require_once(LIB_PATH.'lib_scorecard.php');

      if (isset($HTTP_GET_VARS['calc'])
            && strlen($HTTP_GET_VARS['calc']) && (strlen($HTTP_GET_VARS['calc']) <= 9)){
         $X = $HTTP_GET_VARS['calc'];
         if (ereg("^[a-z]+$",$X) && ($X == 'reset')){ $Action = $X; }
      }
      if (!isset($Action)){ $Action = 'calculate'; }

      $Title = 'Create your own Ranking';
      $TemplateName = 'scorecard.tpl.php';
      $About = & new Template(ABOUT_PATH);
      $AboutTemplateName = 'scorecard-about.tpl.php';
      $W = Weights($Tests, $Action, $HTTP_GET_VARS);
      $Body->set('W', $W);
      $Body->set('Data', WeightedData(DATA_PATH.'data.csv', $Tests, $Langs, $Incl, $Excl, $W));
      $metaRobots = '<meta name="robots" content="all" /><meta name="revisit" content="10 days" />';


   } else {           // Head to Head

      $S = '';
      $PageId = 'headtohead';
      require_once(LIB_PATH.'lib_headtohead.php');
      $LangName = $Langs[$L][LANG_FULL];
      $Title = $LangName.' benchmarks';
      
      if (isset($metaRobots) && (SITE_NAME == 'debian' || SITE_NAME == 'gp4')){ // Assume it's one of our special pages which should be indexed
         $metaRobots = '<meta name="robots" content="index,follow,archive" /><meta name="revisit" content="1 days" />';
         $Family = $Langs[$L][LANG_FAMILY];
         $MetaKeywords = '<meta name="keywords" content="'.
         $Title.' '.$Family.' programs '.$Family.' benchmark '.$Family.' language" />'.
            '<meta name="description" content="'.
            'Compare '.$LangName.' performance on benchmark programs." />';

      } else {
           $metaRobots = '<meta name="robots" content="noindex,nofollow,noarchive" />';
      }

      $Title = $LangName.' benchmarks';

      if ($L!=$L2){
         $TemplateName = 'headtohead.tpl.php';
         $Body->set('Data', HeadToHeadData(DATA_PATH.'ndata.csv',$Langs,$Incl,$Excl,$L,$L2));

      } else {
        $TemplateName = 'language.tpl.php';
        $Body->set('Data', LanguageData(DATA_PATH.'ndata.csv',$Langs,$Incl,$Excl,$L,$L2));
      }
      
      $About = & new Template(ABOUT_PATH);
      $AboutTemplateName = $L.SEPARATOR.'about.tpl.php';
      if (! file_exists(ABOUT_PATH.$AboutTemplateName)){ $AboutTemplateName = 'blank-about.tpl.php'; }
      $About->set('Version', HtmlFragment(VERSION_PATH.$L.SEPARATOR.'version.php'));
      }

   } elseif ($L=='all'){ // Benchmark
   
      $PageId = 'benchmark';

      
      if (isset($HTTP_GET_VARS['sort'])
            && strlen($HTTP_GET_VARS['sort']) && (strlen($HTTP_GET_VARS['sort']) <= 7)){
         $X = $HTTP_GET_VARS['sort'];
         if (ereg("^[a-z]+$",$X) && ($X == 'fullcpu' || $X == 'kb' || $X == 'gz')){ $S = $X; }
      }
      if (!isset($S)){ $S = 'fullcpu'; }


      $TestName = $Tests[$T][TEST_NAME];
      $Title = $TestName.' benchmark';
      $TemplateName = 'benchmark.tpl.php';
      $About = & new Template(ABOUT_PATH);
      $AboutTemplateName = $T.SEPARATOR.'about.tpl.php';
      if (! file_exists(ABOUT_PATH.$AboutTemplateName)){ $AboutTemplateName = 'blank-about.tpl.php'; }
      $Body->set('Data', ReadSelectedDataArrays(DATA_PATH.'data.csv', $T, $Incl) );
      $metaRobots = '<meta name="robots" content="noindex,nofollow,noarchive" />';


   } else {              // Program
   
      $S = '';
      $PageId = 'program';
      $D = ProgramData(DATA_PATH.'data.csv',$T,$L,$I,$Langs,$Incl,$Excl);
      if (sizeof($D)>0){ $I = $D[DATA_ID]; }
      
      $TestName = $Tests[$T][TEST_NAME];
      $LangName = $Langs[$L][LANG_FULL];
      $TemplateName = 'program.tpl.php';
      $Title = $TestName.' '.$LangName.IdName($I).' program';

      $Id = '';
      if ($I > 1){ $Id = SEPARATOR.$I; }
      
      $About = & new Template(ABOUT_PROGRAMS_PATH);
      $AboutTemplateName = $T.SEPARATOR.$L.$Id.SEPARATOR.'about.tpl.php';
      if (! file_exists(ABOUT_PROGRAMS_PATH.$AboutTemplateName)){ $AboutTemplateName = 'blank-about.tpl.php'; }

      $Body->set('Data', $D );
      $Body->set('Code', HtmlFragment( CODE_PATH.$T.'.'.$I.'.'.$L.'.code' ));
      $Body->set('Log', HtmlFragment( LOG_PATH.$T.'.'.$I.'.'.$L.'.log' ));

      $Body->set('Id', $I);
      $Body->set('Title', $Title);
      $metaRobots = '<meta name="robots" content="noindex,nofollow,noarchive" />';

}


// TEMPLATE VARS ////////////////////////////////////////////////

$Page->set('PageTitle', $Title.BAR.SITE_TITLE);
$Page->set('BannerTitle', BANNER_TITLE);
$Page->set('FaqTitle', FAQ_TITLE);
$Page->set('Sort', $S);

$Body->set('Tests', $Tests);
$Body->set('SelectedTest', $T);
$Body->set('Langs', $Langs);
$Body->set('SelectedLang', $L);
$Body->set('SelectedLang2', $L2);
$Body->set('Sort', $S);
$Body->set('Excl', $Excl);

$About->set('SelectedTest', $T);
$About->set('SelectedLang', $L);
$About->set('Sort', $S);

$Body->set('About', $About->fetch($AboutTemplateName));

$Page->set('PageBody', $Body->fetch($TemplateName));
$Page->set('Robots', $metaRobots);
$Page->set('MetaKeywords', $MetaKeywords);
$Page->set('PageId', $PageId);

echo $Page->fetch('page.tpl.php');
?>



