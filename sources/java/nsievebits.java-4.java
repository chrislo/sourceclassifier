/* The Computer Language Benchmarks Game
http://shootout.alioth.debian.org/

contributed by Alkis Evlogimenos
slightly modified by Pierre-Olivier Gaillard
slightly modified by Klaus Friedel
slightly modified by Daniel Fekete
*/

import java.util.Arrays;

public class nsievebits {
  static class MyBitSet {
    private final int[] bits;
    private static final int mask = 31;
    private static final int shift = 5;

    public MyBitSet(int m) {
      bits = new int[(m >> shift) + 1];
    }

    public void setAll() {
      Arrays.fill(bits, -1);
    }

    public boolean get(int i) {
      return ((bits[i >> shift] >>> (i & mask)) & 1) != 0;
    }

    public void clear(int i) {
      bits[i >> shift] &= ~(1 << (i & mask));
    }
  }

  static int nsieve(int m, MyBitSet bits) {
    bits.setAll();
    int count = 0;
    for (int i = 2; i <= m; ++i) {
      if (bits.get(i)) {
        for (int j = i + i; j <= m; j += i) if (bits.get(j)) bits.clear(j);
        ++count;
      }
    }
    return count;
  }

  static void primes(int n, MyBitSet bits) {
    int m = (1 << n) * 10000;
    System.out.printf("Primes up to %8d %8d\n", m, nsieve(m, bits));
  }

  public static void main(String[] args) {
    int n = 2;
    if (args.length > 0)
      n = Integer.parseInt(args[0]);
    if (n < 2) n = 2;

    int m = (1 << n) * 10000;
    MyBitSet bits = new MyBitSet(m + 1);
    primes(n, bits);
    primes(n-1, bits);
    primes(n-2, bits);
  }
}
