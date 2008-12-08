// The Computer Language Shootout
// http://shootout.alioth.debian.org/
// contributed by Isaac Gouy

var n = arguments[0]; 
var a1 = a2 = a3 = a4 = a5 = a6 = a7 = a8 = a9 = 0.0;   
var twothirds = 2.0/3.0;
var alt = -1.0;
var k2 = k3 = sk = ck = 0.0;

for (var k = 1; k <= n; k++){
   k2 = k*k;
   k3 = k2*k;
   sk = Math.sin(k);
   ck = Math.cos(k);
   alt = -alt;

   a1 += Math.pow(twothirds,k-1);
   a2 += Math.pow(k,-0.5);
   a3 += 1.0/(k*(k+1.0));
   a4 += 1.0/(k3 * sk*sk);
   a5 += 1.0/(k3 * ck*ck);
   a6 += 1.0/k;
   a7 += 1.0/k2;
   a8 += alt/k;
   a9 += alt/(2*k -1);
}
print(a1.toFixed(9) + "\t(2/3)^k");
print(a2.toFixed(9) + "\tk^-0.5");
print(a3.toFixed(9) + "\t1/k(k+1)");
print(a4.toFixed(9) + "\tFlint Hills");
print(a5.toFixed(9) + "\tCookson Hills");
print(a6.toFixed(9) + "\tHarmonic");
print(a7.toFixed(9) + "\tRiemann Zeta");
print(a8.toFixed(9) + "\tAlternating Harmonic");
print(a9.toFixed(9) + "\tGregory");
