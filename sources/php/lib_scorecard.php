<?php
// Copyright (c) Isaac Gouy 2005-2008


function Weights($Tests, $Action, $Vars){
   $w = array(); $wd = array();
   foreach($Tests as $t){
      $link = $t[TEST_LINK];
      
      if (isset($Vars[$link]) && (strlen($Vars[$link]) == 1)
            && (ereg("^[0-9]$",$Vars[$link]))){ $x = intval($Vars[$link]); }
      else { $x = intval($t[TEST_WEIGHT]); }

      $w[$link] = $x;
      $wd[$link] = intval($t[TEST_WEIGHT]);
   }


   $Metrics = array('xfullcpu' => 1, 'xmem' => 0, 'xloc' => 0);
   foreach($Metrics as $k => $v){

      if (isset($Vars[$k]) && (strlen($Vars[$k]) == 1)
            && (ereg("^[0-9]$",$Vars[$k]))){ $x = intval($Vars[$k]); }
      else { $x = $v; }

      $w[$k] = $x;
      $wd[$k] = $v;
   }

   if ($Action=='reset'){ $w = $wd; }

   // normalize weights
   $minWeight = 0;
   $maxWeight = 5;

   foreach($w as $k => $v){
      if ($v > $maxWeight){ $w[$k] = $maxWeight; }
      elseif ($v < $minWeight){ $w[$k] = $minWeight; }
   }
   return $w;
}


// Data filtering and summary ///////////////////////////////////////////


function WeightedData($FileName,&$Tests,&$Langs,&$Incl,&$Excl,&$W,$HasHeading=TRUE){
   $f = @fopen($FileName,'r') or die ('Cannot open $FileName');
   if ($HasHeading){ $row = @fgetcsv($f,1024,','); }

   // assume no values larger than 1,000,000
   $mins = array();
   foreach($Tests as $k => $v){ $mins[$k] = array(1000000,1000000,1000000); }

   $data = array();
   $timeout = array();
   while (!@feof ($f)){
      $row = @fgetcsv($f,1024,',');
      if (!is_array($row)){ continue; }

      $test = $row[DATA_TEST];
      $lang = $row[DATA_LANG];
      settype($row[DATA_ID],'integer');
      $id = $row[DATA_ID];
      $key = $test.$lang.strval($id);

      // accumulate all acceptable datarows, exclude duplicates

      if (isset($Incl[$test]) && isset($Incl[$lang]) &&
               isset($Langs[$lang]) &&
                  !isset($Excl[$key])){
                    
            // this isn't quite correct doesn't take account of more than one program
            if (PROGRAM_TIMEOUT == $row[DATA_STATUS]){
               if (!isset($timeout[$lang])){ $timeout[$lang] = 1; }
               else { $timeout[$lang]++; }
            }

            if ($row[DATA_STATUS] == 0 && (
                  ($row[DATA_FULLCPU] > 0 && (!isset($data[$lang][$test]) ||
                     $row[DATA_FULLCPU] < $data[$lang][$test][DATA_FULLCPU])))){

               $data[$lang][$test] = $row;

               $mt = &$mins[$test];
               if (($row[DATA_FULLCPU] < $mt[CPU_MIN]) && $row[DATA_FULLCPU] > 0.0){
                  $mt[CPU_MIN] = $row[DATA_FULLCPU];
               }
               if (($row[DATA_MEMORY] < $mt[MEM_MIN]) && $row[DATA_MEMORY] > 0){
                  $mt[MEM_MIN] = $row[DATA_MEMORY];
               }
               if (($row[DATA_GZ] < $mt[GZ_MIN]) && $row[DATA_GZ] > 0){
                  $mt[GZ_MIN] = $row[DATA_GZ];
               }
            }

      }
   }
   @fclose($f);

   $score = array();
   foreach($data as $k => $test){
//      if ((!isset($timeout[$k]) || ($timeout[$k] < 3)) && (sizeof($test) > 8)){
      if ((!isset($timeout[$k]) || ($timeout[$k] < 5)) && (sizeof($test) > 9)){
         $s = 0.0; $ws = 0.0; $include = 0.0;
         foreach($test as $t => $v){
            $mt = &$mins[$t];

            $w1 = $W[$t] * $W['xfullcpu'];
            $w2 = $W[$t] * $W['xmem'];
            $w3 = $W[$t] * $W['xloc'];

            if ($w1>0){
              $val = $v[DATA_FULLCPU];
              if ($val > 0){
                 $s += log($val/$mt[CPU_MIN])*$w1;
                 $ws += $w1;
                 $include += $val;
              }
            }
            if ($w2>0){
              $val = $v[DATA_MEMORY];
              if ($val > 0){
                 $s += log($val/$mt[MEM_MIN])*$w2;
                 $ws += $w2;
                 $include += $val;
              }
            }
            if ($w3>0){
              $val = $v[DATA_GZ];
              if ($val > 0){
                 $s += log($val/$mt[GZ_MIN])*$w3;
                 $ws += $w3;
                 $include += $val;
              }
            }
         }
         if ($ws == 0.0){ $ws = 1.0; }
         if ($include > 0){ $score[$k] = array(1.0,exp($s/$ws),sizeof($Tests)-sizeof($test)); }
      }
   }

   uasort($score, 'CompareMeanScore');
   $ratio = array();
   foreach($score as $k => $v){
      if (!isset($first)){ $first = $v[SCORE_MEAN]; }
      if ($first==0){ $r = 0.0; } else { $r = $v[SCORE_MEAN]/$first; }
      $score[$k][SCORE_RATIO] = $r;
      $ratio[] = $r;   // for chart
   }

   return array($score,$ratio);
}



function CompareMeanScore($a, $b){
   if ($a[SCORE_MEAN] == $b[SCORE_MEAN]) return 0;
   return  ($a[SCORE_MEAN] < $b[SCORE_MEAN]) ? -1 : 1;
}


// Formating ///////////////////////////////////////////

function PBlank($d){
   if ($d>0){ return number_format($d); }   
   else { return "&nbsp;"; }
}


?>
