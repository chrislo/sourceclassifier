#!/usr/bin/perl 
# $Id: sieve.perl,v 1.1.1.1 2004-05-19 18:12:27 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/
# with help from Tony Bowden

use strict;
use integer;

my $NUM = ($ARGV[0] < 1) ? 1 : $ARGV[0];
my $count;
my @flags = ();
while ($NUM--) {
    $count = 0; 
    my @flags = (0 .. 8192);
    for my $i (2 .. 8192 ) {
	next unless defined $flags[$i];
	# remove all multiples of prime: i
	my $k = $i;
	undef $flags[$k] while (($k+=$i) < 8193);
	$count++;
    }
}
print "Count: $count\n";
