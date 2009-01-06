<pre>
3050 samples, 29.45 average ms/sample, 7384 scavenges, 0 incGCs,
81.13s active, 8.52s other processes,
89.82s real time, 0.17s profiling overhead

** Tree **
100.0 BlockClosure [] in Shootout.Tests class>>unboundMethod
  100.0 Shootout.Tests class>>fannkuch:to:
    100.0 Shootout.PermGenerator>>maxPfannkuchenTo:
      81.6 Array>>pfannkuchen
      16.7 Shootout.PermGenerator>>next
        16.0 Shootout.PermGenerator>>makeNext
      1.2 Magnitude>>max:

** Totals **
81.6 Array>>pfannkuchen
16.0 Shootout.PermGenerator>>makeNext
1.2 Magnitude>>max:
</pre>
