#  The Computer Language Benchmarks Game
#  http://shootout.alioth.debian.org/

# contributed by Marc Lehmann

use strict;
use Coro;
use Coro::Semaphore;

my $threads = 503;
my $result;
my @data = $ARGV[0];
my @mutex;

sub thr_func {
   my ($id, $next) = @_;

   my $next = ($id + 1) % $threads;
  
   while () {
      $mutex[$id]->down;

      if ($data[$id]) {
        $data[$next] = $data[$id] - 1;
        $mutex[$next]->up;
      } else {
        $result = $next;
        print "$next\n";
        exit;
     }
   }
}


for (0 .. $threads - 1) {
   $mutex[$_] = new Coro::Semaphore 0;
   async \&thr_func, $_;
}

$mutex[0]->up;
schedule;


