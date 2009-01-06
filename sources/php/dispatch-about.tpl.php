<p>The <a href="http://c2.com/cgi/wiki?StatePattern">State pattern</a>, <a href="http://c2.com/cgi/wiki?FlyweightPattern">Flyweight pattern</a>, and <a href="http://c2.com/cgi/wiki?SingletonPattern">Singleton pattern</a> are one way to represent state machines in object-oriented programming languages - and are the basis for this very contrived measurement of virtual method dispatch.</p> 

<p>(Procedural implementations should switch on the tag value of BottleState records - see <a href="benchmark.php?test=dispatch&amp;lang=ooc&amp;sort=<?=$Sort;?>#program">B_DispatchNext and PB_DispatchNext</a>.)</p>
<br />

<p>Bottle objects cycle between 3 states - Empty, Full, Sealed - which are represented by flyweight (or singleton) instances of EmptyState or FullState or SealedState (subclasses of the abstract class BottleState) which specify their successor state:</p>


<ul>
   <li><em>BottleState</em>
      <ul>
      <li>EmptyState</li>
      <li>FullState</li>
      <li>SealedState</li>    
      </ul>      
   </li>    
</ul>


<p>PressurizedBottle objects cycle between 4 states- UnpressurizedEmpty, UnpressurizedFull, PressurizedUnsealed, PressurizedSealed - which are represented by flyweight (or singleton) instances of  the corresponding subclasses of the abstract class PressurizedBottleState (itself a subclass of BottleState):</p>
<ul>
   <li><em>BottleState</em>
      <ul>
      <li><em>PressurizedBottleState</em>
         <ul>
         <li>UnpressurizedEmptyState</li>
         <li>UnpressurizedFullState</li>
         <li>PressurizedUnsealedState</li>
         <li>PressurizedSealedState</li>      
         </ul>             
      </li>      
      </ul>      
   </li>    
</ul>


<p>PressurizedBottle is a subclass of Bottle:</p>
</p>
<ul>
   <li>Bottle
      <ul>
      <li>PressurizedBottle</li>
      </li>      
      </ul>   
   </li>      
</ul>

<br />
<p>Each program should:</p>
<ul>
   <li>use simple variable references instead of a collection of objects</li>  
   <li>initialize 10 Bottle objects and 10 PressurizedBottle objects</li>  
   <li>repeatedly cycle the Bottle and PressurizedBottle objects, and sum a simple check value</li>       
   <li>print the check value</li>
</ul>

<br />

<p>Correct output N = 10 is:</p>
<pre>450
</pre><br />
<p>Correct output N = 100 is:</p>
<pre>4500
</pre><br />
<p>Correct output N = 1000 is:</p>
<pre>45000
</pre><br />

