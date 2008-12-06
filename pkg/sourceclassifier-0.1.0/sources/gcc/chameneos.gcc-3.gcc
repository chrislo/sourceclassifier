/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/

   Written by Jorge Peixoto de Morais Neto
   based on code by Josh Goldfoot
*/

#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>
#include <sched.h>
#include <stdbool.h>
#include <err.h>
static unsigned long meetingsleft;

typedef enum { Blue, Red, Yellow, Faded } color_t;
typedef struct {
    color_t color;
    bool waiting_partner;
} creature_t;

/* When this function is called with two different colors, it must return the other color */
/* We assume that none of the colors is Faded */
/* If it is called with two equal colors, the specification allows us to return any color.  */
/* In this case, we return Red if both colors are Blue, Yellow if both are Red and Blue if both are Yellow */
static color_t complementarycolor (color_t c1, color_t c2) {
    switch (c1) {
    case Yellow:
	return c2 == Blue ? Red : Blue;
    case Red:
	return c2 == Yellow ? Blue : Yellow;
    default:
    case Blue:
	return c2 == Red ? Yellow : Red;
    }
}

/* This is the meeting place. The threads simulating creatures call this function. */
/* This function takes a pointer to the creaure data */
/* and writes to the color field the new color the creature must assume */
static void meeting_place (creature_t volatile *creature_p) {
    /* A creature in the meeting place waiting for a partner. NULL means */
    /* there is no such creature */
    static creature_t volatile *waiting_creature_p = NULL;
    static pthread_mutex_t mutex = PTHREAD_MUTEX_INITIALIZER;
    pthread_mutex_lock (&mutex);
    if (!waiting_creature_p) {
	if (meetingsleft) {
	    waiting_creature_p = creature_p;
	    creature_p->waiting_partner = true;
	    pthread_mutex_unlock(&mutex);
	    while (creature_p->waiting_partner)
		sched_yield ();
	} else {
	    pthread_mutex_unlock (&mutex);
	    creature_p->color = Faded;
	}
    } else {
	color_t newcolor = 
	    complementarycolor (creature_p->color, waiting_creature_p->color);
	creature_p->color = newcolor;
	waiting_creature_p->color = newcolor;
	waiting_creature_p->waiting_partner = false;
	waiting_creature_p = NULL;
	meetingsleft--;
	pthread_mutex_unlock (&mutex);
    }
}

/* This function simulates a creature. */
/* It returns a pointer to the number of meetings this creature performed */
static void *run_creature (void *me_voidp) {
    creature_t *me_p = me_voidp;
    unsigned long meetings = 0;
    do {
	meetings++;
	meeting_place (me_p);
    } while (me_p->color != Faded);
    unsigned long *meetings_p = malloc (sizeof *meetings_p);
/* The '-1' compensates the fact that the meetings variable counts the meeting */
/* in wich the creature becomes faded (but it shouldn't) */
    *meetings_p = meetings - 1;
    return meetings_p;
}

#define NCREATURES 4
/* This function unleashes NCREATURES creatures and returns the sum of reported meetings */
static unsigned long meetings_of_creatures (void) {
    creature_t creatures[NCREATURES];
    creatures[0].color = Blue;
    creatures[1].color = Red;
    creatures[2].color = Yellow;
    creatures[3].color = Blue;

    pthread_t pids[NCREATURES];
    int i;
    for (i = NCREATURES - 1; i >= 0; i--)
	pthread_create (&pids[i], NULL, run_creature, &creatures[i]);

    unsigned long sum = 0;
    for (i = NCREATURES - 1; i >= 0; i--) {
	void *result_p;
	pthread_join (pids[i], &result_p);
	sum += *(unsigned long *) result_p;
    }
    return sum;
}

int main (int argc, char **argv) {
    meetingsleft = 1e6;
    if (argc > 1) {
	char *tail;
	meetingsleft = strtoul (argv[1], &tail, 0);
	if (tail == argv[1]) 
	    errx (1, "Could not convert \"%s\" to an unsigned long integer", argv[1]);
    }
    unsigned long sum = meetings_of_creatures ();
    printf ("%lu\n", sum);
    return 0;
}
