public class ack {

    // load the shared library containing the external function
    static {
	System.loadLibrary("ack");
    }

    // define the external function 
    public native static int Ack(int M, int N);

    public static void main(String[] args) {
	int NUM = Integer.parseInt(args[0]);
	// call the external function Ack()
	System.out.print("Ack(3," + NUM + "): " + Ack(3, NUM) + "\n");
    }
}

