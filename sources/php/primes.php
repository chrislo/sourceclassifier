<?php

/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/
   contributed by Isaac Gouy
*/

function isPrime($k){
   if ($k < 2){ return False; }
   if ($k < 4){ return True; }
   if ($k%2 == 0){ return False; }
   if (($k+1)%6 != 0 && ($k-1)%6 != 0){ return False; }

   $limit = ceil(sqrt($k));
   for ($i = 5; $i <= $limit; $i += 2){
      if ($k % $i == 0) { return False; }
   }
   return True; 
}


function Prime($n){
   $count = 0;
   $primeNumber = 0;

   for ($k = 1; $count < $n; $k++){
      if (isPrime($k)) {
         $count++;
         $primeNumber = $k;
      }
   }
   return $primeNumber;
}


$n = $argv[1];

printf("1st prime is %d\n", Prime(1));
printf("2nd prime is %d\n", Prime(2));

for ($i = 10*$n; $i <= 50*$n; $i += 10*$n)
   printf("%dth prime is %d\n", $i, Prime($i));

?>
