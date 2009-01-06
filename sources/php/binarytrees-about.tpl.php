<p><strong>diff</strong> program output N = 10 with this 1KB <a href="iofile.php?test=<?=$SelectedTest;?>&amp;file=output">output file</a> to check your program is correct before contributing.
</p>

<p>Each program should</p>
<ul>
   <li>define a tree node class and methods, a tree node record and procedures, or an algebraic data type and functions, or&#8230;</li>
   <li>allocate a binary tree to 'stretch' memory, check it exists, and deallocate it</li>
   <li>allocate a long-lived binary tree which will live-on while other trees are allocated and deallocated</li>   
   <li>allocate, walk, and deallocate many bottom-up binary trees
      <ul>
      <li>allocate a tree</li>
      <li>walk the tree nodes, checksum node items (and maybe deallocate the node)</li>
      <li>deallocate the tree</li>
      </ul>      
   </li>
   <li>check that the long-lived binary tree still exists</li>
</ul>

<p>Note: this is an adaptation of a benchmark for testing GC so we are interested in the whole tree being allocated before any nodes are GC'd - which probably excludes lazy evaluation.</p>
<p>Note: the left subtrees are heads of the right subtrees, keeping a depth counter in the accessors to avoid duplication is cheating!</p>
<p>Note: the tree should have tree-nodes all the way down, replacing the bottom nodes by some other value is not acceptable; and the bottom nodes should be at depth 0.</p>

<p>There are reference implementations in OCaml, C#, and PHP.</p>
<br />

<p>The binary-trees benchmark is a simplistic adaptation of <a href="http://www.hpl.hp.com/personal/Hans_Boehm/gc/gc_bench/applet/GCBench.java">Hans Boehm's GCBench</a>,
which in turn was adapted from a benchmark by John Ellis and Pete Kovac.</p>

<p>Thanks to Christophe Troestler and Einar Karttunen for help with this benchmark.</p>
