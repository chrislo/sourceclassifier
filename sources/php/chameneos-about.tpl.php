<p><strong>diff</strong> program output N = 100 with this <a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;file=output">output file</a> to check your program is correct before contributing.
</p>

<p>Programs may use kernel threads, lightweight threads&#8230; <strong>cooperative threads&#8230; and other programs with custom schedulers will be listed as interesting alternative implementations</strong>. Briefly say what concurrency technique is used in the program header comment.</p>

<p>Each program should</p>
<ul>
<li>create four differently coloured (blue, red, yellow, blue) concurrent chameneos creatures</li>
<li>each creature will repeatedly go to the meeting place and meet, or wait to meet, another chameneos "(at the request the
caller does not know whether another chameneos is already present or not, neither if there will be one in some future)"</li>
<li>each creature will change colour to complement the colour of the chameneos that they met - don't use arithmetic to complement the colour, use if-else or switch/case or pattern-match</li>
<li>after N total meetings have taken place, any creature entering the meeting place will take on a faded colour, report the number of creatures it has met, and end</li>
<li>write the sum of reported creatures met</li>
</ul>

<p>The chameneos benchmark is a simplistic adaptation of <a href="http://cedric.cnam.fr/PUBLIS/RC474.pdf">"Chameneos, a Concurrency Game for Java, Ada and Others"</a> 100KB pdf (which includes example implementations in Java, Ada and C).</p>
