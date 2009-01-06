<?php
// Copyright (c) Isaac Gouy 2004-2008

// DATA LAYOUT ///////////////////////////////////////////////////

define('TEST_LINK',0);
define('TEST_NAME',1);
define('TEST_TAG',2);
define('TEST_WEIGHT',3);
define('TEST_DATE',4);         

define('LANG_LINK',0);
define('LANG_FAMILY',1);
define('LANG_NAME',2);
define('LANG_FULL',3);
define('LANG_HTML',4);
define('LANG_TAG',5);
define('LANG_DATE',6);   
define('LANG_COMPARE',7);     
define('LANG_SPECIALURL',8); 

define('DATA_TEST',0);
define('DATA_LANG',1);
define('DATA_ID',2);
define('DATA_TESTVALUE',3);
define('DATA_GZ',4);
define('DATA_FULLCPU',5);
define('DATA_MEMORY',6);
define('DATA_STATUS',7);
define('DATA_LOAD',8);
define('DATA_ELAPSED',9);

define('INCL_LINK',0);
define('INCL_NAME',1);

define('EXCL_USE',0);
define('EXCL_TEST',1);
define('EXCL_LANG',2);
define('EXCL_ID',3);


// CONSTANTS ///////////////////////////////////////////////////

define('EXCLUDED','X');
define('PROGRAM_TIMEOUT',-1);
define('PROGRAM_ERROR',-2);
define('PROGRAM_SPECIAL','-3');
define('PROGRAM_EXCLUDED',-4);
define('LANGUAGE_EXCLUDED',-5);
define('NO_COMPARISON',-6);
define('NO_PROGRAM_OUTPUT',-7);

define('N_TEST',0);
define('N_LANG',1);
define('N_ID',2);
define('N_NAME',3);
define('N_FULL',4);
define('N_HTML',5);
define('N_FULLCPU',6);
define('N_MEMORY',7);
define('N_CPU_MAX',8);
define('N_MEMORY_MAX',9);
define('N_COLOR',10);

define('N_N',3);
define('N_LINES',8);
define('N_GZ',9);
define('N_EXCLUDE',10);


define('CPU_MIN',0);
define('MEM_MIN',1);
define('GZ_MIN',2);

define('SCORE_RATIO',0);
define('SCORE_MEAN',1);
define('SCORE_TESTS',2);

define('NAME_LEN',16);
define('PRG_ID_LEN',NAME_LEN+2);

// FUNCTIONS ///////////////////////////////////////////////////

function GetMicroTime(){
   $t = explode(" ", microtime());
   return doubleval($t[1]) + doubleval($t[0]);
}

function ReadIncludeExclude(){
   $incl = array();
   $f = @fopen('./include.csv','r') or die('Cannot open ./include.csv');
   $row = @fgetcsv($f,1024,','); // heading row
   while (!@feof ($f)){
      $row = @fgetcsv($f,1024,',');
      if (!is_array($row)){ continue; }
      if (isset($row[INCL_LINK]{0})){ $incl[ $row[INCL_LINK] ] = 0; }                   
   }
   @fclose($f);
   
   $excl = array();
   $f = @fopen(DESC_PATH.'/exclude.csv','r') or die('Cannot open '.DESC_PATH.'/exclude.csv');
   $row = @fgetcsv($f,1024,','); // heading row

   while (!@feof ($f)){
      $row = @fgetcsv($f,1024,',');
      if (!is_array($row)){ continue; }
      if (isset($row[EXCL_TEST]{0})){           
         if (!isset($row[EXCL_ID])){ $row[EXCL_ID] = 1; }
         $key = $row[EXCL_TEST].$row[EXCL_LANG].strval($row[EXCL_ID]);
         $excl[$key] = $row;
      }
   }
   @fclose($f);

   return array($incl,$excl);
}



function ReadUniqueArrays($FileName,$Incl,$HasHeading=TRUE){
   if (file_exists('./'.$FileName)){
      $f = @fopen('./'.$FileName,'r') or die('Cannot open '.$FileName);
   } else {
      $f = @fopen(DESC_PATH.$FileName,'r') or die('Cannot open '.$FileName);
   }

   if ($HasHeading){ $row = @fgetcsv($f,1024,','); }

   while (!@feof ($f)){
      $row = @fgetcsv($f,1024,',');
      if (!is_array($row)){ continue; }
     
//######## Hardcoded assumption that $row[0] is a link name
      if (isset( $Incl[$row[0]] )){ $rows[ $row[0] ] = $row; }      
   }
   @fclose($f);
   return $rows;
}


function ReadSelectedDataArrays($FileName,$Value,$Incl,$HasHeading=TRUE){
   $f = @fopen($FileName,'r') or die ('Cannot open $FileName');
   if ($HasHeading){ $row = @fgetcsv($f,1024,','); }
   $rows = array();
   while (!@feof ($f)){
      $row = @fgetcsv($f,1024,',');
      if (!is_array($row)){ continue; }
      if ( isset($row[DATA_LANG]) && ($row[DATA_TEST]==$Value) ){                  
         settype($row[DATA_ID],'integer');
         if (isset($rows[$row[DATA_LANG]])){
            array_push( $rows[$row[DATA_LANG]], $row);
         } else {
            $rows[$row[DATA_LANG]] = array($row);
         }
      }
   }
   @fclose($f);      
   return $rows;
}


function SplitByTestValue(&$data){
   $splitdata = array();
   foreach($data as $d){
      if (isset($splitdata[ $d[DATA_TESTVALUE] ])){
         $splitdata[ $d[DATA_TESTVALUE] ][] = $d;
      } else {
         $splitdata[ $d[DATA_TESTVALUE] ] = array($d);
      }
   }
   krsort($splitdata);
   $ks = array_keys($splitdata);
   $k = array_shift($ks);
   $largest = $splitdata[ $k ];
   unset( $splitdata[ $k ] );
   $others = array();
   foreach ($splitdata as $k => $v){
      $others = array_merge($others,$v);
   }
   return array($largest,$others);
}



function CompareTestCpuTime($a, $b){
   if ($a[DATA_TEST] == $b[DATA_TEST]){
      if ($a[DATA_FULLCPU] == $b[DATA_FULLCPU]){
         if ($a[DATA_MEMORY] == $b[DATA_MEMORY]){ 
            if ($a[DATA_GZ] == $b[DATA_GZ]){ return 0; }
            else { return ($a[DATA_GZ] < $b[DATA_GZ]) ? -1 : 1; }
         }
         else { return ($a[DATA_MEMORY] < $b[DATA_MEMORY]) ? -1 : 1; }
      }
      else { return ($a[DATA_FULLCPU] < $b[DATA_FULLCPU]) ? -1 : 1; }
   }
   return  ($a[DATA_TEST] < $b[DATA_TEST]) ? -1 : 1;
}


function CompareFullCpuTime($a, $b){
   if ($a[DATA_FULLCPU] == $b[DATA_FULLCPU]){
      if ($a[DATA_MEMORY] == $b[DATA_MEMORY]){
         if ($a[DATA_GZ] == $b[DATA_GZ]){ return 0; }
         else { return ($a[DATA_GZ] < $b[DATA_GZ]) ? -1 : 1; }
      }
      else { return ($a[DATA_MEMORY] < $b[DATA_MEMORY]) ? -1 : 1; }
   }
   return  ($a[DATA_FULLCPU] < $b[DATA_FULLCPU]) ? -1 : 1;
}

function CompareMemoryUse($a, $b){
   if ($a[DATA_MEMORY] == $b[DATA_MEMORY]){
      if ($a[DATA_FULLCPU] == $b[DATA_FULLCPU]){
         if ($a[DATA_GZ] == $b[DATA_GZ]){ return 0; }
         else { return ($a[DATA_GZ] < $b[DATA_GZ]) ? -1 : 1; }
      }
      else { return ($a[DATA_FULLCPU] < $b[DATA_FULLCPU]) ? -1 : 1; }
   }
   return  ($a[DATA_MEMORY] < $b[DATA_MEMORY]) ? -1 : 1;
}

function CompareGz($a, $b){
   if ($a[DATA_GZ] == $b[DATA_GZ]){
      if ($a[DATA_FULLCPU] == $b[DATA_FULLCPU]){
         if ($a[DATA_MEMORY] == $b[DATA_MEMORY]){ return 0; }
         else { return ($a[DATA_MEMORY] < $b[DATA_MEMORY]) ? -1 : 1; }            
      }
      else { return ($a[DATA_FULLCPU] < $b[DATA_FULLCPU]) ? -1 : 1; }
   }
   return  ($a[DATA_GZ] < $b[DATA_GZ]) ? -1 : 1;
}

function CompareLangName($a, $b){
   return strcasecmp($a[LANG_FULL],$b[LANG_FULL]);
}

function CompareTestName($a, $b){
   return strcasecmp($a[TEST_NAME],$b[TEST_NAME]);
}

function CompareTestValue($a, $b){
   if ($a[DATA_LANG] == $b[DATA_LANG]){
      if ($a[DATA_ID] == $b[DATA_ID]){
         if ($a[DATA_TESTVALUE] == $b[DATA_TESTVALUE]) return 0;
         return ($a[DATA_TESTVALUE] < $b[DATA_TESTVALUE]) ? -1 : 1;
      }
      else {
         return ($a[DATA_ID] < $b[DATA_ID]) ? -1 : 1;      
      }
   }
   else {
      return ($a[DATA_LANG] < $b[DATA_LANG]) ? -1 : 1;      
   }   
}

function CompareTestValue2($a, $b){
   if ($a[DATA_TEST] == $b[DATA_TEST]){
         if ($a[DATA_TESTVALUE] == $b[DATA_TESTVALUE]) return 0;
         return ($a[DATA_TESTVALUE] > $b[DATA_TESTVALUE]) ? -1 : 1;
   }
   else {
      return ($a[DATA_TEST] < $b[DATA_TEST]) ? -1 : 1;      
   }
}


function CompareNName($a, $b){
   return strcasecmp($a[N_FULL],$b[N_FULL]);
}

function SortName($sort){
   if ($sort=='fullcpu'){ return 'Full CPU Time'; }
   elseif ($sort=='gz'){ return 'GZ Compressed Source'; }
   elseif ($sort=='lines'){ return 'Lines Of Code'; }
   else { return 'Memory use'; }
}

function IdName($id){
   if ($id>1){ return ' #'.$id; } else { return ''; }
}


function ExcludeData(&$d,&$langs,&$Excl){
   if( !isset($langs[$d[DATA_LANG]]) ) { return LANGUAGE_EXCLUDED; }

   $key = $d[DATA_TEST].$d[DATA_LANG].strval($d[DATA_ID]);
   if (isset($Excl[$key])){
      if ($Excl[$key][EXCL_USE]==EXCLUDED){ return PROGRAM_EXCLUDED; }
      else { return PROGRAM_SPECIAL; }
   }
   return $d[DATA_STATUS];
}


function FilterAndSortData($langs,$data,$sort,&$Excl){
   $Accepted = array();
   $Rejected = array();   
   $Special = array();

   // $data is an associative array keyed by language
   // Each value is itself an array of one or more data records

   foreach($data as $ar){
      foreach($ar as $d){  
         $x = ExcludeData($d,$langs,$Excl);         
         if ($x==PROGRAM_SPECIAL){ 
            $Special[] = $d;
         } elseif ($x==PROGRAM_EXCLUDED) { 

         } elseif ($x) {
            $Rejected[] = $d;
         } else {
            $Accepted[] = $d;
         }
      }         
   }

   if ($sort=='fullcpu'){
      usort($Accepted, 'CompareFullCpuTime'); 
      usort($Special, 'CompareFullCpuTime');
   } elseif ($sort=='kb'){ 
      usort($Accepted, 'CompareMemoryUse'); 
      usort($Special, 'CompareMemoryUse');
   } elseif ($sort=='gz'){
      usort($Accepted, 'CompareGz'); 
      usort($Special, 'CompareGz'); 
   }

   return array($Accepted,$Rejected,$Special);
}



function ProgramData($FileName,$T,$L,$I,&$Langs,&$Incl,&$Excl,$HasHeading=TRUE){
   $f = @fopen($FileName,'r') or die ('Cannot open $FileName');
   if ($HasHeading){ $row = @fgetcsv($f,1024,','); }

   $data = array();
   while (!@feof ($f)){
      $row = @fgetcsv($f,1024,',');
      if (!is_array($row)){ continue; }

      if (($row[DATA_TEST]==$T)&&($row[DATA_LANG]==$L)){
         settype($row[DATA_ID],'integer');
         if (($I > -1)&&($row[DATA_ID]==$I)){ return $row; }
         else { $data[] = $row; }
      }
   }
   @fclose($f);
   usort($data, 'CompareFullCpuTime');

   if ($I == -1){
      foreach($data as $ar){
         if (isset($Incl[$ar[DATA_TEST]]) && isset($Incl[$ar[DATA_LANG]])
               && !ExcludeData($ar,$Langs,$Excl)){
            return $ar;
         }
      }
      foreach($data as $ar){
         if (isset($Incl[$ar[DATA_TEST]]) && isset($Incl[$ar[DATA_LANG]])){
           $ex = ExcludeData($ar,$Langs,$Excl);
           if (($ex == PROGRAM_TIMEOUT)||($ex == PROGRAM_ERROR)){
              return $ar;
           }
         }
      }
   }
   return array();
}



// CONTENT ///////////////////////////////////////////////////

function MkMenuForm($Tests,$SelectedTest,$Langs,$SelectedLang,$Sort){
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
   echo '</select>', "\n";
   echo '<input type="submit" value="Show" />', "\n";
   echo '</p></form>', "\n";
}


function MkScorecardMenuForm($Sort){
   echo '<form class="score" method="get" action="benchmark.php">', "\n";
   echo '<p><select name="test">', "\n";
   echo '<option selected="selected" value="all">- all ', TESTS_PHRASE, 's -</option>', "\n";
   echo '</select>', "\n";

   echo '<select name="lang">', "\n";
   echo '<option value="all">- all ', LANGS_PHRASE, 's -</option>', "\n";
   echo '</select>', "\n";
   echo '<input type="submit" value="Show" title="Create your own Ranking"/>', "\n"; 
   echo '</p><br/></form>', "\n";
}


function HtmlFragment($FileName){
   $html = '<p>&nbsp;</p>';
   if (is_readable($FileName)){
      $f = fopen($FileName,'r');
      $fs = filesize($FileName);
      if ($fs > 0){ $html = fread($f,$fs); }
      fclose($f);
   }
   return $html;
}


function PFx($d){
   if ($d>9.9){ return number_format($d); }   
   elseif ($d>0.0){ return number_format($d,1); }
   else { return "&nbsp;"; }
}

function PTime($d){
   if ($d<300.0){ return number_format($d,2); }
   elseif ($d<3600.0){
     $m = floor($d/60); $s = $d-($m*60); $ss = number_format($s,0);
     if (strlen($ss)<2) { $ss = "0".$ss; }
     return number_format($m,0)."m".$ss; }
   else {
     $h = floor($d/3600); $m = floor(($d-($h*3600))/60);
     $mm = number_format($m,0); if (strlen($mm)<2) { $mm = "0".$mm; }
     return number_format($h,0)."h".$mm;
   }
}

function HttpVarsEncodeArray($a){
   foreach($a as $v){ $d[] = intval(sprintf('%d',$v*10)); }
   $s = implode('o',$d);
   return $s;
}


function StatusMessage($i){
   if ($i==0){ $m = ''; }
   elseif ($i==-1){ $m = 'Timed Out'; }
   elseif ($i==-2){ $m = 'Error'; }
   elseif ($i==-10){ $m = 'Bad Output'; }
   elseif ($i==-11){ $m = 'Missing'; }
   elseif ($i==-12){ $m = 'Empty'; }
   else { $m = ''; }
   return $m;
}


function ElapsedTime($d){
   if ($d[DATA_ELAPSED] > 0.0){
      return number_format($d[DATA_ELAPSED],2);
   } else {
      return '';
   }
}


function CpuLoad($d){
   if (strlen($d[DATA_LOAD])>1){
      return str_replace(' ','&nbsp;',$d[DATA_LOAD]);
   } else {
      return '';
   }
}


?>