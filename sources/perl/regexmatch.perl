#!/usr/bin/perl 
# $Id: regexmatch.perl,v 1.1.1.1 2004-05-19 18:11:25 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

use strict;

my $re = qr{
    (?: ^ | [^\d\(])		# must be preceeded by non-digit
    ( \( )?			# match 1: possible initial left paren
    (\d\d\d)			# match 2: area code is 3 digits
    (?(1) \) )			# if match1 then match right paren
    [ ]				# area code followed by one space
    (\d\d\d)			# match 3: prefix of 3 digits
    [ -]			# separator is either space or dash
    (\d\d\d\d)			# match 4: last 4 digits
    \D				# must be followed by a non-digit
}x;

my $NUM = $ARGV[0];
$NUM = 1 if ($NUM < 1);

my @phones = <STDIN>;
my $count = 0;
my $num;
while ($NUM--) {
    foreach (@phones) {
	if (/$re/o) {
	    $num = "($2) $3-$4";
	    if (0 == $NUM) {
		$count++;
		print "$count: $num\n";
	    }
	}
    }
}
