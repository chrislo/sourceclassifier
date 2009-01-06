<p><strong>diff</strong> program output N = 10 with this <a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;file=output">output file</a> to check your program is correct before contributing.
</p>

<p>Each program will be started first with argument N negated (reply to requests), and then once more with argument N at a lower priority (make requests).</p>
<ul>
   <li>N&#60;=0, start a TCP server that will reply to requests
      <ul>
      <li>make 10*N replies    
      <ul>       
         <li>read a request (of known size) from the socket</li>
         <li>write a reply to the socket</li>   
         <li>after M<sub>i</sub>*N requests change to a new reply size</li>    
      </ul>           
      </li>  
      <li>stop the server</li>                    
      </ul>         
   </li>
   
   <li>N&#62;0, start a TCP client that will make requests
      <ul>
      <li>make 10*N +3 requests    
      <ul>              
         <li>write a request to the socket</li>
         <li>read a reply (of known size) from the socket</li>
         <li>after M<sub>i</sub>*N requests expect a new reply size</li>   
      </ul>           
      </li>                    
      <li>count the replies, and sum the bytes in the replies</li>
      <li>close the socket</li>
      <li>print the count and sum</li>      
      </ul>       
   </li>   
   
   <li>Buffer size = 1024 bytes</li>    
   <li>Request size = 64 bytes</li>    
   <li>Reply sizes
      <ul>   
      <li>The first 2*N replies should be 64 bytes</li>
      <li>The next 7*N replies should be 4096 bytes</li>
      <li>The last 1*N replies should be 409600 bytes</li>                     
      </ul>       
   </li>       
  
</ul>    
<br/>
<p>Each program should leave the sockets available for immediate reuse.</p>
