<?php
include "../datacon.php";
include '../classes/admin_class.php';
$PRESCRIPTION_ID = $_GET['prescription_id'];
$TYPE = $_GET['TYPE'];

$admin = new admin();
$admin->insertUpdatepastMedicalHistory($PRESCRIPTION_ID, $TYPE);

$q15 = "SELECT b.type, b.ID FROM prescribed_past_med_history a, past_medical_history_master b
                WHERE a.clinical_impression_id = b.id
                AND a.prescription_id = '$PRESCRIPTION_ID'";
        $rsd1 = mysqli_query($con,$q15);
echo '<table>';
       
        while($rs = mysqli_fetch_array($rsd1)) {
            $type = $rs['type'];
            $cf_d = $rs['ID'];
            echo "<tr><td style='width: 180px;'>".$type."<a id='minus7' href='#' ></a></td>".
                "<td><a id='minus7' href='#' onclick='deletePastMedicalHistory($cf_d,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

        }
            
        
echo '</table>';

?>
