/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/
   contributed by Graham Miller 
*/

public class message {
   public static final int numberOfThreads = 500;

   public static int numberOfMessagesToSend;

   public static void main(String args[]) {
      numberOfMessagesToSend = Integer.parseInt(args[0]);

      RingBufferThread chain = null;
      for (int i = 0; i < numberOfThreads; i++) {
         chain = new RingBufferThread(chain, numberOfMessagesToSend*(numberOfThreads));
         chain.start();
       }


      for (int i = 0; i < numberOfMessagesToSend; i++) {
         chain.enqueue(0);
      }
      chain.signalDoneSendingMessages();
    }

   public static class RingBufferThread extends Thread {

      private static final int RING_BUFFER_CAPACITY = 100;
         
      private volatile RingNode loadNode;
      private volatile RingNode consumeNode;

      RingBufferThread nextThread;
      private volatile boolean done = false;
      private final int finalSum;

      
      RingBufferThread(RingBufferThread nextThread, int finalSum) {
         RingNode node = new RingNode();
         RingNode tail = node;
         for (int i = 0; i < RING_BUFFER_CAPACITY-1; i ++){
            RingNode newNode = new RingNode();
            newNode.next = node;
            node = newNode;
         }
         // complete the ring
         tail.next = node;
         
         // both load and consume start at the same node
         loadNode = node;
         consumeNode = node;
         
         this.nextThread = nextThread;
         this.finalSum = finalSum;
      }

      public void run() {
         if (nextThread != null) {
            while (!done || !isEmpty()) {
               nextThread.enqueue(dequeue());
            }
            nextThread.signalDoneSendingMessages();
         } else {
            int sum = 0;
            while (sum < finalSum) {
               int message = dequeue();
               sum += message;
            }
            System.out.println(sum);
            System.exit(0);
         }
      }


      private boolean isEmpty() {
         return consumeNode == loadNode;
      }

      /**
       * @param message
       */
      public final void enqueue(int message) {
         // after this test becomes false, and the loop exits
         // the removal of an element by the "other" thread
         // cannot make it true again, so therefore it is invariant
         // for the rest of the execution of this method.
         // that is once we have some free space, we will always
         // have free space until the thread calling this method
         // adds an element.
         do { /* nothing */ } while (loadNode.next == consumeNode && trueYield());

         loadNode.message = message;
         loadNode = loadNode.next;
      }

      public final int dequeue() {
         // after this test becomes false, and the loop exits
         // the addition of an element by the "other" thread
         // cannot make it true again, therefore it is invariant
         // for the rest of the execution of this method
         // that is once we have at least one element, we will always
         // have at least one element until the thread calling this
         // method removes one.
         do { /* nothing */ } while (loadNode == consumeNode && trueYield());

         int message = 1 + consumeNode.message;
         consumeNode = consumeNode.next;
         
          return message;
      }

      public final void signalDoneSendingMessages() {
         // once done is true, I am the only
         // thread accessing any of my variables, so we have no
         // more threading issues
         done = true;
      }
      
      private final boolean trueYield() {
         Thread.yield();
         return true;
      }
   }
   
   static class RingNode {
      public volatile int message;
      public RingNode next;
   }
}
