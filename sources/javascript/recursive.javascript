// The Computer Language Shootout
// http://shootout.alioth.debian.org/
// contributed by Isaac Gouy

function ack(m,n){
   if (m==0) { return n+1; }
   if (n==0) { return ack(m-1,1); }
   return ack(m-1, ack(m,n-1) );
}

function fib(n) {
    if (n < 2){ return 1; }
    return fib(n-2) + fib(n-1);
}

function tak(x,y,z) {
  if (y >= x) return z;
  return tak(tak(x-1,y,z), tak(y-1,z,x), tak(z-1,x,y));
}

var n = parseInt(arguments[0]);
print("Ack(3," + n + "): " + ack(3,n));
print("Fib(" + (27.0+n).toFixed(1) + "): " + fib(27.0+n).toFixed(1));
n--; print("Tak(" + 3*n + "," + 2*n + "," + n + "): " + tak(3*n,2*n,n));
print("Fib(3): " + fib(3));
print("Tak(3.0,2.0,1.0): " + tak(3.0,2.0,1.0).toFixed(1));
