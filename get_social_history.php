<?php
require_once "inc/config.php";

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select * from social_history_master where TYPE LIKE '$q%'";
$rsd = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($rsd)) {
	$cname = $rs['TYPE'];
	echo "$cname\n";
}
?>
