/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/

   Written by Jorge Peixoto de Morais Neto
   based on code by Josh Goldfoot */

#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>
#include <semaphore.h>
#include <err.h>

static sem_t mutex, second_creature;

static unsigned long meetingsleft;

typedef enum { Blue, Red, Yellow, Faded } color_t;
typedef struct {
    unsigned long *meetingsp;
    color_t color;
} creature_t;

/* When this function is called with two different colors, it must return the other color */
/* We assume that none of the colors is Faded */
/* If it is called with two equal colors, the specification allows us to return any color.  */
/* In this case, we return Red if both colors are Blue, Yellow if both are Red and Blue if both are Yellow */
static color_t complementarycolor (color_t c1, color_t c2) {
    switch (c1) {
    case Blue:
	return c2 == Red ? Yellow : Red;
    case Red:
	return c2 == Yellow ? Blue : Yellow;
    case Yellow:
    default:
	return c2 == Blue ? Red : Blue;
    }
}

/* This is the meeting place. Multiple threads call this function.  */
/* This function returns the new color the creature must assume after the meeting*/
/* The first creature locks mutex, sets color1 = color, updates mp_state, */
/* unlocks the mutex and waits to lock second_creature */
/* The second creature locks mutex, sets othercolor=color1 and color2 = color , */
/* decrements meetingsleft, updates mp_state, unlocks second_creature and returns */
/* The first creature sets othercolor = color2, unlocks mutex and returns */
/* mp_state is EMPTY again, the two semaphores are back to initial values and the cycle continues */
/* until meetingsleft reaches 0. */
static color_t new_color (color_t color) {
/* Meeting place state*/
    static enum {
	MEETINGS_LIMIT_REACHED = -1,
	EMPTY,
	ONE_CREATURE
    } mp_state = EMPTY;

    static color_t color1, color2;
    color_t othercolor;
    sem_wait (&mutex);
    switch (mp_state) {
    case EMPTY:
	color1 = color;
	mp_state = ONE_CREATURE;
	sem_post (&mutex);
	sem_wait (&second_creature);
	othercolor = color2;
	sem_post (&mutex);
	break;
    case ONE_CREATURE:
	othercolor = color1;
	color2 = color;
	mp_state = (--meetingsleft ? EMPTY : MEETINGS_LIMIT_REACHED);
	sem_post (&second_creature);
	break;
    case MEETINGS_LIMIT_REACHED:
    default:
	sem_post (&mutex);
	return Faded;
    }
    return complementarycolor (color, othercolor);
}

/* This function simulates a creature. */
static void *run_creature (void *voidpme) {
    creature_t const *me = voidpme;
    unsigned long meetings = 0;
    color_t color = me->color;
    do {
	meetings++;
	color = new_color (color);
    } while (color != Faded);
/* The '-1' compensates the fact that the meetings variable counts the meeting  */
/* in wich the creature becomes faded (but it shouldn't) */
    *me->meetingsp = meetings - 1;
    static int zero = 0;
/* We return a pointer to 0, meaning success. */
    return &zero;
}

/* This function sets loose four creatures and returns the sum of reported meetings*/
static unsigned long meetings_of_four_creatures (void) {
    sem_init (&mutex, 0, 1);
    sem_init (&second_creature, 0, 0);

    unsigned long reports[4];
    creature_t creatures[4] = {{&reports[0], Blue},
			       {&reports[1], Red},
			       {&reports[2], Yellow},
			       {&reports[3], Blue}};
    pthread_t pids[4];
    int i;
    for (i = 0; i < 4; i++)
	pthread_create (&pids[i], NULL, run_creature, &creatures[i]);

    for (i = 0; i < 4; i++)
	pthread_join (pids[i], NULL);

    unsigned long sum = reports[0];
    for (i = 1; i < 4; i++)
	sum += reports[i];
    return sum;
}

int main (int argc, char const **argv) {
    meetingsleft = 1e6;
    if (argc > 1) {
	char *tail;
	meetingsleft = strtoul (argv[1], &tail, 0);
	if (tail == argv[1]) 
	    errx (1, "Could not convert \"%s\" to an unsigned long integer", argv[1]);
    }
    unsigned long sum = meetings_of_four_creatures ();
    printf ("%lu\n", sum);
    return 0;
}
