<p>This is a <strong>contest</strong> - different algorithms may be used.</p>

<p>You are expected to <strong>diff the output from your program N = 2098 against this </strong><a href="iofile.php?test=<?=$SelectedTest;?>&amp;file=output"><strong>output file</strong></a> <strong><em>before</em> you contribute your program.</strong></p>


<p>The <a href="http://www-128.ibm.com/developerworks/java/library/j-javaopt/"><strong>Meteor Puzzle</strong></a> board is made up of 10 rows of 5 hexagonal Cells. There are 10 puzzle pieces to be placed on the board, we'll number them 0 to 9. Each puzzle piece is made up of 5 hexagonal Cells. As different algorithms may be used to generate the puzzle solutions, we require that the solutions be printed in a standard order and format. Here's one approach - working along each row left to right, and down the board from top to bottom, take the number of the piece placed in each cell on the board, and create a string from all 50 numbers, for example the smallest puzzle solution would be represented by </p><pre>00001222012661126155865558633348893448934747977799</pre>
<p>Print the smallest and largest Meteor Puzzle 50 character solution string in this format to mimic the hexagonal puzzle board:</p>

<pre>0 0 0 0 1 
 2 2 2 0 1 
2 6 6 1 1 
 2 6 1 5 5 
8 6 5 5 5 
 8 6 3 3 3 
4 8 8 9 3 
 4 4 8 9 3 
4 7 4 7 9 
 7 7 7 9 9 
</pre>

<p>The command line parameter N should limit how many solutions will be found before the program halts, so that you can work with just a few solutions to debug and optimize your program.</p>
<p>Diff program output N = 2098 against the <a href="iofile.php?test=<?=$SelectedTest;?>&amp;file=output">output file</a> to check the format is correct.</p>


<h5>Notes</h5>
<ul>
<li>the <tt>printSolutions()</tt> method in <a href="benchmark.php?test=meteor&amp;lang=scala&amp;id=0">the Scala program</a> provides one example of how to print the solutions.</li>
<li>the <tt>printBoardCellsAndNeighbours()</tt> method in <a href="benchmark.php?test=meteor&amp;lang=scala&amp;id=0">the Scala program</a> provides an example of how to print <a href="http://shootout.alioth.debian.org/download/meteor-puzzleboard.txt">the puzzle board (Save Target As… Save Link As…)</a> to check that the board cells are joined up correctly.
<pre>

cell    NW NE W  E  SW SE
0       -- -- -- 01 -- 05
1       -- -- 00 02 05 06
2       -- -- 01 03 06 07
3       -- -- 02 04 07 08
4       -- -- 03 -- 08 09
5       00 01 -- 06 10 11
6       01 02 05 07 11 12
7       02 03 06 08 12 13
8       03 04 07 09 13 14
9       04 -- 08 -- 14 --
10      -- 05 -- 11 -- 15
11      05 06 10 12 15 16
12      06 07 11 13 16 17
13      07 08 12 14 17 18
14      08 09 13 -- 18 19
15      10 11 -- 16 20 21
16      11 12 15 17 21 22
17      12 13 16 18 22 23
18      13 14 17 19 23 24
19      14 -- 18 -- 24 --
20      -- 15 -- 21 -- 25
21      15 16 20 22 25 26
22      16 17 21 23 26 27
23      17 18 22 24 27 28
24      18 19 23 -- 28 29
25      20 21 -- 26 30 31
26      21 22 25 27 31 32
27      22 23 26 28 32 33
28      23 24 27 29 33 34
29      24 -- 28 -- 34 --
30      -- 25 -- 31 -- 35
31      25 26 30 32 35 36
32      26 27 31 33 36 37
33      27 28 32 34 37 38
34      28 29 33 -- 38 39
35      30 31 -- 36 40 41
36      31 32 35 37 41 42
37      32 33 36 38 42 43
38      33 34 37 39 43 44
39      34 -- 38 -- 44 --
40      -- 35 -- 41 -- 45
41      35 36 40 42 45 46
42      36 37 41 43 46 47
43      37 38 42 44 47 48
44      38 39 43 -- 48 49
45      40 41 -- 46 -- --
46      41 42 45 47 -- --
47      42 43 46 48 -- --
48      43 44 47 49 -- --
49      44 -- 48 -- -- --
</pre></li>
</ul>
<p><strong>The Meteor Puzzle and 3 Java puzzle solvers</strong> are described in <a href="http://www-128.ibm.com/developerworks/java/library/j-javaopt/"><strong>"Optimize your Java application's performance"</strong></a>.</p>

