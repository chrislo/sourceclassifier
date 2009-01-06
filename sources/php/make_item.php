#!/usr/bin/php 
<?
// Copyright (c) Isaac Gouy 2005
// Run from shootout directory

// take 3 commandline args - $title, $desc, $url
// add them to RSS feed as a new RSS item


$title = $argv[1];
$desc = $argv[2];
$url = $argv[3];

$newItem = "<item><title>".$title."</title>";
$newItem .= "<description>".$desc."</description>";
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

?>