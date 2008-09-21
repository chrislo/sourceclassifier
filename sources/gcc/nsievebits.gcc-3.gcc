// The Computer Language Shootout
// http://shootout.alioth.debian.org/
// Precedent C entry modified by bearophile for speed and size, 31 Jan 2006
// Modified to use bits to hold state by mukund
// Compile with:  gcc -pipe -Wall -O3 -funroll-all-loops -march=athlon64 -m3dnow nsieve.c -o nsieve

#include <stdio.h>
#include <stdint.h>
#include <stdlib.h>
#include <string.h>

#define INDEX_INT(i) ((i) >> 5)
#define INDEX_BIT(i) (1 << ((i) & 0x1f))
#define INDEX_BITMASK(i) (~INDEX_BIT(i))

int
main (int argc, char *argv[])
{
  int n = atoi (argv[1]);
  unsigned int count1 = 0, count2 = 0, count4 = 0;
  unsigned int i, j, m, m2;
  uint32_t *flags;

  m = 10000 << n;

  flags = (uint32_t *) malloc ((m / sizeof (uint32_t)) + 1);
  memset (flags, 0xff, (m / sizeof (uint32_t)) + 1);

  for (i = 2; i < m; ++i)
    {
      if (flags[INDEX_INT (i)] & INDEX_BIT (i))
        {
          for (j = i * 2; j <= m; j += i)
            flags[INDEX_INT (j)] &= INDEX_BITMASK (j);

          ++count1;
          m2 = m >> 1;
          if (i < m2)
            ++count2;
          m2 = m2 >> 1;
          if (i < m2)
            ++count4;
        }
    }

  printf ("Primes up to %8u %8u\n", m, count1);
  printf ("Primes up to %8u %8u\n", m / 2, count2);
  printf ("Primes up to %8u %8u\n", m / 4, count4);

  free (flags);

  return 0;
}
