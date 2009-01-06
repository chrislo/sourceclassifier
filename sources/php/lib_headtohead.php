<?php
// Copyright (c) Isaac Gouy 2005

// FUNCTIONS ///////////////////////////////////////////////////



function HeadToHeadData($FileName,&$Langs,&$Incl,&$Excl,$L1,$L2,$HasHeading=TRUE){
   // Simple filter on file rows
   $f = @fopen($FileName,'r') or die ('Cannot open $FileName');
   if ($HasHeading){ $row = @fgetcsv($f,1024,','); }
   $rows = array();
   while (!@feof ($f)){
      $row = @fgetcsv($f,1024,',');
      if (!is_array($row)){ continue; }
      
      $lang = $row[DATA_LANG];                                  
      if ($lang==$L1 || $lang==$L2){  $rows[] = $row;}
   }
   @fclose($f);     
      
   // Filter again in memory      
   $Data = array();   
   foreach($rows as $row){ 
      if (isset($Incl[$row[DATA_TEST]])){   
         settype($row[DATA_ID],'integer');                              
           
         if (ExcludeData($row,$Langs,$Excl) > PROGRAM_SPECIAL){  
            $Data[] = $row;                                                                      
         } 
      }      
   }            
   unset($rows);     
  
// SELECTION DEPENDS ON THIS SORT ORDER
   usort($Data,'CompareTestValue2');   

// TRANSFORM SELECTED DATA

   $lang = ""; $id = ""; $test = ""; $n = 0;
   $NData = array(); 
   $comparable = array(); 
   $errorRowL1 = NULL;
   

   $i=0; $j=0;
   while ($i<sizeof($Data)){
    
      $n = $Data[$i][DATA_TESTVALUE];
      $test = $Data[$i][DATA_TEST];                
            
      do {
         $dj = $Data[$j];
                              
         if ($dj[DATA_STATUS] > PROGRAM_TIMEOUT){
            if (isset($comparable[$dj[DATA_LANG]])){ 
               if ($dj[DATA_FULLCPU] < $comparable[$dj[DATA_LANG]][DATA_FULLCPU]){
                  if ($isComparable){
                     if ($dj[DATA_TESTVALUE]==$comparable[$dj[DATA_LANG]][DATA_TESTVALUE]){                  
                        $comparable[$dj[DATA_LANG]] = $Data[$j];   
                     }                
                  }
                  else {
                     $comparable[$dj[DATA_LANG]] = $Data[$j];                   
                  }                                        
                                
               }
            } else {             
               $comparable[$dj[DATA_LANG]] = $Data[$j];              
            }
         }
         elseif ($dj[DATA_LANG]==$L1){
            $errorRowL1 = $Data[$j];
         }
                    
         $isComparable = isset($comparable[$L1]) && isset($comparable[$L2]) 
            && ($comparable[$L1][DATA_TESTVALUE]==$comparable[$L2][DATA_TESTVALUE]);  
                                                       
         $j++;                                 
         $hasMore = $j<sizeof($Data);                                    
         $isSameTest = $hasMore && ($test==$Data[$j][DATA_TEST]);
         
      } while ($isSameTest);


                                    
             
      if (isset($comparable[$L1])){
         $r1 = $comparable[$L1];
      
         if (isset($comparable[$L2])){           
            $r2 = $comparable[$L2];            
            $full = 1;
            $mem = 1;
            $lines = 1;
            $cpu = 1; 
            $gz = 1;

            //if ($r2[DATA_FULLCPU]>0){ $full = $r1[DATA_FULLCPU] / $r2[DATA_FULLCPU]; }
            //if ($r2[DATA_MEMORY]>0){ $mem = $r1[DATA_MEMORY] / $r2[DATA_MEMORY]; }
            //if ($r2[DATA_CPU]>0){ $cpu = $r1[DATA_CPU] / $r2[DATA_CPU]; }

            if ($r1[DATA_FULLCPU]>0){ $full = $r2[DATA_FULLCPU] / $r1[DATA_FULLCPU]; }
            if ($r1[DATA_MEMORY]>0){ $mem = $r2[DATA_MEMORY] / $r1[DATA_MEMORY]; }
            if ($r1[DATA_GZ]>0){ $gz = $r2[DATA_GZ] / $r1[DATA_GZ]; }
                                 
            $NData[$r1[DATA_TEST]] = array(
                 $r1[DATA_TEST]
               , $r1[DATA_LANG]
               , $r1[DATA_ID]
               , ($r1[DATA_TESTVALUE] == $n) ? 0 : $r1[DATA_TESTVALUE]
               , $Langs[$r1[DATA_LANG]][LANG_FULL].IdName($r1[DATA_ID])
               , $Langs[$r1[DATA_LANG]][LANG_HTML].IdName($r1[DATA_ID])
               , $full
               , $mem
               , $lines
               , $gz
               , 0
               );
                                                    
            while ($j<sizeof($Data) && $test==$Data[$j][DATA_TEST]){ $j++; }
         }      
         else {

            $NData[$r1[DATA_TEST]] = array(
                 $r1[DATA_TEST]         
               , $L2
               , $r1[DATA_ID]
               , ($r1[DATA_TESTVALUE] == $n) ? 0 : $r1[DATA_TESTVALUE]
               , $Langs[$r1[DATA_LANG]][LANG_FULL].IdName($r1[DATA_ID])
               , $Langs[$r1[DATA_LANG]][LANG_HTML].IdName($r1[DATA_ID])
               , 0
               , 0
               , NO_COMPARISON
               , 0
               , 0
               );          
         
            while ($j<sizeof($Data) && $test==$Data[$j][DATA_TEST]){ $j++; }          
         }                                             
      }          
      elseif (!$isSameTest && isset($errorRowL1)){
         $e = $errorRowL1;    
         $exclude = ExcludeData($e,$Langs,$Excl);        
         
         $NData[$e[DATA_TEST]] = array(
              $e[DATA_TEST]         
            , $e[DATA_LANG]
            , $e[DATA_ID]
            , $e[DATA_TESTVALUE]
            , $Langs[$e[DATA_LANG]][LANG_FULL].IdName($e[DATA_ID])
            , $Langs[$e[DATA_LANG]][LANG_HTML].IdName($e[DATA_ID])
            , 0
            , 0
            , $exclude
            , 0
            , 0
            );          
              
      }
      
      unset($comparable[$L1]); 
      unset($comparable[$L2]);
      unset($errorRowL1);
      $i = $j;               
   }
   return $NData;     
}


function MkHeadToHeadMenuForm($Tests,$SelectedTest,$Langs,$SelectedLang,$SelectedLang2,$Sort){
   echo '<form method="get" action="benchmark.php">', "\n";
   echo '<p><select name="test">', "\n";
   echo '<option value="all">- all ', TESTS_PHRASE, 's -</option>', "\n";

   foreach($Tests as $Row){
      $Link = $Row[TEST_LINK];
      $Name = $Row[TEST_NAME];
      if ($Link==$SelectedTest){
         $Selected = 'selected="selected"';
      } else {
         $Selected = '';
      }
      printf('<option %s value="%s">%s</option>', $Selected,$Link,$Name); echo "\n";
   }
   echo '</select>', "\n";


   echo '<select name="lang">', "\n";
   echo '<option value="all">- all ', LANGS_PHRASE, 's -</option>', "\n";
   foreach($Langs as $Row){
      $Link = $Row[LANG_LINK];
      $Name = $Row[LANG_FULL];
      if ($Link==$SelectedLang){
         $Selected = 'selected="selected"';
      } else {
         $Selected = '';
      }
      printf('<option %s value="%s">%s</option>', $Selected,$Link,$Name); echo "\n";
   }
   echo '</select></p>', "\n";
   
   
   echo '<p><strong>Compare</strong> to: <select name="lang2">', "\n";
   foreach($Langs as $Row){
      $Link = $Row[LANG_LINK];
      $Name = $Row[LANG_FULL];
      if ($Link==$SelectedLang2){
         $Selected = 'selected="selected"';
      } else {
         $Selected = '';
      }
      printf('<option %s value="%s">%s</option>', $Selected,$Link,$Name); echo "\n";
   }
   echo '</select>', "\n";   
   
   
   echo '<input type="submit" value="Show" />', "\n";
   echo '</p></form>', "\n";
}


function PF($d){
   if ($d>14.99){ return '<td class="num5">'.number_format($d).'</td>'; } 
   elseif ($d>1.001){ return '<td class="num4">'.number_format($d,1).'</td>'; } 
   elseif ($d>0.999){ return '<td>&nbsp;</td>'; }
   else {
      if ($d>0){
         $i = 1.0 / $d;
            if ($i>14.99){ return '<td class="num1">~'.number_format($i).'</td>'; }
            elseif ($i>1.001){ return '<td class="num2">~'.number_format($i,1).'</td>'; }
            else { return '<td>&nbsp;</td>'; }
      } else { return '<td>&nbsp;</td>'; }
   }
}

function LanguageData($FileName,&$Langs,&$Incl,&$Excl,$L1,$L2,$HasHeading=TRUE){
   // Simple filter on file rows
   $f = @fopen($FileName,'r') or die ('Cannot open $FileName');
   if ($HasHeading){ $row = @fgetcsv($f,1024,','); }
   $rows = array();
   while (!@feof ($f)){
      $row = @fgetcsv($f,1024,',');
      if (!is_array($row)){ continue; }
      
      $lang = $row[DATA_LANG];                                  
      if ($lang==$L1){  $rows[] = $row;}
   }
   @fclose($f);         
      
   // Filter again in memory
   $Data = array();   
   foreach($rows as $row){ 
      if (isset($Incl[$row[DATA_TEST]])){   
         settype($row[DATA_ID],'integer');                              
           
         if (ExcludeData($row,$Langs,$Excl) > PROGRAM_SPECIAL){  
            $Data[] = $row;                                                                      
         } 
      }      
   }            
   unset($rows);     
  
// SELECTION DEPENDS ON THIS SORT ORDER
   usort($Data,'CompareTestValue2');         

// TRANSFORM SELECTED DATA

   $lang = ""; $id = ""; $test = ""; $n = 0;
   $NData = array(); 
   unset($row);    
   
   $i=0; $j=0;
   while ($i<sizeof($Data)){
    
      $n = $Data[$i][DATA_TESTVALUE];
      $test = $Data[$i][DATA_TEST];                
            
      do {                                
         if (isset($row)){           
            if ( ($Data[$j][DATA_TESTVALUE] > $row[DATA_TESTVALUE]) 
               || (($Data[$j][DATA_TESTVALUE] == $row[DATA_TESTVALUE])
                && ((ExcludeData($row,$Langs,$Excl)<=PROGRAM_TIMEOUT)
                 || ((ExcludeData($Data[$j],$Langs,$Excl)>PROGRAM_TIMEOUT)
                  && ($Data[$j][DATA_FULLCPU]<$row[DATA_FULLCPU])))) ){
                                                   
                  $row = $Data[$j];              
            }         
         }
         else {         
            $row = $Data[$j];                           
         }        
                    
         $j++;                                 
         $hasMore = $j<sizeof($Data);                                    
         $isSameTest = $hasMore && ($test==$Data[$j][DATA_TEST]);         
      } while ($isSameTest);
                                                 
      if (isset($row)){                                                    
         $NData[$row[DATA_TEST]] = array(
              $row[DATA_TEST]
            , $row[DATA_LANG]
            , $row[DATA_ID]
            , $row[DATA_TESTVALUE]
            , $Langs[$row[DATA_LANG]][LANG_FULL].IdName($row[DATA_ID])
            , $Langs[$row[DATA_LANG]][LANG_HTML].IdName($row[DATA_ID])
            , $row[DATA_FULLCPU]
            , $row[DATA_MEMORY]
            , 0 //$row[DATA_GZ]
            , $row[DATA_GZ]
            , ExcludeData($row,$Langs,$Excl)
            );                           
      }    
                                                   
      while ($j<sizeof($Data) && $test==$Data[$j][DATA_TEST]){ $j++; }                                                   
                
      unset($row); 
      $i = $j;               
   }
   return $NData;     
}

?>