<dl>
<dt><a href="#dynamic" name="dynamic">What about Java dynamic compilation?</a></dt>
<dd>
<dl>
<dd>
<p>Sometimes Java programmers point out that JVM profiling and dynamic compilation will improve program performance when the same program is used again and again and again without shutting down the JVM. Sometimes other programmers don't believe that JVM profiling and dynamic compilation will have any effect on simple programs like those shown in the benchmarks game - let's take a look.</p>

<p>In these examples we measured elapsed time (in seconds) once the Java program had started: in the first case, we simply started and measured the program 400 times; in the second case, we started the program once and measured the program again and again and again 400 times, without restarting the JVM. </p>
</dd>


<dt><a href="#nsieve" name="nsieve">nsieve</a></dt>
<dd>
<table>
<tr>
<th colspan="2">&nbsp;started&nbsp;400&nbsp;times&nbsp;</th>
<th colspan="2">&nbsp;started&nbsp;once&nbsp;</th>
</tr>
<tr>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
</tr>
<tr>
<td>2.37</td>
<td>0.05</td>
<td>2.14</td>
<td>0.01</td>
</tr>
</table>
<p><img src="<?=IMAGE_PATH;?>jnsieve.png"
   alt=""
   title=""
   width="450" height="150"
 /></p>
 </dd>
 
 
<dt><a href="#mandelbrot" name="mandelbrot">mandelbrot</a></dt>
<dd>
<table>
<tr>
<th colspan="2">&nbsp;started&nbsp;400&nbsp;times&nbsp;</th>
<th colspan="2">&nbsp;started&nbsp;once&nbsp;</th>
</tr>
<tr>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
</tr>
<tr>
<td>3.42</td>
<td>0.01</td>
<td>3.20</td>
<td>0.01</td>
</tr>
</table>
<p><img src="<?=IMAGE_PATH;?>jmandelbrot.png"
   alt=""
   title=""
   width="450" height="150"
 /></p>
 </dd>

<dt><a href="#binarytrees" name="binarytrees">binary-trees</a></dt>
<dd>
<table>
<tr>
<th colspan="2">&nbsp;started&nbsp;400&nbsp;times&nbsp;</th>
<th colspan="2">&nbsp;started&nbsp;once&nbsp;</th>
</tr>
<tr>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
</tr>
<tr>
<td>6.37</td>
<td>0.06</td>
<td>5.66</td>
<td>0.05</td>
</tr>
</table>
<p><img src="<?=IMAGE_PATH;?>jbinarytrees.png"
   alt=""
   title=""
   width="450" height="150"
 /></p>
 </dd>


<dt><a href="#nsievebits" name="nsievebits">nsieve-bits</a></dt>
<dd>
<table>
<tr>
<th colspan="2">&nbsp;started&nbsp;400&nbsp;times&nbsp;</th>
<th colspan="2">&nbsp;started&nbsp;once&nbsp;</th>
</tr>
<tr>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
</tr>
<tr>
<td>7.43</td>
<td>0.28</td>
<td>7.15</td>
<td>0.08</td>
</tr>
</table>
<p><img src="<?=IMAGE_PATH;?>jnsievebits.png"
   alt=""
   title=""
   width="450" height="150"
 /></p>
 </dd>
 
 <dt><a href="#fannkuch" name="fannkuch">fannkuch</a></dt>
<dd>
<table>
<tr>
<th colspan="2">&nbsp;started&nbsp;400&nbsp;times&nbsp;</th>
<th colspan="2">&nbsp;started&nbsp;once&nbsp;</th>
</tr>
<tr>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
</tr>
<tr>
<td>11.66</td>
<td>0.16</td>
<td>11.13</td>
<td>0.43</td>
</tr>
</table>
<p><img src="<?=IMAGE_PATH;?>jfannkuch.png"
   alt=""
   title=""
   width="450" height="150"
 /></p>
 </dd>


 <dt><a href="#nbody" name="nbody">nbody</a></dt>
<dd>
<table>
<tr>
<th colspan="2">&nbsp;started&nbsp;400&nbsp;times&nbsp;</th>
<th colspan="2">&nbsp;started&nbsp;once&nbsp;</th>
</tr>
<tr>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
</tr>
<tr>
<td>16.21</td>
<td>0.05</td>
<td>16.06</td>
<td>0.34</td>
</tr>
</table>
<p><img src="<?=IMAGE_PATH;?>jnbody.png"
   alt=""
   title=""
   width="450" height="150"
 /></p>
 </dd>

<dt><a href="#spectral" name="spectral">spectral-norm</a></dt>
<dd>
<table>
<tr>
<th colspan="2">&nbsp;started&nbsp;400&nbsp;times&nbsp;</th>
<th colspan="2">&nbsp;started&nbsp;once&nbsp;</th>
</tr>
<tr>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
<th class="txt">mean</th>
<th class="txt">&#963;</th>
</tr>
<tr>
<td>24.71</td>
<td>0.02</td>
<td>23.65</td>
<td>0.05</td>
</tr>
</table>
<p><img src="<?=IMAGE_PATH;?>jspectralnorm.png"
   alt=""
   title=""
   width="450" height="150"
 /></p>
 </dd>
</dl>
</dd>

<dd>
<p>The costs of JVM profiling and dynamic compilation are always included in the first case; in the second case the first measurement shows the costs of partial interpretation and JVM profiling and dynamic compilation, but the next 399 measurements show the benefits without showing the costs. We can't just wish the costs away - Java bytecode does need to be loaded and profiled and compiled.</p>
</dd>
</dl>
