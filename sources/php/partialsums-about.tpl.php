<p><strong>diff</strong> program output N = 25000 with this <a href="iofile.php?test=<?=$SelectedTest;?>&amp;file=output">output file</a> to check your program is correct before contributing.</p>

<p>(Programs may use a single-loop or several-loops; programs may cache <tt>&#178;&#8260;<sub>3</sub></tt>, <tt>k&#178;</tt>, <tt>k&#179;</tt>, <tt>sin k</tt>, <tt>cos k</tt> in local variables)

<p>Each program should use the same <strong>na&#239;ve</strong> iterative double-precision algorithms to calculate partial-sums of the series:</p>
<div>
<p>&#8721; (&#178;&#8260;<sub>3</sub>)<sup>k</sup> <sub>k=0, &#8230;</sub> <em>use power function</em></p>
<p>&#8721; k<sup>&#8722;0.5</sup> <sub>k=1, &#8230;</sub> <em>use power or sqrt function</em></p>
<p>&#8721; &#185;&#8260;<sub>k(k+1)</sub></p>
<p>&#8721; &#185;&#8260;<sub>k&#179;(sin k)&#178;</sub></p>
<p>&#8721; &#185;&#8260;<sub>k&#179;(cos k)&#178;</sub></p>
<p>&#8721; &#185;&#8260;<sub>k</sub></p>
<p>&#8721; &#185;&#8260;<sub>k&#178;</sub></p>
<p>&#8721; <sup>&#8722;1<sup>k+1</sup></sup>&#8260;<sub>k</sub></p>
<p>&#8721; <sup>&#8722;1<sup>k+1</sup></sup>&#8260;<sub>2k &#8722;1</sub></p>
</div>

<p>For more information see "General Series." From <a href="http://mathworld.wolfram.com"><i>MathWorld</i></a>--A Wolfram Web Resource.<br/><a href="http://mathworld.wolfram.com/topics/GeneralSeries.html">http://mathworld.wolfram.com/topics/GeneralSeries.html</a></p>
