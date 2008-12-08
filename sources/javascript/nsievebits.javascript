// The Great Computer Language Shootout
//  http://shootout.alioth.debian.org
//
//  Contributed by Ian Osgood

function pad(n,width) {
  var s = n.toString();
  while (s.length < width) s = ' ' + s;
  return s;
}

function primes(isPrime, n) {
  var i, count = 0, m = 10000<<n, size = m+31>>5;

  for (i=0; i<size; i++) isPrime[i] = 0xffffffff;
  
  for (i=2; i<m; i++)
    if (isPrime[i>>5] & 1<<(i&31)) {
      for (var j=i+i; j<m; j+=i)
        isPrime[j>>5] &= ~(1<<(j&31));
      count++;
    }

  print("Primes up to" + pad(m,9) + pad(count,9));
}

var n = arguments[0]
var isPrime = new Array((10000<<n)+31>>5)

primes(isPrime, n)
primes(isPrime, n-1)
primes(isPrime, n-2)