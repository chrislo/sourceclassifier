/**
 * The Computer Language Benchmarks Game
 * http://shootout.alioth.debian.org/
 * contributed by Klaus Friedel
 */

import java.util.concurrent.locks.LockSupport;

public class threadring {
  static final int THREAD_COUNT = 503;

  public static class MessageThread extends Thread {
    MessageThread nextThread;
    volatile Integer message;

    public MessageThread(MessageThread nextThread, int name) {
      super(""+name);
      this.nextThread = nextThread;
    }

    public void run() {
      while(true) nextThread.enqueue(dequeue());
    }

    public void enqueue(Integer hopsRemaining) {
      if(hopsRemaining == 0){
        System.out.println(getName());
        System.exit(0);
      }
      // as only one message populates the ring, it's impossible
      // that queue is not empty
      message = hopsRemaining - 1;
      LockSupport.unpark(this); // work waiting...
    }

    private Integer dequeue(){
      while(message == null){
        LockSupport.park();
      }
      Integer msg = message;
      message = null;
      return msg;
    }
  }

  public static void main(String args[]) throws Exception{
    int hopCount = Integer.parseInt(args[0]);

    MessageThread first = null;
    MessageThread last = null;
    for (int i = THREAD_COUNT; i >= 1 ; i--) {
      first = new MessageThread(first, i);
      if(i == THREAD_COUNT) last = first;
    }
    // close the ring:
    last.nextThread = first;

    // start all Threads
    MessageThread t = first;
    do{
      t.start();
      t = t.nextThread;
    }while(t != first);
    // inject message
    first.enqueue(hopCount);
    first.join(); // wait for System.exit
  }
}