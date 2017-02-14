<?php

require_once "inc/config.php";

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select a.TYPE from past_medical_history_master a where a.TYPE LIKE '$q%'";
//$sql = "select * from clinical_impression where TYPE LIKE '$q%'";
$rsd = mysqli_query($con,$sql) ;
while($rs = mysqli_fetch_array($rsd)) {
	$cname = $rs['TYPE'];
	echo "$cname\n";
}
?>
