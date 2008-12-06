/* The Computer Language Shootout
 * http://shootout.alioth.debian.org/
 * contributed by Joern Inge Vestgaarden
 * Compile with gcc -O3 -fomit-frame-pointer -march=pentium4 -mfpmath=sse -msse2 -o fasta fasta.c
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define MIN(a,b) ((a) <= (b) ? (a) : (b))
#define LINE_LEN 60

#define IM 139968
#define IA   3877
#define IC  29573
int global_last = 42;
#define gen_random(max) (max*((global_last = (global_last * IA + IC) % IM) / ((float)(IM))))

struct aminoacids {
  float p;
  char c;
};

void make_cumulative (struct aminoacids * genelist, int count) {
    float cp = 0.0;
    int i;
    for (i=0; i < count; i++) {
        cp += genelist[i].p;
        genelist[i].p = cp;
    }
}

void repeat_fasta (const char *s, int n) {
  int len = strlen(s);
  int pos = 0;
  while (n > 0) {
    const int line = MIN(LINE_LEN, n);
    const int left = len-pos; 
    n -= line;
    if (left >= line) {     /* Line not broken */
      fwrite(s+pos,1,line,stdout);
      putc('\n', stdout);
      pos += line;
    } else {                /* Line broken */
      fwrite(s+pos,1,left,stdout);
      pos = 0;
      fwrite(s,1,line-left,stdout);
      pos += line - left;
      putc('\n', stdout);
    }
  }    
}

void random_fasta (struct aminoacids * genelist, int n) {
  char buf[LINE_LEN+1];
  char *s = NULL;
  struct aminoacids *a = genelist;
  float r;
  while (n > 0) {
    const int line = MIN(LINE_LEN, n);
    const char *end = (char *)buf + line;
    n -= line;
    s = buf;
    while (s < end) {
      r = gen_random(1.0);
      a = genelist;
      while (*((float *)a) < r) ++a; /* Linear search */
      *s++ = a->c;
    }
    *s = '\n';
    fwrite(buf, 1, line+1, stdout);
  }
}


/* Main -- define alphabets, make 3 fragments */

static struct aminoacids iub[] = {
    { 0.27, 'a' },
    { 0.12, 'c' },
    { 0.12, 'g' },
    { 0.27, 't' },
    { 0.02, 'B' },
    { 0.02, 'D' },
    { 0.02, 'H' },
    { 0.02, 'K' },
    { 0.02, 'M' },
    { 0.02, 'N' },
    { 0.02, 'R' },
    { 0.02, 'S' },
    { 0.02, 'V' },
    { 0.02, 'W' },
    { 0.02, 'Y' }
};

#define IUB_LEN (sizeof (iub) / sizeof (struct aminoacids))

static struct aminoacids homosapiens[] = {
    { 0.3029549426680, 'a' },
    { 0.1979883004921, 'c' },
    { 0.1975473066391, 'g' },
    { 0.3015094502008, 't' },
};

#define HOMOSAPIENS_LEN (sizeof (homosapiens) / sizeof (struct aminoacids))

static char * alu =
   "GGCCGGGCGCGGTGGCTCACGCCTGTAATCCCAGCACTTTGG" \
   "GAGGCCGAGGCGGGCGGATCACCTGAGGTCAGGAGTTCGAGA" \
   "CCAGCCTGGCCAACATGGTGAAACCCCGTCTCTACTAAAAAT" \
   "ACAAAAATTAGCCGGGCGTGGTGGCGCGCGCCTGTAATCCCA" \
   "GCTACTCGGGAGGCTGAGGCAGGAGAATCGCTTGAACCCGGG" \
   "AGGCGGAGGTTGCAGTGAGCCGAGATCGCGCCACTGCACTCC" \
   "AGCCTGGGCGACAGAGCGAGACTCCGTCTCAAAAA";

int main (int argc, char * argv[]) {
    int n = 1000;
    if (argc > 1) sscanf (argv[1], "%d", &n);
    make_cumulative (iub, IUB_LEN);
    make_cumulative (homosapiens, HOMOSAPIENS_LEN);

    printf (">ONE Homo sapiens alu\n");
    repeat_fasta ( alu, n*2);
    printf (">TWO IUB ambiguity codes\n");    
    random_fasta ( iub,   n*3);
    printf (">THREE Homo sapiens frequency\n");
    random_fasta ( homosapiens,  n*5);

    return 0;
}

