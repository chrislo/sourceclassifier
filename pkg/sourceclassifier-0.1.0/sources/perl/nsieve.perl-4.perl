# The Computer Language Benchmarks Game
# http://shootout.alioth.debian.org/
#
# contributed by David Pyke, March 2005
# optimized by Steffen Mueller, Sept 2007
# optimized by Laimonas Vėbra, Nov 2007

use integer;
use strict;


sub nsieve {
   my ($m) = @_;
   my $i, my $j, my $a;
   my $count = 0;
   
   $a = 0 x $m;

   for($i = 2; $i < $m; $i++) {
      if (substr($a, $i, 1) ne '1') {
         for ($j = $i + $i; $j < $m; $j += $i){
            substr($a, $j, 1) = '1';
         }
         ++$count;
      }
   }
   return $count;
}


sub nsieve_test {
   my($n) = @_;

   my $m = (1<<$n) * 10000;
   my $ncount= nsieve($m);
   printf "Primes up to %8u %8u\n", $m, $ncount;
}

my $N = ($ARGV[0] < 1) ? 1 : $ARGV[0];

nsieve_test($N);
nsieve_test($N-1)  if $N >= 1;
nsieve_test($N-2)  if $N >= 2;
