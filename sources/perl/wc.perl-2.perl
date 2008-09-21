#!/usr/bin/perl
#   The Computer Language Shootout
#   http://shootout.alioth.debian.org/
#   contributed by Cosimo Streppone

use strict;
my($nl, $nw, $nc);
while (read(STDIN, $_, 4095)) {
    $_ .= <STDIN>;
    $nc += length;
    $nw += scalar split;
    $nl += tr/\n/\n/;
}
print "$nl $nw $nc\n";
