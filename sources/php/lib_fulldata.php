<?php
// Copyright (c) Isaac Gouy 2005-2008

// FUNCTIONS ///////////////////////////////////////////////////


function ComparisonData($langs,$data,$p,&$Excl){
   list($Accepted) = FilterAndSortData($langs,$data,'fullcpu',&$Excl);

// SELECTION DEPENDS ON THIS SORT ORDER

   uasort($Accepted,'CompareTestValue');

// TRANSFORM SELECTED DATA

   $lang = ""; $id = "";
   $NData = array(); $TestValues = array();

   foreach($Accepted as $d){
      if (($lang != $d[DATA_LANG])||($id != $d[DATA_ID])){
         $lang = $d[DATA_LANG];
         $id = $d[DATA_ID]; 

         $NData[] = array(
              ''
            , $lang
            , $id
            , ''
            , $langs[$lang][LANG_FULL].IdName($id)
            , $langs[$lang][LANG_HTML].IdName($id)
            , array()
            , array()
            , 0
            , 0
            , 0
            );

         $i = sizeof($NData)-1;         
      } 
      $NData[$i][N_FULLCPU][] = $d[DATA_FULLCPU];
      $NData[$i][N_MEMORY][] = $d[DATA_MEMORY];    
      $TestValues[ $d[DATA_TESTVALUE] ] = $d[DATA_TESTVALUE];
   }  

// SUB-SELECT DATA FOR SPECIFIC PROGRAMS

   $plang = array(); $pid = array();
   foreach($p as $pdash){
      list($a, $b) = explode('-', $pdash);
      $plang[] = $a; 
      $pid[] = $b;
   }

   $Selected = array();
   foreach($NData as $d){
      if ((($plang[0]==$d[N_LANG])&&($pid[0]==$d[N_ID])) ||
          (($plang[1]==$d[N_LANG])&&($pid[1]==$d[N_ID])) ||
          (($plang[2]==$d[N_LANG])&&($pid[2]==$d[N_ID])) ||
          (($plang[3]==$d[N_LANG])&&($pid[3]==$d[N_ID]))){
         $Selected[] = $d;
      }
   }


// MAX AND NAME FOR SPECIFIC PROGRAMS
   for ($i=0; $i<sizeof($Selected); $i++){
      $d = $Selected[$i];
      $lang = $d[N_LANG];
      $id = $d[N_ID]; 

      if (strlen($langs[$lang][LANG_NAME])>0){
         $Selected[$i][N_NAME] = $langs[$lang][LANG_NAME].IdName($id); }
      else {
         $Selected[$i][N_NAME] = $langs[$lang][LANG_FAMILY].IdName($id); } 
         
      foreach($d[N_FULLCPU] as $v){
         if ($Selected[$i][N_CPU_MAX]<$v){ $Selected[$i][N_CPU_MAX] = $v; }
      }

      foreach($d[N_MEMORY] as $v){
         if ($Selected[$i][N_MEMORY_MAX]<$v){ $Selected[$i][N_MEMORY_MAX] = $v; }
      }

// USE SAME COLOR FOR PROGRAM IN EVERY CHART
      $Selected[$i][N_COLOR] = $i;
   }
   uasort($NData,'CompareNName');
   sort($TestValues);
   
   return array(&$NData,&$Selected,$TestValues);
}


function MkComparisonMenuForm($Langs,$Tests,$SelectedTest,$Data,$p1,$p2,$p3,$p4,$Sort){
   echo '<form method="get" action="fulldata.php">', "\n";
   echo '<p><select name="test">', "\n";

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
   echo '</select></p>', "\n";    
   
     
// NASTY HACK      
// ADD DUMMY VALUES TO PRESERVE SELECTION IN DROP-DOWN MENUS 
// default is '-0' so check $a

   list($a, $b) = explode('-', $p1); 
   if (strlen($a)){
      $c = $Langs[$a]; $d = IdName($b);
      $Data[] = array($a, $b, '', $c[LANG_FULL].$d, $c[LANG_FULL].$d);
   }

   list($a, $b) = explode('-', $p2); 
   if (strlen($a)){
      $c = $Langs[$a]; $d = IdName($b);
      $Data[] = array($a, $b, '', $c[LANG_FULL].$d, $c[LANG_FULL].$d);
   }

   list($a, $b) = explode('-', $p3); 
   if (strlen($a)){
      $c = $Langs[$a]; $d = IdName($b);
      $Data[] = array($a, $b, '', $c[LANG_FULL].$d, $c[LANG_FULL].$d);
   }

   list($a, $b) = explode('-', $p4); 
   if (strlen($a)){
      $c = $Langs[$a]; $d = IdName($b);
      $Data[] = array($a, $b, '', $c[LANG_FULL].$d, $c[LANG_FULL].$d);
   }

        
   echo '<p class="h"><strong>Choose</strong> programs for side-by-side comparison: <br />', "\n";    
   echo '<select name="p1">', "\n";

   $first = 1;
   foreach($Data as $Row){
      $Link = $Row[N_LANG].'-'.$Row[N_ID];
      $Name = $Row[N_FULL];
      if ($Link==$p1 && $first){ // avoid choosing the dummy value if possible
         $Selected = 'selected="selected"'; $first = 0;
      } else {
         $Selected = '';
      }
      printf('<option %s value="%s">%s</option>', $Selected,$Link,$Name); echo "\n";
   }
   echo '</select>', "\n";
   echo '<select name="p2">', "\n";

   $first = 1;   
   foreach($Data as $Row){
      $Link = $Row[N_LANG].'-'.$Row[N_ID];
      $Name = $Row[N_FULL];
      if (($Link==$p2) && $first){ // avoid choosing the dummy value if possible
         $Selected = 'selected="selected"'; $first = 0;
      } else {
         $Selected = '';
      }
      printf('<option %s value="%s">%s</option>', $Selected,$Link,$Name); echo "\n";
   }

   echo '</select>', "\n";
   echo '<select name="p3">', "\n";

   $first = 1;   
   foreach($Data as $Row){
      $Link = $Row[N_LANG].'-'.$Row[N_ID];
      $Name = $Row[N_FULL];

      if ($Link==$p3 && $first){ // avoid choosing the dummy value if possible
         $Selected = 'selected="selected"'; $first = 0;
      } else {
         $Selected = '';
      }
      printf('<option %s value="%s">%s</option>', $Selected,$Link,$Name); echo "\n";
   }

   echo '</select>', "\n";
   echo '<select name="p4">', "\n";
   
   $first = 1;   
   foreach($Data as $Row){
      $Link = $Row[N_LANG].'-'.$Row[N_ID];
      $Name = $Row[N_FULL];

      if ($Link==$p4 && $first){ // avoid choosing the dummy value if possible
         $Selected = 'selected="selected"'; $first = 0;
      } else {
         $Selected = '';
      }
      printf('<option %s value="%s">%s</option>', $Selected,$Link,$Name); echo "\n";
   }
   echo '</select>', "\n";
   echo '<input type="submit" value="Show" />', "\n";
   echo '</p></form>', "\n";
}



function CompareMaxCpu($a, $b){
   if ($a[N_CPU_MAX] == $b[N_CPU_MAX]) return 0;
   return  ($a[N_CPU_MAX] > $b[N_CPU_MAX]) ? -1 : 1;
}

function CompareMaxMemory($a, $b){
   if ($a[N_MEMORY_MAX] == $b[N_MEMORY_MAX]) return 0;
   return  ($a[N_MEMORY_MAX] > $b[N_MEMORY_MAX]) ? -1 : 1;
}


?>