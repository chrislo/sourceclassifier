<?   // Copyright (c) Isaac Gouy 2008 ?>

<dl>
<?
list($Incl,$Excl) = ReadIncludeExclude();
$Tests = ReadUniqueArrays('test.csv',$Incl);
uasort($Tests, 'CompareTestName');

$Tests = array_values($Tests);
$i = 0;
$testsSize = sizeof($Tests);
while ($i<$testsSize){
   $t = $Tests[$i];
   $TestLink = $t[TEST_LINK];
   $TestName = $t[TEST_NAME];

   $About = & new Template(ABOUT_PATH);
   $AboutTemplateName = $TestLink.SEPARATOR.'about.tpl.php';
   if (! file_exists(ABOUT_PATH.$AboutTemplateName)){ $AboutTemplateName = 'blank-about.tpl.php'; }

   $About->set('SelectedTest', $TestLink);
   $About->set('SelectedLang', 'all');
   $About->set('Sort', 'fullcpu');

   printf('<dt><a href="#%s" name="%s">&nbsp;the %s %s rules</a></dt>', $TestLink,$TestLink,$TestName,TESTS_PHRASE);
   echo '<dd>', $About->fetch($AboutTemplateName), '</dd>';

   $i++;
}
?>
</dl>