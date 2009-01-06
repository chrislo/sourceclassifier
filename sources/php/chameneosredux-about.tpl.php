<p><strong>diff</strong> program output N = 600 with this <a href="iofile.php?test=<?=$SelectedTest;?>&amp;file=output">output file</a> to check your program output has <em>the correct format</em> before contributing.</p>

<p>The text-part and spelled-out numbers in the program output should match the expected output exactly. Thread scheduling may cause small differences in the other numbers, so program output is checked with <a href="http://www.math.utah.edu/~beebe/software/ndiff/">ndiff</a>.</p>


<p>Each program should</p>
<ul>
<li>create differently coloured (blue, red, yellow), differently named, concurrent chameneos creatures</li>
<li>each creature will repeatedly go to the meeting place and meet, or wait to meet, another chameneos "(at the request the
caller does not know whether another chameneos is already present or not, neither if there will be one in some future)"</li>
<li>both creatures will change colour to complement the colour of the chameneos that they met - don't use arithmetic to complement the colour, use if-else or switch/case or pattern-match</li>
<li>write all the colour changes for blue red and yellow creatures, using the colour complement function</li>
<li>for rendezvouses with an odd number of creatures (blue red yellow) and with an even number of creatures (blue red yellow red yellow blue red yellow red blue)
<ul>
<li>write the colours the creatures start with</li>
<li>after N meetings have taken place, for each creature write the number of creatures met and spell out the number of times the creature met a creature with the same name (should be zero)</li>
<li>spell out the sum of the number of creatures met (should be 2N)</li>
</ul>
</li>
</ul>

<p>The chameneos benchmark is an adaptation of <a href="http://cedric.cnam.fr/PUBLIS/RC474.pdf">"Chameneos, a Concurrency Game for Java, Ada and Others"</a> 100KB pdf (which includes example implementations in Java, Ada and C).</p>

<p>Programs may use kernel threads, lightweight threads&#8230; <strong>cooperative threads&#8230; and other programs with custom schedulers will be listed as interesting alternative implementations</strong>. Briefly say what concurrency technique is used in the program header comment.</p>
