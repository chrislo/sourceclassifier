/* The Computer Language Benchmarks Game
http://shootout.alioth.debian.org/

contributed by Alkis Evlogimenos
slightly modified by Pierre-Olivier Gaillard
slightly modified by Klaus Friedel
slightly modified by Daniel Fekete
modified by Chad Whipkey -- converted to not use a class
*/

import java.util.Arrays;

public class nsievebits
{
    private static final int mask = 31;
    private static final int shift = 5;

    public static void main(String[] args) {
        int n = 2;
        if (args.length > 0)
            n = Integer.parseInt(args[0]);
        if (n < 2) n = 2;

        int m = (1 << n) * 10000;
        final int[] bits = new int[((m + 1) >> shift) + 1];
        primes(n, bits);
        primes(n - 1, bits);
        primes(n - 2, bits);
    }

    static void primes(int n, int[] bits) {
        final int m = (1 << n) * 10000;
        Arrays.fill(bits, 0, ((m + 1) >> shift) + 1, -1);
        int count = 0;
        for (int i = 2; i <= m; i++)
        {
            if (((bits[i >> shift] >>> (i & mask)) & 1) != 0)
            {
                for (int j = i + i; j <= m; j += i)
                    bits[j >> shift] &= ~(1 << (j & mask));
                count ++;
            }
        }

        System.out.printf("Primes up to %8d %8d\n", m, count);
    }
}
