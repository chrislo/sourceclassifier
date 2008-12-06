# The Computer Language Shootout
# http://shootout.alioth.debian.org/
# contributed by Danny Sauer
# completely rewritten and
# cleaned up for speed and fun by
# Mirco Wahab (wahab@chemie.uni-halle.de)

use strict;
use warnings;
use re 'eval';

my $content =  do { local $/; <STDIN> };
my $l_file  =  length $content;
my $dispose =  qr/^>.*$|\n/m;
   $content =~ s/$dispose//g;
my $l_code  =  length $content;

my @seq = ( 'agggtaaa|tttaccct',
        '[cgt]gggtaaa|tttaccc[acg]',
        'a[act]ggtaaa|tttacc[agt]t',
        'ag[act]gtaaa|tttac[agt]ct',
        'agg[act]taaa|ttta[agt]cct',
        'aggg[acg]aaa|ttt[cgt]ccct',
        'agggt[cgt]aa|tt[acg]accct',
        'agggta[cgt]a|t[acg]taccct',
        'agggtaa[cgt]|[acg]ttaccct' );

my @cnt = (0) x @seq;
for my $k (0..$#seq) {
  ++$cnt[$k] while $content=~/$seq[$k]/gi;
  printf "$seq[$k] $cnt[$k]\n"
}

my %iub = (         B => '(c|g|t)',  D => '(a|g|t)',
  H => '(a|c|t)',   K => '(g|t)',    M => '(a|c)',
  N => '(a|c|g|t)', R => '(a|g)',    S => '(c|g)',
  V => '(a|c|g)',   W => '(a|t)',    Y => '(c|t)' );

my $findiub = '(['.(join '', keys %iub).'])';

1 while $content =~ s/$findiub/$iub{$1}/og;
printf "\n%d\n%d\n%d\n", $l_file, $l_code, length $content;

