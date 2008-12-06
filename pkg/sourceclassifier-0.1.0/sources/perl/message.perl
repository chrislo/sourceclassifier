# The Computer Language Benchmarks Game
# http://shootout.alioth.debian.org/
# contributed by Sean O'Rourke

use threads;
use Thread::Queue;

my $t = 500;
my $n = shift;

my @q : shared;
@q = map { new Thread::Queue } 1..$t;

for my $i (1..$t-1) {
    (async {
        while (!$done) {
            $q[$i]->enqueue(1+$q[$i-1]->dequeue);
        }
    })->detach;
}

for (1..$n) {
    $q[0]->enqueue(0);
    $sum += $q[-1]->dequeue + 1;
}

print "$sum\n";
