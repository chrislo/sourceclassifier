<p>Each program should be implemented the <a href="faq.php?sort=<?=$Sort;?>#sameway"><b>same&nbsp;way</b></a>  &#8212;  the same way as this <a href="benchmark.php?test=prodcons&amp;lang=python&amp;sort=<?=$Sort;?>">Python program</a>.</p>


<p>Each program should use <b>kernel threads</b>. Lightweight threads and other forms of concurrency are included in the <a href="benchmark.php?test=process&amp;lang=all&amp;sort=<?=$Sort;?>">threads benchmark</a> and <a href="benchmark.php?test=message&amp;lang=all&amp;sort=<?=$Sort;?>">messages benchmark</a>.</p>

<ul>
<li>producer thread
<ul>
<li>for i = 1 through n
<ul>
<li>lock mutex to enter critical section</li>
<li>while count not equal zero wait for condition variable</li>
<li>put value of i into data buffer</li>
<li>increment count</li>
<li>signal condition that resource is ready (data buffer full)</li>
<li>increment produced</li>
</ul>
</li>
</ul>
</li>

<li>consumer thread
<ul>
<li>repeat
<ul>
<li>lock mutex to enter critical section</li>
<li>while count equal zero wait for condition variable</li>
<li>retrieve value of i from data buffer</li>
<li>decrement count</li>
<li>signal condition that resource is ready (data buffer empty)</li>
<li>increment consumed</li>
</ul>
</li>
</ul>
</li>

<li>main thread
<ul>
<li>start producer</li>
<li>start consumer</li>
<li>join threads</li>
<li>print values of produced and consumed</li>
</ul>
</li>

</ul>


<p>Correct output N = 1000 is:</p>
<pre>1000 1000
</pre>