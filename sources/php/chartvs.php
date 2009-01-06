<?
header("Content-type: image/png");

// Copyright (c) Isaac Gouy 2004-2008

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_common.php'); 
require_once(LIB_PATH.'lib_headtohead.php'); 
      

// DATA ////////////////////////////////////////////////////

list($Incl,$Excl) = ReadIncludeExclude();
$Langs = ReadUniqueArrays('lang.csv',$Incl);
$Tests = ReadUniqueArrays('test.csv',$Incl);
uasort($Tests, 'CompareTestName');


if (isset($HTTP_GET_VARS['lang'])
      && strlen($HTTP_GET_VARS['lang']) && (strlen($HTTP_GET_VARS['lang']) <= NAME_LEN)){
   $X = $HTTP_GET_VARS['lang'];
   if (ereg("^[a-z0-9]+$",$X) && (isset($Langs[$X]) || $X == 'all')){ $L = $X; }
}
if (!isset($L)){ $L = 'all'; }


if (isset($HTTP_GET_VARS['lang2'])
      && strlen($HTTP_GET_VARS['lang2']) && (strlen($HTTP_GET_VARS['lang2']) <= NAME_LEN)){
   $X = $HTTP_GET_VARS['lang2'];
   if (ereg("^[a-z0-9]+$",$X) && (isset($Langs[$X]) || $X == 'all')){ $L2 = $X; }
}
if (!isset($L2)){
   if ($L=='all'){ $L2 = $L; }
   else { $L2 = $Langs[$L][LANG_COMPARE]; }
}


if (isset($HTTP_GET_VARS['sort'])
      && strlen($HTTP_GET_VARS['sort']) && (strlen($HTTP_GET_VARS['sort']) <= 7)){
   $X = $HTTP_GET_VARS['sort'];
   if (ereg("^[a-z]+$",$X) && ($X == 'fullcpu' || $X == 'kb' || $X == 'gz')){ $S = $X; }
}
if (!isset($S)){ $S = 'fullcpu'; }


$ShortName = $Langs[$L][LANG_FULL];
$ShortName2 = $Langs[$L2][LANG_FULL];


// FILTER & SORT DATA ////////////////////////////////////////

$Data = HeadToHeadData(DATA_PATH.'ndata.csv',$Langs,$Incl,$Excl,$L,$L2);

// CHART /////////////////////////////////////////////////////

// This is a mess! The chart should adjust vertically to show 
// however many tests there are (with some minimum height)
// and the scale and margins should be constants in config.php
// so that the headtohead.php page can adjust the image size.

   $w = 300;
   $w2 = 150;
   $o = 150;
   $h = 300;
   $hsec = 5;
   $hmem = 1;
   $vscale = CHART_VSCALE;
   $hscale = 15;   

   $ts = 28;
   $t = $ts+13;   
   $v1 = $w2/$hscale;
   $b = $h-68;

   $ysec = $t+7;
   $ymem = $t+7 -1;
   $height = 9;


$im = ImageCreate($w,$h);
ImageColorAllocate($im,204,204,204);

$white = ImageColorAllocate($im,255,255,255);
$black = ImageColorAllocate($im,0,0,0);
$bgray = ImageColorAllocate($im,204,204,204);


/* TrueType font
$fpath = '/usr/share/fonts/truetype/ttf-bitstream-vera/Vera.ttf';
$fsize = 10;
$rect = ImageTtfBbox($fsize,0,$fpath,$ShortName);
$xsize = abs($rect[0]) + abs($rect[2]);
$ysize = abs($rect[5]) + abs($rect[1]);
$left = ($w - $xsize) / 2;
ImageTtfText($im,$fsize,0, $left, $ysize - 3, $black,$fpath,$ShortName);
*/


// TOP GRIDLINES & GRIDLINE LABELS

$gray = ImageColorAllocate($im,221,221,221);
$charwidth = 7.0; // for size 3

ImageString($im, 3, ($w-(strlen($ShortName)*$charwidth))/2, $ts-25, $ShortName, $black);
ImageString($im, 5, $o-$v1*12 -6, $ts-14 , 'worse', $white);
ImageString($im, 5, $o+$v1*9 -8, $ts-14 , 'better', $white);

ImageString($im, 2, $o -2, $ts, '1', $white);
ImageString($im, 2, $o-$v1*4 -6, $ts, '5x', $white);
ImageString($im, 2, $o-$v1*9 -8, $ts, '10x', $white);
ImageString($im, 2, $o-$v1*14 -6, $ts, '>15x', $white);
ImageString($im, 2, $o+$v1*4 -6, $ts, '5x', $white);
ImageString($im, 2, $o+$v1*9 -8, $ts, '10x', $white);
ImageString($im, 2, $o+$v1*14 -16, $ts, '>15x', $white);

ImageLine($im, $o-$v1*14, $t+5, $o+$v1*14, $t+5, $white);
ImageLine($im, $o-$v1*14, $b-5, $o+$v1*14, $b-5, $white);

ImageLine($im, $o, $t, $o, $b, $white);
ImageLine($im, $o-$v1*4, $t, $o-$v1*4, $b, $gray);
ImageLine($im, $o-$v1*9, $t, $o-$v1*9, $b, $gray);
ImageLine($im, $o-$v1*14, $t, $o-$v1*14, $b, $white);
ImageLine($im, $o+$v1*4, $t, $o+$v1*4, $b, $gray);
ImageLine($im, $o+$v1*9, $t, $o+$v1*9, $b, $gray);
ImageLine($im, $o+$v1*14, $t, $o+$v1*14, $b, $white);

// CHART BARS

foreach($Tests as $Row){
   if (isset($Data[$Row[TEST_LINK]])){
      $v = $Data[$Row[TEST_LINK]];             

      if ($v[N_LINES] >= 0){
         $wsec = $v[N_FULLCPU];   
         if ($wsec < 1){ 
            if ($wsec==0){ $wsec = 0.0001; }      
            $wsec = min( (1/$wsec)*$v1, $w2) - $v1; 
            ImageFilledRectangle($im, $o-$wsec, $ysec, $o, $ysec+$hsec, $white);
         }            
         else { 
            $wsec = min( $wsec*$v1, $w2) - $v1;
            ImageFilledRectangle($im, $o, $ysec, $o+$wsec, $ysec+$hsec, $white);
         }

         $wmem = $v[N_MEMORY];
         if ($wmem < 1){ 
            if ($wmem==0){ $wmem = 0.0001; }      
            $wmem = min( (1/$wmem)*$v1, $w2) - $v1; 
            ImageFilledRectangle($im, $o-$wmem, $ymem, $o, $ymem+$hmem, $black);
         }            
         else { 
            $wmem = min( $wmem*$v1, $w2) - $v1;
            ImageFilledRectangle($im, $o, $ymem, $o+$wmem, $ymem+$hmem, $black);
         }                             
      }
   }      

   $ysec = $ysec + $height;
   $ymem = $ymem + $height;
}


// BOTTOM GRIDLINE LABELS

ImageString($im, 2, $o -2, $b, '1', $white);
ImageString($im, 2, $o-$v1*4 -6, $b, '5x', $white);
ImageString($im, 2, $o-$v1*9 -8, $b, '10x', $white);
ImageString($im, 2, $o-$v1*14 -6, $b, '>15x', $white);
ImageString($im, 2, $o+$v1*4 -6, $b, '5x', $white);
ImageString($im, 2, $o+$v1*9 -8, $b, '10x', $white);
ImageString($im, 2, $o+$v1*14 -16, $b, '>15x', $white);

// LEGEND 

ImageString($im, 3, ($w-(strlen($ShortName2)*$charwidth))/2, $b+26, $ShortName2, $black);
ImageString($im, 5, $o-$v1*12 -6, $b+11 , 'better', $white);
ImageString($im, 5, $o+$v1*9 -8, $b+11 , 'worse', $white);

ImageFilledRectangle($im, $o-$v1*9+10, $b+54, $o-$v1*9+8+10, $b+54+$hsec, $white);
ImageString($im, 3, $o-$v1*9+8+5+10, $b+50, 'CPU Time', $white);

ImageFilledRectangle($im, $o-$v1*9+110, $b+57, $o-$v1*9+8+110, $b+57+$hmem, $black);
ImageString($im, 2, $o-$v1*9+8+5+110, $b+50, 'Memory Use', $black);


ImageInterlace($im,1);
ImagePNG($im);
ImageDestroy($im); 
?> 
