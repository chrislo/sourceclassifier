/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/

   contributed by Klaus Friedel
*/

public class fannkuch {
  final static class Permutation{
    private final byte [] num;
    private final int n;

    Permutation(int n) {
      this.n = n;
      this.num = new byte[n];
    }

    void copyTo(Permutation p2){
      System.arraycopy(num, 0, p2.num, 0, n);
    }

    void init(){
      for(byte i = 0; i < n; i++) num[i] = i;
    }

    byte get(int idx){
      return num[idx];
    }

    byte first(){
      return num[0];
    }

    // rotate digit 0...r by one
    void rotate(final int r){
      byte fn = num[0];
      for(byte i = 0; i < r; i++){
        num[i] = num[i+1];
      }
      num[r] = fn;
    }

    void reverse(final int count){
      for(byte i = 0; i < (count>>1); i++){
        byte tmp = num[i];
        num[i] = num[count - i - 1];
        num[count - i - 1] = tmp;
      }
    }

    int flipUntilDone(){
      for(int flips = 0;;flips++){
        final byte f = first();
        if(f == 0) return flips;
        reverse((byte) (f + 1));
      }
    }

    public String toString() {
      StringBuilder s = new StringBuilder(30);
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
    System.out.printf("Pfannkuchen(%d) = %d\n", n, fannkuch((byte) n));
  }
}
