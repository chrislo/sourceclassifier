/*
 * The Great Computer Language Shootout 
 * http://shootout.alioth.debian.org/
 * 
 * modified by Mehmet D. AKIN
 *
 */

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.HashMap;

public class spellcheck {

	static HashMap dict = new HashMap(1024);
	static String word;

	public static void main(String args[]) throws IOException {
		try {
			BufferedReader in = new BufferedReader(new FileReader("Usr.Dict.Words"));
			while ((word = in.readLine()) != null) {
				dict.put(word, null);
			}
			in.close();
			in = new BufferedReader(new InputStreamReader(System.in));
			while ((word = in.readLine()) != null) {
				if (!dict.containsKey(word)) {
					System.out.println(word);
				}
			}
		} catch (IOException e) {
			System.err.println(e);
			return;
		}
	}
}
