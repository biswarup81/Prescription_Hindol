<?php
include "../datacon.php";
include '../classes/admin_class.php';
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$ci_id = $_GET['ID'];
$admin= new admin();
$result = $admin->deleteClinicalImpression($PRESCRIPTION_ID,$ci_id);

echo $result;
echo '<table>';
/*
if (mysql_affected_rows() > 0){
   echo "<tr><td colspan='2'>". mysql_affected_rows() ." item(s) deleted</td></tr>";
} */

$q15 = "SELECT b.type, b.ID FROM prescribed_social_history a, social_history_master b
                WHERE a.social_history_id = b.ID
                AND a.prescription_id = '$PRESCRIPTION_ID'";
        $rsd1 = mysqli_query($con,$q15);

        if(mysqli_num_rows($rsd1) > 0){
        while($rs = mysqli_fetch_array($rsd1)) {
            $type = $rs['TYPE'];
            $cf_d = $rs['ID'];
            echo "<tr><td style='width: 180px;'>".$type."<a id='minus7' href='#' ></a></td>".
                "<td><a id='minus7' href='#' onclick='deleteClinicalImpression($cf_d,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

        }
            
        } 
echo '</table>';
?>
