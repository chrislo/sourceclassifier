/* 
 The Computer Language Shootout
 http://shootout.alioth.debian.org/
 #303304
 contributed by tt@kyon.de
 */

public final class message extends Thread {

	private static final int THREADS = 500;
	private static int msgCount;
	private static int max;
	private final message nextThread;
	private int[] messages = new int[1024]; // reasonably sized buffer
	private int todo;

	public static void main(String args[]) {
		msgCount = Integer.parseInt(args[0]);
		max = msgCount * THREADS;
		message thread = null;
		for (int i = THREADS; --i >= 0;) {
			(thread = new message(thread)).start();
		}
		for (int i = msgCount; --i >= 0;) {
			thread.send(0);
		}
	}
	private message(message next) {
		nextThread = next;
	}
	public void run() {
		try {
			for (;;) {
				synchronized (this) {
					if (todo != 0) {
						break;
					}
				}
				yield();
			}
			if (nextThread != null) {
				pass();
			} else {
				add();
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	private void pass() throws Exception {
		for (;;) {
			synchronized (this) {
				int done = todo;
				int[] m = messages;
				do {
					nextThread.send(m[--done] + 1);
				} while (done != 0);
				todo = 0;
			}
			while (todo == 0) {
				// no unsynchronized todos left
				yield();
			}
		}
	}
	private void add() throws Exception {
		int sum = 0;
		for (;;) {
			synchronized (this) {
				int done = todo;
				int[] m = messages;
				do {
					sum += m[--done] + 1;
				} while (done != 0);
				todo = 0;
			}
			while (todo == 0) {
				// no unsynchronized todos left
				if (sum == max) {
					System.out.println(sum);
					System.exit(0);
				}
				yield();
			}
		}
	}
	private synchronized void send(int message) {
		int[] m = messages;
		int l = m.length;
		if(todo == l) {
			int[] n = new int[l << 2];
			System.arraycopy(m, 0, n, 0, l);
			messages = m = n;
		}
		m[todo++] = message;
	}
}
