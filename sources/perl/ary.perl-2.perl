#!/usr/bin/perl
# The Great Computer Language Shootout
# http://shootout.alioth.debian.org/
# Modified: 2005-06-18 Cosimo Streppone

use integer;

my $n = @ARGV[0] || 1;
my(@X, @Y, $i, $k);
my $last = $n - 1;

# Initialize @X list in a single step
@X = (1 .. $n);

# Execute 1000 times
for(0 .. 999) {
    # Use of `$_' aliasing is faster than using a lexical var
    # Also, there is no need to reverse (0 .. $last) list
    $Y[$_] += $X[$_] for 0 .. $last;
}

print $Y[0], ' ', $Y[$last], "\n";

