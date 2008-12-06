#!/usr/bin/perl
# $Id: nestedloop.perl,v 1.1.1.1 2004-05-19 18:10:57 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

use strict;

my $n = ($ARGV[0] > 0) ? $ARGV[0] : 1;
my $x = 0;
my $a = $n;
while ($a--) {
    my $b = $n;
    while ($b--) {
	my $c = $n;
	while ($c--) {
	    my $d = $n;
	    while ($d--) {
		my $e = $n;
		while ($e--) {
		    my $f = $n;
		    while ($f--) {
			$x++;
		    }
		}
	    }
	}
    }
}
print "$x\n";
