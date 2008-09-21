#!/usr/bin/perl
# $Id: hash.perl-3.perl,v 1.1 2004-11-10 06:34:44 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

# this program is modified from:
#   http:#cm.bell-labs.com/cm/cs/who/bwk/interps/pap.html
# Timing Trials, or, the Trials of Timing: Experiments with Scripting
# and User-Interface Languages</a> by Brian W. Kernighan and
# Christopher J. Van Wyk.

use strict;

my $n = $ARGV[0] || 1;
my %X = ();
keys %X = $n / 3;
my $c = 0;

for my $i (1..$n) {
    $X{sprintf('%x', $i)} = $i;
}
for my $i (reverse 1..$n) {
    ++$c if exists $X{$i};
}
print "$c\n";
