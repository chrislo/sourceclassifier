#!/usr/bin/perl
# The Great Win32 Computer Language Shootout
# http://shootout.alioth.debian.org/
# modified by Isaac Gouy

use integer;

sub Ack {
    my($M, $N) = @_;
    return( $N + 1 )         if ($M == 0);
    return( Ack($M - 1, 1) ) if ($N == 0);
    Ack($M - 1, Ack($M, $N - 1));
}

my $NUM = $ARGV[0];
$NUM = 1 if ($NUM < 1);
my $ack = Ack(3, $NUM);
print "Ack(3,$NUM): $ack\n";
