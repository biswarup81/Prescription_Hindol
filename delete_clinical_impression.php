<?php
require_once "inc/config.php";
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$ci_id = $_GET['ID'];
//$message = "";
mysql_query("delete from prescribed_cf 
             where prescription_id = '$PRESCRIPTION_ID' 
             and clinical_impression_id  ='$ci_id' ") or die(mysql_error());

echo '<table>';
if (mysql_affected_rows() > 0){
   echo "<tr><td colspan='2'>". mysql_affected_rows() ." item(s) deleted</td></tr>";
}

$q15 = "SELECT b.type, b.ID FROM prescribed_cf a, clinical_impression b
                WHERE a.clinical_impression_id = b.id
                AND a.prescription_id = '$PRESCRIPTION_ID'";
        $rsd1 = mysql_query($q15);

        if(mysql_num_rows($rsd1) > 0){
        while($rs = mysql_fetch_array($rsd1)) {
            $type = $rs['type'];
            $cf_d = $rs['ID'];
            echo "<tr><td style='width: 180px;'>".$type."<a id='minus7' href='#' ></a></td>".
                "<td><a id='minus7' href='#' onclick='deleteClinicalImpression($cf_d,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

        }
            
        } 
echo '</table>';
?>
