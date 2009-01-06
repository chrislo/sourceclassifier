<p>Each program should do the <a
 href="faq.php?sort=<?=$Sort;?>#samething"><strong>same&nbsp;thing</strong></a>.</p>

<p>Reverse the input file from stdin, line by line. The benchmark is the-same-as the <em>tail</em> test in <a href="
  http://cm.bell-labs.com/cm/cs/who/bwk/interps/pap.html">
  Timing Trials, or, the Trials of Timing: Experiments with Scripting
  and User-Interface Languages</a> by Brian W. Kernighan and
  Christopher J. Van Wyk.</p>

<p>It's okay to use input methods other than line-oriented
  I/O, such as reading the entire input from stdin, as long as each
  read is no more than 4096 bytes at a time.</p>

<p>Correct output for this 100KB <a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;sort=<?=$Sort;?>&amp;file=input">input file</a> is in this 100KB
<a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;sort=<?=$Sort;?>&amp;file=output">output file</a>.</p>

<p>Programs can assume that the file ends with a trailing newline.</p>