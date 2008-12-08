/* The Great Computer Language Shootout
   http://shootout.alioth.debian.org/
 
   contributed by James McIlree
*/

import java.util.*;
import java.io.*;
import java.text.*;

public class knucleotide {
  String sequence;
  int count = 1;

  knucleotide(String s) {
    sequence = s;
  }

  public static void main(String[] args) throws Exception
  {
    StringBuffer sbuffer = new StringBuffer();
    String line;
    
    BufferedReader in = new BufferedReader(new InputStreamReader(System.in));
    while ((line = in.readLine()) != null) {
      if (line.startsWith(">THREE")) break;
    }
    
    while ((line = in.readLine()) != null) {
      char c = line.charAt(0);
      if (c == '>')
        break;
      else if (c != ';')
        sbuffer.append(line.toUpperCase());
    }
    
    knucleotide kn = new knucleotide(sbuffer.toString());
    kn.writeFrequencies(1);
    kn.writeFrequencies(2);

    kn.writeCount("GGT");
    kn.writeCount("GGTA");
    kn.writeCount("GGTATT");
    kn.writeCount("GGTATTTTAATT");
    kn.writeCount("GGTATTTTAATTTATAGT");
  }

  void writeFrequencies(int nucleotideLength) {
    Map frequencies = calculateFrequencies(nucleotideLength);
    ArrayList list = new ArrayList(frequencies.size());
    Iterator it = frequencies.entrySet().iterator();

    while (it.hasNext()) {
      knucleotide fragment = (knucleotide)((Map.Entry)it.next()).getValue();
      list.add(fragment);
    }

    Collections.sort(list, new Comparator() {
        public int compare(Object o1, Object o2) {
          int c = ((knucleotide)o2).count - ((knucleotide)o1).count;
          if (c == 0) {
            c = ((knucleotide)o1).sequence.compareTo(((knucleotide)o2).sequence);
          }
          return c;
        }
      });

    NumberFormat nf = NumberFormat.getInstance();
    nf.setMaximumFractionDigits(3);
    nf.setMinimumFractionDigits(3);

    int sum = sequence.length() - nucleotideLength + 1;

    for (int i=0; i<list.size(); i++) {
      knucleotide fragment = (knucleotide)list.get(i);
      double percent = (double)fragment.count/(double)sum * 100.0;
      System.out.println(fragment.sequence + " " + nf.format(percent) );
    }
    System.out.println("");
  }

  void writeCount(String nucleotideFragment) {
    Map frequencies = calculateFrequencies(nucleotideFragment.length());

    knucleotide found = (knucleotide)frequencies.get(nucleotideFragment);
    int count = (found == null) ? 0 : found.count;
    System.out.println(count + "\t" + nucleotideFragment);
  }

  Map calculateFrequencies(int fragmentLength) {
    HashMap map = new HashMap();
    for (int offset=0; offset<fragmentLength; offset++)
      calculateFrequencies(map, offset, fragmentLength);

    return map;
  }

  // Is this method really needed? The benchmark specification seems to
  // indicate so, but it is not entirely clear. This method could easily
  // be folded up.
  void calculateFrequencies(Map map, int offset, int fragmentLength) {
    int lastIndex = sequence.length() - fragmentLength + 1;
    for (int index=offset; index<lastIndex; index+=fragmentLength) {
      String temp = sequence.substring(index, index + fragmentLength);
      knucleotide fragment = (knucleotide)map.get(temp);
      if (fragment != null)
        fragment.count++;
      else
        map.put(temp, new knucleotide(temp));
    }
  }
}

