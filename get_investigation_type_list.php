<?php

require_once "inc/config.php";
$q = $_GET["q"];
if (!$q) return;

$sql = "select distinct(investigation_type) from  investigation_master where investigation_type LIKE '$q%' and STATUS = 'ACTIVE'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['investigation_type'];
	echo "$cname\n";
}
?>
