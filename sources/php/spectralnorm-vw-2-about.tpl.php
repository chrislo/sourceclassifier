<pre>
14289 samples, 39.1 average ms/sample, 319397 scavenges, 3 incGCs,
398.22s active, 159.61s other processes,
558.76s real time, 0.93s profiling overhead

** Tree **
100.0 BlockClosure [] in Shootout.Tests class>>unboundMethod
  100.0 Shootout.Tests class>>spectralnorm:
    100.0 Array>>multiplyAtAv
      50.1 Array>>multiplyAv
        46.4 primitives
        3.7 SmallInteger>>matrixA:
      49.9 Array>>multiplyAtv
        46.5 primitives
        3.4 SmallInteger>>matrixA:

** Totals **
46.5 Array>>multiplyAtv
46.4 Array>>multiplyAv
7.1 SmallInteger>>matrixA:
</pre>
