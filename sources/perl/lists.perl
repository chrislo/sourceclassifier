#!/usr/bin/perl 
# $Id: lists.perl,v 1.1.1.1 2004-05-19 18:10:24 bfulgham Exp $
use strict;

my $SIZE = 10000;

my $ITER = $ARGV[0];
$ITER = 1 if ($ITER < 1);

my $result = 0;
while ($ITER--) {
    $result = &test_lists();
}
print "$result\n";

sub test_lists {
    # create a list of integers (Li1) from 1 to SIZE
    my @Li1 = (1..$SIZE);
    # copy the list to Li2 (not by individual items)
    my @Li2 = @Li1;
    my @Li3 = ();
    # remove each individual item from left side of Li2 and
    # append to right side of Li3 (preserving order)
    push(@Li3, shift @Li2) while (@Li2);
    # Li2 must now be empty
    # remove each individual item from right side of Li3 and
    # append to right side of Li2 (reversing list)
    push(@Li2, pop @Li3) while (@Li3);
    # Li3 must now be empty
    # reverse Li1 in place
    @Li1 = reverse @Li1;
    # check that first item is now SIZE
    return(0) if $Li1[0] != $SIZE;
    # compare Li1 and Li2 for equality
    my $len1 = scalar(@Li1);
    my $len2 = scalar(@Li2);
    my $lists_equal = ($len1 == $len2);
    return(0) if not $lists_equal;
    for my $i (0..($len1-1)) {
	if ($Li1[$i] != $Li2[$i]) {
	    $lists_equal = 0;
	    last;
	}
    }
    return(0) if not $lists_equal;
    # return the length of the list
    return($len1);
}
