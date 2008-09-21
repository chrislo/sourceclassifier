/*
** The Computer Language Shootout
** http://shootout.alioth.debian.org/
** contributed by Mike Pall
**
**   gcc -O3 -fomit-frame-pointer -o pidigits pidigits.c -lgmp
*/

#include <stdio.h>
#include <stdlib.h>
#include <gmp.h>

typedef struct ctx_s {
  mpz_t q, r, s, t;	/* Transformation matrix components. */
  mpz_t u, v, w;	/* Temporary numbers. */
  int d, i, n;		/* Counters. */
  char digits[10+1];	/* Accumulated digits for one line. */
} ctx_t;

/* Compose matrix with numbers on the right. */
static void compose_r(ctx_t *c, int bq, int br, int bs, int bt)
{
  mpz_mul_si(c->u, c->r, bs);
  mpz_mul_si(c->r, c->r, bq);
  mpz_mul_si(c->v, c->t, br);
  mpz_add(c->r, c->r, c->v);
  mpz_mul_si(c->t, c->t, bt);
  mpz_add(c->t, c->t, c->u);
  mpz_mul_si(c->s, c->s, bt);
  mpz_mul_si(c->u, c->q, bs);
  mpz_add(c->s, c->s, c->u);
  mpz_mul_si(c->q, c->q, bq);
}

/* Compose matrix with numbers on the left. */
static void compose_l(ctx_t *c, int bq, int br, int bs, int bt)
{
  mpz_mul_si(c->r, c->r, bt);
  mpz_mul_si(c->u, c->q, br);
  mpz_add(c->r, c->r, c->u);
  mpz_mul_si(c->u, c->t, bs);
  mpz_mul_si(c->t, c->t, bt);
  mpz_mul_si(c->v, c->s, br);
  mpz_add(c->t, c->t, c->v);
  mpz_mul_si(c->s, c->s, bq);
  mpz_add(c->s, c->s, c->u);
  mpz_mul_si(c->q, c->q, bq);
}

/* Extract one digit. */
static int extract(ctx_t *c, unsigned int j)
{
  mpz_mul_ui(c->u, c->q, j);
  mpz_add(c->u, c->u, c->r);
  mpz_mul_ui(c->v, c->s, j);
  mpz_add(c->v, c->v, c->t);
  mpz_tdiv_q(c->w, c->u, c->v);
  return mpz_get_ui(c->w);
}

/* Print one digit. Returns 1 for the last digit. */
static int prdigit(ctx_t *c, int y)
{
  c->digits[c->d++] = '0'+y;
  if (++c->i % 10 == 0 || c->i == c->n) {
    c->digits[c->d] = '\0';
    printf("%-10s\t:%d\n", c->digits, c->i);
    c->d = 0;
  }
  return c->i == c->n;
}

/* Generate successive digits of PI. */
static void pidigits(ctx_t *c)
{
  int k = 1;
  c->d = 0;
  c->i = 0;
  mpz_init_set_ui(c->q, 1);
  mpz_init_set_ui(c->r, 0);
  mpz_init_set_ui(c->s, 0);
  mpz_init_set_ui(c->t, 1);
  mpz_init(c->u);
  mpz_init(c->v);
  mpz_init(c->w);
  for (;;) {
    int y = extract(c, 3);
    if (y == extract(c, 4)) {
      if (prdigit(c, y)) return;
      compose_r(c, 10, -10*y, 0, 1);
    } else {
      compose_l(c, k, 4*k+2, 0, 2*k+1);
      k++;
    }
  }
}

int main(int argc, char **argv)
{
  ctx_t c;
  c.n = argc > 1 ? atoi(argv[1]) : 27;
  pidigits(&c);
  return 0;
}

