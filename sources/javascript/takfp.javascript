// The Great Computer Language Shootout
// http://shootout.alioth.debian.org/
//
// contributed by Ian Osgood

function tak(x,y,z) {
  if (y >= x) return z;
  return tak(tak(x-1,y,z), tak(y-1,z,x), tak(z-1,x,y));
}
var n = arguments[0];
print( tak(n*3, n*2, n).toFixed(1) );
