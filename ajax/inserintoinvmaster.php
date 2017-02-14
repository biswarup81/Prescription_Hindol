
<?php

require_once "../datacon.php";
$investigation_name =$_GET["investigation_name"];
$prescription_id = $_GET["PRESCRIPTION_ID"];
$type = $_GET["investigation_type"];

$sql = "insert into investigation_master(investigation_name,investigation_type) values ('$investigation_name','$type')";
mysqli_query($con,$sql) or die(mysqli_error());
if(mysql_affected_rows() > 0){
    //echo "<input name='".$investigation_name."' type='checkbox' value='".$investigation_name."'/>&nbsp;".$investigation_name."&nbsp;";
    echo $investigation_name;
}

?>

 