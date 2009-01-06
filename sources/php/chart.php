<?
header("Content-type: image/png");

// Copyright (c) Isaac Gouy 2004-2008

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_common.php');      

// DATA ////////////////////////////////////////////////////

list($Incl,$Excl) = ReadIncludeExclude();
$Langs = ReadUniqueArrays('lang.csv',$Incl);
$Tests = ReadUniqueArrays('test.csv',$Incl);

if (isset($HTTP_GET_VARS['test'])
      && strlen($HTTP_GET_VARS['test']) && (strlen($HTTP_GET_VARS['test']) <= NAME_LEN)){
   $X = $HTTP_GET_VARS['test'];
   if (ereg("^[a-z]+$",$X) && (isset($Tests[$X]) || $X == 'all')){ $T = $X; }
}
if (!isset($T)){ $T = 'nbody'; }


if (isset($HTTP_GET_VARS['sort'])
      && strlen($HTTP_GET_VARS['sort']) && (strlen($HTTP_GET_VARS['sort']) <= 7)){
   $X = $HTTP_GET_VARS['sort'];
   if (ereg("^[a-z]+$",$X) && ($X == 'fullcpu' || $X == 'kb' || $X == 'gz')){ $S = $X; }
}
if (!isset($S)){ $S = 'fullcpu'; }


// FILTER & SORT DATA ////////////////////////////////////////

$Data = ReadSelectedDataArrays(DATA_PATH.'data.csv',$T,$Incl);
list($Accepted) = FilterAndSortData($Langs,$Data,$S,$Excl);


// CHART /////////////////////////////////////////////////////

   $w = 600;
   $h = 150;
   $wsec = 5;
   $wmem = 1;
   $vscale = CHART_VSCALE;
   $xsec = 7;
   $xmem = 6;
   $width = 9;
   $minsec = -1;
   $minmem = -1;

// FIND THE MINIMUM VALUES
// VALUES WILL BE SCALED SO $hscale TIMES THE MINIMUM WILL FIT THE IMAGE HEIGHT

   foreach($Accepted as $v){   
      if (($minsec == -1) && ($v[DATA_FULLCPU] > 0.0)){ $minsec = $v[DATA_FULLCPU]; }
      elseif (($v[DATA_FULLCPU] > 0.0) && ($v[DATA_FULLCPU] < $minsec)){ $minsec = $v[DATA_FULLCPU]; }
             
      if (($minmem == -1) && ($v[DATA_MEMORY] > 0.0)){ $minmem = $v[DATA_MEMORY]; }
      elseif (($v[DATA_MEMORY] > 0.0) && ($v[DATA_MEMORY] < $minmem)){ $minmem = $v[DATA_MEMORY]; }
   }

if ($minsec < 0.01){ $minsec = 0.01; }
if ($minmem < 100){ $minmem = 100; }

$im = ImageCreate($w,$h);
ImageColorAllocate($im,204,204,204);

$white = ImageColorAllocate($im,255,255,255);
$black = ImageColorAllocate($im,0,0,0);
$bgray = ImageColorAllocate($im,204,204,204);


// GRIDLINES

$gray = ImageColorAllocate($im,221,221,221);
$h1 = $h - ((CHART_V1 / $vscale) * $h);
$h2 = $h - ((CHART_V2 / $vscale) * $h);
$h3 = $h - ((CHART_V3 / $vscale) * $h);
ImageLine($im, 0, $h1, $w, $h1, $gray);
ImageLine($im, 0, $h2, $w, $h2, $gray);
ImageLine($im, 0, $h3, $w, $h3, $gray);


// CHART BARS

   foreach($Accepted as $v){
      $hsec = min( ($v[DATA_FULLCPU]/$minsec)*($h/$vscale), $h);
      $hmem = min( ($v[DATA_MEMORY]/$minmem)*($h/$vscale), $h);

      ImageFilledRectangle($im, $xsec, $h-$hsec, $xsec+$wsec, $h, $white);
      ImageFilledRectangle($im, $xmem, $h-$hmem, $xmem+$wmem, $h, $black);

      $xsec = $xsec + $width;
      $xmem = $xmem + $width;
   }


// GRIDLINES & GRIDLINE LABELS

ImageString($im, 2, 6, $h1-14, CHART_V1.'x', $white);
ImageString($im, 2, 6, $h2-14, CHART_V2.'x', $white);
if (CHART_V2 != CHART_V3){ ImageString($im, 2, 6, $h3+4, CHART_V3.'x', $white); }

ImageString($im, 2, $w-26, $h1-14, CHART_V1.'x', $white);
ImageString($im, 2, $w-26, $h2-14, CHART_V2.'x', $white);
ImageString($im, 2, $w-26, $h3-14, CHART_V3.'x', $white);


// LEGEND - SHOW SORT ORDER BY PUTTING SORT CRITERIA AT TOP OF LEGEND

if (($S=='kb')||($S=='lines')||($S=='gz')){ 
   $kbTop = $h-148; $cpuTop = $h-135; $sortname = SortName('fullcpu'); }
else { 
   $kbTop = $h-135; $cpuTop = $h-148; $sortname = SortName('fullcpu'); }  

ImageFilledRectangle($im, 2, $cpuTop, $wsec+105, $cpuTop+13, $bgray);
ImageFilledRectangle($im, 6, $cpuTop+2, $wsec+6, $cpuTop+10, $white);
ImageString($im, 3, 20, $cpuTop, $sortname, $black);
ImageFilledRectangle($im, 2, $kbTop, $wsec+80, $kbTop+13, $bgray);
ImageFilledRectangle($im, 6, $kbTop+2, $wmem+6, $kbTop+10, $black);
ImageString($im, 3, 20, $kbTop, SortName('kb'), $black);

ImageInterlace($im,1);
ImagePNG($im);
ImageDestroy($im);
?>