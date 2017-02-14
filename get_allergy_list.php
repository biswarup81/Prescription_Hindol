<?php
require_once "inc/config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select * from allergy_master where ALLERGY_NAME LIKE '$q%'";
$rsd = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($rsd)) {
	$cname = $rs['ALLERGY_NAME'];
	echo "$cname\n";
}
?>
