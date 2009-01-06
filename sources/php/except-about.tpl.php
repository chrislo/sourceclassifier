<p>Each program should be implemented the <a
  href="faq.php?sort=<?=$Sort;?>#sameway"><strong>same&nbsp;way</strong></a> - the same way as this <a href="benchmark.php?test=except&amp;lang=nice&amp;sort=<?=$Sort;?>">Nice program</a>.</p>

<p>Each program should raise and handle N exceptions:</p>
<ul>
<li>alternately raise Lo_Exception or Hi_Exception</li>
<li>handle and count Lo_Exceptions; re-throw other exceptions</li>
<li>handle and count Hi_Exceptions; re-throw other exceptions</li>
<li>handle other exceptions - print error message</li>
<li>print Lo_Exception and Hi_Exception counts</li>
</ul>

<p>Correct output N = 1000 is:</p>
<pre>
Exceptions: HI=500 / LO=500
</pre>
<br />

<p>Most normal programs do not use exceptions to the extent that they factor significantly into the overall performance. However, it is interesting to compare the different exception implementations in each language.</p>
<p>Languages that can limit catching exceptions at a given stack frame
  to a given exception type will perform better than those that can't,
  because the latter will have to catch all exceptions in the caller, and
  re-throw those that are not supposed to be caught at that level.  For
  instance, Perl implements exceptions via its eval/die functions, and you
  must catch all exceptions and re-throw those that do not belong to you.
  By contrast, Python allows you to specify just those exceptions you wish
  to catch, and others are automatically passed up the call chain.</p>
  