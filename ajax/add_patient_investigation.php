<?php
include "../datacon.php";
include '../classes/admin_class.php';
$PATIENT_ID = $_GET['patientid'];
$VISIT_ID = $_GET['visit_id'];
$INVESTIGATION_NAME = $_GET['invName'];
$VALUE = $_GET['invVal'];
if(isset($_GET['UNIT'])){
    $UNIT = mysql_real_escape_string($_GET['UNIT']);
} else {
    $UNIT =  "";
}

if(isset( $_GET['TYPE'])){
    $TYPE = $_GET['TYPE'];
} else {
    $TYPE = "";
}
//$TYPE = $_GET['TYPE'];

//get the investigation id from investigation master

$admin = new admin();
$admin->insertUpdatePatientInvestigation($INVESTIGATION_NAME, $TYPE, $UNIT, $VALUE, $PATIENT_ID, $VISIT_ID );

//Draw Table
$result = mysql_query("select b.investigation_name, a.investigation_id,  b.unit, a.value, b.investigation_type
                            from patient_investigation a, investigation_master b
                            where a.investigation_id = b.ID 
                            and a.visit_id = '$VISIT_ID'
                            and a.patient_id = '$PATIENT_ID'" ) or die(mysql_error());



/*while($rs = mysql_fetch_array($result)) { 
        echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
        echo "<tr>";
        echo "<td width='240' height='23' align='left'>".$rs['investigation_name']." 
                <input type='hidden' name='investigation_id' value='". $rs['investigation_id']."'/></td>";
        echo "<td width='150' align='left'>".$rs['value']."</td>";
        echo "<td width='150' align='left'>".$rs['unit']."</td>";

        echo "<td width='150' align='left'>".$$rs['investigation_type'] ."</td>";
        echo "<td width='60' align='center'>
            <a id='minus7' href='#' onclick='deleteInvestigationRow(".$rs['investigation_id']."
                                        ,".$VISIT_ID .",".$PATIENT_ID.")'>[-]</a>" ;
        echo "</td>";
        echo "</tr>";
        echo "</table>"; 
} */
echo "<table>";
while($d = mysql_fetch_object($result)){
    
        echo "<tr>";
            echo "<td width='120'>".$d->investigation_name."</td>";
            echo "<td width='60'>".$d->value." ".$d->unit."</td>";
          
            echo "<td><a id='minus7' href='#' onclick='deletePatientInvestigation($d->investigation_id ,$VISIT_ID)'>[-]</a></td>"; 
            
            
        echo "</tr>";
   
}
 echo "</table>"; 

?>
