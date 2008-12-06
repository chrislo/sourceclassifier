# The Computer Language Shootout
# http://shootout.alioth.debian.org/
# Contributed by Kjetil Skotheim

use constant {IM => 139968, IA => 3877, IC => 29573};
my $LAST=42;

sub gen_random {
  my ($n,$max) = @_;
  use integer;
  $LAST = ($LAST * IA + IC) % IM for 1..$n;
  no integer;
  return $max * $LAST / IM;
}

printf "%.9f\n", gen_random($ARGV[0] || 1, 100.0);

