# The Computer Language Benchmarks Game
# http://shootout.alioth.debian.org/
# contributed by Danny Sauer
# modified by Mirco Wahab
# modified by Steffen Mueller
# modified by Kuang-che Wu

use strict;
use warnings;

my $content =  do { local $/; <STDIN> };
my $l_file  =  length $content;
$content =~ s/^>.*$//mg;
$content =~ s/\n//g;
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
for (0..$#seq) {
  my ($l, $r) = map {qr/$_/} split /\|/, $seq[$_];
  $cnt[$_] += (() = ($content=~/$l/gi, $content=~/$r/gi));
  print $seq[$_], ' ', $cnt[$_], "\n";
}

my %iub = (         B => '(c|g|t)',  D => '(a|g|t)',
  H => '(a|c|t)',   K => '(g|t)',    M => '(a|c)',
  N => '(a|c|g|t)', R => '(a|g)',    S => '(c|g)',
  V => '(a|c|g)',   W => '(a|t)',    Y => '(c|t)' );

my $findiub = '(['.(join '', keys %iub).'])';

$content =~ s/$findiub/$iub{$1}/g;
print "\n", $l_file, "\n", $l_code, "\n", length($content), "\n";

