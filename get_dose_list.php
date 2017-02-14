<?php

require_once "inc/config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select * from dose_details_master where DOSE_DETAILS LIKE '$q%'";
$rsd = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($rsd)) {
	$cname = $rs['DOSE_DETAILS'];
	echo "$cname\n";
}
?>
