<?php
// Copyright (c) Isaac Gouy 2004-2008

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_common.php');  
require_once(LIB); 

// DATA ///////////////////////////////////////////

list($Incl,$Excl) = ReadIncludeExclude();
$Tests = ReadUniqueArrays('test.csv',$Incl);

if (isset($HTTP_GET_VARS['test'])
      && strlen($HTTP_GET_VARS['test']) && (strlen($HTTP_GET_VARS['test']) <= NAME_LEN)){
   $X = $HTTP_GET_VARS['test'];
   if (ereg("^[a-z]+$",$X) && (isset($Tests[$X]) || $X == 'all')){ $T = $X; }
}
if (!isset($T)){ $T = 'nbody'; }


if (isset($HTTP_GET_VARS['file'])
      && strlen($HTTP_GET_VARS['file']) && (strlen($HTTP_GET_VARS['file']) <= 6)){
   $X = $HTTP_GET_VARS['file'];
   if (ereg("^[a-z]+$",$X) && ($X == 'input')){ $F = $X; }
}
if (!isset($F)){ $F = 'output'; }

/*
if (isset($HTTP_GET_VARS['ext'])
      && strlen($HTTP_GET_VARS['ext']) && (strlen($HTTP_GET_VARS['ext']) <= 3)){
   $X = $HTTP_GET_VARS['ext'];
   if (ereg("^[a-z]+$",$X)){ $E = $X; }
}
*/
if (!isset($E)){ $E = 'txt'; }


$TestName = $Tests[$T][TEST_NAME];

if ($F == 'input'){ $Title = $TestName.' input file'; } 
elseif ($F == 'output'){ $Title = $TestName.' output file'; }
//elseif ($F == 'dict') { $Title = $TestName.' Usr.Dict.Words file'; }
else { $Title = $TestName; }

// TEMPLATE VARS ////////////////////////////////////////////////

$Page = & new Template(LIB_PATH);
$Page->set('PageTitle', $Title.BAR.SITE_TITLE);
$Page->set('BannerTitle', BANNER_TITLE);
$Page->set('FaqTitle', FAQ_TITLE);
$Page->set('PageBody', BLANK);

$Body = & new Template(LIB_PATH);
$Body->set('Title', $Title);
$Body->set('Download', DOWNLOAD_PATH.$T.SEPARATOR.$F.'.'.$E);
$Body->set('Text', HtmlFragment( DOWNLOAD_PATH.$T.SEPARATOR.$F.'.'.$E ));

$Page->set('PageBody', $Body->fetch('iofile.tpl.php'));
$Page->set('Robots', '<meta name="robots" content="noindex,nofollow" />');
$Page->set('MetaKeywords', '');
$Page->set('PageId', 'iofile');
echo $Page->fetch('page.tpl.php');
?>

