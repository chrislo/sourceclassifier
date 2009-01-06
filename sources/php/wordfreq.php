#!/usr/bin/php -f
<?
/* The Great Computer Language Shootout
   http://shootout.alioth.debian.org/
   contributed by Isaac Gouy 

   php -q wordfreq.php < input.txt > output.txt
*/ 


$hasSplitWord = FALSE;

$fp = fopen("php://stdin", "r");

while ($block = fread($fp, 4096)){

   $words = preg_split('/[^a-zA-Z]+/', $block);

   $first = 0;
   $last = sizeof($words) - 1;

   if ($last >= $first){
      
      // some words will be split across $block's      

      if (strlen($words[$first])){          
         if ($hasSplitWord){ $words[$first] = $splitWord.$words[$first]; }
      } else {
         if ($hasSplitWord){ $words[$first] = $splitWord; } 
         else { $first++; }      
      }
      if ($hasSplitWord = strlen($words[$last])){
         $splitWord = $words[$last]; 
      }


      for ($i=$first; $i<$last; $i++){
         $w = strtolower($words[$i]);
         if (isset($counts[$w])){ $counts[$w]++; } else { $counts[$w] = 1; }
      }
   }
   unset($words);
} 
fclose($fp);



function CmpCountAndName($a, $b){
   if ($a[1] == $b[1]){ return strcmp($b[0], $a[0]); }
   else { return $a[1] < $b[1]; }
}

while (list($k,$v) = each($counts)) $wordcounts[] = array($k,$v);
usort($wordcounts,'CmpCountAndName');
while (list($k,$v) = each($wordcounts)) printf("%7d %s\n", $v[1], $v[0]);

?>
