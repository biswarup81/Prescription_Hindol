<?php
require_once "inc/config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select * from  investigation_master where investigation_name LIKE '$q%' and STATUS = 'ACTIVE'";
$rsd = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($rsd)) {
	$cname = $rs['investigation_name'];
	echo "$cname\n";
}
?>