/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/

   contributed by Alexei Svitkine
   modified by Razzi
*/

public final class nsieve
{
    static int nsieve(int m, byte[] isPrime)
    {
        int count = 0;
        for (int i=2; i <= m; i++) {
            if (isPrime[i] == 0) {
                for (int k=i+i; k <= m; k+=i) isPrime[k] = 1;
                count++;
            }
        }
        return count;
    }

    public static void main(String[] args)
    {
        int n = Integer.parseInt(args[0]);

        int m = (1<<n)*10000;
        byte [] flags = new byte[m+1];

        System.out.printf("Primes up to %8d %8d\n", m, nsieve(m,flags));
        m = (1<<n-1)*10000;
        System.out.printf("Primes up to %8d %8d\n", m, nsieve(m,flags));
        m = (1<<n-2)*10000;
        System.out.printf("Primes up to %8d %8d\n", m, nsieve(m,flags));
    }
}
