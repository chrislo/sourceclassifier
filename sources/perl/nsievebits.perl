#!/usr/bin/perl

# The Great Computer Language Shootout
# http://shootout.alioth.debian.org/
# nsieve-bits benchmark
# contributed by Joel Hoffman, 2005-03-28

use strict;

sub nsieve {
   my $mx = shift;
   vec(my $vec,$mx,1)=0;
   my $count=0;
   for my $idx (2..$mx) {   
      unless (vec($vec,$idx,1)) {
         $count++;
         for (my $i=2 * $idx; $i<=$mx; $i+=$idx) {
            vec($vec,$i,1)=1;
         }
      }
   }
   $count;
}

sub test {
   my $n = shift;
   my $mx = 10000 * (2**$n);
   printf "Primes up to %8d %8d\n",$mx,nsieve($mx);
}

for (0,1,2) {
   if ($ARGV[0] > $_) {
      test($ARGV[0] - $_)
   }
}


