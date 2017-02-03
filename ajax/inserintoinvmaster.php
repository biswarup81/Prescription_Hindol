
<?php

require_once "../inc/config.php";
$investigation_name =$_GET["investigation_name"];
$prescription_id = $_GET["PRESCRIPTION_ID"];
$type = $_GET["investigation_type"];

$sql = "insert into investigation_master(investigation_name,investigation_type) values ('$investigation_name','$type')";
mysql_query($sql) or die(mysql_error());
if(mysql_affected_rows() > 0){
    //echo "<input name='".$investigation_name."' type='checkbox' value='".$investigation_name."'/>&nbsp;".$investigation_name."&nbsp;";
    echo $investigation_name;
}

?>

 