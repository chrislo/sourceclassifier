# The Computer Language Shootout
# http://shootout.alioth.debian.org/
# contributed by Danny Sauer
# completely rewritten and
# cleaned up for speed and fun by
# Mirco Wahab (wahab@chemie.uni-halle.de)
#
# Rewritten for speed sextuplication by
# Emanuele Zeppieri

use strict;

my $input = do { local $/; <STDIN> };
my $file_length = length $input;

$input =~ s/^>.*$//mg;
$input =~ tr/\n//d;

my $seq_length = length $input;

my $input_lc = lc $input;

for (
        'agggtaaa|tttaccct',
    '[cgt]gggtaaa|tttaccc[acg]',
    'a[act]ggtaaa|tttacc[agt]t',
    'ag[act]gtaaa|tttac[agt]ct',
    'agg[act]taaa|ttta[agt]cct',
    'aggg[acg]aaa|ttt[cgt]ccct',
    'agggt[cgt]aa|tt[acg]accct',
    'agggta[cgt]a|t[acg]taccct',
    'agggtaa[cgt]|[acg]ttaccct'
) {
    my ($r1, $r2) = split /\|/;
    my $count;
    $count++ while $input_lc =~ /$r1/g;
    $count++ while $input_lc =~ /$r2/g;
    print "$_ $count\n"
}

my %iub = (
    B => '(c|g|t)', D => '(a|g|t)', H => '(a|c|t)'  ,
    K => '(g|t)'  , M => '(a|c)'  , N => '(a|c|g|t)',
    R => '(a|g)'  , S => '(c|g)'  , V => '(a|c|g)'  ,
    W => '(a|t)'  , Y => '(c|t)'
);
my $findiub = '([' . join('', keys %iub) . '])';
$input =~ s/$findiub/$iub{$1}/og;

printf "\n%d\n%d\n%d\n", $file_length, $seq_length, length $input;
