<?php
require_once "inc/config.php";
$PRESCRIPTION_ID = $_GET['prescription_id'];
$TYPE = $_GET['TYPE'];

//GET ID of the TYPE

$query = "select ID from clinical_impression where TYPE = '$TYPE'";
$result = mysqli_query($con,$query);
$id = "";
if(mysqli_num_rows($result) > 0){
    //Clinical Impression Type exists in the Database. Get the ID
    while($rs = mysqli_fetch_array($result)){
        $id = $rs['ID'];
    }
} else {
    //Insert into master and then add
    $query = "insert into clinical_impression (TYPE, DESCRIPTION) values('$TYPE','$TYPE')";
    mysqli_query($con,$query);
    $id = mysql_insert_id();
}
$query = "insert into prescribed_cf(clinical_impression_id, prescription_id) 
            values('$id' , '$PRESCRIPTION_ID')";
mysqli_query($con,$query);
$q15 = "SELECT b.type, b.ID FROM prescribed_cf a, clinical_impression b
                WHERE a.clinical_impression_id = b.id
                AND a.prescription_id = '$PRESCRIPTION_ID'";
        $rsd1 = mysqli_query($con,$q15);
echo '<table>';
       
        while($rs = mysqli_fetch_array($rsd1)) {
            $type = $rs['type'];
            $cf_d = $rs['ID'];
            echo "<tr><td style='width: 180px;'>".$type."<a id='minus7' href='#' ></a></td>".
                "<td><a id='minus7' href='#' onclick='deleteClinicalImpression($cf_d,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

        }
            
        
echo '</table>';

?>
