/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/
   contributed by Stefan Krause
*/

import java.io.BufferedOutputStream;
import java.io.IOException;

class mandelbrot {
	
   final static double limitSquared = 4.0;
   final static int iterations = 50;
	
   public static void main(String[] args) throws Exception {
      int size = Integer.parseInt(args[0]);
      Mandelbrot m = new Mandelbrot(size);
      m.compute();
   }   

   public static class Mandelbrot {
      public Mandelbrot(int size)
      {
         this.size = size;
         fac = 2.0 / size;
         out = new BufferedOutputStream(System.out);
	   
         int offset = size % 8;
         shift = offset == 0 ? 0 : (8-offset);
      }
      final int size;
      final BufferedOutputStream out;
      final double fac;
      final int shift;

      public void compute() throws IOException
      {
         System.out.format("P4\n%d %d\n",size,size);
         for (int y = 0; y<size; y++)
            computeRow(y);
         out.close();
      }
	   
      private void computeRow(int y) throws IOException
      {	   
         int bits = 0;

         for (int x = 0; x<size;x++) {
            double Zr = 0.0;
            double Zi = 0.0;
            double Cr = (x*fac - 1.5); 
            double Ci = (y*fac - 1.0);

            int i = iterations;
            double ZrN = 0;
            double ZiN = 0;
            do {
               Zi = 2.0 * Zr * Zi + Ci;
               Zr = ZrN - ZiN + Cr;
               ZiN = Zi * Zi;
               ZrN = Zr * Zr;
            } while (!(ZiN + ZrN > limitSquared) && --i > 0);

            bits = bits << 1;
            if (i == 0) bits++;
            
            if (x%8 == 7) {
               out.write((byte)bits);
               bits = 0;
            }
         }
         if (shift!=0) {
            bits = bits << shift;
            out.write((byte)bits);
         }
      }
   }
}
