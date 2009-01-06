<?   // Copyright (c) Isaac Gouy 2004-2008 ?>

<? 
MkMenuForm($Tests,$SelectedTest,$Langs,$SelectedLang,"fullcpu"); 
$TestName = $Tests[$SelectedTest][TEST_NAME];
$LangName = $Langs[$SelectedLang][LANG_FULL];
$P = $SelectedLang.'-'.$Id;
?>

<p>
<a href="benchmark.php?test=<?=$SelectedTest;?>&amp;lang=all"
title="Check CPU times and source-code for the <?=$TestName;?> <?=TESTS_PHRASE;?>" ><?=$TestName;?> <?=TESTS_PHRASE;?></a> 
<?=BAR;?>
<a href="benchmark.php?test=all&amp;lang=<?=$SelectedLang;?>&amp;lang2=<?=$SelectedLang;?>"  
title="Show <?=$LangName;?> <?=TESTS_PHRASE;?> summary" >
<?=$LangName;?></a>
<?=BAR;?>
<a href="fulldata.php?test=<?=$SelectedTest;?>&amp;p1=<?=$P;?>&amp;p2=<?=$P;?>&amp;p3=<?=$P;?>&amp;p4=<?=$P;?>"  
title="Check all the data for the <?=$TestName;?> <?=TESTS_PHRASE;?>" ><?=$TestName;?> full data</a>
</p>

<h2><a href="#program" name="program">&nbsp;<?=$Title;?></a></h2>
<table>
<colgroup span="4" class="num"></colgroup>
<tr>
<th>&nbsp;N&nbsp;</th>
<th>CPU&nbsp;secs</th>
<th>Memory&nbsp;KB</th>
<th>Size B</th>
<th>Elapsed&nbsp;secs</th>
<th>~&nbsp;CPU&nbsp;Load</th>
</tr>
<?
if (sizeof($Data)>0){
      if ($Id==$Data[DATA_ID]){
         if ($Data[DATA_STATUS]<0){
            $kb = '&nbsp;'; $fullcpu = '&nbsp;';$elapsed = '&nbsp;'; $load = '&nbsp;';
            $fullcpu = StatusMessage($Data[DATA_STATUS]);
         } else {
            if ($Data[DATA_MEMORY]==0){
               $kb = '?';
            } else {
               if ($TestName=='startup'){ $kb = '&nbsp;'; }
               else { $kb = number_format((double)$Data[DATA_MEMORY]); }
            }
            $fullcpu = sprintf('%0.2f',$Data[DATA_FULLCPU]);
            $elapsed = ElapsedTime($Data);
            $load = CpuLoad($Data);
         }

         if ($Data[DATA_TESTVALUE]>0){ $n = number_format((double)$Data[DATA_TESTVALUE]); } else { $n = '?'; }
         printf('<tr class="a"><td class="r">%s</td><td class="r">%s</td><td class="r">%s</td><td class="r">%d</td><td class="r">%s</td><td class="r">&nbsp;&nbsp;%s</td></tr>',
            $n,$fullcpu,$kb,$Data[DATA_GZ],$elapsed,$load); echo "\n";
      }
} else {
   echo '<tr class="a"><td></td> <td></td> <td></td> <td></td> <td></td></tr>'; echo "\n";
}
?>
</table>
<pre><?=$Code;?></pre>

<h3><a href="#about" name="about">&nbsp;about the program</a></h3>
<?=$About;?>

<h3><a href="#log" name="log">&nbsp;build &amp; benchmark results</a></h3>
<pre><?=$Log;?></pre>


