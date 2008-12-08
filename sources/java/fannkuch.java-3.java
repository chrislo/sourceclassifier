/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/

   contributed by Klaus Friedel

   will only shine on a 64Bit JVM
*/

public class fannkuch {
  final static class Permutation{
    private long p;
    private int n;

    Permutation(int n) {
      this.n = n;
    }

    void copyTo(Permutation p2){
      p2.n = n;
      p2.p = p;
    }

    void init(){
      for(int i = 0; i < n; i++) set(i, i);
    }

    void set(int idx, int value){
      int shift = idx * 4;
      p &= ~(0xFL << shift);
      p |= ((long)value) << shift;
    }

    int get(int idx){
      int shift = idx * 4;
      return (int)(p >> shift) & 0xF;
    }

    int first(){
      return (int)p & 0xF;
    }

    // rotate digit 0...r by one
    void rotate(final int r){
      final long mask = (16L << 4*r) - 1;
      long x = (p & mask) >>> 4;
      x |= (p & 0xFL) << (4*r);
      p = (p & ~mask) | x;
    }

    void reverse(final int count){
      // do a complete reversal first
      long r = p;
      r = (r & 0x0F0F0F0F0F0F0F0FL) << 4  | (r & 0xF0F0F0F0F0F0F0F0L) >>> 4;
      r = (r & 0x00FF00FF00FF00FFL) << 8  | (r & 0xFF00FF00FF00FF00L) >>> 8;
      r = (r & 0x0000FFFF0000FFFFL) << 16 | (r & 0xFFFF0000FFFF0000L) >>> 16;
      r = (r & 0x00000000FFFFFFFFL) << 32 | (r & 0xFFFFFFFF00000000L) >>> 32;
      // select the relevant part:
      final int shift = 4*(16 - count);
      r >>= shift;
      // replace count of them:
      final long mask = (1L << 4*count) - 1;
      p = (p & ~mask) | (r & mask);
    }

    int flipUntilDone(){
      for(int flips = 0;;flips++){
        final int f = first();
        if(f == 0) return flips;
        reverse(f + 1);
      }
    }

    public String toString() {
      StringBuilder s = new StringBuilder();
      for(int i = 0; i < n; i++){
        s.append(get(i) + 1);
      }
      return s.toString();
    }
  }

  static long fannkuch(final int n) {
    Permutation perm = new Permutation(n);
    Permutation perm1 = new Permutation(n);
    int[] count = new int[n];
    final int n1 = n - 1;

    if (n < 1) return 0;
    perm1.init();

    int r = n;
    int didpr = 0;
    int flipsMax = 0;
    for (; ;) {
      if (didpr < 30) {
        System.out.println(perm1.toString());
        didpr++;
      }

      for (; r != 1; --r) count[r - 1] = r;

      if (!(perm1.first() == 0 || perm1.get(n1) == n1)) {
        perm1.copyTo(perm);
        int flips = perm.flipUntilDone();
        if (flipsMax < flips) {
          flipsMax = flips;
        }
      }

      for (; ;r++) {
        if (r == n) return flipsMax;
        /* rotate down perm1[0..r] by one */
        perm1.rotate(r);
        count[r]--;
        if (count[r] > 0) break;
      }
    }
  }


  public static void main(String[] args) {
    int n = 11;
    if(args.length == 1) n = Integer.parseInt(args[0]);
    System.out.printf("Pfannkuchen(%d) = %d\n", n, fannkuch(n));
  }
}
