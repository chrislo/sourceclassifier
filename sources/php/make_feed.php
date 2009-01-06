#!/usr/bin/php 
<?
// Copyright (c) Isaac Gouy 2005
// Run from shootout directory

// Used PHP because I know it somewhat - should rewrite in Perl

// Assumes rigid RSS file structure of one item per line
// - xml, rss, channel: one line
// - channel title: one line
// - items: one per line
// - /channel /rss: one line

// LIBRARIES ////////////////////////////////////////////////

require_once('website/lib/lib_common.php'); 

define('DESC_PATH', 'website/desc/');
define('CODE_PATH', 'website/code/');
define('FEEDS_PATH', 'website/websites/feeds/');


// FUNCTIONS ///////////////////////////////////////////


function ReadUnique($FileName,$HasHeading=TRUE){
   if (file_exists('./'.$FileName)){
      $f = @fopen('./'.$FileName,'r') or die('Cannot open '.$FileName);
   } else {
      $f = @fopen(DESC_PATH.$FileName,'r') or die('Cannot open '.$FileName);
   }

   if ($HasHeading){ $row = @fgetcsv($f,1024,','); }

   while (!@feof ($f)){
      $row = @fgetcsv($f,1024,',');
      if (!is_array($row)){ continue; }
     
      $rows[ $row[0] ] = $row;     
   }
   @fclose($f);
   return $rows;
}


// MAIN //////////////////////////////////////////////// 

// are we measuring on Gentoo or Debian?
$isGentoo = preg_match("/gp4/i",`pwd`);
$cutoff = filemtime('timestamp');

printf("Generating feed data for ");
if ($isGentoo) {
    printf("Gentoo");
} else {
    printf("Debian");
}
printf(" for timestamp: $cutoff\n");

$dirName = CODE_PATH;
$Tests = ReadUnique('test.csv');
$Langs = ReadUnique('lang.csv');

// get test and lang from most recently updated logfiles
$dh = opendir($dirName);
while ($file = readdir($dh)){
   $newcut = filemtime($dirName.$file);
   $file22 = $dirName.$file;
   if (preg_match("/([a-z]*)-([a-z]*)(\S*)\.log$/i",$file,$matches) 
      && (filemtime($dirName.$file) > $cutoff)){

      $lang = $matches[2];
      if (!isset($langNames[$lang])) $langNames[$lang] = $Langs[$lang][LANG_FULL];

      $test = $matches[1];
      if (!isset($testNames[$test])) $testNames[$test] = $Tests[$test][TEST_NAME];
   }
}
closedir($dh);


if (isset($langNames)){
   asort($langNames);
   foreach($langNames as $k => $v){
      if (isset($desc1)){ $desc1 = $desc1.', '.$v; } else { $desc1 = $v; }
   }

   asort($testNames);
   foreach($testNames as $k => $v){
      if (isset($desc2)){ $desc2 = $desc2.', '.$v; } else { $desc2 = $v; }
   }

   $day = date("jS M");
   if ($isGentoo){ 
      printf("Gentoo\n");
      $os = "Gentoo";
      $url = "http://shootout.alioth.debian.org/gp4/"; 
   } else { 
      printf("Debian\n");
      $os = "Debian";
      $url = "http://shootout.alioth.debian.org/"; 
   }
   $newItem = "<item><title>".$day.", ".$os." computer language benchmarks measured</title>";
   $newItem .= "<description>".$desc1." :: ".$desc2."</description>";
   $newItem .= "<link>".$url."</link></item>\n";


   $oldFeed = file(FEEDS_PATH.'rss.xml');
   $itemCount = sizeof($oldFeed) - 3; // 1 header, 1 title, 1 footer line
   if ($itemCount < 50){ $itemCount++; } 

   $f = fopen(FEEDS_PATH.'rss.xml', "w+");

   // write old header and channel definition
   fwrite($f,$oldFeed[0]);
   fwrite($f,$oldFeed[1]);

   // write new item
   fwrite($f,$newItem);

   // write old items
   $i = 2;
   while ($i <= $itemCount){ fwrite($f,$oldFeed[$i]); $i++; }

   // write footer
   fwrite($f,$oldFeed[sizeof($oldFeed)-1]);
   fclose($f);
}


/* maybe useful for individual language implementation feeds

foreach($testNames as $lang => $ar){   
   asort($ar);
   foreach($ar as $k => $v){ 
      if (isset($desc)){ $desc = $desc.', '.$v; } else { $desc = $v; }
   }
   $langName = $Langs[$lang][LANG_FULL];

      // Is there a short URL for this language?
   if (strlen($Langs[$lang][LANG_SPECIALURL])>0){ 
      $link = $url.$Langs[$lang][LANG_SPECIALURL].".php";
   } else {
      $link = $url."benchmark.php?test=all&amp;lang=".$lang;
   }

   printf("<item><title>New %s measurements</title>",$langName);
   printf("<description>%s</description>",$desc);
   printf("<link>%s</link></item>\n",$link);

   unset($desc);
}
*/
?>
