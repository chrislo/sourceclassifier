#!/usr/bin/perl
# $Id: ackermann.perl-2.perl,v 1.1 2005-04-04 14:56:35 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

# With help from Ernesto Hernandez-Novich
use integer;

# Note:  If memoization were allowed in this program, we could
# do so by adding:
use Memoize;
memoize("Ack");

# in our quest for speed, we must get ugly:
# it helps reduce stack frame size a little bit
# from Leif Stensson
sub Ack {
    return $_[0] ? ($_[1] ? Ack($_[0]-1, Ack($_[0], $_[1]-1))
		    : Ack($_[0]-1, 1))
	: $_[1]+1;
}

my $NUM = $ARGV[0];
$NUM = 1 if ($NUM < 1);
my $ack = Ack(3, $NUM);
print "Ack(3,$NUM): $ack\n";
