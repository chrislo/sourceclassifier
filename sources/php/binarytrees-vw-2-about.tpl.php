<pre>
126 samples, 79.24 average ms/sample, 2418 scavenges, 34 incGCs,
3.22s active, 6.71s other processes,
9.98s real time, 0.06s profiling overhead

** Tree **
100.0 BlockClosure [] in Shootout.Tests class>>unboundMethod
  100.0 Shootout.Tests class>>binarytrees:to:
    68.8 Shootout.TreeNode class>>bottomUpTree:depth:
      68.8 Shootout.TreeNode class>>bottomUpTree:depth:
        66.7 Shootout.TreeNode class>>bottomUpTree:depth:
          64.8 Shootout.TreeNode class>>bottomUpTree:depth:
            61.8 Shootout.TreeNode class>>bottomUpTree:depth:
              57.8 Shootout.TreeNode class>>bottomUpTree:depth:
                54.4 Shootout.TreeNode class>>bottomUpTree:depth:
                  46.1 Shootout.TreeNode class>>bottomUpTree:depth:
                    45.1 Shootout.TreeNode class>>bottomUpTree:depth:
                      38.2 Shootout.TreeNode class>>bottomUpTree:depth:
                        29.5 Shootout.TreeNode class>>bottomUpTree:depth:
                          20.5 Shootout.TreeNode class>>bottomUpTree:depth:
                            15.7 Shootout.TreeNode class>>bottomUpTree:depth:
                              11.9 Shootout.TreeNode class>>bottomUpTree:depth:
                                9.1 Shootout.TreeNode class>>bottomUpTree:depth:
                                  5.1 Shootout.TreeNode class>>bottomUpTree:depth:
                                    4.0 Shootout.TreeNode class>>bottomUpTree:depth:
                                      2.1 Shootout.TreeNode class>>left:right:item:
                                  2.3 primitives
                                2.0 Shootout.TreeNode class>>left:right:item:
                              2.1 Shootout.TreeNode class>>left:right:item:
                            2.6 primitives
                            2.1 Shootout.TreeNode class>>left:right:item:
                          4.7 primitives
                          4.3 Shootout.TreeNode class>>left:right:item:
                            3.4 primitives
                        4.7 primitives
                        4.0 Shootout.TreeNode class>>left:right:item:
                          2.7 primitives
                      3.7 Shootout.TreeNode class>>left:right:item:
                        2.8 primitives
                      3.3 primitives
                  4.6 Shootout.TreeNode class>>left:right:item:
                    3.1 Shootout.TreeNode>>left:right:item:
                  3.7 primitives
              3.2 Shootout.TreeNode class>>left:right:item:
                2.3 Shootout.TreeNode>>left:right:item:
    31.2 Shootout.TreeNode>>itemCheck
      30.6 Shootout.TreeNode>>itemCheck
        29.6 Shootout.TreeNode>>itemCheck
          28.7 Shootout.TreeNode>>itemCheck
            26.9 Shootout.TreeNode>>itemCheck
              24.1 Shootout.TreeNode>>itemCheck
                23.5 Shootout.TreeNode>>itemCheck
                  21.4 Shootout.TreeNode>>itemCheck
                    19.4 Shootout.TreeNode>>itemCheck
                      17.1 Shootout.TreeNode>>itemCheck
                        17.1 Shootout.TreeNode>>itemCheck
                          15.8 Shootout.TreeNode>>itemCheck
                            11.7 Shootout.TreeNode>>itemCheck
                              8.4 Shootout.TreeNode>>itemCheck
                                8.4 Shootout.TreeNode>>itemCheck
                                  6.2 primitives
                                  2.2 Shootout.TreeNode>>itemCheck
                                    2.2 Shootout.TreeNode>>itemCheck
                              3.3 primitives
                            4.1 primitives
                      2.4 primitives
                  2.2 primitives
              2.8 primitives

** Totals **
31.2 Shootout.TreeNode>>itemCheck
31.0 Shootout.TreeNode class>>bottomUpTree:depth:
20.5 Shootout.TreeNode class>>left:right:item:
17.4 Shootout.TreeNode>>left:right:item:

</pre>
