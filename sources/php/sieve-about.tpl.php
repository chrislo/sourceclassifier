<p>Each program should be implemented the <a href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=sieve&amp;lang=gcc&amp;sort=<?=$Sort;?>">C program</a>.</p>

<p>Count the prime numbers from 2 to 8192 N times.</p> 
<p>Find the prime numbers with Eratosthenes Sieve:</p>
<ul>
  <li>mark all numbers as prime numbers</li>
  <li>for each number
     <ul>
     <li>if the number is marked, unmark all multiples of the number</li>
     </ul>
   </li>
  <li>count the remaining marked numbers and print the count</li>
</ul>


<p>Correct output N = 10 is:</p>
<pre>
Count: 1028
</pre>
<br />

<p>This method of finding prime numbers is named after its inventor,
  Eratosthenes of Cyrene (now in Libya), who lived from 276 to 197 BC.
  After studying in Alexandria and Athens he became the director of
  the Library in Alexandria.  After Eratosthenes, the science of prime
  numbers was pretty much stagnant until Fermat came along in the 17th
  century.  Eratosthenes is also known for his fairly accurate
  measurements of the Earth's circumference, tilt, and distance from
  the sun and moon.</p>



