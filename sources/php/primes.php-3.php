<?php

/* The Computer Language Benchmarks Game 
   http://shootout.alioth.debian.org/
   contributed by Isaac Gouy
*/

function Prime($n){
   $count = 0;
   $primeNumber = 0;

   if ($n < 2){
      if ($n == 1){ $count = 1; $primeNumber = 2; }
   } 
   else { 
      $count = 2; $primeNumber = 3; 
   }

   for ($k = 5; $count < $n; $k += 2){

      if (($k+1)%6 == 0 || ($k-1)%6 == 0){

         $isTrivial = True;
         $limit = ceil(sqrt($k));

         for ($i = 5; $i <= $limit; $i += 2)
            if ($k % $i == 0) { $isTrivial = False; break; }

         if ($isTrivial) {
            $count++;
            $primeNumber = $k;
         }
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
