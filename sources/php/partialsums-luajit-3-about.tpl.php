<p><ol>
<li>Lua has only a single number type, which is a 'double' by
default. I spent a lot of time optimizing floating point
arithmetics for LuaJIT. Most other language implementors have
probably targeted integer optimizations first. Both approaches
make sense, but of course it shows in FP-intensive benchmarks.</li>
<li>Unlike many other languages, Lua has an intrinsic power
operator ('^') and does not delegate this to a function. Lua also
doesn't have bit operations and until recently didn't have hex
numbers. This means the power operator gets more (ab)use than in
most other languages. It was important to optimize it for LuaJIT.
Other languages probably didn't bother (even the most recent GCC
doesn't inline pow()).</li>
<li>The x86 ABI requires flushing of the complete FPU stack before
any subroutine call. Most languages use the pow(), sin() and
cos() functions in the C library and don't inline them. This
reduces the CPU's abilities for exploiting possible execution
parallelism. Since LuaJIT inlines all three operations, it wins
on this benchmark.</li>
</ol>
Mike Pall
</p>