<!--#set var="TITLE" value="Ackermann's Function" -->
<!--#set var="KEYWORDS" value="performance, benchmark, ackerman,
ackermann, computer, language, compare, cpu, memory" -->

<?php require("../../html/testtop.php");
      require("../../html/cmp_test.php");
      testtop_nav("Ackermann's Function"); ?>

<div class="h4"><h4>Measurements while N varies</h4></div>
<p>The test parameter N is used as the second parameter to the
  Ackermann function.  So if N is 8, then we compute Ackermann(3,8).</p>

<?php cmp_test("ackermann", $_SERVER['QUERY_STRING']);?>

