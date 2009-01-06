<?
header("Content-type: image/png");
// Copyright (c) Isaac Gouy 2004-2008

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_common.php'); 
require_once(LIB_PATH.'lib_fulldata.php');


// DATA ////////////////////////////////////////////////////

list($Incl,$Excl) = ReadIncludeExclude();
$Langs = ReadUniqueArrays('lang.csv',$Incl);
$Tests = ReadUniqueArrays('test.csv',$Incl);

if (isset($HTTP_GET_VARS['test'])
      && strlen($HTTP_GET_VARS['test']) && (strlen($HTTP_GET_VARS['test']) <= NAME_LEN)){
   $X = $HTTP_GET_VARS['test'];
   if (ereg("^[a-z]+$",$X) && isset($Tests[$X])){ $T = $X; }
}
if (!isset($T)){ $T = 'nbody'; }


if (isset($HTTP_GET_VARS['p1'])
      && strlen($HTTP_GET_VARS['p1']) && (strlen($HTTP_GET_VARS['p1']) <= PRG_ID_LEN)){
   $X = $HTTP_GET_VARS['p1'];
   if (ereg("^[a-z0-9]+-[0-9]$",$X)){
      list($a, $b) = explode('-', $X);
      if (isset($Langs[$a])){ $P1 = $X; }
   }
}
if (!isset($P1)){ $P1 = '-0'; }


if (isset($HTTP_GET_VARS['p2'])
      && strlen($HTTP_GET_VARS['p2']) && (strlen($HTTP_GET_VARS['p2']) <= PRG_ID_LEN)){
   $X = $HTTP_GET_VARS['p2'];
   if (ereg("^[a-z0-9]+-[0-9]$",$X)){
      list($a, $b) = explode('-', $X);
      if (isset($Langs[$a])){ $P2 = $X; }
   }
}
if (!isset($P2)){ $P2 = '-0'; }


if (isset($HTTP_GET_VARS['p3'])
      && strlen($HTTP_GET_VARS['p3']) && (strlen($HTTP_GET_VARS['p3']) <= PRG_ID_LEN)){
   $X = $HTTP_GET_VARS['p3'];
   if (ereg("^[a-z0-9]+-[0-9]$",$X)){
      list($a, $b) = explode('-', $X);
      if (isset($Langs[$a])){ $P3 = $X; }
   }
}
if (!isset($P3)){ $P3 = '-0'; }


if (isset($HTTP_GET_VARS['p4'])
      && strlen($HTTP_GET_VARS['p4']) && (strlen($HTTP_GET_VARS['p4']) <= PRG_ID_LEN)){
   $X = $HTTP_GET_VARS['p4'];
   if (ereg("^[a-z0-9]+-[0-9]$",$X)){
      list($a, $b) = explode('-', $X);
      if (isset($Langs[$a])){ $P4 = $X; }
   }
}
if (!isset($P4)){ $P4 = '-0'; }



// FILTER & SORT DATA ////////////////////////////////////////

$nd = ReadSelectedDataArrays(DATA_PATH.'ndata.csv',$T,$Incl);
$p = array($P1,$P2,$P3,$P4);
list($NData,$Selected,$TestValues) = ComparisonData($Langs,$nd,$p,$Excl);
usort($Selected,'CompareMaxCpu');


// CHART /////////////////////////////////////////////////////

$w = 160;
$h = 240;
$lm = 5; $rm = 5; $tm = 5; $bm = 5;
$width = ($w - ($lm + $rm)) / (sizeof($TestValues) - 1);
$legend = $tm;

$max = -10;
foreach($Selected as $t){
   if (($t[N_CPU_MAX] > $max) && ($t[N_CPU_MAX] != 0)){ $max = $t[N_CPU_MAX]; }
}
$vscale = ($h - ($tm + $bm))/$max;

$im = ImageCreate($w,$h);
ImageColorAllocate($im,204,204,204);

$white = ImageColorAllocate($im,255,255,255);
$black = ImageColorAllocate($im,0,0,0);
$bgray = ImageColorAllocate($im,204,204,204);
$yellow = ImageColorAllocate($im,255,255,16);
$orange = ImageColorAllocate($im,255,132,41);
$red = ImageColorAllocate($im,255,49,24);

$colors = array($white, $yellow, $orange, $red);

function drawPolyline($values,$color){
   global $lm, $bm, $vscale, $im, $h, $width;
   $x = $lm;   
   foreach($values as $v){
      if (!isset($y1)){
         if ($v > 0){ $y1 = $v * $vscale; }
         else { $x += $width; }
      }
      else {
         if ($v > 0){
            $y2 = $v * $vscale;
            ImageLine($im, $x, $h-($y1+$bm), $x+$width, $h-($y2+$bm), $color);            
            $x += $width;
            $y1 = $y2;
         }
      }
   }
}


function drawName($name,$color){
   global $lm, $im, $legend;
   ImageString($im, 3, $lm, $legend, $name, $color);
   $legend += 15;
}

for ($i=0; $i<sizeof($Selected); $i++){
   drawPolyline($Selected[$i][N_FULLCPU], $colors[ $Selected[$i][N_COLOR] ]); 
}
for ($i=0; $i<sizeof($Selected); $i++){
   drawName($Selected[$i][N_FULL], $colors[ $Selected[$i][N_COLOR] ]);
}

ImageInterlace($im,1);
ImagePNG($im);
ImageDestroy($im); 
?> 