<p>Each program should be implemented the <a
  href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=heapsort&amp;lang=gcc&amp;sort=<?=$Sort;?>">C program</a>.</p>

<p>Programs implement an in-place heapsort function that takes
  arguments (N, ARY), where N is the number of elements in the array
  ARY, starting from index 1.  ARY is passed by reference.</p>

<p>Correct output N = 1000 is:</p>
<pre>
0.9990640718
</pre>
<br />

<p>The heapsort algorithm is from <em>Numerical Recipes in C</em>, section
  9.2, page 247.  Initialize the array with random double-precision floating point numbers using the naive
  (and lightweight) pseudo-random number generator from the <a
  href="benchmark.php?test=random&amp;lang=all&amp;sort=<?=$Sort;?>">random benchmark</a>.</p>


