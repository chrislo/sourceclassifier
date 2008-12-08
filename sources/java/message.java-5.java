/**
 * The Computer Language Benchmarks Game
 * http://shootout.alioth.debian.org/
 * contributed by James Ahlborn
 */

import java.util.*;

public class message {

   public static final int numberOfThreads = 500;
   public static int numberOfMessagesToSend;

  public static void main(String args[]) {
    numberOfMessagesToSend = Integer.parseInt(args[0]);

    MessageThread chain = null;
    for (int i=0; i<numberOfThreads; i++){
      chain = new MessageThread(chain);
    }

    for (int i=0; i<numberOfMessagesToSend; i++)
      chain.enqueue(Integer.valueOf(0));
  }


  public static class MessageThread extends Thread {
    MessageThread nextThread;
    List<Integer> list = new ArrayList<Integer>(16);
    boolean started;
    
    MessageThread(MessageThread nextThread){
      this.nextThread = nextThread;
    }

    public void run() {
      if (nextThread != null)
        while (true) nextThread.enqueue(dequeue());
      else {
        int sum = 0;
        int finalSum = numberOfThreads * numberOfMessagesToSend;
        while (sum < finalSum)
          sum += dequeue().intValue();

        System.out.println(sum);
        System.exit(0);
      }
    }

    public void enqueue(Integer message)
    {
      if(!started) {
        start();
        started = true;
      }

      Integer newValue = Integer.valueOf(message.intValue() + 1);
      synchronized(list) {
        list.add(newValue);
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
        return list.remove(0);
      }
    }
  
  }
  
}
