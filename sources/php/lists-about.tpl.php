<p>Each program should be implemented the <a href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=lists&amp;lang=gst&amp;sort=<?=$Sort;?>">Smalltalk program</a>.</p>

<p>Programs should:</p>
<ul>
  <li>create a list (L1) of integers from 1 through SIZE.</li>
  <li>copy L1 to L2</li>
  <li>remove each individual item from left side (head) of L2 and append to
  right side (tail) of L3 (preserving order).  (L2 should be emptied by
  one item at a time as that item is appended to L3).</li>
  <li>remove each individual item from right side (tail) of L3 and append
  to right side (tail) of L2 (reversing list).  (L3 should be emptied
  by one item at a time as that item is appended to L2).</li>
  <li>reverse L1 (preferably in place)</li>
  <li>check that first item of L1 is now == SIZE.</li>
  <li>compare L1 and L2 for equality and return length of L1 (which
  should be equal to SIZE).</li>
</ul>

<p>Correct output is:</p>
<pre>
10000
</pre>
<br />

<p>Programs can use any sequence data structure: list, array, deque, doubly-linked-list. Native data structures are prefered, but custom data structures can also be used.</p>