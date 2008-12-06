#!/usr/bin/perl
# $Id: hash2.perl,v 1.1.1.1 2004-05-19 18:10:02 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/
# with help from Steve Fink

use strict;

my $n = ($ARGV[0] > 0) ? $ARGV[0] : 1;
my %hash1 = ();
$hash1{"foo_$_"} = $_ for 0..9999;
my %hash2 = ();
my($k, $v);
for (1..$n) {
    $hash2{$_} += $hash1{$_} while (defined ($_ = each %hash1));
}
print "$hash1{foo_1} $hash1{foo_9999} $hash2{foo_1} $hash2{foo_9999}\n";
