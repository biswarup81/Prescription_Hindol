<?php include "header.html"; ?> 
<?php
require_once "inc/config.php";
include 'classes/admin_class.php';
$admin = new admin();
echo $eg = $admin->calcEGFR("Male", 1.23, "30");
echo $admin->deriveClinicalImpressionFromEGFR($eg);
?>
<input id='inv_type' class='input_box_big' type='text'  value='TYPE1' >

<?php
$sql = "select * from past_medical_history_master a ";
echo $sql;
//$sql = "select * from clinical_impression where TYPE LIKE '$q%'";
$rsd = mysql_query($sql) or die(mysql_error()) ;
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['TYPE'];
	echo "$cname\n";
}

?>