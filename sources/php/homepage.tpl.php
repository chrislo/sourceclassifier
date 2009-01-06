<?   // Copyright (c) Isaac Gouy 2004-2006 ?>

<?php      echo '<?xml version="1.0" encoding="iso-8859-1" ?>';      ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?=$Robots;?>

<title><?=$PageTitle;?></title>
<link rel="stylesheet" type="text/css" href="<?=IMAGE_PATH;?>benchmark.css" />
<link rel="shortcut icon" href="./favicon.ico" />
</head>

<body id="<?=SITE_NAME;?>">

<table class="banner"><tr>
<td><h1><a href="index.php"><?=$BannerTitle;?></a></h1></td>
<td><h4><a href="faq.php"><?=$FaqTitle;?></a></h4></td>
</tr></table>

<div id="nav">
<?=$PageBody;?>

<p class="img">
<a href="miscfile.php?file=license&amp;title=Revised BSD license" title="Software contributed to the Shootout is published under this revised BSD license" >
   <img src="<?=IMAGE_PATH;?>open_source_button.png" alt="Revised BSD license" height="31" width="88" /></a>
</p>
</div>
<? $virtual_page=$PageTitle; include_once(IMAGE_PATH.'analyticstracking.php') ?>
</body>
</html>
