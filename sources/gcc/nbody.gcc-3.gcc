/*
 * The Computer Language Benchmarks Game
 * http://shootout.alioth.debian.org/
 *
 * Contributed by Christoph Bauer
 * modified by Jorge Peixoto de Morais Neto
 */

#include <stdio.h>
#include <stdlib.h>
#include <math.h>
#include <err.h>

#define SOLAR_MASS (4 * M_PI * M_PI)

/*power-of-two alignment helps when indexing arrays */
struct __attribute__ ((aligned(64))) planet_t {
    double x, y, z;
    double vx, vy, vz;
    double mass;
};
typedef struct planet_t planet_t;

static void advance (planet_t *bodies, int nb, double dt) {
    int i, j;
    for (i = nb - 1; i >= 0; i--) 
     	for (j = 0; j < i; j++) { 
    	    double dx = bodies[i].x - bodies[j].x;
     	    double dy = bodies[i].y - bodies[j].y;
     	    double dz = bodies[i].z - bodies[j].z;
     	    double distance = sqrt (dx * dx + dy * dy + dz * dz);
     	    double mag = dt / (distance * distance * distance);
     	    bodies[i].vx -= bodies[j].mass * mag * dx;
     	    bodies[i].vy -= bodies[j].mass * mag * dy;
     	    bodies[i].vz -= bodies[j].mass * mag * dz;
     	    bodies[j].vy += bodies[i].mass * mag * dy;
     	    bodies[j].vz += bodies[i].mass * mag * dz;
     	    bodies[j].vx += bodies[i].mass * mag * dx;
     	}

    for (i = nb - 1; i >= 0; i--) { 
     	bodies[i].x += dt * bodies[i].vx; 
     	bodies[i].y += dt * bodies[i].vy; 
     	bodies[i].z += dt * bodies[i].vz;
    } 
}

static inline double energy (planet_t const *bodies, int nb) {
    double e = 0.0;
    int i, j; 
    for (i = nb - 1; i >= 0; i--)
     	e += bodies[i].mass *
	    (bodies[i].vx * bodies[i].vx + bodies[i].vy * bodies[i].vy + bodies[i].vz * bodies[i].vz); 

    e /= 2;
    for (i = nb - 1; i >= 0; i--) 
	for (j = 0; j < i; j++) {
	    double dx = bodies[i].x - bodies[j].x;  
      	    double dy = bodies[i].y - bodies[j].y;  
      	    double dz = bodies[i].z - bodies[j].z;  
      	    double distance = sqrt (dx * dx + dy * dy + dz * dz);  
      	    e -= bodies[i].mass * bodies[j].mass / distance;  
      	} 
    return e;
}

static inline void offset_momentum (planet_t *bodies, int nb) {
    double py = 0.0, pz = 0.0, px = 0.0;
    int i;
    for (i = nb - 1; i >= 0; i--) {
	py += bodies[i].vy * bodies[i].mass;
	pz += bodies[i].vz * bodies[i].mass;
	px += bodies[i].vx * bodies[i].mass;
    }
    /*bodies[0] is the Sun*/
    bodies[0].vx = -px / SOLAR_MASS;
    bodies[0].vy = -py / SOLAR_MASS;
    bodies[0].vz = -pz / SOLAR_MASS;
}

int main (int argc, char **argv) {
#define NBODIES 5
#define DAYS_PER_YEAR 365.24
    static planet_t bodies[NBODIES] = {
	{                               /* sun */
	    0, 0, 0, 0, 0, 0, SOLAR_MASS
	},
	{                               /* jupiter */
	    4.84143144246472090e+00,
	    -1.16032004402742839e+00,
	    -1.03622044471123109e-01,
	    1.66007664274403694e-03 * DAYS_PER_YEAR,
	    7.69901118419740425e-03 * DAYS_PER_YEAR,
	    -6.90460016972063023e-05 * DAYS_PER_YEAR,
	    9.54791938424326609e-04 * SOLAR_MASS
	},
	{                               /* saturn */
	    8.34336671824457987e+00,
	    4.12479856412430479e+00,
	    -4.03523417114321381e-01,
	    -2.76742510726862411e-03 * DAYS_PER_YEAR,
	    4.99852801234917238e-03 * DAYS_PER_YEAR,
	    2.30417297573763929e-05 * DAYS_PER_YEAR,
	    2.85885980666130812e-04 * SOLAR_MASS
	},
	{                               /* uranus */
	    1.28943695621391310e+01,
	    -1.51111514016986312e+01,
	    -2.23307578892655734e-01,
	    2.96460137564761618e-03 * DAYS_PER_YEAR,
	    2.37847173959480950e-03 * DAYS_PER_YEAR,
	    -2.96589568540237556e-05 * DAYS_PER_YEAR,
	    4.36624404335156298e-05 * SOLAR_MASS
	},
	{                               /* neptune */
	    1.53796971148509165e+01,
	    -2.59193146099879641e+01,
	    1.79258772950371181e-01,
	    2.68067772490389322e-03 * DAYS_PER_YEAR,
	    1.62824170038242295e-03 * DAYS_PER_YEAR,
	    -9.51592254519715870e-05 * DAYS_PER_YEAR,
	    5.15138902046611451e-05 * SOLAR_MASS
	}
    };
    long n = 1000;
    if (argc >= 2) {
	char *tail;
	char const *arg = argv[1];
	n = strtol (arg, &tail, 0);
	if (tail == arg)
	    errx (1, "Could no convert \"%s\" to a long integer", arg);
    }

    offset_momentum (bodies, NBODIES);
    printf ("%.9f\n", energy (bodies, NBODIES));
    long i;
    for (i = n; i > 0; i--)
	advance (bodies, NBODIES, 0.01);

    printf ("%.9f\n", energy (bodies, NBODIES));
    return 0;
}
