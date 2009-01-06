<?php
// Copyright (c) Isaac Gouy 2004-2008

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_common.php');
require_once(LIB); 

// DATA ///////////////////////////////////////////

if (isset($HTTP_GET_VARS['file'])
      && strlen($HTTP_GET_VARS['file']) && (strlen($HTTP_GET_VARS['file']) <= NAME_LEN)){
   $X = $HTTP_GET_VARS['file'];
   if (ereg("^[a-z]+$",$X) && (
         $X == 'acknowledgements' ||
         $X == 'benchmarking' ||
         $X == 'dynamic' ||
         $X == 'license'
      )){ $F = $X; }
}
if (!isset($F)){ $F = 'license'; }


if (isset($HTTP_GET_VARS['title'])
      && strlen($HTTP_GET_VARS['title']) && (strlen($HTTP_GET_VARS['title']) <= 2*NAME_LEN)){
   $T = strip_tags($HTTP_GET_VARS['title']);
}
if (!isset($T)){ $T = ''; }


// TEMPLATE VARS ////////////////////////////////////////////////

$Page = & new Template(LIB_PATH);  
$Page->set('PageTitle', $T.BAR.SITE_TITLE);
$Page->set('BannerTitle', BANNER_TITLE);
$Page->set('FaqTitle', FAQ_TITLE);
$Page->set('PageBody', BLANK);
$Page->set('PicturePath', CORE_SITE);

$Body = & new Template(LIB_PATH);
$Body->set('Title', $T);
$Body->set('MiscFile', MISC_PATH.$F.'.php');
$Body->set('Changed', filemtime(MISC_PATH.$F.'.php'));

$Page->set('PageBody', $Body->fetch('misc.tpl.php'));

if ($F == 'benchmarking'){ $metaRobots = '<meta name="robots" content="all" /><meta name="revisit" content="10 days" />'; }
else { $metaRobots = '<meta name="robots" content="noindex,nofollow,noarchive" />'; }

$Page->set('Robots', $metaRobots);
$Page->set('MetaKeywords', '');
$Page->set('PageId', 'miscfile');

echo $Page->fetch('page.tpl.php');
?>
