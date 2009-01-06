<p><strong>Don't split pattern at |</strong></p>
<pre>While working on this Python benchmark, I looked into most of the regexdna benchmarks for the other languages. The idea
was to find differences and ideas that might affect performance there. Also, I wanted to avoid implementing 'tricks'
that would be rejected anyway. In fact all the changes that affect speed were taken from the other (accepted) benchmarks,
*nothing* was invented new. So I did my best in the sense of "same way".

The result is an almost twofold speed improvement (on my Pentium 4) over the program contributed by Dominique Wahli,
which I took as the basis.

The speed relevant changes are (benchmarks with this feature in parens):

1. No parens in the regex for description/linefeed replacement (Tcl, D, C gcc, FreeBASIC, PHP, Ruby, Lua)

2. Split regex for description/linefeed replacement at '|' to two statements (Lua)

3. Split regex for patterns (Lua)

The last one contributes most to the speed improvement. The implementation is more elegant than in the Lua program,
I think, as Python's split-string method makes it a one-liner.

The other changes have no big influence on speed, but as the Python people like to say: shorter is better! So I tried
to make the program as short as possible, which makes it also easier to read in most cases. These changes are:

4. Import of full modules instead of individual functions, slightly faster, surprisingly

5. No double \n in regex for description/linefeed replacement (as in D, C gcc, FreeBASIC, PHP)

6. Rearrange the length-value print statements for compactness (as in C++ g++)

7. Rearrange IUB codes. Note that the data items appear at the loop variables f, r the same way, it's only a more comapact
notation

8. Directly use constants for pattern and IUB codes in loops

The last one can be seen as provoking or ridiculous, and I would not have done it, if it wasn't the only way to make
it the shortest program of all, shorter than Ruby, which does the same to get *that* short!</pre>
