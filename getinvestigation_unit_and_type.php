<?php

require_once "inc/config.php";
$q = $_GET["INVESTIGATION_NAME"];
if (!$q) return;

$sql = "select * from  investigation_master where investigation_name = '$q%' and STATUS = 'ACTIVE'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	
	echo $rs['ID']. ",".$rs['investigation_type'].",".$rs['unit'];
}
?>
