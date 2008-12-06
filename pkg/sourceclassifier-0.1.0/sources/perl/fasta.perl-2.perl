#!/usr/bin/perl

# The Great Computer Language Shootout
# http://shootout.alioth.debian.org/
#
# contributed by David Pyke
# tweaked by Danny Sauer

use constant IM => 139968;
use constant IA => 3877;
use constant IC => 29573;

use constant LINELENGTH => 60;

my $LAST = 42;
sub gen_random ($) {
    return ( ($_[0] * ($LAST = ($LAST * IA + IC) % IM)) / IM );
}

sub makeCumulative($){
    my($genelist) = @_;
    $cp = 0.0;

    foreach (@$genelist){
        $_->[1] = $cp += $_->[1];
    }
}

sub selectRandom($){
    my($genelist) = @_;
    $r = gen_random (1);

    foreach (@$genelist){
        if ($r < $_->[1]){ return $_->[0]; }
    }
}


sub makeRandomFasta($$$$){
#void makeRandomFasta (const char * id, const char * desc, const struct aminoacids * genelist, int count, int n) {
    my($id,$desc,$n,$genelist) = @_;

    print ">$id $desc\n";
    $pick='';

    # print whole lines
    foreach (1 .. int($n / LINELENGTH) ){
        foreach (1 ..  LINELENGTH ){
            $pick .= selectRandom($genelist);
        }
        print "$pick\n";
        $pick = '';
    }
    #print remaining line (if required)
    if ($n % LINELENGTH){
        foreach (1 ..  $n % LINELENGTH ){
            $pick .= selectRandom($genelist);
        }
        print "$pick\n";
    }
}

sub makeRepeatFasta($$$$){
#void makeRepeatFasta (const char * id, const char * desc, const char * s, int n) {
    # we want to print $n characters of $s (repeated if nessary) with newlines every LINELENGTH
    my($id,$desc,$s,$n) = @_;

    print ">$id $desc\n";

    # what we need, and the extra (if any) will be discarded.
    foreach (1 .. int($n / LINELENGTH) ){
        while (length $ss < LINELENGTH){
            $ss .= $s;
        }
        print substr($ss,0,LINELENGTH), "\n";
        $ss = substr($ss,LINELENGTH);
    }
    #final_line
    while (length $ss < LINELENGTH){
        $ss .= $s;
    }
    print substr($ss, 0, ($n % LINELENGTH)), "\n";
print STDERR "\n";
}


my $iub = [
    [ 'a', 0.27 ],
    [ 'c', 0.12 ],
    [ 'g', 0.12 ],
    [ 't', 0.27 ],
    [ 'B', 0.02 ],
    [ 'D', 0.02 ],
    [ 'H', 0.02 ],
    [ 'K', 0.02 ],
    [ 'M', 0.02 ],
    [ 'N', 0.02 ],
    [ 'R', 0.02 ],
    [ 'S', 0.02 ],
    [ 'V', 0.02 ],
    [ 'W', 0.02 ],
    [ 'Y', 0.02 ]
];

my $homosapiens = [
    [ 'a', 0.3029549426680 ],
    [ 'c', 0.1979883004921 ],
    [ 'g', 0.1975473066391 ],
    [ 't', 0.3015094502008 ]
];

$alu =
    'GGCCGGGCGCGGTGGCTCACGCCTGTAATCCCAGCACTTTGG' .
    'GAGGCCGAGGCGGGCGGATCACCTGAGGTCAGGAGTTCGAGA' .
    'CCAGCCTGGCCAACATGGTGAAACCCCGTCTCTACTAAAAAT' .
    'ACAAAAATTAGCCGGGCGTGGTGGCGCGCGCCTGTAATCCCA' .
    'GCTACTCGGGAGGCTGAGGCAGGAGAATCGCTTGAACCCGGG' .
    'AGGCGGAGGTTGCAGTGAGCCGAGATCGCGCCACTGCACTCC' .
    'AGCCTGGGCGACAGAGCGAGACTCCGTCTCAAAAA';

######################################################################
#main

my $n = ($ARGV[0] || 1000) ;

makeCumulative $iub;
makeCumulative $homosapiens;

makeRepeatFasta ('ONE', 'Homo sapiens alu', $alu, $n*2);
makeRandomFasta ('TWO', 'IUB ambiguity codes', $n*3, $iub);
makeRandomFasta ('THREE', 'Homo sapiens frequency', $n*5, $homosapiens);

exit 0;

#END OF FILE
