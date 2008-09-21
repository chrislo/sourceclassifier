#  The Computer Language Benchmarks Game
#  http://shootout.alioth.debian.org/

#  contributed by Richard Cottrill


use strict;
use warnings;
use threads;
use threads::shared;
use Thread::Semaphore;

my $numThreads	:shared;
my $data	:shared;
my $result	:shared;
my @mutex	:shared;

$numThreads = 503;

sub thr_func {
  my ($nextThread, $thr_name);
  $thr_name = threads->tid();
  threads->detach();
  if ($thr_name == $numThreads) {
    $nextThread = 1;
  }
  else {
    $nextThread = $thr_name + 1;
  }
  while (1) {
    $mutex[$thr_name]->down();
    if ($data) {
      $data = --$data;
      $mutex[$nextThread]->up();
    }
    else {
      $result = $thr_name;
      $mutex[0]->up();
    }
  } 
}

$data = $ARGV[0];

$mutex[0] = new Thread::Semaphore(0);
{
  for (1 .. $numThreads) {
    $mutex[$_] = new Thread::Semaphore(0);
    threads->create(\&thr_func);
  }
}
$mutex[1]->up();
$mutex[0]->down();
print "$result\n";
exit(0);
