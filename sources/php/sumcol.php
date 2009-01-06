#!/usr/bin/php -f
<?php
/* The Great Computer Language Shootout
   http://shootout.alioth.debian.org/
   contributed by Isaac Gouy 

   php -q sumcol.php < in.txt
*/ 


$sum = 0;

$fp = fopen("php://stdin", "r");
while ($line = fgets($fp, 128)) $sum += intval($line); 
fclose($fp);

print "$sum\n"; 

?>
