#!/usr/bin/perl
# The Computer Language Shootout
# http://shootout.alioth.debian.org/
#
# Contributed by Doug King
# Corrected by Heiner Marxen

use integer;

sub item_check {
    my ($tree) = @_;

    return $$tree[2] unless (defined $$tree[0]);
    return $$tree[2] + item_check($$tree[0]) - item_check($$tree[1]);
}


sub bottom_up_tree {
    my($item, $depth) = @_;

    return [ undef, undef, $item ] if $depth <= 0;
    return [ bottom_up_tree(2 * $item - 1, $depth - 1),
	     bottom_up_tree(2 * $item,     $depth - 1),
	     $item ];
}


$n = shift @ARGV;

$min_depth = 4;

if ( ($min_depth + 2) > $n) {
    $max_depth = $min_depth + 2;
} else {
    $max_depth = $n;
}

$stretch_depth = $max_depth + 1;

$stretch_tree = bottom_up_tree(0, $stretch_depth);
print "stretch tree of depth $stretch_depth\t check: ", item_check($stretch_tree), "\n";
$stretch_tree = undef;

$long_lived_tree = bottom_up_tree(0, $max_depth);

$depth = $min_depth;
while( $depth <= $max_depth ) {

    $iterations = 2 ** ($max_depth - $depth + $min_depth);
    $check = 0;

    for $i (1..$iterations) {
	$temp_tree = bottom_up_tree($i, $depth);
	$check += item_check($temp_tree);
	$temp_tree = undef;

	$temp_tree = bottom_up_tree(-$i, $depth);
	$check += item_check($temp_tree);
	$temp_tree = undef;
    }

    print $iterations * 2, "\t trees of depth $depth\t check: ", $check, "\n";
    $depth += 2;
}

print "long lived tree of depth $max_depth\t check: ", item_check($long_lived_tree), "\n";
