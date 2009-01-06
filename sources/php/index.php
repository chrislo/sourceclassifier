<!--#set var="KEYWORDS" value="performance, benchmark, ackerman,
ackermann, ackerman's, ackermann's, function, c, erlang, guile, java,
perl, python, computer, language, compare, cpu, memory, recursion" -->
<!--#set var="TITLE" value="Ackermann's Function" -->

<?php require("../../html/testtop.php");
      testtop("Ackermann's Function"); ?>

<div class="h4"><h4>About this test</h4></div>
<p>For this test, each program should be implemented in the <a
  href="../../method.php#sameway"><i>same way</i></a>. (For this
  test, all solutions must use recursion as specified below. For a
  number of languages other (iterative) techniques may be much faster,
  but that would make it a different test.)</p>
<p>Each program should implement the recursive version of Ackermann's
  function illustrated below.</p>
<p>Ackermann's function is heavily recursive, and will really
  stress a language's ability to do deep recursion.  This test
  computes the value of Ack(3, N), where N ranges up to 8.  Visit
  the <a href="detail.php">detail page</a> to see results for
  different values of N.  Those languages that do not implement
  tail recursion elimination (tail-call elimination) will not
  peform as well as those that do.</p>
<p>This test also appears in the Kernighan and Wyk study <a
  href="http://cm.bell-labs.com/cm/cs/who/bwk/interps/pap.html">
  Timing Trials, or, the Trials of Timing: Experiments with Scripting
  and User-Interface Languages</a>, where they say it will give a
  language's function call mechanism a workout.  However, this probably
  isn't so accurate for languages that do tail-call elimination, since
  they essentially turn recursive tail-calls into iterative loops.</p>
<div class="donemessage">
<p>The correct output (for N = 4) looks like this:
  <pre><?php require("Output"); ?></pre>
</p>
</div>

<div class="h4"><h4>Observations</h4></div>
<p>The <a href="ackermann.bash">bash program</a> is disqualified
  because it exceeds the time limit (300 CPU seconds).</p>
<p>The <a href="ackermann.guile">guile program</a> fails from stack
  overflow unless I add <code>(debug-set! stack 0)</code>.</p>
<p>The <a href="ackermann.tcl">Tcl program</a> fails from stack
  overflow.</p>
<p>The <a href="ackermann.bigforth">bigforth program</a> dumps core.</p>
<p>I was a little surprised by Perl's bad performance and memory usage
  in this test.  Then Ben Tilly wrote to me: <i>As for your Ackermann
  test, Perl actually keeps around call frames when they are done so
  that it can call them again faster.  This is undoubtably why that
  recursion is so slow.</i></p>

<div class="h4"><h4>About Ackermann's Function</h4></div>
<p>
<table cellpadding="8" align="center" width="90%" bgcolor="#c0e0e0">
  <tr>
    <td>
      <p>From: <a href="http://pweb.netcom.com/~hjsmith/Ackerman.html">Harry
       J. Smith's web page about the Ackermann Function:</a></p>
      <p><i>The Ackermann function is the simplest example of a well-defined
       total function which is computable but not primitive recursive. See
       the article &quot;A function to end all functions&quot; by Gunter
       Dötzel, Algorithm 2.4, Oct 1991, Pg 16. The function f(x) = A(x, x)
       grows much faster than polynomials or exponentials. The definition
       is:</i>
       <pre>
          1. If x = 0 then  A(x, y) = y + 1
          2. If y = 0 then  A(x, y) = A(x-1, 1)
          3. Otherwise,     A(x, y) = A(x-1, A(x, y-1))
       </pre>
    </td>
  </tr>
</table>

<div class="h4"><h4><a href="alt/">Alternates</a></h4></div>
<p><i>This section is for displaying alternate solutions that are either
  slower than ones above or perhaps don't quite meet my criteria for
  the competition, but are otherwise worthy of comment.</i>
<ul>
  <li>I find Forth a little hard to read, so I have an <a href=
  "alt/ann.ackermann.forth">annotated</a> version of the Forth
  ackermann's function program.</li>
  <li>The <a href="ackermann.perl">Perl program</a> is quite bad at
  this type of heavy recursion, so I wrote a second version <a href=
  "alt/ackermann.perl2.perl">perl2</a>, which saves intermediate
  calculations (This technique is called <i>memoizing</i>).  The
  memoizing version is as fast as some of the compiled languages,
  but you should note that this cheat won't get you very far, the
  combinatorial explosion will still get you in the end.  Please
  keep kids and pets out of the blast area.</li>
  <li>Marcus Comstedt contributed a <a href="alt/ackermann.pike2.pike">
  Pike program</a> that uses memoization, and he also contributed
  another <a href="alt/ackermann.pike3.pike">Pike program</a> that
  avoids the recursive call altogether :-)</li>
  <li>Johan Boulé contributed a <a href="alt/ackermann.se2.se">SmallEiffel</a>
  that converts some of the recursive calls to an iterative implementation.</li>
  <li>Michael A. Cleverly submitted a <a href="alt/ackermann.tcl2.tcl">Tcl
  program</a> that avoids the recursion by defining Tcl functions on
  the fly that define the result for a given pair of inputs.  This is
  similar to memoization where results of invariant functions are
  remembered.  Some functional languages work like this automatically.</li>
</ul>

  </tr>
</table>
                                                                                
<?php require("../../html/footer.php"); ?>
