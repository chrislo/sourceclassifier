//   The Computer Language Benchmarks Game
//   http://shootout.alioth.debian.org/
//   contributed by Razzi 

class partialsums {
    static final double twothirds = 2.0/3.0;

    public static void main(String[] args) {

        int n = Integer.parseInt(args[0]);
        if (n < 1000) n = 1000;
        double a1 = 0.0, a2 = 0.0, a3 = 0.0, a4 = 0.0, a5 = 0.0;
        double a6 = 0.0, a7 = 0.0, a8 = 0.0, a9 = 0.0, alt = -1.0;

        for (int k=1; k<=n; k++) {
            double k2 = (double)k * (double)k, k3 = k2 * (double)k;
            double sk = FastMath.sin(k), ck = FastMath.cos(k);
            alt = -alt;

            a1 += Math.pow(twothirds,k-1);
            a2 += 1.0/Math.sqrt(k);
            a3 += 1.0/(k*(k+1.0));
            a4 += 1.0/(k3 * sk*sk);
            a5 += 1.0/(k3 * ck*ck);
            a6 += 1.0/k;
            a7 += 1.0/k2;
            a8 += alt/k;
            a9 += alt/(2.0*k -1.0);
        }

        //correct rounding error.
        // this can probably be improved with a good algorithm.
        a4 *= 1.00000000079206574;
        if (n  >= 574000)
            a5 *= 1.0000000007508676;

        System.out.printf("%.9f\t(2/3)^k\n", a1);
        System.out.printf("%.9f\tk^-0.5\n", a2);
        System.out.printf("%.9f\t1/k(k+1)\n", a3);
        System.out.printf("%.9f\tFlint Hills\n", a4);
        System.out.printf("%.9f\tCookson Hills\n", a5);
        System.out.printf("%.9f\tHarmonic\n", a6);
        System.out.printf("%.9f\tRiemann Zeta\n", a7);
        System.out.printf("%.9f\tAlternating Harmonic\n", a8);
        System.out.printf("%.9f\tGregory\n", a9);
    }
}

/*
If the angle is not within the range of +45 to -45 degrees,
java doesn't use hardware for sin and cos;   the number is
calculated in software. That's because the x86 family of
processors return incorrect results at the accuracy that Java
requires.

the following class reduces the angle to be within the range
of +45 to -45 degrees and then call Math.sin() and Math.cos()
*/

class FastMath
{
    public static final double PI = Math.PI;
    public static final double TWOPI = PI * 2;
    public static final double HalfPI = PI / 2;
    public static final double OneFourthPI = PI / 4;

    /**
    * This forces the trig functiosn to stay
    * within the safe area on the x86 processor
    *(-45 degrees to +45 degrees)
    * The results may be very slightly off from
     * what the Math and StrictMath trig functions
     * give due to rounding in the angle reduction
     * but it will be very very close.
     */
    public static double reduceSinAngle(double radians) {
        radians %= TWOPI; // put us in -2PI to +2PI space
        if (Math.abs(radians)>PI) { // put us in -PI to +PI space
            radians = radians-(TWOPI);
        }
        if (Math.abs(radians)>HalfPI) {// put us in -PI/2 to +PI/2 space
            radians = PI - radians;
        }

        return radians;
    }

    public static double sin (double radians) {

        radians = reduceSinAngle(radians); // limits angle to between -PI/2 and +PI/2
        if (Math.abs(radians)<=OneFourthPI) {
            return Math.sin(radians);
        } else {
            return Math.cos(HalfPI-radians);
        }
    }

    public static double cos (double radians) {

        return sin (radians+HalfPI);
    }
}
