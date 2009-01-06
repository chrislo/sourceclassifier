<?   // Copyright (c) Isaac Gouy 2004-2008 ?>

<?
$p = array($P1,$P2,$P3,$P4);
list($NData,$Selected,$TestValues) = ComparisonData($Langs,$Data,$p,$Excl);

$cols = sizeof($TestValues) + 1;
$TestName = $Tests[$SelectedTest][TEST_NAME];
$TestTag = $Tests[$SelectedTest][TEST_TAG];
?>

<? MkComparisonMenuForm($Langs,$Tests,$SelectedTest,$NData,$P1,$P2,$P3,$P4,"fullcpu"); ?>
<h2><a href="#cpuchart" name="cpuchart">&nbsp;<?=$TestName;?> full data - CPU Time secs</a></h2>

<table class="layout"><tr><td>

<img src="chartcpu.php?test=<?=$SelectedTest;?>&amp;p1=<?=$P1;?>&amp;p2=<?=$P2;?>&amp;p3=<?=$P3;?>&amp;p4=<?=$P4;?>" 
   width="160" height="240" alt="" />

</td><td>

<table class="data">
<colgroup span="1" class="txt"></colgroup>
<colgroup span="<?=$cols;?>" class="num"></colgroup>
<tr><th colspan="<?=$cols;?>">CPU Time secs as N increases</th></tr>

<tr>
<th>N</th>
<? foreach($TestValues as $v){ 
      if ($v>0){ $fv = number_format((double)$v); } else { $fv = '?'; }
      printf('<th>%s</th>',$fv); echo "\n"; 
   } ?>
</tr>

<? 
usort($Selected,'CompareMaxCpu');
foreach($Selected as $row){
   printf('<tr>'); echo "\n";
   printf('<td>%s</td>', $row[N_FULL]); echo "\n";
   foreach($row[N_FULLCPU] as $v){ 
      printf('<td class="r">%0.2f</td>', $v); echo "\n";
   }   
   echo "</tr>\n";                          
}
?>
</table>

</td></tr></table>

<h2><a href="#memchart" name="memchart">&nbsp;<?=$TestName;?> full data - Memory use</a></h2>

<table class="layout"><tr><td>

<img src="chartmem.php?test=<?=$SelectedTest;?>&amp;p1=<?=$P1;?>&amp;p2=<?=$P2;?>&amp;p3=<?=$P3;?>&amp;p4=<?=$P4;?>" 
   width="160" height="240" alt="" />

</td><td>

<table class="data">
<colgroup span="1" class="txt"></colgroup>
<colgroup span="<?=$cols;?>" class="num"></colgroup>
<tr><th colspan="<?=$cols;?>">Memory use as N increases</th></tr>
<tr>
<th>N</th>
<? foreach($TestValues as $v){ 
      if ($v>0){ $fv = number_format((double)$v); } else { $fv = '?'; }
      printf('<th>%s</th>',$fv); echo "\n"; 
   } 
?>
</tr>

<? 
usort($Selected,'CompareMaxMemory');

foreach($Selected as $row){
   printf('<tr>'); echo "\n";
   printf('<td>%s</td>', $row[N_FULL]); echo "\n";
   foreach($row[N_MEMORY] as $v){ 
      if ($TestName=='startup'){ $kb = '&nbsp;'; }      
      else { 
         if ($v==0){ $kb = '?'; } 
         else { $kb = number_format((double)$v); }
      }
      printf('<td class="r">%s</td>', $kb); echo "\n"; 
   }   
   echo "</tr>\n";                           
}
?>
</table>

</td></tr></table>

<h2><a href="#cputable" name="cputable">&nbsp;<?=$TestName;?> full data - CPU Time secs</a></h2>
<table class="data">
<colgroup span="1" class="txt"></colgroup>
<colgroup span="<?=$cols;?>" class="num"></colgroup>
<tr><th colspan="<?=$cols;?>">CPU Time secs as N increases</th></tr>
<tr>
<th>Program &amp; Logs</th>
<? foreach($TestValues as $v){ 
      if ($v>0){ $fv = number_format((double)$v); } else { $fv = '?'; }
      printf('<th>%s</th>',$fv); echo "\n"; 
   } 
?>
</tr>
<? 
foreach($NData as $row){
   printf('<tr>'); echo "\n";
   printf('<td><a href="benchmark.php?test=%s&amp;lang=%s&amp;id=%d">%s</a></td>', 
      $SelectedTest,$row[N_LANG],$row[N_ID],$row[N_HTML]); echo "\n";

   foreach($row[N_FULLCPU] as $v){ 
      printf('<td class="r">%0.2f</td>', $v); echo "\n"; 
   }   
   echo "</tr>\n";                            
}
?>
</table>

<h2><a href="#memtable" name="memtable">&nbsp;<?=$TestName;?> full data - Memory use</a></h2>
<table class="data">
<colgroup span="1" class="txt"></colgroup>
<colgroup span="<?=$cols;?>" class="num"></colgroup>
<tr><th colspan="<?=$cols;?>">Memory use as N increases</th></tr>
<tr>
<th>Program &amp; Logs</th>
<? foreach($TestValues as $v){ 
      if ($v>0){ $fv = number_format((double)$v); } else { $fv = '?'; }
      printf('<th>%s</th>',$fv); echo "\n"; 
   } 
?>
</tr>
<? 
foreach($NData as $row){
   printf('<tr>'); echo "\n";
   printf('<td><a href="benchmark.php?test=%s&amp;lang=%s&amp;id=%d">%s</a></td>', 
      $SelectedTest,$row[N_LANG],$row[N_ID],$row[N_HTML]); echo "\n";

   foreach($row[N_MEMORY] as $v){ 
      if ($TestName=='startup'){ $kb = '&nbsp;'; }
      else { 
         if ($v==0){ $kb = '?'; } 
         else { $kb = number_format((double)$v); }
      }
      printf('<td class="r">%s</td>', $kb); echo "\n"; 
   }   
   echo "</tr>\n";                          
}
?>
</table>

<h3><a href="#about" name="about">&nbsp;about full data comparison</a></h3>
<?=$About;?>
