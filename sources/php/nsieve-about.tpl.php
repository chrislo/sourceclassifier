<p><strong>diff</strong> program output N = 2 with this <a href="iofile.php?test=<?=$SelectedTest;?>&amp;file=output">output file</a> to check your program is correct before contributing.
</p>

<p>Each program should count the prime numbers from 2 to M, using the same na&#239;ve Sieve of Eratosthenes algorithm:</p>
<ul>
  <li>create a sequence of M <strong>boolean flags</strong> (don't use bit flags - if the language implementation doesn't provide a boolean type or if the boolean type is packed then use byte flags)</li>
  <li>for each index number
     <ul>
     <li>if the flag value at that index is true
     <ul>
     <li>set <em>all</em> the flag values at multiples of that index false</li>
     <li>increment the count</li>
     </ul>
     </li>
     </ul>
   </li>
</ul>

<p>Calculate 3 prime counts, for M = 2<sup>N</sup> &#215; 10000, 2<sup>N-1</sup> &#215; 10000, and 2<sup>N-2</sup> &#215; 10000.</p>

<p>The basic benchmark was described in "A High-Level Language Benchmark." BYTE, September 1981, p. 180, Jim Gilbreath.</p>
<p>Of course, there are more efficient implementations of the <em>Sieve of Eratosthenes</em>, and there are more efficient ways to sieve prime numbers, for example <a href="http://www.ams.org/journal-getitem?pii=S0025-5718-03-01501-1">"Prime sieves using binary quadratic forms"</em></a>.</p>
<p>For more information see Eric W. Weisstein, "Sieve of Eratosthenes." From <a href="http://mathworld.wolfram.com"><em>MathWorld</em></a>--A Wolfram Web Resource.<br/><a href="http://mathworld.wolfram.com/SieveofEratosthenes.html">http://mathworld.wolfram.com/SieveofEratosthenes.html</a> <a href="http://mathworld.wolfram.com/PrimeCountingFunction.html">http://mathworld.wolfram.com/PrimeCountingFunction.html</a></p>
