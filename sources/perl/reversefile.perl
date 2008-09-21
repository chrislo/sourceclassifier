#!/usr/bin/perl
# $Id: reversefile.perl,v 1.2 2004-11-23 08:08:45 bfulgham Exp $
# http://shootout.alioth.debian.org/
# Revised by Soren Morton

undef($/);
print reverse( split(/^/, <STDIN>));
#print join("\n", reverse split(/\n/, <STDIN>)),"\n";
