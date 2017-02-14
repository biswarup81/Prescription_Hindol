<?php
include "../datacon.php";
include '../classes/admin_class.php';
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$allergy_id = $_GET['ID'];
$admin= new admin();
$result = $admin->deleteAllergy($PRESCRIPTION_ID,$allergy_id);

echo $result;
echo '<table>';
/*
if (mysql_affected_rows() > 0){
   echo "<tr><td colspan='2'>". mysql_affected_rows() ." item(s) deleted</td></tr>";
} */

$q15 = "SELECT b.ALLERGY_NAME, b.ALLERGY_ID FROM prescribed_allergy a, allergy_master b
                WHERE a.ALLERGY_ID = b.ALLERGY_ID
                AND a.prescription_id = '$PRESCRIPTION_ID'";
        $rsd1 = mysqli_query($con,$q15);

        if(mysqli_num_rows($rsd1) > 0){
        while($rs = mysqli_fetch_array($rsd1)) {
            $allergy_name = $rs['TYPE'];
            $allergy_id = $rs['ALLERGY_ID'];
            echo "<tr><td style='width: 180px;'>".$allergy_name."<a id='minus7' href='#' ></a></td>".
                "<td><a id='minus7' href='#' onclick='deleteClinicalImpression($allergy_id,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

        }
            
        } 
echo '</table>';
?>
