#!/usr/bin/perl
# $Id: ackermann.perl-3.perl,v 1.1 2005-04-27 16:51:28 greg-guest Exp $
# http://www.bagley.org/~doug/shootout/

# We avoid using memoize by inlining the cache
# from Thomas Drugeon

# in our quest for speed, we must get ugly:
# it helps reduce stack frame size a little bit
# from Leif Stensson
sub Ack {
    $_[0] ? ($Ack[$_[0]][$_[1]] ||= $_[1] ? Ack($_[0]-1, Ack($_[0], $_[1]-1))
		    : Ack($_[0]-1, 1))
	: $_[1]+1;
}

my $NUM = $ARGV[0];
$NUM = 1 if ($NUM < 1);
my $ack = Ack(3, $NUM);
print "Ack(3,$NUM): $ack\n";