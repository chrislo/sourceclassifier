<p><strong>diff</strong> program output N = 2 with this <a href="iofile.php?test=<?=$SelectedTest;?>&amp;file=output">output file</a> to check your program is correct before contributing.
</p>

<p>Each program should count the prime numbers from 2 to M, using the same na&#239;ve Sieve of Eratosthenes algorithm:</p>
<ul>
  <li>create an array of M <strong>bit flags</strong> which represent either prime or not-prime</li>
  <li>for each index number
     <ul>
     <li>test the flag value at that index
      <ul>
      <li>set or clear the flag values at multiples of that index as necessary</li>
      <li>if necessary keep and increment a separate count</li>
      </ul>
     </li>
     </ul>
   </li>
</ul>

<p>Calculate 3 prime counts, for M = 2<sup>N</sup> &#215; 10000, 2<sup>N-1</sup> &#215; 10000, and 2<sup>N-2</sup> &#215; 10000.</p>

<p>A variation on the <a href="benchmark.php?test=nsieve&amp;lang=all&amp;sort=<?=$Sort;?>">nsieve benchmark</a> with 2 differences - bit flags are used and it's acceptable to test the bit value and only flip values that need to be changed.</p>
