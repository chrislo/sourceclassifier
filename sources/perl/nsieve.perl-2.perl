# The Computer Language Benchmarks Game
# http://shootout.alioth.debian.org/
#
# contributed by David Pyke, March 2005
# optimized by Steffen Mueller, Sept 2007

use integer;
use strict;

sub nsieve {
   my ($m) = @_;
   my @a = (1) x $m;

   my $count = 0;
   foreach my $i (2..$m-1) {
      if ($a[$i]) {
         for (my $j = $i + $i; $j < $m; $j += $i){
            $a[$j] = 0;
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


