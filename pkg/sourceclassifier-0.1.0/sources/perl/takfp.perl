#!/usr/bin/perl -w 
# http://shootout.alioth.debian.org
# 
# Perl dies from lack of memory while computing the recursive
# tak function.  So here's a version that can compute the benchmark
# in constant time.
#
# by Greg Buchholz


$n=shift;
printf "%.1f\n", tak($n);

sub tak
{   
    my $z=shift;

    return $z   if($z<0);
    return 2*$z if(int($z)==$z && $z%2);
    return $z+1 if(int($z)==$z && !($z%2));
    return 2*$z if(!(int($z)%2));
    return int($z)+2*($z-int($z));
}
