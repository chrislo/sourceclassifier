/*
 * The Computer Language Benchmarks Game
 * http://shootout.alioth.debian.org/
 *
 * contributed by Klaus Friedel
 * modified by Jeffrey Stedfast
 *
 */

import java.io.StreamTokenizer;

public class sumcol {
   public static void main(String[] args) throws Exception{
      int sum = 0;
      StreamTokenizer lineTokenizer = new StreamTokenizer(System.in);
       while (lineTokenizer.nextToken() != StreamTokenizer.TT_EOF) {
         sum += (int) lineTokenizer.nval;
       }
       System.out.println(Integer.toString(sum));
   }
}
