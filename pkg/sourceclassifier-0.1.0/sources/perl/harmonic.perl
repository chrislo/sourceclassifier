#!/usr/bin/perl -w
# The Great Computer Language Shootout
# http://shootout.alioth.debian.org/
# contributed by Greg Buchholz

$sum += 1/$_ for 1..$ARGV[0];
printf "%.9f\n", $sum;