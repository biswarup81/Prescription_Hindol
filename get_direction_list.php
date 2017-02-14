<?php

require_once "inc/config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select * from dose_direction where DIRECTION LIKE '$q%'";
$rsd = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($rsd)) {
	$cname = $rs['DIRECTION'];
	echo "$cname\n";
}
?>
