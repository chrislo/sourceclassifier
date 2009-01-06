<p>What does -Xrunhprof show?</p>
<pre>SITES BEGIN (ordered by live bytes) Mon Oct 23 14:08:14 2006
          percent          live          alloc'ed  stack class
 rank   self  accum     bytes objs     bytes  objs trace name
    1 21.47% 21.47%   1023760 63985 326300224 20393764 302031 scala.$colon$colon
    2 18.11% 39.58%    863736 35989  57000696 2375029 302006 scala.concurrent.MailBox$Receiver
    3 12.08% 51.66%    576000 36000  38000496 2375031 302000 message$Incrementor$0$$anonfun$0
    4 12.02% 63.68%    573344 35834  37917888 2369868 302040 message$Message$0
    5  9.73% 73.41%    463936 28996   5280560 330035 302009 scala.$colon$colon
    6  2.61% 76.02%    124464 5186  49127208 2046967 302029 scala.collection.mutable.ListBuffer
    7  2.12% 78.15%    101168 6323    106544  6659 302025 message$Message$0
    8  1.97% 80.11%     93792 5862  38000448 2375028 302008 scala.concurrent.MailBox$$anonfun$0
    9  1.96% 82.08%     93616 5851  37917824 2369864 302041 scala.concurrent.MailBox$$anonfun$1
   10  1.75% 83.82%     83344 5209  32751472 2046967 302028 scala.$colon$colon

CPU SAMPLES BEGIN (total = 1914688) Mon Oct 23 14:08:14 2006
rank   self  accum   count trace method
   1 30.95% 30.95%  592508 302045 java.lang.Object.&lt;init&gt;
   2 14.11% 45.06%  270170 302032 java.lang.Object.&lt;init&gt;
   3 13.15% 58.20%  251709 302048 java.lang.Object.&lt;init&gt;
   4  6.35% 64.55%  121561 302013 java.lang.Object.&lt;init&gt;
   5  6.08% 70.64%  116501 302047 java.lang.Object.&lt;init&gt;
   6  6.04% 76.68%  115733 302050 java.lang.Object.&lt;init&gt;
   7  4.99% 81.67%   95499 302059 java.lang.Object.&lt;init&gt;
   8  3.71% 85.37%   70945 302054 java.lang.Object.&lt;init&gt;
   9  3.66% 89.03%   70112 302066 java.lang.Object.&lt;init&gt;
  10  3.30% 92.34%   63221 302021 java.lang.Object.&lt;init&gt;
</pre>
