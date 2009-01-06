<p>
The Cheap Concurrency uses the cooperative multi-tasking library
proposed by SmartEiffel: <a
href="http://smarteiffel.loria.fr/wiki/en/index.php/Lib/sequencer"><tt>lib/sequencer</tt></a>.
</p>
<p>
The threads are defined as <a
href="http://smarteiffel.loria.fr/libraries/JOB.html"><tt>JOB</tt></a>
objects. In this program, they are called <tt>CREATURE</tt>s and are
implemented in the same way as the library's <a
href="http://smarteiffel.loria.fr/libraries/BACKGROUND_JOB.html"><tt>BACKGROUND_JOB</tt></a>s
(I could have inherited from that class, oh well...)
</p>
