<p>Each program should be implemented the <a
  href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=spellcheck&amp;lang=lua&amp;sort=<?=$Sort;?>">Lua program</a>.</p>
<p>The spellcheck benchmark measures line oriented I/O and hash table  (associative array) performance.</p>

<p>Each program should:</p>
<ul>
<li>read the word dictionary</li>
<li>read words from standard input and print
  those words which do not appear in the dictionary</li>
</ul>

<p>Correct output for this 345KB <a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;sort=<?=$Sort;?>&amp;file=input">input file</a> with this 345KB <a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;sort=<?=$Sort;?>&amp;file=dict">Usr.Dict.Words file</a> is:</p>
<pre>
zuul
zuul
zuul
zuul
zuul
</pre>
<br />


<p>Assume that for both the dictionary and standard
  input there is only one word per line.  The dictionary is based on
  /usr/dict/words, but we only use words that consist entirely of
  lowercase letters. Each program can assume that no line will exceed 128
  characters (including newline).</p>