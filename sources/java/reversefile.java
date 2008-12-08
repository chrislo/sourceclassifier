// $Id: reversefile.java,v 1.1 2004-05-23 07:14:28 bfulgham Exp $
// http://www.bagley.org/~doug/shootout/
// from Stephen Darnell

import java.io.*;

public class reversefile {
    final static int BUFF_SIZE = 4096;

    public static void main( String[] args ) {
	InputStream in = System.in;

	byte[] buff = new byte[BUFF_SIZE];
	byte[] obuff = new byte[BUFF_SIZE];

	try {
	    int pos = 0;
	    for (int n ; (n = in.read(buff, pos, BUFF_SIZE)) > 0 ;) {
		pos += n;
		if ((pos + BUFF_SIZE) > buff.length) {
		    byte[] new_buff = new byte[buff.length << 1];
		    System.arraycopy(buff, 0, new_buff, 0, buff.length);
		    buff = new_buff;
		}
	    }

	    int opos = 0;

	    for (int p = --pos ; ;) {
		--p;
		if (p < 0 || buff[p] == '\n') {
		    for( int bp = p ; ++bp <= pos ; ) {
			obuff[opos] = buff[bp];
			if (++opos >= BUFF_SIZE) {
			    System.out.write(obuff, 0, opos);
			    opos = 0;
			}
		    }
		    pos = p;

		    if (p < 0)
			break;
		}
	    }

	    System.out.write(obuff, 0, opos);
	}
	catch(IOException ex) {
	}
    }
}
