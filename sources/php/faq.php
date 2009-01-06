<?php
// Copyright (c) Isaac Gouy 2004-2008

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_common.php');  
require_once(LIB); 


// TEMPLATE VARS ////////////////////////////////////////////////

$Page = & new Template(LIB_PATH);
$Page->set('PageTitle', FAQ_TITLE.BAR.SITE_TITLE);
$Page->set('BannerTitle', BANNER_TITLE);
$Page->set('FaqTitle', FAQ_TITLE);
$Page->set('PageBody', BLANK);

$Body = & new Template(LIB_PATH);
$Body->set('Download', DOWNLOAD_PATH);
$Body->set('Changed', filemtime(LIB_PATH.'faq.tpl.php'));

$Page->set('PageBody', $Body->fetch('faq.tpl.php'));
$metaRobots = '<meta name="robots" content="all" /><meta name="revisit" content="10 days" />';
$Page->set('Robots', $metaRobots);
$Page->set('MetaKeywords', '');
$Page->set('PageId', 'faq');

echo $Page->fetch('page.tpl.php');
?>

