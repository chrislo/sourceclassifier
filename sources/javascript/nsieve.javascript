// The Great Computer Language Shootout
// http://shootout.alioth.debian.org/
//
// modified by Isaac Gouy


function pad(number,width){
   var s = number.toString();
   var prefixWidth = width - s.length;
   if (prefixWidth>0){
      for (var i=1; i<=prefixWidth; i++) s = " " + s;
   }
   return s;
}

function nsieve(m, isPrime){
   var i, k, count;

   for (i=2; i<=m; i++) { isPrime[i] = true; }
   count = 0;

   for (i=2; i<=m; i++){
      if (isPrime[i]) {
         for (k=i+i; k<=m; k+=i) isPrime[k] = false;
         count++;
      }
   }
   return count;
}


var n = arguments[0];
if (n<2) n = 2;

var m = (1<<n)*10000;
var flags = Array(m+1);

print("Primes up to " + pad(m,8) + " " +  pad(nsieve(m,flags),8));

m = (1<<n-1)*10000;
print("Primes up to " + pad(m,8) + " " +  pad(nsieve(m,flags),8));

m = (1<<n-2)*10000;
print("Primes up to " + pad(m,8) + " " +  pad(nsieve(m,flags),8));

