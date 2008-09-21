#!/usr/bin/perl
# $Id: prodcons.perl,v 1.3 2005-05-13 16:24:18 igouy-guest Exp $
# http://www.bagley.org/~doug/shootout/ 

use strict;
use Thread qw(cond_wait cond_signal);

my $count = 0;
my $data = 0;
my $produced = 0;
my $consumed = 0;

sub consumer {
    my $n = shift;
    while (1) {
	lock($count);
	cond_wait($count) while ($count == 0);
	my $i = $data;
	$count = 0;
	$consumed++;
	last if ($i == $n);
	cond_signal($count);
    }
}

sub producer {
    my $n = shift;
    for (my $i=1; $i<=$n; $i++) {
	lock($count);
	cond_wait($count) while ($count == 1);
	$data = $i;
	$count = 1;
	$produced++;
	cond_signal($count);
    }
}

sub main {
    my $n = ($ARGV[0] < 1) ? 1 : $ARGV[0];
    my $p = Thread->new(\&producer, $n);
    my $c = Thread->new(\&consumer, $n);
    $p->join;
    $c->join;
    print "$produced $consumed\n";
}

&main();
