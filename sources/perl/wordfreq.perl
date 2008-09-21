#!/usr/bin/perl
# $Id: wordfreq.perl,v 1.2 2004-07-03 05:36:11 bfulgham Exp $
# http://shootout.alioth.debian.org/

# Tony Bowden suggested using tr versus lc and split(/[^a-z]/)
# Some corrections to comply with tr/wc/sort "master" implementation

use strict;

my %count = ();
while (read(STDIN, $_, 4095) and $_ .= <STDIN>) {
    tr/A-Za-z/\n/cs;
    ++$count{$_} foreach split('\n', lc $_);
}

my @lines = ();
my ($w, $c);
while (($w, $c) = each(%count)) {
    next if ("$w" eq "");
    push(@lines, sprintf("%7d %s\n", $c, $w));
}
print sort { $b cmp $a } @lines;
