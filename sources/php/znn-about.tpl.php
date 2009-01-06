<?=$Version;?>
<p>Home Page: <a href="http://www.zonnon.ethz.ch/">zonnon programming language & compiler</a></p>
<p>Download: <a href="http://www.zonnon.ethz.ch/compiler/download.html">compiler for Mono/Rotor (Eclipse plugin)</a></p>

<pre>
<span class="hl kwa">module</span> BenchmarksGame;
<span class="hl kwa">import</span> System;

<span class="hl kwa">procedure</span> {public} argi(): <span class="hl kwa">integer</span>;
<span class="hl kwa">var</span> 
   objArray : System.Array;
   obj : System.Object;
<span class="hl kwa">begin</span>
   objArray := System.Environment.GetCommandLineArgs();
   obj := objArray.GetValue(1);
   <span class="hl kwa">return</span> <span class="hl kwa">integer</span>(System.Int32.Parse(obj.ToString()));
<span class="hl kwa">end</span> argi;

<span class="hl kwa">end</span> BenchmarksGame.
</pre>
