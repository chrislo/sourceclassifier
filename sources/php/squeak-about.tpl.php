<p>Code size measurements are misleading for Smalltalk because source files are usually only used to archive or transfer code. Smalltalk code is created, stored and run in a Smalltalk <em>image</em>. We show Smalltalk source code in a verbose <em>chunk file</em> format used to archive or transfer source code between Smalltalk <em>images</em>.</p>
<p><a href="http://users.ipa.net/~dwighth/smalltalk/byte_aug81/design_principles_behind_smalltalk.html">"Design Principles Behind Smalltalk" by Daniel Ingalls</a></p>
<?=$Version;?>
<p>Home Page: <a href="http://www.squeak.org/">http://www.squeak.org/</a></p>
<p>Download: <a href="http://www.squeak.org/Download/">http://www.squeak.org/Download/</a></p>
<p>We use the Squeak map package <a href="http://map.squeak.org/package/812c9d14-5236-4cad-82ea-cc3e3837e30d">OSProcess</a> for stdio.</p>
<p></br>We've made the Smalltalk code a little more generic by abstracting out these implementation specific details:</p>
<pre>
Object subclass<span class="sym">: #</span>Tests   instanceVariableNames<span class="sym">:</span> <span class="str">''</span>   classVariableNames<span class="sym">:</span> <span class="str">''</span>   poolDictionaries<span class="sym">:</span> <span class="str">''</span>   category<span class="sym">:</span> <span class="str">'Shootout'</span><span class="sym">!</span>

<span class="sym">!</span>Tests class methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>arg   <span class="sym">^(</span>SmalltalkImage current getSystemAttribute<span class="sym">:</span> <span class="num">3</span><span class="sym">)</span> asInteger<span class="sym">! !</span>

<span class="sym">!</span>Tests class methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>stdin   <span class="sym">^</span>UnixProcess stdIn<span class="sym">! !</span>

<span class="sym">!</span>Tests class methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>stdinSpecial   <span class="sym">^</span>UnixProcess stdIn<span class="sym">! !!</span>Tests class methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>stdout   <span class="sym">^</span>UnixProcess stdOut<span class="sym">! !</span>

<span class="sym">!</span>Tests class methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>stdoutSpecial   <span class="sym">^</span>UnixProcess stdOut<span class="sym">! !</span>

<span class="sym">!</span>Stream methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>nl   <span class="kwa">self</span> nextPut<span class="sym">:</span> Character lf<span class="sym">! !</span>

<span class="sym">!</span>Stream methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>print<span class="sym">:</span> number digits<span class="sym">:</span> decimalPlaces
   <span class="sym">|</span> precision rounded <span class="sym">|</span>   decimalPlaces <span class="sym">&lt;=</span> <span class="num">0</span> ifTrue<span class="sym">: [^</span> number rounded printString<span class="sym">].</span>   precision <span class="sym">:=</span> Utilities floatPrecisionForDecimalPlaces<span class="sym">:</span> decimalPlaces<span class="sym">.</span>   rounded <span class="sym">:=</span> number roundTo<span class="sym">:</span> precision<span class="sym">.</span>
   <span class="kwa">self</span> nextPutAll<span class="sym">:       ((</span>rounded asScaledDecimal<span class="sym">:</span> decimalPlaces<span class="sym">)</span> printString copyUpTo<span class="sym">: $</span>s<span class="sym">)! !</span>

<span class="sym">!</span>Stream methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>print<span class="sym">:</span> number paddedTo<span class="sym">:</span> width   <span class="kwa">self</span> nextPutAll<span class="sym">: (</span>number printStringLength<span class="sym">:</span> width padded<span class="sym">:</span> <span class="kwa">false</span><span class="sym">)! !</span>
</pre>
