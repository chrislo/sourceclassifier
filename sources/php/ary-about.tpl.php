<p>Each program should be implemented the <a
  href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=ary&amp;lang=gcc&amp;sort=<?=$Sort;?>">C program</a>.</p>

<p>The array benchmark was inspired by the array test in
  <a href="http://cm.bell-labs.com/cm/cs/who/bwk/interps/pap.html">
  Timing Trials, or, the Trials of Timing: Experiments with Scripting
  and User-Interface Languages</a> by Brian W. Kernighan and Christopher
  J. Van Wyk.</p>

<p>Correct output N = 1000 is:</p>
<pre>
1000 1000000
</pre>
<br />

<p>The original test didn't take into account array
  initilization overhead, and so in this version we create an array
  and then re-use it many times.</p>

<p>Note that one loop counts down from the end of the array to the
  beginning.  This is to give the advantage to a random-access data
  structure, as an <em>array</em> should be, and not just any sequence
  data structure, as such as a <em>list</em>.</p>
  