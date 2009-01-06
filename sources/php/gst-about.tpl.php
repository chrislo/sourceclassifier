<p><a href="http://users.ipa.net/~dwighth/smalltalk/byte_aug81/design_principles_behind_smalltalk.html">"Design Principles Behind Smalltalk" by Daniel Ingalls</a></p>
<?=$Version;?>
<p>Home Page: <a href="http://smalltalk.gnu.org/"> GNU Smalltalk : The Smalltalk for those who can type </a></p>
<p>Download: <a href="http://smalltalk.gnu.org/download">Downloading GNU Smalltalk</a></p><br/>

<p><strong>--enable-jit was not available for this build</strong></p>


<p></br>We've made the Smalltalk code a little more generic by abstracting out these implementation specific details, these are read from the command line before each script:</p>
<pre>
Object subclass<span class="sym">: #</span>Tests   instanceVariableNames<span class="sym">:</span> <span class="str">''</span>   classVariableNames<span class="sym">:</span> <span class="str">''</span>   poolDictionaries<span class="sym">:</span> <span class="str">''</span>   category<span class="sym">:</span> <span class="str">'Shootout'</span><span class="sym">!</span>

<span class="sym">!</span>Tests class methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>arg   <span class="sym">^</span>Smalltalk arguments first asInteger<span class="sym">! !!</span>Tests class methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>stdin   <span class="sym">^</span>FileStream stdin<span class="sym">! !</span>

<span class="sym">!</span>Tests class methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>stdinSpecial   <span class="sym">^</span><span class="kwa">self</span> stdin bufferSize<span class="sym">:</span> <span class="num">4096</span><span class="sym">! ! !</span>Tests class methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>stdout   <span class="sym">^</span>FileStream stdout<span class="sym">! !</span>

<span class="sym">!</span>Tests class methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>stdoutSpecial
   <span class="sym">^</span><span class="kwa">self</span> stdout bufferSize<span class="sym">:</span> <span class="num">4096</span><span class="sym">! !</span>

<span class="sym">!</span>Stream methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>print<span class="sym">:</span> number digits<span class="sym">:</span> decimalPlaces
   <span class="sym">|</span> n s <span class="sym">|</span>
   n <span class="sym">:=</span> <span class="num">0.5</span>d0 <span class="sym">* (</span><span class="num">10</span> raisedToInteger<span class="sym">:</span> decimalPlaces negated<span class="sym">).</span>
   s <span class="sym">:= ((</span>number sign <span class="sym">&lt;</span> <span class="num">0</span><span class="sym">)</span> ifTrue<span class="sym">: [</span>number <span class="sym">-</span> n<span class="sym">]</span> ifFalse<span class="sym">: [</span>number <span class="sym">+</span> n<span class="sym">])</span> printString<span class="sym">.</span>   <span class="kwa">self</span> nextPutAll<span class="sym">: (</span>s copyFrom<span class="sym">:</span> <span class="num">1</span> to<span class="sym">: (</span>s indexOf<span class="sym">: $.) +</span> decimalPlaces<span class="sym">)! !</span>

<span class="sym">!</span>Stream methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>print<span class="sym">:</span> number paddedTo<span class="sym">:</span> width
   <span class="sym">|</span> s <span class="sym">|</span>
   s <span class="sym">:=</span> number printString<span class="sym">.</span>   <span class="kwa">self</span> nextPutAll<span class="sym">: (</span>String new<span class="sym">: (</span>width <span class="sym">-</span> s size<span class="sym">)</span> withAll<span class="sym">: $ ),</span> s<span class="sym">! !!</span>Integer methodsFor<span class="sym">:</span> <span class="str">'platform'</span><span class="sym">!</span>asFloatD   <span class="sym">^</span><span class="kwa">self</span> asFloat<span class="sym">! !</span>
</pre>
