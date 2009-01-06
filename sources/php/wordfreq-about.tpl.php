<p>Each program should do the <a href="faq.php?sort=<?=$Sort;?>#samething"><strong>same&nbsp;thing</strong></a>.</p>

<p>Each program should:</p>
<ul>
<li>read a text file from stdin</li>
<li>extract all the words</li>
<li>convert the words to lowercase</li>
<li>calculate the frequency of each word in the text file</li>
<li>print each word and word frequency, in descending order by frequency and descending alphabetic order by word</li>
</ul>

<p>Correct output for this 170KB <a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;sort=<?=$Sort;?>&amp;file=input">input file</a> is in this 50KB 
<a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;sort=<?=$Sort;?>&amp;file=output">output file</a>.</p>
<br />

<p>Programs should use constant space over a range of input sizes. Programs may read the input file line-by-line, or with 4096 byte (or smaller) block reads.</p>

<p>The input file to the tests is the text file <em>The Prince</em>, by
  Nicoló Machiavelli.</p>

<p>(The <strong>bash</strong> program is really a pipeline using <strong>tr</strong>,
  <strong>grep</strong>, <strong>sort</strong> and <strong>uniq</strong>.  This is the UNIX way of
  combining tools in the shell to get things done.)</p>