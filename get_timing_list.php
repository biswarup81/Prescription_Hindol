<?php

require_once "inc/config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select * from dose_timing_master where TIMING LIKE '$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['TIMING'];
	echo "$cname\n";
}
?>
