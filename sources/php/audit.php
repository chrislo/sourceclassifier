<?php 

// Copyright (c) Isaac Gouy 2004, 2005

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_common.php'); 
require_once(LIB); 
require_once(LIB_PATH.'lib_audit.php'); 

// DATA ///////////////////////////////////////////

list($Incl,$Excl) = ReadIncludeExclude();

$Tests = ReadUniqueArrays('test.csv',$Incl);
uasort($Tests, 'CompareTestName');

$Langs = ReadUniqueArrays('lang.csv',$Incl);
uasort($Langs, 'CompareLangName');


// PAGE ///////////////////////////////////////////////////

$Page = & new Template(LIB_PATH);
$Body = & new Template(LIB_PATH); 

$Title = 'audit'; 
$TemplateName = 'audit.tpl.php'; 
$AboutTemplateName = 'blank-about.tpl.php';

list($d,$n,$t) = ReadCsv(DATA_PATH.'ndata.csv');
$Body->set('NData', $d);
$Body->set('NDataN', $n);
$Body->set('NDataTime', $t);

list($d,$n,$t) = ReadCsv(DATA_PATH.'data.csv');
$Body->set('Data', $d);

list($l,$o) = ReadLogFiles(LOG_PATH);
$Body->set('Logs', $l);
$Body->set('bad6', $o);

$Body->set('Now', time());


// TEMPLATE VARS //////////////////////////////////////////////// 

$Page->set('PageTitle', $Title.BAR.SITE_TITLE);
$Page->set('BannerTitle', BANNER_TITLE);
$Page->set('FaqTitle', FAQ_TITLE);

$About = & new Template(ABOUT_PATH);
$Body->set('About', $About->fetch($AboutTemplateName));
$Page->set('PageBody', $Body->fetch($TemplateName));
$Page->set('Robots', '<meta name="robots" content="noindex,nofollow,noarchive" />');
$Page->set('MetaKeywords', '');

echo $Page->fetch('page.tpl.php');
?>

