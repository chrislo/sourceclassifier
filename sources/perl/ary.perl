#!/usr/bin/perl
# $Id: ary.perl,v 1.2 2004-05-22 07:25:00 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

# this program is modified from:
#   http://cm.bell-labs.com/cm/cs/who/bwk/interps/pap.html
# Timing Trials, or, the Trials of Timing: Experiments with Scripting
# and User-Interface Languages</a> by Brian W. Kernighan and
# Christopher J. Van Wyk.

my $n = @ARGV[0] || 1;
my @X;
my @Y;

my $last = $n - 1;
for my $i (0..$last) {
    $X[$i] = $i + 1;
}
for my $k (0..999) {
    for my $i (reverse 0..$last) {
	$Y[$i] += $X[$i];
    }
}

print "$Y[0] $Y[$last]\n";
