<p>"The Tree datatype in this program is not strict:</p>

<pre>:: Tree a = TreeNode a (Tree a) (Tree a) | Nil</pre>

<p>so the following function that creates the Tree's in the program:</p>

<pre>bottomup :: !Int !Int -> .(Tree Int)
bottomup i d
   | d == 0
      = TreeNode i Nil Nil
      = TreeNode i (bottomup (2*i-1)(d-1)) (bottomup (2*i)(d-1))</pre>

<p>will create only one TreeNode and 2 thunks, one for each bottomup
call, each time it is called (except if d==0). If such a thunk
is evaluated, the bottomup function is called again and another
TreeNode with 2 thunks is created (except if d==0), etc.
(actually part of the TreeNode overwrites the thunk node).</p>

<p>These Tree's are traversed by the following function:</p>

<pre>itemcheck Nil = 0
itemcheck (TreeNode a left right)
  = a + itemcheck(left) - itemcheck(right)</pre>

<p>If this function is called with a TreeNode, the following happens;</p>
<ul><li>The elements of the TreeNode (a, left and right) are moved to registers or the stack. The reference to this TreeNode is removed from the register or stack, so that the garbage collector can reclaim the memory used by this node (if this was the only reference).</li>

<li>The integer a is evaluated and pushed on the stack. The reference to this integer node is removed from the register or stack.</li>

<li>left is evaluated and itemcheck is called with left as argument. Other references to left (within this function) are removed from registers or the stack, so that the garbage collector can reclaim the memory used by this node after the recursive call to itemcheck has loaded the elements of the TreeNode.

<li>the same happens for right: right is evaluated and itemcheck is called with right as argument. Other references to right are removed from registers or the stack, so that the garbage collector can reclaim the memory used by this node after the recursive call to itemcheck has loaded the elements of the TreeNode.</li>

<li>the three integers (a and the results of the itemcheck calls) are used to compute the result of the function, and the function returns.</li>
</ul>

<p>Consequently, if itemcheck is applied to a Tree created by bottomup, the
memory used by a TreeNode created by bottomup can be reclaimed almost
immediately by the garbage collector after the elements are loaded
in registers or pushed on the stack by itemcheck. So the garbage will mark or copy at most one TreeNode and at most 2 thunks
and an Int node for each recursive call to itemcheck (that is being evaluated).</p>


<p>So the low memory usage is caused by lazy evaluation. Other non strict
languages like Haskell should have similar memory usage for this program."</p>
