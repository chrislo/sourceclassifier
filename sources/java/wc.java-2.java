/* The Great Computer Language Shootout
   http://shootout.alioth.debian.org/

   contributed by bfulgham (with help from Dirus@programmer.net)
   modified by M. Hanauska
   
   this program modified from:
     http://cm.bell-labs.com/cm/cs/who/bwk/interps/pap.html
   Timing Trials, or, the Trials of Timing: Experiments with Scripting
   and User-Interface Languages</a> by Brian W. Kernighan and
   Christopher J. Van Wyk.
*/

import java.io.*;

public class wc {
    public static void main(String[] args) {
        int nl = 0, nw = 0, nc = 0;

        try {
            byte[] buff = new byte[4096];
            boolean inword = false;
            int length;
	   
            while ((length = System.in.read(buff)) != -1) {
                nc += length;
                for(int i = 0; i < length; i++) {
                    switch (buff[i]) {
                        /* Linebreak */
                        case '\n': nl++;
                                                
                        /* Whitespace */
                        case '\r':
                        case '\t':
                        case  ' ': inword = false; break;
                        
                        /* Within word */
                        default:
                            if (!inword) {
                                nw ++;
                                inword = true;
                            }
                    }
          
                }
            }
        } catch (IOException e) {
            System.err.println(e);
            return;
        }
        System.out.println(Integer.toString(nl) + " " +
                           Integer.toString(nw) + " " +
                           Integer.toString(nc));
    }
}