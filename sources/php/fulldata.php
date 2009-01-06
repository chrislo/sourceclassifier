<?php

// Copyright (c) Isaac Gouy 2004-2008

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_common.php'); 
require_once(LIB); 
require_once(LIB_PATH.'lib_fulldata.php');

// DATA ///////////////////////////////////////////

list($Incl,$Excl) = ReadIncludeExclude();

$Tests = ReadUniqueArrays('test.csv',$Incl);
uasort($Tests, 'CompareTestName');

$Langs = ReadUniqueArrays('lang.csv',$Incl);
uasort($Langs, 'CompareLangName');


if (isset($HTTP_GET_VARS['test'])
      && strlen($HTTP_GET_VARS['test']) && (strlen($HTTP_GET_VARS['test']) <= NAME_LEN)){
   $X = $HTTP_GET_VARS['test'];
   if (ereg("^[a-z]+$",$X) && isset($Tests[$X])){ $T = $X; }
}
if (!isset($T)){ $T = 'nbody'; }


if (isset($HTTP_GET_VARS['p1'])
      && strlen($HTTP_GET_VARS['p1']) && (strlen($HTTP_GET_VARS['p1']) <= PRG_ID_LEN)){
   $X = $HTTP_GET_VARS['p1'];
   if (ereg("^[a-z0-9]+-[0-9]$",$X)){
      list($a, $b) = explode('-', $X);
      if (isset($Langs[$a])){ $P1 = $X; }
   }
}
if (!isset($P1)){ $P1 = '-0'; }


if (isset($HTTP_GET_VARS['p2'])
      && strlen($HTTP_GET_VARS['p2']) && (strlen($HTTP_GET_VARS['p2']) <= PRG_ID_LEN)){
   $X = $HTTP_GET_VARS['p2'];
   if (ereg("^[a-z0-9]+-[0-9]$",$X)){
      list($a, $b) = explode('-', $X);
      if (isset($Langs[$a])){ $P2 = $X; }
   }
}
if (!isset($P2)){ $P2 = '-0'; }


if (isset($HTTP_GET_VARS['p3'])
      && strlen($HTTP_GET_VARS['p3']) && (strlen($HTTP_GET_VARS['p3']) <= PRG_ID_LEN)){
   $X = $HTTP_GET_VARS['p3'];
   if (ereg("^[a-z0-9]+-[0-9]$",$X)){
      list($a, $b) = explode('-', $X);
      if (isset($Langs[$a])){ $P3 = $X; }
   }
}
if (!isset($P3)){ $P3 = '-0'; }


if (isset($HTTP_GET_VARS['p4'])
      && strlen($HTTP_GET_VARS['p4']) && (strlen($HTTP_GET_VARS['p4']) <= PRG_ID_LEN)){
   $X = $HTTP_GET_VARS['p4'];
   if (ereg("^[a-z0-9]+-[0-9]$",$X)){
      list($a, $b) = explode('-', $X);
      if (isset($Langs[$a])){ $P4 = $X; }
   }
}
if (!isset($P4)){ $P4 = '-0'; }



// PAGE ///////////////////////////////////////////////////

$Page = & new Template(LIB_PATH);
$Body = & new Template(LIB_PATH); 

$TestName = $Tests[$T][TEST_NAME];
$Title = $TestName.' full data'; 
$TemplateName = 'fulldata.tpl.php'; 

$AboutTemplateName = 'fulldata-about.tpl.php'; 
if (! file_exists(ABOUT_PATH.$AboutTemplateName)){ $AboutTemplateName = 'blank-about.tpl.php'; }

$Body->set('Data', ReadSelectedDataArrays(DATA_PATH.'ndata.csv', $T, $Incl) );


// TEMPLATE VARS ////////////////////////////////////////////////

$Page->set('PageTitle', $Title.BAR.SITE_TITLE);
$Page->set('BannerTitle', BANNER_TITLE);
$Page->set('FaqTitle', FAQ_TITLE);

$Body->set('Tests', $Tests);
$Body->set('SelectedTest', $T);
$Body->set('Langs', $Langs);

$Body->set('Excl', $Excl);

$Body->set('P1', $P1);
$Body->set('P2', $P2);
$Body->set('P3', $P3);
$Body->set('P4', $P4);

$About = & new Template(ABOUT_PATH);
$Body->set('About', $About->fetch($AboutTemplateName));
$Page->set('PageBody', $Body->fetch($TemplateName));
$Page->set('Robots', '<meta name="robots" content="noindex,nofollow" />');
$Page->set('MetaKeywords', '');
$Page->set('PageId', 'fulldata');

echo $Page->fetch('page.tpl.php');
?>

