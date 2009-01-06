<p>The parallelMap function in CAL creates a new java thread to apply the function to each of the elements in the list in parallel.</p><pre>(parallelMap
    (\colour -> chameneos colour meetingRoom occupant 0)
   [Red, Blue, Yellow]</pre>
<p>Starts three JVM threads executing the chamenoes function, one Red,
one Blue and one Yellow.</p>

<p>These three threads share the mutable variables meetingRoom and
occupant. The code is significantly faster than the Java
implementation as MutableVariable rely on Java's AtomicReferences and
Yield to pass values between the threads.</p>

<p>The MutableVariables are a very reasonable method to pass
the values between threads in functional language - this is
equivalent to the MVar's in Haskell - originating from m- and i-
structures in the Id functional language.</p>
