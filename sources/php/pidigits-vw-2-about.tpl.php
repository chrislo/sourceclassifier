<pre>
402 samples, 32.56 average ms/sample, 4118 scavenges, 13 incGCs,
9.46s active, 3.5s other processes,
13.09s real time, 0.13s profiling overhead
</pre>
<pre>** Totals **
47.6 LargeInteger>>*
25.1 LargeInteger>>//
11.8 LargeInteger>>productFromInteger:
10.4 LargeInteger>>+
4.4 LargeInteger>>sumFromInteger:
</pre>
<pre>** Tree **
100.0 BlockClosure [] in Shootout.Tests class>>unboundMethod
  100.0 Stream>>next:
    100.0 Stream>>next:into:startingAt:
      100.0 BlockClosure>>on:do:
        100.0 [] in Stream>>next:into:startingAt:
          100.0 Shootout.PiDigitSpigot>>next
            76.8 Shootout.PiDigitSpigot>>next
              57.0 Shootout.PiDigitSpigot>>next
                35.5 Shootout.PiDigitSpigot>>next
                  19.8 Shootout.PiDigitSpigot>>next
                    9.3 Shootout.PiDigitSpigot>>next
                      3.6 Shootout.PiDigitSpigot>>next
                    3.5 Shootout.PiDigitSpigot>>isSafe:
                      3.5 Shootout.Transformation>>extract:
                  5.1 Shootout.PiDigitSpigot>>consume:
                    5.1 Shootout.Transformation>>*
                      4.8 LargeInteger>>*
                  3.7 Shootout.PiDigitSpigot>>produce:
                    3.7 Shootout.Transformation>>*
                      3.4 SmallInteger>>*
                        3.4 LargeInteger>>productFromInteger:
                  3.7 Shootout.PiDigitSpigot>>digit
                    3.7 Shootout.Transformation>>extract:
                  3.2 Shootout.PiDigitSpigot>>isSafe:
                    3.2 Shootout.Transformation>>extract:
                5.8 Shootout.PiDigitSpigot>>digit
                  5.8 Shootout.Transformation>>extract:
                5.8 Shootout.PiDigitSpigot>>consume:
                  5.8 Shootout.Transformation>>*
                    4.8 LargeInteger>>*
                5.6 Shootout.PiDigitSpigot>>isSafe:
                  5.6 Shootout.Transformation>>extract:
                    3.8 LargeInteger>>//
                4.3 Shootout.PiDigitSpigot>>produce:
                  4.3 Shootout.Transformation>>*
                    3.9 SmallInteger>>*
                      3.9 LargeInteger>>productFromInteger:
              8.3 Shootout.PiDigitSpigot>>consume:
                8.3 Shootout.Transformation>>*
                  6.8 LargeInteger>>*
              6.7 Shootout.PiDigitSpigot>>digit
                6.7 Shootout.Transformation>>extract:
                  3.1 LargeInteger>>//
              4.0 Shootout.PiDigitSpigot>>isSafe:
                4.0 Shootout.Transformation>>extract:
            11.4 Shootout.PiDigitSpigot>>consume:
              11.4 Shootout.Transformation>>*
                9.7 LargeInteger>>*
            5.6 Shootout.PiDigitSpigot>>isSafe:
              5.6 Shootout.Transformation>>extract:
                3.2 LargeInteger>>//
            5.4 Shootout.PiDigitSpigot>>digit
              5.4 Shootout.Transformation>>extract:
</pre>
