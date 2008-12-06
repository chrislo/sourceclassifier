#!/usr/bin/perl
# The Computer Language Shootout
# http://shootout.alioth.debian.org/
# by Greg Buchholz
# memory consumption fixed by Danny Sauer

my $n = $ARGV[0];
sub takfp($$$);

printf "%.1f\n", takfp(3*$n, 2*$n, $n);

sub takfp($$$)
{
   return ($_[1] >= $_[0]) ? 
           $_[2] : 
           takfp( takfp($_[0]-1.0, $_[1], $_[2]),
                  takfp($_[1]-1.0, $_[2], $_[0]),
                  takfp($_[2]-1.0, $_[0], $_[1])
              )
}
