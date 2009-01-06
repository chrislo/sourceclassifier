<?php
// Copyright (c) Isaac Gouy 2004-2008

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_common.php'); 
require_once(LIB); 

// DATA ////////////////////////////////////////////////

list($Incl,$Excl) = ReadIncludeExclude();
$Tests = ReadUniqueArrays('test.csv',$Incl);
//if (SITE_NAME != 'debian' && SITE_NAME != 'gp4'){ uasort($Tests, 'CompareTestName'); }

$Langs = ReadUniqueArrays('lang.csv',$Incl);
uasort($Langs, 'CompareLangName');

// TEMPLATE VARS /////////////////////////////////////////// 

$Page = & new Template(LIB_PATH);  
$Page->set('PageTitle', SITE_TITLE);
$Page->set('BannerTitle', BANNER_TITLE);
$Page->set('FaqTitle', FAQ_TITLE);

$Body = & new Template(LIB_PATH); 
$Body->set('Tests', $Tests);
$Body->set('Langs', $Langs);

if (SITE_NAME == 'contests'){
   $Body->set('AboutName', 'The Language Shootout Contests');
   $Body->set('Headline', 'Programmer and language contests');   
} else {
   $Body->set('AboutName', 'The Language Shootout Benchmarks');
   $Body->set('Headline', 'Benchmarking programming languages?');   
}
$Body->set('Measured', filemtime(DATA_PATH.'data.csv'));

$Intro = & new Template(ABOUT_PATH);
$Body->set('Intro', $Intro->fetch(SITE_NAME.SEPARATOR.'intro.about'));

$Feature = & new Template(ABOUT_PATH);
$Body->set('Feature', $Feature->fetch('feature.about'));

$About = & new Template(ABOUT_PATH);
$Body->set('About', $About->fetch(SITE_NAME.SEPARATOR.'home.about'));

$Page->set('PageBody', $Body->fetch('home.tpl.php'));

$metaRobots = '<meta name="robots" content="follow,index,noarchive" /><meta name="revisit" content="1 days" />';

$Page->set('Robots', $metaRobots);
$Page->set('PageId', 'nav');

echo $Page->fetch('homepage.tpl.php');
?>

