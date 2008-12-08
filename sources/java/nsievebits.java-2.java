
/* The Computer Language Benchmarks Game
http://shootout.alioth.debian.org/

contributed by Alkis Evlogimenos
slightly modified by Pierre-Olivier Gaillard
*/



public class nsievebits
{
   private static class MyBitSet {
      private int[] bits;
      int length;
      private static final int mask = 31;
      private static final int shift = 5;
      public MyBitSet(int m) {
         bits = new int[m/8+1];
         length = m;
      }
      
      public void setRange() {
         for (int i =0; i < ((length >> shift)+1); i++ ){
               bits[i] = -1;
            }
      }
      public boolean get(int i){
         return  ((((int) bits[i >> shift]) >>>  (i & mask)) & 1) != 0; 
      }
      public void set(int i) {
         bits[i >> shift] |= (1 << (i & mask));
      }
      
      public void clear(int i) {
         bits[i >> shift] &= ~(1 << (i & mask));
      }
      
      public static void test() {
         MyBitSet bs = new MyBitSet(128);
         bs.setRange();
         bs.clear(5);
         System.out.println("Position 5 : " + bs.get(5));
         System.out.println("Position 6 : " + bs.get(6));
      }
   }
   private static int nsieve(int m, MyBitSet bits) {
   
      
      
     bits.setRange();
      int count = 0;
      for (int i = 2; i <= m; ++i) {
         if (bits.get(i)) {
         //System.err.println("Found prime : " + i);
         for (int j = i + i; j <=m; j += i)
            bits.clear(j);
            ++count;
         }
      }
      return count;
   }

   public static String padNumber(int number, int fieldLen)
   {
      StringBuffer sb = new StringBuffer();
      String bareNumber = "" + number;
      int numSpaces = fieldLen - bareNumber.length();

      for (int i = 0; i < numSpaces; i++)
         sb.append(" ");

      sb.append(bareNumber);

      return sb.toString();
   }

   public static void main(String[] args)
   {
     //MyBitSet.test();
      int n = 2;
      if (args.length > 0)
         n = Integer.parseInt(args[0]);
      if (n < 2)
         n = 2;

      int m = (1 << n) * 10000;
      MyBitSet bits = new MyBitSet(m+1);
      System.out.println("Primes up to " + padNumber(m, 8) + " " 
                            + padNumber(nsieve(m,bits), 8));

      m = (1 << n-1) * 10000;
      System.out.println("Primes up to " + padNumber(m, 8) + " " 
                            + padNumber(nsieve(m,bits), 8));

      m = (1 << n-2) * 10000;
      System.out.println("Primes up to " + padNumber(m, 8) + " " 
                            + padNumber(nsieve(m,bits), 8));
   }
}
