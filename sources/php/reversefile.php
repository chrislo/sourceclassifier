#!/usr/bin/php -f
<?php
/* The Great Computer Language Shootout
   http://shootout.alioth.debian.org/
   contributed by Isaac Gouy 

   php -q reversefile.php < in.txt > out.txt
*/ 


$fp = fopen("php://stdin", "r");
while ($b = fread($fp, 4096)) $blocks[]=$b;
fclose($fp);

$lines = explode("\n", implode('',$blocks));
$last = count($lines)-1;

// Skip the null char string terminator
if (ord($lines[$last])==0) $last--;  

for ($i=$last; $i>=0; $i--) echo $lines[$i], "\n";

?>
