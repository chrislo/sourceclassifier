/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/

   contributed by Michael Barker
   based on a contribution by Luzius Meisser 
 */


/**
 * This implementation uses standard Java threading (native threads).  The
 * interesting part is that if you remove the Thread.yeild() from the 
 * Future<T>.getItem() method the program slows by up to a factor 10.
 * 
 * This implementation uses the basic design by Luzius Meisser from the orginal
 * chameneos shootout, but instead of spinning while waiting for the other
 * creature to arrive it blocks the thread.
 */ 
public class chameneosredux {

    enum Colour {
        blue,
        red,
        yellow
    }
        
    private static Colour doCompliment(Colour c1, Colour c2) {
        switch (c1) {
        case blue:
            switch (c2) {
            case blue:
                return Colour.blue;
            case red:
                return Colour.yellow;
            case yellow:
                return Colour.red;
            }
        case red:
            switch (c2) {
            case blue:
                return Colour.yellow;
            case red:
                return Colour.red;
            case yellow:
                return Colour.blue;
            }
        case yellow:
            switch (c2) {
            case blue:
                return Colour.red;
            case red:
                return Colour.blue;
            case yellow:
                return Colour.yellow;
            }
        }
        
        throw new RuntimeException("Error");
    }

    static class MeetingPlace {
        
        private int meetingsLeft;

        public MeetingPlace(int meetings) {
            this.meetingsLeft = meetings;
        }
        
        private Colour firstColour = null;
        private int firstId = 0;
        Future<Pair> current;
        
        public Pair meet(int id, Colour c) throws Exception {
            Future<Pair> newPair;
            synchronized (this) {
                if (meetingsLeft == 0) {
                    throw new Exception("Finished");
                } else {
                    if (firstColour == null) {
                        firstColour = c;
                        firstId = id;
                        current = new Future<Pair>();
                    } else {
                        Colour newColour = doCompliment(c, firstColour);
                        current.setItem(new Pair(id == firstId, newColour));
                        firstColour = null;
                        meetingsLeft--;
                    }
                    newPair = current;
                }
            }
            return newPair.getItem();
            
        }
    }
        
    public static class Future<T> {

        private volatile T t;

        public T getItem() throws InterruptedException {
            // Without this yield statement, performance suffers.
            Thread.yield();
            synchronized (this) {
                while (t == null) {
                    wait();
                }
            }
            return t;
        }

        public void setItem(T t) {
            synchronized (this) {
                this.t = t;
                notify();
            }
        }
    }
    
    
    static class Creature implements Runnable {

        private final MeetingPlace place;
        private int count = 0;
        private int sameCount = 0;
        private Colour colour;
        private int id;

        public Creature(MeetingPlace place, Colour colour) {
            this.place = place;
            this.id = System.identityHashCode(this);
            this.colour = colour;
        }
        
        public void run() {
            try {
                
                while (true) {
                    Pair p = place.meet(id, colour);
                    colour = p.colour;
                    if (p.sameId) {
                        sameCount++;
                    }
                    count++;
                }
                
            } catch (Exception e) {}
        }
        
        public int getCount() {
            return count;
        }
        
        public String toString() {
            return String.valueOf(count) + getNumber(sameCount);
        }
    }    
    
    private static void run(int n, Colour...colours) {
        MeetingPlace place = new MeetingPlace(n);
        Creature[] creatures = new Creature[colours.length];
        for (int i = 0; i < colours.length; i++) {
            System.out.print(" " + colours[i]);
            creatures[i] = new Creature(place, colours[i]);
        }
        System.out.println();
        Thread[] ts = new Thread[colours.length];
        for (int i = 0; i < colours.length; i++) {
            ts[i] = new Thread(creatures[i]);
            ts[i].start();
        }
        
        for (Thread t : ts) {
            try {
                t.join();
            } catch (InterruptedException e) {
            }
        }
        
        int total = 0;
        for (Creature creature : creatures) {
            System.out.println(creature);
            total += creature.getCount();
        }
        System.out.println(getNumber(total));
        System.out.println();
    }
    
    public static void main(String[] args) {
        
        int n = 600;
        try {
            n = Integer.parseInt(args[0]);
        } catch (Exception e) {
        }
        
        printColours();
        System.out.println();
        run(n, Colour.blue, Colour.red, Colour.yellow);
        run(n, Colour.blue, Colour.red, Colour.yellow, Colour.red, Colour.yellow, 
                Colour.blue, Colour.red, Colour.yellow, Colour.red, Colour.blue);
    }    

    public static class Pair {
        public final boolean sameId;
        public final Colour colour;

        public Pair(boolean sameId, Colour c) {
            this.sameId = sameId;
            this.colour = c;
        }
    }
    
    private static final String[] NUMBERS = {
        "zero", "one", "two", "three", "four", "five", 
        "six", "seven", "eight", "nine"
    };
    
    private static String getNumber(int n) {
        StringBuilder sb = new StringBuilder();
        String nStr = String.valueOf(n);
        for (int i = 0; i < nStr.length(); i++) {
            sb.append(" ");
            sb.append(NUMBERS[Character.getNumericValue(nStr.charAt(i))]);
        }
        
        return sb.toString();
    }
    
    private static void printColours() {
        printColours(Colour.blue, Colour.blue);
        printColours(Colour.blue, Colour.red);
        printColours(Colour.blue, Colour.yellow);
        printColours(Colour.red, Colour.blue);
        printColours(Colour.red, Colour.red);
        printColours(Colour.red, Colour.yellow);
        printColours(Colour.yellow, Colour.blue);
        printColours(Colour.yellow, Colour.red);
        printColours(Colour.yellow, Colour.yellow);
    }
    
    private static void printColours(Colour c1, Colour c2) {
        System.out.println(c1 + " + " + c2 + " -> " + doCompliment(c1, c2));
    }
    
    
}
