
/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/
   contributed by Thomas GODART (based on Greg Buchholz's C program) */

var w = 0; var h = 0; var bit_num = 0;
var byte_acc = 0;
var i = 0; var iter = 50;
var x = 0; var y = 0; var limit2 = 4;
var Zr = 0; var Zi = 0; var Cr = 0; var Ci = 0; var Tr = 0; var Ti = 0;

var h = 3000;
var w = h;

document.write ("P4\n" + w + " " + h + "\n");

for (y = 0 ; y < h ; y++)
{
   for (x = 0 ; x < w ; x++)
   {
      Zr = 0; Zi = 0; Tr = 0; Ti = 0.0;

      Cr = (2.0 * x / w - 1.5); Ci = (2.0 * y / h - 1.0);

      for (i = 0 ; i < iter && (Tr + Ti <= limit2) ; i++)
      {
         Zi = 2.0 * Zr * Zi + Ci;
         Zr = Tr - Ti + Cr;
         Tr = Zr * Zr;
         Ti = Zi * Zi;
      }

      byte_acc = byte_acc << 1;
      if (Tr + Ti <= limit2) byte_acc = byte_acc | 1;

      bit_num++;

      if (bit_num == 8)
      {
         document.write (String.fromCharCode(byte_acc));
         byte_acc = 0;
         bit_num = 0;
      }
      else if (x == w - 1)
      {
         byte_acc = byte_acc << (8 - w % 8);
         document.write (String.fromCharCode(byte_acc));
         byte_acc = 0;
         bit_num = 0;
      }
   }
}
