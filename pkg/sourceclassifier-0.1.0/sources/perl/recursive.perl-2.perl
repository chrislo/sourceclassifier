# The Computer Language Shootout
# http://shootout.alioth.debian.org/
# recursive test, by Andreas Koenig, Sep 24 2006

### Uses temp variables to help perl free memory earlier

use strict;

sub Ack
{
	my ($x, $y) = @_;

	return $y + 1         if $x == 0;
	return Ack($x - 1, 1) if $y == 0;

        my $y2 = Ack($x, $y - 1);
	my $ret = Ack($x - 1, $y2);
        return $ret;
}

sub Fib
{
	my ($n) = @_;

	return 1 if $n < 2;

        my $f1 = Fib($n - 1);
        my $f2 = Fib($n - 2);
	return $f2 + $f1;
}

sub Tak
{
	my ($x, $y, $z) = @_;

        if ($y < $x) {
          my $z1 = Tak($x - 1.0, $y, $z);
          my $z2 = Tak($y - 1.0, $z, $x);
          my $z3 = Tak($z - 1.0, $x, $y);
          my $ret = Tak($z1, $z2, $z3);
          return $ret;
        } else {
          return $z;
        }
}

my $n = ($ARGV[0] || 0) - 1;
printf "Ack(%d,%d): %d\n",
	3, $n + 1, Ack(3, $n + 1);
printf "Fib(%.1f): %.1f\n",
	28.0 + $n, Fib(28.0 + $n);
printf "Tak(%d,%d,%d): %d\n",
	$n * 3, $n * 2, $n, Tak($n * 3, $n * 2, $n);
printf "Fib(%d): %d\n",
	3, Fib(3);
printf "Tak(%.1f,%.1f,%.1f): %.1f\n",
	3.0,2.0,1.0, Tak(3.0,2.0,1.0);
