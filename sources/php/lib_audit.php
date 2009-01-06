<?php
// Copyright (c) Isaac Gouy 2005

// FUNCTIONS ///////////////////////////////////////////////////

function ReadCsv($FileName,$HasHeading=TRUE){
      $t0 = GetMicroTime();
   $f = @fopen($FileName,'r') or die ('Cannot open $FileName');
   if ($HasHeading){ $row = @fgetcsv($f,1024,','); }
   
   $count = 0;
   $dset = array();
   while (!@feof ($f)){
      $row = @fgetcsv($f,1024,',');
      if (!is_array($row)){ continue; }  
            
      settype($row[DATA_ID],'integer');      
      $tag = $row[DATA_TEST]."-".$row[DATA_LANG]."-".$row[DATA_ID]; 
      $value = $row[DATA_FULLCPU];    
      
      if (isset($dset[$tag])){      
         if ($value < 0){ $dset[$tag] = $value; }            
      }
      else {
         $dset[$tag] = $value;      
      }
      $count++;          
   }
   @fclose($f);       
      $t1 = GetMicroTime();          
   return array($dset,$count,$t1-$t0);
}



function ReadLogFiles($dirPath){
   $prefix = 30; // PROGRAM OUTPUTLF==============LF
   
   $logs = array();   
   $oldlogs = array();
   $dh = opendir($dirPath);
   while($fn = readdir($dh)){
      $ext = strpos($fn,'.log');
      $tag = substr($fn,0,$ext);                                   
      if ($tag){ 
         $oldtag = $tag;                     
         $byteSize = filesize(LOG_PATH.$fn);                  
         if ( sizeof(explode('-',$tag)) < 3 ){ $tag .= '-0'; }  
         
         if (file_exists(LOG_PATH.$oldtag.'.code')){
            $logtime = filemtime(LOG_PATH.$fn);       
            $codetime = filemtime(LOG_PATH.$oldtag.'.code');  
            if ($codetime > $logtime){ $oldlogs[$tag] = $tag; }
         }          
                                             
         $code = 0;         
         if (($byteSize > 0) && ($byteSize <= 40960)){                  
            $f = fopen(LOG_PATH.$fn,'r');
            $s = fread($f,$byteSize);
            fclose($f);
                        
            if (strpos($s,'Permission denied')){ $code = PROGRAM_EXCLUDED; }         
            elseif (strpos($s,'TIMEOUT')){ $code = PROGRAM_TIMEOUT; }
            elseif (strpos($s,'FAILED')){ $code = PROGRAM_ERROR; }            
            else {
               if ($i = strpos($s,'PROGRAM OUTPUT')){               
                  if ($i+$prefix == strlen($s)){ $code = NO_PROGRAM_OUTPUT; }
               }
               else { $code = NO_PROGRAM_OUTPUT; }
            }   
         }      
         else { $code = NO_PROGRAM_OUTPUT; }          
                                          
         $logs[$tag] = array($code,$byteSize);                                                                   
      }
   }
   closedir($dh);    
   ksort($logs); 
   ksort($oldlogs);         
   return array($logs,$oldlogs);
}


function PrettyTag($k){
   $a = explode('-',$k);
   $s = $a[0]." ".$a[1];
   if ($a[2]>0){ $s .= " #".$a[2]; }
   return $s;
}

function PrintPrettyTag($k){
   echo '<p>', PrettyTag($k), '</p>', "\n";
}

function CompareLogFileSize($a, $b){
   if ($a[1] == $b[1]) return 0;
   return  ($a[1] > $b[1]) ? -1 : 1;
}


function &AuditResults(&$NData, &$Logs, &$Data){
   $missingRows = array();
   foreach($NData as $k => $v){ if (!isset($Data[$k])){ $missingRows[] = $k; } }

   $badPermissions = array();
   foreach($Logs as $k => $v){ if ($Logs[$k][0]==PROGRAM_EXCLUDED){ $badPermissions[] = $k; } } 

   $missingLogs = array();
   foreach($NData as $k => $v){ if (!isset($Logs[$k])){ $missingLogs[] = $k; } }

   $orphanLogs = array();
   foreach($Logs as $k => $v){ if (!isset($NData[$k])){ $orphanLogs[] = $k; } }

   $badLogs1 = array();
   foreach($NData as $k => $v){ 
      if ($v==PROGRAM_ERROR && isset($Logs[$k])){ 
         if (($Logs[$k][0]!=PROGRAM_EXCLUDED)&&($Logs[$k][0]!=PROGRAM_ERROR)){
            $badLogs1[] = $k; } } }

   $badLogs2 = array();
   foreach($Logs as $k => $v){ 
      if (($v[0]==PROGRAM_ERROR||$v[0]==PROGRAM_EXCLUDED) && isset($NData[$k])){ 
         if ($NData[$k]!=PROGRAM_ERROR){
            $badLogs2[] = $k; } } }
            
   $badLogs3 = array();
   foreach($Logs as $k => $v){ 
      if ($v[0]==NO_PROGRAM_OUTPUT){ $badLogs3[] = $k; } }     
    
   $badLogs4 = array();
   foreach($NData as $k => $v){ 
      if ($v==PROGRAM_TIMEOUT && isset($Logs[$k])){ 
         if ($Logs[$k][0]!=PROGRAM_TIMEOUT){ $badLogs4[] = $k; } } }    
    
   $badLogs5 = array();
   foreach($Logs as $k => $v){ 
      if ($v[0]==PROGRAM_TIMEOUT && isset($NData[$k])){ 
         if ($NData[$k]!=PROGRAM_TIMEOUT){ $badLogs5[] = $k; } } }    
     
   $bigLogs = array();
   foreach($Logs as $k => $v){ 
      if ($v[1]>20480){ $bigLogs[$k] = $v; } 
   }       
   
   $timeoutCount = 0;
   foreach($Logs as $k => $v){ 
      if ($v[0]==PROGRAM_TIMEOUT && isset($NData[$k])){ $timeoutCount++; }     
   }      
   
   $failedCount = 0;   
   foreach($Logs as $k => $v){ 
      if ($v[0]==PROGRAM_ERROR && isset($NData[$k])){ $failedCount++; }     
   }      
   
            
   return array(
      $missingRows, $badPermissions, $missingLogs, 
      $orphanLogs, $badLogs1, $badLogs2, $badLogs3,
      $badLogs4, $badLogs5, $bigLogs, $timeoutCount,
      $failedCount      
   );            
}

?>