<?   // Copyright (c) Isaac Gouy 2004-2007 ?>
<?
if (LANGS_PHRASE){ $LangsPhrase = LANGS_PHRASE; } else { $LangsPhrase = ''; }
if (TESTS_PHRASE){ $TestsPhrase = TESTS_PHRASE; } else { $TestsPhrase = ''; }
?>

<?=$Intro;?>

<p class="score"><a href="#play" name="play"><strong>&nbsp;For Fun:</strong></a> <span class="smaller">Create your own Ranking!</span></p>
<? MkScorecardMenuForm("fullcpu"); ?>


<p>It can be fun to watch the Benchmarks Game but like other games <a href="faq.php#play">it's more fun to <strong>play!</strong></a></p>

<p class="timestamp">Most recent measurement: <strong><? printf('%s', gmdate("d M Y, l,", $Measured)) ?></strong>
<? printf(' %s GMT', gmdate("g:i a", $Measured)) ?></p>


<table class="layout">
<tr>
<th class="test"><dl>
<dt><a href="#check" name="check"><strong>&nbsp;Benchmarks</strong></a></dt>
<dd>Source-code, CPU times</dd>
</dl></th>

<th colspan="2"><dl>
<dt><a href="#compare" name="compare"><strong>&nbsp;Language Implementations</strong></a></dt>
<dd>Compare two language implementations</dd>
</dl></th>
</tr>

<?
   $Tests = array_values($Tests);
   $i = 0;
   $testsSize = sizeof($Tests); 

   $Langs = array_values($Langs);
   $j = 0;
   $langsSize = sizeof($Langs);

   while ($i<$testsSize||$j<$langsSize){
      printf('<tr>'); 

      if ($i<$testsSize){
         if ($j==$langsSize){ $j++; }         
         $t = $Tests[$i];
         $TestLink = $t[TEST_LINK];
         $TestName = $t[TEST_NAME];
         $TestTag = $t[TEST_TAG];
         printf('<td class="test"><dl><dt><a href="benchmark.php?test=%s&amp;lang=all">%s</a></dt><dd>%s</dd></dl></td>', $TestLink,$TestName,$TestTag); 
         $i++;  
      }
      else {
         if ($j<$langsSize){

            $l = $Langs[$j];
            $LangLink = $l[LANG_LINK];
            $LangName = $l[LANG_FULL];
            $LangTag = $l[LANG_TAG];  

            if (isset($l[LANG_SPECIALURL]) && !empty($l[LANG_SPECIALURL])){
               printf('<td><dl><dt><a href="%s.php">%s</a></dt><dd>%s</dd></dl></td>', $l[LANG_SPECIALURL],$LangName,$LangTag); 
            } else {
               printf('<td><dl><dt><a href="benchmark.php?test=all&amp;lang=%s">%s</a></dt><dd>%s</dd></dl></td>', $LangLink,$LangName,$LangTag); 
            }
            $j++;
         }
         else {
            printf('<td class="test">&nbsp;</td>');
         }
      }


      if ($j<$langsSize){

         $l = $Langs[$j];
         $LangLink = $l[LANG_LINK];
         $LangName = $l[LANG_FULL];
         $LangTag = $l[LANG_TAG];  

         if (isset($l[LANG_SPECIALURL]) && !empty($l[LANG_SPECIALURL])){
            printf('<td><dl><dt><a href="%s.php">%s</a></dt><dd>%s</dd></dl></td>', $l[LANG_SPECIALURL],$LangName,$LangTag); 
         } else {
            printf('<td><dl><dt><a href="benchmark.php?test=all&amp;lang=%s">%s</a></dt><dd>%s</dd></dl></td>', $LangLink,$LangName,$LangTag); 
         }
         $j++;
      }
      else {
         if ($i<$testsSize){
            
            $t = $Tests[$i];
            $TestLink = $t[TEST_LINK];
            $TestName = $t[TEST_NAME];
            $TestTag = $t[TEST_TAG];
            printf('<td class="test"><dl><dt><a href="benchmark.php?test=%s&amp;lang=all">%s</a></dt><dd>%s</dd></dl></td>', $TestLink,$TestName,$TestTag); 
            $i++; 
         }
         else {
            if (2*$testsSize>$langsSize){
               printf('<td class="test">&nbsp;</td>');
            }
            else {
               printf('<td>&nbsp;</td>');
            }
         }
      }


      if ($j<$langsSize){
         $l = $Langs[$j];
         $LangLink = $l[LANG_LINK];
         $LangName = $l[LANG_FULL];
         $LangTag = $l[LANG_TAG]; 

         if (isset($l[LANG_SPECIALURL]) && !empty($l[LANG_SPECIALURL])){
            printf('<td><dl><dt><a href="%s.php">%s</a></dt><dd>%s</dd></dl></td>', $l[LANG_SPECIALURL],$LangName,$LangTag); 
         } else { 
            printf('<td><dl><dt><a href="benchmark.php?test=all&amp;lang=%s">%s</a></dt><dd>%s</dd></dl></td>', $LangLink,$LangName,$LangTag); 
         }
         $j++;
      }
      else {
         if ($i<$testsSize){
            if ($j==$langsSize){
               printf('<td>&nbsp;</td>');
               $j++;
            }
            else {
               $t = $Tests[$i];
               $TestLink = $t[TEST_LINK];
               $TestName = $t[TEST_NAME];
               $TestTag = $t[TEST_TAG];
               printf('<td class="test"><dl><dt><a href="benchmark.php?test=%s&amp;lang=all">%s</a></dt><dd>%s</dd></dl></td>', $TestLink,$TestName,$TestTag);  
               $i++;  
            } 
         }
         else {
            if (2*$testsSize>$langsSize){
               printf('<td class="test">&nbsp;</td>');
            }
            else {
               printf('<td>&nbsp;</td>');
            }
         }
      }
      printf('</tr>');
   }

?>
</table>



