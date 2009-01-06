#!/usr/bin/php -f
<?php
/* The Great Computer Language Shootout
   http://shootout.alioth.debian.org/
   contributed by Isaac Gouy 

   php -q spellcheck.php < input.txt
*/ 


$fp = fopen("Usr.Dict.Words", "r");
while ($line = fgets($fp, 128)) { $dict[chop($line)] = 1; }
fclose($fp);


$fp = fopen("php://stdin", "r");
while ($line = fgets($fp, 128)) {
    $line = chop($line);

    if (!isset($dict[$line])) print "$line\n";
}
fclose($fp);

?>
