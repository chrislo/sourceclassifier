# The Computer Language Shootout
# http://shootout.alioth.debian.org/
# Initial port from C by Steve Clark
# Rewrite by Kalev Soikonen

sub fannkuch {
    my ($n) = shift;
    my ($iter, $flips, $maxflips, $i);
    my (@q, @p, @count);

    $iter = $maxflips = 0;
    @p = @count = (1..$n);

    TRY: while (1) {
	print @p, "\n" if ($iter++ < 30);

#	splice @count, 0, $i, (1..$i);

	$flips = 0;
	for (@q = @p; $q[0] != 1; ) {
	    unshift @q, reverse splice @q, 0, $q[0];
	    $flips++;
	}
	$maxflips = $flips if ($flips > $maxflips);

	for ($i = 1; $i < $n; $i++) {
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

