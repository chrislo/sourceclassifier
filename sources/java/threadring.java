/**
 * The Computer Language Benchmarks Game
 * http://shootout.alioth.debian.org/
 * contributed by Klaus Friedel
 */

import java.util.concurrent.*;

public class threadring {
  static final int THREAD_COUNT = 503;

  public static class MessageThread extends Thread {
    MessageThread nextThread;
    BlockingQueue<Integer> queue = new ArrayBlockingQueue<Integer>(1);

    public MessageThread(MessageThread nextThread, int name) {
      super(""+name);
      this.nextThread = nextThread;
    }

    public void run() {
      try {
        while(true) nextThread.enqueue(dequeue());
      } catch (InterruptedException e) {
        if(! nextThread.isInterrupted()) nextThread.interrupt();
      }
    }

    public void enqueue(Integer hopsRemaining) throws InterruptedException {
      if(hopsRemaining == 0){
        System.out.println(getName());
        throw new InterruptedException("This is the end..");
      }
      queue.put(hopsRemaining - 1);
    }

    public Integer dequeue() throws InterruptedException {
      return queue.take();
    }
  }

  public static void main(String args[]) throws Exception{
    int hopCount = Integer.parseInt(args[0]);

    MessageThread thread = null;
    MessageThread last = null;
    for (int i = THREAD_COUNT; i >= 1 ; i--) {
      thread = new MessageThread(thread, i);
      if(i == THREAD_COUNT) last = thread;
    }
    // close the ring:
    last.nextThread = thread;

    // start all Threads
    MessageThread t = thread;
    do{
      t.start();
      t = t.nextThread;
    }while(t != thread);
    // inject message
    thread.enqueue(hopCount);
    // wait until end
    MessageThread t2 = thread;
    do{
      t2.join();
      t2 = t2.nextThread;
    }while(t2 != thread);
  }
}
