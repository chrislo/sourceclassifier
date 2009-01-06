<p><strong>diff</strong> program output N = 4 with this <a href="iofile.php?test=<?=$SelectedTest;?>&amp;file=output">output file</a> to check your program is correct before contributing.
</p>

<p>Each program should</p> 
<ul>
<li>Read in an integer value N from the command line (typically N > 3).
<li>Use a <a href="http://www.wikipedia.org/wiki/Best-first_search">Best-First search</a> algorithm
to find a magic square of size N.  The best-first search algorithm must use the
same priority ranking and node-expansion algorithm as those shown in the
model benchmark implementations.</li>
<li>Print all numbers in the square</li>
</ul>
<p>A <a href="http://mathworld.wolfram.com/MagicSquare.html">magic square</a> is an n &times; n square array of numbers consisting of the distinct positive integers 1, 2, ..., n<sup>2</sup> arranged such that the sum of the n numbers in any horizontal, vertical, or main diagonal line is always equal to (n + n<sup>3</sup>)&divide;2.  The benchmark requires the use of the best-first search algorithm, although many more efficient algorithms are possible.</p>
<br />

<p>Thanks to Josh Goldfoot for this benchmark.</p>
