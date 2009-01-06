<p>Each program should do the <a href="faq.php?sort=<?=$Sort;?>#samething"><b>same&nbsp;thing</b></a>.</p>

<p>Essentially the benchmark is the-same-as the wordcount test in <a
  href="http://cm.bell-labs.com/cm/cs/who/bwk/interps/pap.html">
  Timing Trials, or, the Trials of Timing: Experiments with Scripting
  and User-Interface Languages</a> by Brian W. Kernighan and
  Christopher J. Van Wyk.</p>

<p>Each program reads the input from standard input; counts lines, words (whitespace delimited tokens), and characters; and outputs those counts.  Programs should not read more than 4K input at a time. Programs can assume the file ends in a newline, and programs should handle arbitrarily long lines.</p>

<p>Correct output for this 6KB <a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;sort=<?=$Sort;?>&amp;file=input">input file</a> is: </p>
<pre>
25 137 6121
</pre>
<br />

<p>(Note that as in the original version, whitespace is
  defined as space, newline and tab characters, which is a little
  different from the Unix <strong>wc</strong> command.)</p>