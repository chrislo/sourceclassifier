#!/usr/bin/perl
# $Id: fibo.perl,v 1.5 2005-04-25 19:01:38 igouy-guest Exp $
# http://www.bagley.org/~doug/shootout/

use strict;
use integer;

# from Leif Stensson
sub fib {
    return $_[0] < 2 ? 1 : fib($_[0]-2) + fib($_[0]-1);
}

my $N = ($ARGV[0] < 1) ? 1 : $ARGV[0];
my $fib = fib($N);
print "$fib\n";
