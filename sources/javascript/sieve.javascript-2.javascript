// The Great Computer Language Shootout
//  http://shootout.alioth.debian.org
//
//  Contributed by Ian Osgood

function padded(n,width) {
  var s = n.toString();
  while (s.length < width) s = ' ' + s;
  return s;
}

function primes(e) {
  var i, count = 0, n = 10000 << e;
  var isPrime = new Array(n);

  for (i=0; i<n; i++) isPrime[i] = true;
  
  for (i=2; i<n; i++)
    if (isPrime[i]) {
      for (var j=i+i; j<n; j+=i) isPrime[j] = false;
      count++;
    }

  print("Primes up to" + padded(n,9) + padded(count,9));
}

var n = arguments[0]

primes(n)
primes(n-1)
primes(n-2)