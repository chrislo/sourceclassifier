<pre>
13318 samples, 69.06 average ms/sample, 384341 scavenges, 0 incGCs,
392.43s active, 525.8s other processes,
919.7s real time, 1.47s profiling overhead

** Tree **
100.0 BlockClosure [] in Shootout.Tests class>>unboundMethod
  99.8 Shootout.NBodySystem>>after:
    67.2 Shootout.Body>>and:velocityAfter:
      45.8 Shootout.Body>>decreaseVelocity:y:z:m:
      19.3 Shootout.Body>>increaseVelocity:y:z:m:
      2.1 primitives
    18.8 primitives
    9.8 OrderedCollection>>do:
      8.6 primitives
      1.3 [] in Shootout.NBodySystem>>after:
        1.0 primitives
        0.3 Shootout.Body>>positionAfter:
    3.5 OrderedCollection>>at:
    0.5 OrderedCollection>>size

** Totals **
45.8 Shootout.Body>>decreaseVelocity:y:z:m:
19.3 Shootout.Body>>increaseVelocity:y:z:m:
18.8 Shootout.NBodySystem>>after:
8.6 OrderedCollection>>do:
3.5 OrderedCollection>>at:
2.1 Shootout.Body>>and:velocityAfter:
1.0 [] in Shootout.NBodySystem>>after:
0.5 OrderedCollection>>size
0.3 Shootout.Body>>positionAfter:
</pre>
