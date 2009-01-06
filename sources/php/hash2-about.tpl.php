<p>Each program should be implemented the <a
  href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=hash2&amp;lang=lua&amp;sort=<?=$Sort;?>">Lua program</a>.</p>

<ul>
<li>create 10000 hash entries</li>
<li>add them into a new hashtable N times</li>
</ul>

<p>Correct output N = 10 is:</p>
<pre>
1 9999 10 99990
</pre>
<br />

<p>We try to avoid the cost of creating the hash key strings by creating a limited set of keys (10000), by less expensive means than sprintf(). Hash keys are created by turning an integer into a string. Some hash table implementations may be penalized somewhat by having to deal with many similar keys. But a good one won't :-)</p>





