/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/
   contributed by Amir K aka Razii
*/

import java.io.*;

public final class sumcol {

   static final byte[] buf = new byte [18432];
   final static InputStream in = System.in;

   public static void main(String[] args) throws Exception {

      System.out.println(sum());
   }

   private static int sum() throws Exception
   {
   	  int total = 0, num=0, j, neg = 1;
   	  while ((j = in.read(buf)) > 0)
   	  {
   	  	for (int i = 0; i < j; i++)
   	  	{
   	  		int c = buf[i];
            if (c >= '0' && c <= '9')
                num =  num * 10 + c - '0';
            else if (c == '-')
                neg = -1;
            else {
                total += (num * neg);
                num = 0;
                neg = 1;
            }	
   	  	}
   	  	
   	  }
      return total;
   }
}
