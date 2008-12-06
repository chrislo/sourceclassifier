#!/usr/bin/perl 
# $Id: heapsort.perl,v 1.1.1.1 2004-05-19 18:10:10 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/
# Matt Harris suggested passing the array via typeglob

use strict;

use constant IM => 139968;
use constant IA =>   3877;
use constant IC =>  29573;

use vars qw(@ra);

my $LAST = 42;
sub gen_random { ($_[0] * ($LAST = ($LAST * IA + IC) % IM)) / IM }

sub heapsort ($\@) {
    my $n = shift;
    # use typeglob ra to refer to array.
    local *ra = shift;

    my($rra, $i, $j);

    my $l = ($n >> 1) + 1;
    my $ir = $n;
    while (1) {
	if ($l > 1) {
	    $rra = $ra[--$l];
	} else {
	    $rra = $ra[$ir];
	    $ra[$ir] = $ra[1];
	    if (--$ir == 1) {
		$ra[1] = $rra;
		return;
	    }
	}
	$i = $l;
	$j = $l << 1;
	while ($j <= $ir) {
	    $j++ if (($j < $ir) && ($ra[$j] < $ra[$j+1]));
	    if ($rra < $ra[$j]) {
		$ra[$i] = $ra[$j];
		$j += ($i = $j);
	    } else {
		$j = $ir + 1;
	    }
	}
	$ra[$i] = $rra;
    }
}


my $N = $ARGV[0];
$N = 1 if ($N < 1);

# create an array of N random doubles
my @ary = ();
for (my $i=1; $i<=$N; $i++) {
    $ary[$i] = gen_random(1.0);
}

heapsort($N, @ary);

printf("%.10f\n", $ary[-1]);

