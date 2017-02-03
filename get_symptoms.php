<?php
require_once "datacon.php";
// no term passed - just exit early with no response
if (empty($_GET['term'])) exit ;
$q = strtolower($_GET["term"]);

$sql = "select * from clinical_impression where TYPE LIKE '$q%'";


$result = array();

$fetch = mysql_query($sql); 

while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    
    array_push($result, array("id"=>$row['ID'], 
        "label"=>$row['TYPE'], "value" => strip_tags($row['TYPE'])));
}

echo json_encode($result);
?>