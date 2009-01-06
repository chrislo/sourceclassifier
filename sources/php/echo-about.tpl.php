<p>Each program should do the <a
 href="faq.php?sort=<?=$Sort;?>#samething"><strong>same&nbsp;thing</strong></a>.</p>

<p>Each program should:</p>
<ul>
<li>open a TCP/IP socket</li>
<li>fork a client process that connects back to the socket</li>
<li>the client process should repeat N times:
<ul>
<li>write to the socket</li>
<li>read from the socket</li>
<li>check that data read is the same as the data written</li>
</ul>
</li>
<li>the server process should repeat N times:
<ul>
<li>read from the socket</li>
<li>sum the bytes read from the socket</li>
<li>write the data read back to the socket</li>
</ul>

</li>
<li>print server process bytes-read sum</li>
<li>close the socket</li>
</ul>

<p>Correct output N = 1000 is:</p>
<pre>
server processed 19000 bytes
</pre>
<br />

<p>The read/write operations on the stream socket should either use
  line-oriented standard I/O functions or else handle incomplete
  reads/writes.</p>

<p>The reason for using fork is simply to make it easy for the test
  driver, so it only has to start one process.</p>
<p>We make an exception for Java, and allow it to use multiple threads
  instead of forking. Similarly, Brian Gregor has contributed a
  threaded version for Haskell.</p>
<p>In real life, you might use a small client/server like this to test
  network latency (it's not a throughput test).</p>
