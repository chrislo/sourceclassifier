// $Id: lists.java-2.java,v 1.1 2004-11-10 06:43:53 bfulgham Exp $
// http://shootout.alioth.debian.org/
// from Stephen Darnell

//import java.io.*;		// XXX Not needed
//import java.util.*;	// XXX Replaced by private version
//import java.text.*;	// XXX Not needed

public class lists {

	// XXX Make SIZE a final static
    final static int SIZE = 10000;

    public static void main(String args[])
    {
		int n = 10;
		if (args.length == 1)
		{
			n = Integer.parseInt(args[0]);
		}

		long start = System.currentTimeMillis();

		int result = 0;
		for (int i = 0; i < n; i++) {
		    result = test_lists();
		}
		long stop = System.currentTimeMillis();

		System.out.println(result);
		// System.out.println("Took "+(stop-start)+" ms");
    }

    public static int test_lists() {
	int result = 0;
	// create a list of integers (Li1) from 1 to SIZE
	LinkedList Li1 = new LinkedList();
	for (int i = 1; i < SIZE+1; i++) {
	    Li1.addLast(new LLEntry(i));
	}

//	System.out.println("Li1 "+Li1.size());

	// copy the list to Li2 (not by individual items)
	LinkedList Li2 = new LinkedList(Li1);
	LinkedList Li3 = new LinkedList();

//	System.out.println("Li2 "+Li2.size()+" Li3 "+Li3.size());

	// remove each individual item from left side of Li2 and
	// append to right side of Li3 (preserving order)
	while (! Li2.isEmpty()) {
	    Li3.addLast(Li2.removeFirst());
	}

//	System.out.println("Li2 "+Li2.size()+" Li3 "+Li3.size());

	// Li2 must now be empty
	// remove each individual item from right side of Li3 and
	// append to right side of Li2 (reversing list)
	while (! Li3.isEmpty()) {
	    Li2.addLast(Li3.removeLast());
	}

//	System.out.println("Li2 "+Li2.size()+" Li3 "+Li3.size());

	// Li3 must now be empty
	// reverse Li1
	LinkedList tmp = new LinkedList();
	while (! Li1.isEmpty()) {
	    tmp.addFirst(Li1.removeFirst());
	}
	Li1 = tmp;
	// check that first item is now SIZE
	if (Li1.getFirst().val != SIZE) {
	    System.err.println("first item of Li1 != SIZE");
	    return(0);
	}
	// compare Li1 and Li2 for equality
	if (! Li1.equals(Li2)) {
	    System.err.println("Li1 and Li2 differ");
	    System.err.println("Li1:" + Li1);
	    System.err.println("Li2:" + Li2);
	    return(0);
	}
	// return the length of the list
	return(Li1.size());
    }
}

class LLEntry
{
	LLEntry prev, next;
	int val;

	LLEntry() { }

	LLEntry(int value) {
		val = value;
	}
}

class LinkedList extends LLEntry
{
	LinkedList()
	{
		next = prev = this;
	}

	LinkedList( LinkedList other )
	{
		this();

		LLEntry last = this;
		for( LLEntry curr = other.next ; curr != other ; curr = curr.next )
		{
			LLEntry entry = new LLEntry(curr.val);
			last.next = entry;
			entry.prev = last;
			last = entry;
		}
		last.next = this;
		this.prev = last;

		this.val = other.val;
	}

	boolean isEmpty()
	{
		return val == 0;
	}

	void addFirst( LLEntry entry )
	{
		entry.prev = this;
		entry.next = this.next;
		this.next.prev = entry;
		this.next = entry;
		this.val++;
	}

	void addLast( LLEntry entry )
	{
		entry.next = this;
		entry.prev = this.prev;
		this.prev.next = entry;
		this.prev = entry;
		this.val++;
	}

	LLEntry removeFirst()
	{
		LLEntry entry = this.next;
		if (entry == this)
			return null;

		this.val--;
		this.next = entry.next;
		entry.next.prev = this;
		return entry;
	}

	LLEntry removeLast()
	{
		LLEntry entry = this.prev;
		if (entry == this)
			return null;

		this.val--;
		this.prev = entry.prev;
		entry.prev.next = this;
		return entry;
	}

	LLEntry getFirst()
	{
		return this.next;
	}

	int size()
	{
// Simple sanity checking code:
//		int n = 0;
//		for( LLEntry curr = this.next; curr != this ; curr = curr.next)
//		{
//			n++;
//		}
//		if (n != this.val)
//			throw new Error("size mismatch");

		return this.val;
	}

	boolean equals(LinkedList other)
	{
		LLEntry myItem = this;
		LLEntry theirItem = other;
		do
		{
			if (myItem.val != theirItem.val)
				return false;
			theirItem = theirItem.next;
			myItem = myItem.next;
		}
		while(myItem != this);
		return true;
	}
}
