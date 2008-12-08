/**
 * The Computer Language Benchmarks Game
 * http://shootout.alioth.debian.org/
 * contributed by James Ahlborn.
 * Optimized by Klaus Friedel
 */

import java.util.LinkedList;
import java.util.List;

public class message {

  public static long startTime;
  public static final int numberOfThreads = 500;
  public static int numberOfMessagesToSend;

  public static void main(String args[]) {
    //startTime = System.currentTimeMillis();
    numberOfMessagesToSend = Integer.parseInt(args[0]);

    MessageThread chain = null;
    for (int i = 0; i < numberOfThreads; i++) {
      chain = new MessageThread(chain);
    }

    for (int i = 0; i < numberOfMessagesToSend; i++)
      chain.enqueue(0);

    try {
      MessageThread t = chain;
      while(t != null){
        t.join();
        t = t.nextThread;
      }
    } catch (InterruptedException e) {
      e.printStackTrace();
    }
  }


  public static class MessageThread extends Thread {
    MessageThread nextThread;
    List<Integer> list = new LinkedList<Integer>();
    boolean started;
    private static final int BUSY_RETRY_COUNT = 50;

    MessageThread(MessageThread nextThread) {
      this.nextThread = nextThread;
    }

    public void run() {
      if (nextThread != null)
        while (true) nextThread.enqueue(dequeue());
      else {
        int sum = 0;
        final int finalSum = numberOfThreads * numberOfMessagesToSend;
        while (sum < finalSum)
          sum += dequeue();

        System.out.println(sum);
        //long end = System.currentTimeMillis();
        //System.out.printf("Time: %.2fs\n", (end - startTime)/1000.0);
        System.exit(0);
      }
    }

    public void enqueue(Integer message) {
      if (!started) {
        start();
        started = true;
      }

      Integer newValue = message + 1;
      synchronized (list) {
        list.add(newValue);
        if (list.size() == 1) {
          list.notify();
        }
      }
    }

    public Integer dequeue() {
      synchronized (list) {
        try {
          while (list.size() == 0) {
            list.wait();
          }
        } catch (Exception e) {
        }
        return list.remove(0);
      }
    }

  }

}
