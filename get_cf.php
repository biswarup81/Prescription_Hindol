<?php
require_once "inc/config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select * from patient_health_details_master where NAME LIKE '$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['NAME'];
	echo "$cname\n";
}
?>
