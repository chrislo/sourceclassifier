/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/
   modified by … James Antill - 2007-06-14
 */

#define _GNU_SOURCE 1
#include <stdio.h>
#include <stdlib.h>

#define MAXLINELEN 128

int
main() {
    int sum = 0;
    char line[MAXLINELEN];

    while (fgets_unlocked(line, MAXLINELEN, stdin)) {
	sum += atoi(line);
    }
    printf("%d\n", sum);
    return(0);
}
