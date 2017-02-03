<?php
require_once "datacon.php";
// no term passed - just exit early with no response
if (empty($_GET['term'])) exit ;
$q = strtolower($_GET["term"]);

$sql = "select * from medicine_master where MEDICINE_NAME LIKE '$q%' and MEDICINE_STATUS = 'ACTIVE'";



$result = array();

$fetch = mysql_query($sql); 

while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    
    array_push($result, array("id"=>$row['MEDICINE_ID'], 
        "label"=>$row['MEDICINE_NAME'], "value" => strip_tags($row['MEDICINE_NAME'])));
}

echo json_encode($result);
?>