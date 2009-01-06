<p><strong>diff</strong> program output N = 3 with this <a href="iofile.php?test=<?=$SelectedTest;?>&amp;file=output">output file</a> to check your program is correct before contributing.</p>

<p>Each program should use the same na&#239;ve recursive-algorithms to calculate 3 simple numeric functions: ackermann, fibonnaci and tak.</p>
<pre>
Ack(x,y)
  x = 0     = y+1
  y = 0     = Ack(x-1,1)
  otherwise = Ack(x-1, Ack(x,y-1))

Fib(n)
  n < 2     = 1
  otherwise = Fib(n-2) + Fib(n-1)

Tak(x,y,z)
  y < x     = Tak(Tak(x-1.0,y,z),Tak(y-1.0,z,x),Tak(z-1.0,x,y))
  otherwise = z
</pre>
<br />

<p>For this benchmark, the fibonnaci and tak implementations should either provide separate functions - one for integer calculation and one for double calculation - or provide a function that uses integer calculation with integer parameters and double calculation with double parameters.</p><br />


<p>The Ackermann benchmark is described in <a href="http://cm.bell-labs.com/cm/cs/who/bwk/interps/pap.html">Timing Trials, or, the Trials of Timing: Experiments with Scripting and User-Interface Languages</a>.</p>
<p>For more information see Eric W. Weisstein, "Ackermann Function." From <a href="http://mathworld.wolfram.com"><i>MathWorld</i></a>--A Wolfram Web Resource.<br/><a href="http://mathworld.wolfram.com/AckermannFunction.html">http://mathworld.wolfram.com/AckermannFunction.html</a></p>
<p>For a different version of the Fibonacci function see Eric W. Weisstein, "Fibonacci Number." From <a href="http://mathworld.wolfram.com"><i>MathWorld</i></a>--A Wolfram Web Resource.<br/><a href="http://mathworld.wolfram.com/FibonacciNumber.html">http://mathworld.wolfram.com/FibonacciNumber.html</a></p>
<p>The tak benchmark is described in <a href="http://www.dreamsongs.com/NewFiles/Timrep.pdf">Performance and Evaluation of Lisp Systems</a>, Richard P. Gabriel, 1985, page 81. (1.1MB pdf)</p>
<p>For more information see Eric W. Weisstein, "TAK Function." From <a href="http://mathworld.wolfram.com"><em>MathWorld</em></a>--A Wolfram Web Resource.<br/><a href="http://mathworld.wolfram.com/TAKFunction.html">http://mathworld.wolfram.com/TAKFunction.html</a></p>
