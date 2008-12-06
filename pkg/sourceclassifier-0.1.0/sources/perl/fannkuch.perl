# The Computer Language Benchmarks Game
# http://shootout.alioth.debian.org/
# Initial port from C by Steve Clark
# Rewrite by Kalev Soikonen
# Modified by Kuang-che Wu

use integer;

sub fannkuch {
    my ($n) = shift;
    my ($iter, $flips, $maxflips, $i);
    my (@q, @p, @count);

    $iter = $maxflips = 0;
    @p = @count = (1..$n);
    $m = $n - 1;

    TRY: while (1) {
	if ($iter < 30) {
	    print @p, "\n";
	    $iter++;
	}

	if ($p[0] != 1 && $p[$m] != $n) {
	    @q = @p;
	    for ($flips=0; $q[0] != 1; $flips++) {
		unshift @q, reverse splice @q, 0, $q[0];
	    }
	    $maxflips = $flips if ($flips > $maxflips);
	}

	for my$i(1..$m) {
	    splice @p, $i, 0, shift @p;
	    next TRY if (--$count[$i]);
	    $count[$i] = $i + 1;
	}
	return $maxflips;
    }
}

for (shift || 7) {
    print "Pfannkuchen($_) = ".fannkuch($_)."\n";
}

