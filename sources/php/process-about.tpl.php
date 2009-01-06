<p>Each program should <em>create</em>, <em>keep alive</em>, and send integer messages between N explicitly-linked threads. Programs may use kernel threads, lightweight threads, cooperative threads&#8230;</p>

<p>Each program should</p>
<ul>
   <li>create N threads - each thread should:
      <ul>
      <li>hold and use a reference to the next thread</li>      
      <li>take, and increment, an integer message</li>
      <li>put the incremented message on the next thread</li>
      </ul>
   </li>                   
   <li>put the integer message 0 on the first thread</li>
   <li>print the message taken and incremented by the last thread - a count of takes, and indirectly a count of threads</li>
</ul>

<p>Correct output N = 10 is:</p>
<pre>10
</pre>
<br />


<p>With a large number of threads this becomes <a href="http://www.mozart-oz.org/documentation/apptut/node9.html#chapter.concurrency.cheap">Death by Concurrency</a>.</p>
<p>(The threads benchmark is essentially the <a href="benchmark.php?test=message&amp;lang=all&amp;sort=<?=$Sort;?>">threads-flow benchmark</a> with a single message send.)</p>