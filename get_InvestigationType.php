<?php
require_once "inc/config.php";
echo "TEST";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "SELECT DISTINCT ( investigation_type )
		FROM investigation_master
		GROUP BY investigation_type";
$rsd = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($rsd)) {
	$cname = $rs['investigation_type'];
	echo "$cname\n";
}
?>