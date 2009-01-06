<?   // Copyright (c) Isaac Gouy 2004-2008 ?>

<? MkMenuForm($Tests,$SelectedTest,$Langs,$SelectedLang,"fullcpu"); ?>
<h2><a href="#faster" name="faster">&nbsp;Create your own Ranking</a></h2>


<? 
   list($score,$ratio) = $Data;
   unset($Data);
?>

<p>What <strong>fun!</strong> Can you manipulate the multipliers and weights to make your favourite language <a href="#about">the best</a> programming language in the Benchmarks Game?</p>


<p><br/><img src="chartscore.php?<?='d='.HttpVarsEncodeArray($ratio);?>"
   width="600" height="150" alt=""
 /></p>


<table class="layout"><tr><td>

<table>
<colgroup span="2" class="txt"></colgroup>
<colgroup span="2" class="num"></colgroup>
<tr>
<th>&nbsp;&nbsp;x&nbsp;&nbsp;</th>
<th>language</th>
<th>mean</th>
<th>-</th>
</tr>

<?
foreach($score as $k => $v){
   $Name = $Langs[$k][LANG_FULL];
   $HtmlName = $Langs[$k][LANG_HTML];
   printf('<tr>');
   printf('<td>%s</td>', PFx($v[SCORE_RATIO]));

   printf('<td><a href="benchmark.php?test=all&amp;lang=%s&amp;lang2=%s">%s</a></td>',
      $k,$k,$HtmlName); echo "\n";
   printf('<td>%0.2f</td><td>%s</td>',
      $v[SCORE_MEAN], PBlank($v[SCORE_TESTS])); echo "\n";
   echo "</tr>\n";
}
?>
</table>

</td><td>

<form class="score" method="get" action="benchmark.php">
<input type="hidden" name="test" value="all" />
<input type="hidden" name="lang" value="all" />

<table>
<colgroup span="2" class="txt"></colgroup>
<tr>
<td><input type="submit" name="calc" value="calculate" /></td>
<td><input type="submit" name="calc" value="reset" /></td>
</tr>

<tr><th colspan="2">multipliers</th></tr>
<tr>
<td><a href="faq.php#fullcpu">CPU Time</a></td>
<td><input type="text" size="2" name="xfullcpu" value="<?=$W['xfullcpu'];?>" /></td>
</tr>
<tr>
<td><a href="faq.php#memory">Memory Use</a></td>
<td><input type="text" size="2" name="xmem" value="<?=$W['xmem'];?>" /></td>
</tr>
<tr>
<td><a href="faq.php#gzbytes">Source GZip</a></td>
<td><input type="text" size="2" name="xloc" value="<?=$W['xloc'];?>" /></td>
</tr>

<tr><th>benchmark</th><th>weight</th></tr>
<?  
foreach($Tests as $t){
   $Link = $t[TEST_LINK];
   $Name = $t[TEST_NAME];
   $weight = $W[ $t[TEST_LINK] ];

   printf('<tr>'); echo "\n";
   printf('<td><a href="benchmark.php?test=%s&amp;lang=all">%s</a></td>', $Link,$Name); echo "\n";
   printf('<td><p><input type="text" size="2" name="%s" value="%d" /></p></td>', $Link, $weight); echo "\n";
   echo "</tr>\n";
}
?>

<tr>
<td><p><input type="submit" name="calc" value="calculate" /></p></td>
<td><p><input type="submit" name="calc" value="reset" /></p></td>
</tr>
</table>
</form>

</td></tr></table>

<h3><a href="#about" name="about">&nbsp;about the Ranking</a></h3>
<?=$About;?>
