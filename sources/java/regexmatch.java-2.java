
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class regexmatch {

    static final String regex = "(^|^\\D*[^\\(\\d])" // must be preceeded by non-digit
            + "((\\(\\d\\d\\d\\))|(\\d\\d\\d))" // match 2: Area Code inner match 3: area with perens,
            //                    inner match 4: without perens
            + "[ ]" // area code followed by one space
            + "(\\d\\d\\d)" //match 5: prefix of 3 digits
            + "[ -]" // prefix followed by space or dash
            + "(\\d\\d\\d\\d)" // match 6: last 4 digits
            + "(\\D.*|$)"; // followed by non numeric chars

    static final Pattern phonePattern = Pattern.compile(regex);

    public static void main(String args[]) {
        int n = (args.length > 0) ? Integer.parseInt(args[0]) : 1;
        ArrayList file = new ArrayList();
        String inLine;

        try {
            BufferedReader in = new BufferedReader(new InputStreamReader(System.in));
            while ((inLine = in.readLine()) != null) {
                file.add(inLine);
            }
            in.close();

            while (n > 0) {
                int count = 0;
                Iterator itr = file.listIterator(0);
                while (itr.hasNext()) {
                    Matcher match = phonePattern.matcher((String) itr.next());
                    if (match.matches()) {
                        if (n == 1) {
                            if (match.group(3) != null) {
                                System.out.println(++count + ": " + match.group(3) + " " + match.group(5) + "-"
                                        + match.group(6));
                            } else {
                                System.out.println(++count + ": (" + match.group(4) + ") " + match.group(5) + "-"
                                        + match.group(6));
                            }
                        }
                    }
                }
                n--;
            }
        } catch (IOException e) {
            System.err.println(e);
        }
        System.exit(0);
    }

}

