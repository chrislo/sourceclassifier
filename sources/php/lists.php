#!/usr/bin/php -f
<?
/* The Great Computer Language Shootout
   http://shootout.alioth.debian.org/
   contributed by Isaac Gouy 

   php -q lists.php 18
*/ 


$n = ($argc == 2) ? $argv[1] : 1;
$size = 10000;
$L1Size = 0;

while ($n--){
   $L1 = range(1,$size);
   $L2 = $L1;
   $L3 = array();

   while ($L2) array_push($L3, array_shift($L2));
   while ($L3) array_push($L2, array_pop($L3));   
   $L1 = array_reverse($L1);
   
   if ($L1[0] != $size){
      print "First item of L1 != SIZE\n"; break; }
   
   for ($i=0; $i<$size; $i++)   
      if ($L1[$i] != $L2[$i]){ print "L1 != L2\n"; break 2; }
    
   $L1Size = sizeof($L1);
   unset($L1); unset($L2); unset($L3);
}
print "$L1Size\n";

?>
