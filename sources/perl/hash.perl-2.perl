#!/usr/bin/perl
use integer;

$n = $ARGV[0] || 1;
%X = ();
$c = 0;
keys %X=$n;
for ($i=0; $i<$n;) {
    $X{sprintf('%x', $i)} = ++$i;
    $X{sprintf('%x', $i)} = ++$i;
    $X{sprintf('%x', $i)} = ++$i;
    $X{sprintf('%x', $i)} = ++$i;
}
for ($i=$n+1; $i>0;) {
    $c+=exists($X{--$i}) + exists($X{--$i}) + exists($X{--$i}) + exists($X{--$i});
}
print $c,"\n";
