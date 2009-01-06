<p>Simulate a hierarchical healthcare system, with patient transfers from lower-level district hospitals to higher-level regional hospitals.</p>

<p>Each healthcare region</p>
<ul>
<li>has a reference to one local hospital</li>
<li>has 4 subregions</li>
<li>gathers transfer patients from the 4 subregions</li>
</ul>

<p>Each hospital</p>
<ul>
<li>has 0.3 new patient arrivals per time period</li>
<li>has additional transfer patient arrivals</li>
<li>manages 3 patient queues - triage, examination, treatment (Patient queues must be implemented as a linked list, with na&#239;ve <em>add patient</em> and <em>remove patient</em> operations.)</li>
</ul>

<p>Each patient</p>
<ul>
<li>arriving at the highest-level regional hospital will be treated</li>
<li>arriving at a district hospital has 0.9 probability of being treated without transfer from that hospital</li>
</ul>
<br />

<p>Correct output N = 100 is:</p> 
<pre>Patients: 10151
Time:     363815
Visits:   10526

Treatment Queue - Remaining Treatment Time
1       anonymous patient
3       anonymous patient
9       anonymous patient
10      anonymous patient</pre><br />

<p>This is a <em>simplified version</em> of the health benchmark in the
<a href="http://www.cs.princeton.edu/~mcc/olden.html">Olden Benchmark Suite</a>
and <a href="http://ali-www.cs.umass.edu/DaCapo/benchmarks.html">Jolden
Benchmarks</a>.</p>

<p>The original reference seems to be 
G. Lomow, J. Cleary, B. Unger and D. West.  
"A Performance Study of Time Warp" <em>SCS Multiconference on Distributed Simulation</em>, 
pages 50-55, Feb. 1988.
</p>
