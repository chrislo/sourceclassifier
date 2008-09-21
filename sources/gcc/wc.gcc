/* -*- mode: c -*-
 * $Id: wc.gcc,v 1.2 2004-06-18 07:02:55 bfulgham Exp $
 * http://www.bagley.org/~doug/shootout/
 *
 * Author: Waldemar Hebisch (hebisch@math.uni.wroc.pl)
 * Optimizations: Michael Herf (mike@herfconsulting.com)
 * Further Revisions: Paul Hsieh (qed@pobox.com)
 */

#include <stdio.h>
#include <unistd.h>
#include <limits.h>

#define BSIZ 4096

unsigned long ws[UCHAR_MAX + 1];
unsigned long nws[UCHAR_MAX + 1];
char buff[BSIZ];

int main(void) {
    unsigned long prev_nws = 0x10000L, w_cnt = 0, l_cnt = 0, b_cnt = 0, cnt;

    /* Fill tables */
    for (cnt = 0; cnt <= UCHAR_MAX; cnt++) {
         ws[cnt] =  (cnt == ' ' || cnt == '\n' || cnt == '\t') + (0x10000L & -(cnt == '\n'));
	nws[cnt] = !(cnt == ' ' || cnt == '\n' || cnt == '\t') +  0x10000L;
    }

    
    /* Main loop */
    while (0 != (cnt = read (0, buff, BSIZ))) {
        unsigned long vect_count = 0;
	unsigned char *pp, *pe;

	b_cnt += cnt;
	pe = buff + cnt;
	pp = buff;

	while (pp < pe) {
	    vect_count +=  ws[*pp] & prev_nws;
	    prev_nws    = nws[*pp];
	    pp ++;
	}
	w_cnt += vect_count  & 0xFFFFL;
	l_cnt += vect_count >> 16;
    }

    w_cnt += 1 & prev_nws;

    printf ("%d %d %d\n", l_cnt, w_cnt, b_cnt);
    return 0;
}
