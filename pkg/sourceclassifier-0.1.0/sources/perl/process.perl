#!/usr/bin/perl

# perl thread benchmark for The Great Computer Language Shootout
# http://shootout.alioth.debian.org/
# Contributed by Steve Clark

# perl threads creates an interpreter per thread so this won't
# be pretty.
use threads;

# The thread code blocks til it gets a message, then sends it
# Argument is reference to last thread
sub inc_thread {
    my $thr = shift;
    my ($num) = $thr->join;
    $num++;
    return ($num);
}

# special thread to kick off the chain
sub zero_thread {
    return (0);
}


# Algorithm:
#   Create n threads from 1 to n
#   Each thread x has ref to thread x-1
#   Creates extra zero_thread to send 0 to start of chain
#   prints return of last thread created

sub dothread {
    my $n = shift;
    my $thread = threads->new(\&zero_thread);

    for ($i = 1; $i <= $n; $i++) {
	$thread = threads->new(\&inc_thread, $thread);
    }

    # Now wait for end
    my $num = $thread->join;

    # print the result
    print "$num\n";
}


my $NUM = $ARGV[0];
$NUM = 1 if ($NUM < 1);
dothread ($NUM);
