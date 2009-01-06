<p>Each program should solve the Josephus problem by simulation - like this <a href="benchmark.php?test=josephus&lang=java&sort=<?=$Sort;?>">Java program</a>. (Analytical solutions will not be accepted).</p>

<p>Each program should, for M = 2 to 10
<ul>
<li>create a sequence of integers 1 to N </li>

<li>while the sequence length >= M
<ul>
<li>remove every Mth item</li>
</ul>
</li>
<li>print the remaining M-1 items, tab-separated, in ascending-order</li>
</ul>

<p>Correct output N = 41 is:
<pre>
   19
   16   31
   11   15   37
   12   21   22   34
   13   21   27   34   39
   5    20   22   27   31   36
   6    9    14   21   22   30   41
   1    2    5    11   12   28   30   31
   4    13   15   19   22   23   31   35   36
</pre></p><br/>


<p>The Josephus problem is explained in Eric W. Weisstein. "Josephus Problem." From <a href="http://mathworld.wolfram.com"><i>MathWorld</i></a>--A Wolfram Web Resource.<br/><a href="http://mathworld.wolfram.com/JosephusProblem.html">http://mathworld.wolfram.com/JosephusProblem.html</a></p>

