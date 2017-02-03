<?php
require_once "inc/config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select * from medicine_master where MEDICINE_NAME LIKE '$q%' and MEDICINE_STATUS = 'ACTIVE'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['MEDICINE_NAME'];
	echo "$cname\n";
}
?>