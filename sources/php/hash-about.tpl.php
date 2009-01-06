<p>Each program should be implemented the <a
  href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=hash&amp;lang=java&amp;sort=<?=$Sort;?>">Java program</a>.</p>

<p>The benchmark is the-same-as the associative array test in <a
  href="http://cm.bell-labs.com/cm/cs/who/bwk/interps/pap.html"> Timing
  Trials, or, the Trials of Timing: Experiments with Scripting and
  User-Interface Languages</a> by Brian W. Kernighan and Christopher
  J. Van Wyk.
</p> 

<p>Correct output N = 20000 is:</p>
<pre>
4999
</pre>
<br />

<p>It uses sprintf(), which is very
  expensive and pretty much swamps the hash table processing.
 I rewrote the Ocaml program so
  that it constructs its hash keys as efficiently as it can ... and 
  it's speed improved noticeably.</p>
  
<p>The <a href="benchmark.php?test=hash2&amp;lang=all&amp;sort=<?=$Sort;?>">hashtable-update</a> benchmark tries to avoid the cost of hash key string generation.</p>



