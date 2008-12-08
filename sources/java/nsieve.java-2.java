/* The Computer Language Shootout
http://shootout.alioth.debian.org/
contributed by Alexei Svitkine
*/

public class nsieve
{
  static void nsieve(int m) {
    int count = 0, i, j;
    boolean[] flags = new boolean[m];
    
    for (i = 2; i < m; ++i)
      if (!flags[i]) {
        ++count;
        for (j = i << 1; j < m; j += i)
          flags[j] = true;
      }
        
    System.out.println(String.format("Primes up to %8d %8d", m, count));
  }

  public static void main(String[] args) {
    int m = 2;
    if (args.length > 0) m = Integer.parseInt(args[0]);
    for (int i = 0; i < 3; i++)
      nsieve(10000 << (m-i));
  }
}
