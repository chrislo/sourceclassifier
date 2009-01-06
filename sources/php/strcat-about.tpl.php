<p>Each program should be implemented the 
<a href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=strcat&amp;lang=perl&amp;sort=<?=$Sort;?>">Perl program</a>.</p>

<p>Each program should:</p>
<ul>
<li>concatenate or append "hello\n" with a string (or string buffer or character array) N times </li>
<li>print the length of that string</li>
</ul>

<p>Correct output N = 40000 is:</p>
<pre>
240000
</pre>
<br />

<p>After each append, the string should be 6 characters longer. Programs should not construct a list of strings and join them. Programs should not pre-allocate the entire buffer needed to hold the final string. The string buffer should grow whenever more space is required by no more than double the current size.</p>



