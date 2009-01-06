<?   // Copyright (c) Isaac Gouy 2004-2006 ?>

<? 
$Row = $Langs[$SelectedLang];
$LangName = $Row[LANG_FULL];
$LangTag = $Row[LANG_TAG];
$LangName2 = $Langs[$SelectedLang2][LANG_FULL];
$Link = $Row[LANG_LINK];
$Family = $Row[LANG_FAMILY];
?>

<p>For more information about a Timeout or Error click the program name and scroll-down to the 'build &amp; benchmark results'.</p>
<? MkHeadToHeadMenuForm($Tests,$SelectedTest,$Langs,$SelectedLang,$SelectedLang2,"fullcpu"); ?>
<h2><a href="#title" name="title">&nbsp;<?=$LangName;?> measurements</a></h2>

<table>
<colgroup span="1" class="txt"></colgroup>
<colgroup span="4" class="num"></colgroup>
<tr>
<th>Program &amp; Logs</th>
<th>CPU Time&nbsp;secs</th>
<th>Memory Use&nbsp;KB</th>
<th>GZip Bytes</th>
<th>&nbsp;N&nbsp;</th>
</tr>

<? 
foreach($Tests as $Row){
   printf('<tr>'); echo "\n";
   $Link = $Row[TEST_LINK];
   $Name = $Row[TEST_NAME];

   if (isset($Data[$Link])){
      $v = $Data[$Link];     

      printf('<td><a href="benchmark.php?test=%s&amp;lang=%s&amp;id=%d">%s</a></td>', 
         $Link, $SelectedLang, $v[N_ID], $Name);
                
      if ($v[N_N]==0){ $n = '?'; } else { $n = '&nbsp;'.number_format($v[N_N]); }                
                
      if ($v[N_EXCLUDE] >= 0){    
         if ($Name=='startup'){ $kb = '&nbsp;'; } else { $kb = number_format($v[N_MEMORY]); }

         printf('<td>%0.2f</td><td>%s</td><td>%s</td><td><span class="numN">%s</span></td>', 
            $v[N_FULLCPU], $kb, $v[N_GZ], $n); 

      } else {      
         if ($v[N_EXCLUDE] == PROGRAM_ERROR){ $message = 'Error'; } 
         elseif ($v[N_EXCLUDE] == PROGRAM_TIMEOUT){ $message = 'Timout'; } 
         else { $message = 'X'; } 
         
         printf('<td><span class="message">%s</span></td><td></td><td>%s</td><td><span class="numN">%s</span></td>', $message, $v[N_LINES], $n);
      }

   } else {
      printf('<td><a href="benchmark.php?test=%s&amp;lang=%s">%s</a></td>', 
         $Link, $SelectedLang, $Name); echo "\n";
      $message = 'No&nbsp;program';
      printf('<td><span class="message">%s</span></td><td></td><td></td><td></td>', $message); 
   }
   echo "</tr>\n";
}
?> 
</table>


<h3><a href="#about" name="about">&nbsp;about <?=$LangName;?></a></h3>
<?=$About;?> 
