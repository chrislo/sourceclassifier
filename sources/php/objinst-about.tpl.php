<p>Each program should be implemented the <a
  href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=objinst&amp;lang=java&amp;sort=<?=$Sort;?>">Java program</a>.</p>

<p>The objects benchmark measures the speed of object creation in OO languages. It measures a mixture of base class and a derived class object creation.</p>
<p>Each program should:</p>

<ul>
<li>create a <em>Toggle</em> object</li>
<li>activate the object 5 times and print the object's boolean state each time</li>
<li>create N <em>Toggle</em> objects</li>
<li>create an <em>NthToggle</em> object</li>
<li>activate the object 8 times and print the object's boolean state each time</li>
<li>create N <em>NthToggle</em> objects</li>
</ul>

<p>Correct output is:</p>
<pre>
false
true
false
true
false

true
true
false
false
false
true
true
true
</pre>
<br />

<p>The base class <em>Toggle</em> toggles it's boolean state each time it is activated. The derived class <em>NthToggle</em> toggles it's boolean state the Nth time it is activated.</p>
<p>The derived <em>NthToggle</em> class should:</p>
<ul>
<li>inherit the boolean state from <em>Toggle</em></li>
<li>override the <em>Toggle</em> activate method, to toggle on the Nth activation</li>
<li>use the <em>Toggle</em> constructor</li>
<li>inherit the <em>Toggle</em> value method</li>
</ul>

<p>(These classes are also used in the <a href="benchmark.php?test=methcall&amp;lang=all&amp;sort=<?=$Sort;?>">methods benchmark</a>.)</p>
<p>This benchmark needs to be re-designed a little to avoid the creation of invariant objects.</p>