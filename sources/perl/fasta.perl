# The Computer Language Shootout
# http://shootout.alioth.debian.org/
#
# contributed by David Pyke
# tweaked by Danny Sauer
# Butchered by Jesse Millikan

use constant IM => 139968;
use constant IA => 3877;
use constant IC => 29573;

use constant LINELENGTH => 60;

my $LAST = 42;

sub makeCumulative {
    my($genelist) = @_;
    my $cp = 0.0;

    foreach (@$genelist){
        $_->[1] = $cp += $_->[1];
    }
}

sub makeRandomFasta {
    my($id,$desc,$n,$genelist) = @_;

    print ">$id $desc\n";
    my $pick, $r;

	while($n > 0){
		$pick='';

		# Get LINELENGTH chars or what's left of $n
        CHAR: foreach (1 .. ($n > LINELENGTH ? LINELENGTH : $n)){
    		$rand = ($LAST = ($LAST * IA + IC) % IM) / IM;

			# Select gene and append it
    		foreach (@$genelist){
				if($rand < $_->[1]){
					$pick .= $_->[0];
					next CHAR;
				}
    		}
        }

        print "$pick\n";
		$n -= LINELENGTH;
    }
}

# Print $n characters of $s (repeated if nessary) with newlines every LINELENGTH
sub makeRepeatFasta {
    my($id,$desc,$s,$n) = @_;

    print ">$id $desc\n";

	my $ss;
	while($n > 0){
		# Overfill $ss with $s
		$ss .= $s while length $ss < LINELENGTH;
		# Print LINELENGTH chars or whatever's left of $n
        print substr($ss,0,$n > LINELENGTH ? LINELENGTH : $n,""), "\n";
		$n -= LINELENGTH;
	}
}

my $iub = [
    [a, 0.27],
    [c, 0.12],
    [g, 0.12],
    [t, 0.27],
    [B, 0.02],
    [D, 0.02],
    [H, 0.02],
    [K, 0.02],
    [M, 0.02],
    [N, 0.02],
    [R, 0.02],
    [S, 0.02],
    [V, 0.02],
    [W, 0.02],
    [Y, 0.02]
];

my $homosapiens = [
    [a, 0.3029549426680],
    [c, 0.1979883004921],
    [g, 0.1975473066391],
    [t, 0.3015094502008]
];

$alu =
    'GGCCGGGCGCGGTGGCTCACGCCTGTAATCCCAGCACTTTGG' .
    'GAGGCCGAGGCGGGCGGATCACCTGAGGTCAGGAGTTCGAGA' .
    'CCAGCCTGGCCAACATGGTGAAACCCCGTCTCTACTAAAAAT' .
    'ACAAAAATTAGCCGGGCGTGGTGGCGCGCGCCTGTAATCCCA' .
    'GCTACTCGGGAGGCTGAGGCAGGAGAATCGCTTGAACCCGGG' .
    'AGGCGGAGGTTGCAGTGAGCCGAGATCGCGCCACTGCACTCC' .
    'AGCCTGGGCGACAGAGCGAGACTCCGTCTCAAAAA';

#main

my $n = ($ARGV[0] || 1000) ;

makeCumulative $iub;
makeCumulative $homosapiens;

makeRepeatFasta ('ONE', 'Homo sapiens alu', $alu, $n*2);
makeRandomFasta ('TWO', 'IUB ambiguity codes', $n*3, $iub);
makeRandomFasta ('THREE', 'Homo sapiens frequency', $n*5, $homosapiens);

