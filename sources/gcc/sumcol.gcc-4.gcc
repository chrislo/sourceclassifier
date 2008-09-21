/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/
   modified by Jorge Peixoto
 */
 
#define _GNU_SOURCE 1
#include <stdio.h>
#include <stdlib.h>

#define MAXLINELEN 128
int main (void) {
    int sum = 0;
    char line[MAXLINELEN];
    while (fgets_unlocked (line, MAXLINELEN, stdin))
	sum += strtol (line, NULL, 0);
    printf ("%d\n", sum);
    return 0;
}
