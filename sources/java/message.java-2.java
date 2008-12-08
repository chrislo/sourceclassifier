/* The Great Computer Language Shootout
   http://shootout.alioth.debian.org/
 
   contributed by James McIlree
*/


import java.util.*;

public class message {
   public static final int numberOfThreads = 3000;
   public static int numberOfMessagesToSend;

   public static void main(String args[]) {
     numberOfMessagesToSend = Integer.parseInt(args[0]);

     MessageThread chain = null;
     for (int i=0; i<numberOfThreads; i++){
       chain = new MessageThread(chain);
       new Thread(chain).start();
     }

     for (int i=0; i<numberOfMessagesToSend; i++) chain.enqueue(new Integer(0));
   }
}

class MessageThread implements Runnable {
   MessageThread nextThread;
   List list = new ArrayList(4);

   MessageThread(MessageThread nextThread){
     this.nextThread = nextThread;
   }

   public void run() {
     if (nextThread != null)
       while (true) nextThread.enqueue(dequeue());
     else {
       int sum = 0;
       int finalSum = message.numberOfThreads * message.numberOfMessagesToSend;
       while (sum < finalSum)
         sum += dequeue().intValue();

       System.out.println(sum);
       System.exit(0);
     }
   }

   public void enqueue(Integer message)
   {
     synchronized(list) {
       list.add(new Integer(message.intValue() + 1));
       if (list.size() == 1) {
         list.notify();
       }
     }
   }

   public Integer dequeue()
   {
     synchronized(list) {
       while(list.size() == 0) {
         try { list.wait(); } catch (Exception e) {}
       }
       return (Integer)list.remove(0);
     }
   }
}