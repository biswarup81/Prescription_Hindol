<?php
include "../datacon.php";
include '../classes/admin_class.php';
$PRESCRIPTION_ID = $_GET['prescription_id'];
$ALLERGY = $_GET['TYPE'];

$admin = new admin();
$admin->insertUpdateAllergy($PRESCRIPTION_ID, $ALLERGY);

$q15 = "SELECT b.ALLERGY_NAME, b.ALLERGY_ID FROM prescribed_allergy a, allergy_master b 
        WHERE a.ALLERGY_ID = b.ALLERGY_ID
        AND a.prescription_id = '$PRESCRIPTION_ID'";
        $rsd1 = mysql_query($q15);
echo '<table>';
       
    while($rs = mysql_fetch_array($rsd1)) {
        $allergy_name = $rs['ALLERGY_NAME'];
        $allergy_id = $rs['ALLERGY_ID'];
        echo "<tr><td style='width: 180px;'>".$allergy_name."<a id='minus7' href='#' ></a></td>".
            "<td><a id='minus7' href='#' onclick='deleteAllergy($allergy_id,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

    }
        
echo '</table>';

?>
