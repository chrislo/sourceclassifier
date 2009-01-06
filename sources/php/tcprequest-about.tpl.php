<p><strong>diff</strong> program output N = 10 with this <a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;file=output">output file</a> to check your program is correct before contributing.
</p>

<p><strong>Note</strong>: we're thinking about a better way to start client &amp; server within our measurement framework.</p>

<p>Each program (M = 100, REPLY_SIZE = 4096) should</p>
<ul>
   <li>open a TCP/IP socket</li>
   <li>fork a client process that connects back to the socket
      <ul>
      <li>M*N times the client process should
         <ul>
         <li>write a request to the socket</li>
         <li>read a reply from the socket</li>
         <li>count the replies, and sum the bytes in the replies</li>
         </ul>
      </li>
      <li>close the socket</li>
      <li>print the count and sum</li>      
      </ul>
   </li>
   <li>the server process should
      <ul>
      <li>read a request from the socket</li>
      <li>write a reply to the socket</li>
      </ul>
   </li>
</ul>
<p>Each program should leave the sockets available for immediate reuse.</p>

<p>The only difference between the tcp-echo, tcp-request-reply, and tcp-stream programs, should be the values for M and REPLY_SIZE.</p>
