<?php

require_once "inc/config.php";

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select * from clinical_impression where TYPE LIKE '$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['TYPE'];
	echo "$cname\n";
}
?>
