<p>Each program should be implemented the <a
  href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=regex&amp;lang=perl&amp;sort=<?=$Sort;?>">Perl program</a>.</p>

<p>The regex benchmark measures regular expression pattern matching, extracting telephone numbers from a text.</p>

<p>Each program should:</p>
<ul>
<li>read text file</li>
<li>match the pattern against the file contents N times</li>
<li>print the text matches</li>
</ul>

<p>Correct output for this 1KB <a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;sort=<?=$Sort;?>&amp;file=input">input file</a> is:</p>
<pre>
1: (111) 111-1111
2: (111) 222-2222
3: (111) 333-3333
4: (111) 444-4444
5: (111) 555-5555
6: (111) 666-6666
7: (111) 777-7777
8: (111) 888-8888
9: (111) 999-9999
10: (111) 000-0000
11: (111) 232-1111
12: (111) 242-1111
</pre>
<br />

<p>The telephone number pattern:</p>
<ul>
   <li>there may be zero or one telephone numbers per line of input</li>
   <li>a telephone number may start at the beginning of the line or be
   preceeded by a non-digit, (which may be preceeded by anything)</li>
   <li>it begins with a 3-digit <i>area code</i> that looks like this
   (DDD) or DDD (where D is [0-9])</li>
   <li>the <i>area code</i> is followed by one space</li>
   <li>which is followed by the 3 digits of the <i>exchange</i>: DDD</li>
   <li>the <i>exchange</i> is followed by a space or hyphen [ -]</li>
   <li>which is followed by the last 4 digits: DDDD</li>
   <li>which can be followed by end of line or a non-digit (which may be
   followed by anything).</li>
</ul>

<p><strong>Please Note:</strong> this test is due for an overhaul, because of the
  variety of solutions for this test that aren't really using regular
  expressions.</p>

<p>The C program uses the <a href="
  ftp://ftp.csx.cam.ac.uk/pub/software/programming/pcre"> Perl
  Compatible Regular Expressions</a> (PCRE) library.</p>
<p>The C++ program uses Bill Lear's <a href="
  http://sourceforge.net/projects/regx/">PCRE library for C++</a>.</p>
<p>Markus Mottl helped me use his <a href="http://pcre-ocaml.sourceforge.net/">
  PCRE library for Ocaml</a>.</p>

<p>The Java program uses a 3rd party, mostly-Perl5-compatible regexp
  library, called ORO.  Apparently this package, once available from
  oroinc.com (defunct), is now maintained by the <a href="
  http://jakarta.apache.org/oro/">Apache Jakarta project</a>.</p>

<p>Bigloo's regular <a href="regexmatch.bigloo">grammar facility</a> is
  very powerful.  I wish all languages offered this feature.  I think it
  shows that while it's nice to be able to do complex pattern matching,
  it is really more important how easily you can do something with the
  matched data.</p>

