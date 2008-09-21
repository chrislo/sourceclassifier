#!/usr/bin/perl 
# $Id: matrix.perl,v 1.1.1.1 2004-05-19 18:10:34 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

# This program based on the original from:
# "The What, Why, Who, and Where of Python" By Aaron R. Watters
# http://www.networkcomputing.com/unixworld/tutorial/005/005.html

# modified to pass rows and cols, and avoid matrix size checks
# I've sped up the original quite a bit by removing some loop
# invariants and declaring "use integer"

use strict;
use integer;

my $size = 30;

sub mkmatrix {
    my($rows, $cols) = @_;
    --$rows; --$cols;
    my $count = 1;
    my @mx = ();
    foreach (0 .. $rows) {
	my @row = ();
	$row[$_] = $count++ foreach (0 .. $cols);
	push(@mx, \@row);
    }
    return(\@mx);
}

sub mmult {
    my ($rows, $cols, $m1, $m2) = @_;
    my @m3 = ();
    --$rows; --$cols;
    for my $i (0 .. $rows) {
	my @row = ();
	my $m1i = $m1->[$i];
	for my $j (0 .. $cols) {
	    my $val = 0;
	    for my $k (0 .. $cols) {
		$val += $m1i->[$k] * $m2->[$k]->[$j];
	    }
	    push(@row, $val);
	}
	push(@m3, \@row);
    }
    return(\@m3);
}

my $N = $ARGV[0] || 1;

my $m1 = mkmatrix($size, $size);
my $m2 = mkmatrix($size, $size);
my $mm;
while ($N--) {
    $mm = mmult($size, $size, $m1, $m2);
}
print "$mm->[0]->[0] $mm->[2]->[3] $mm->[3]->[2] $mm->[4]->[4]\n";

