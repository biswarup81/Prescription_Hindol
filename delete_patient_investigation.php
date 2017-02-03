<?php

include("inc/config.php");
$INVESTIGATION_ID = $_GET['INVESTIGATION_ID'];
$VISIT_ID = $_GET['VISIT_ID'];
$PATIENT_ID = $_GET['PATIENT_ID'];

mysql_query("delete from patient_investigation 
             where investigation_id = '$INVESTIGATION_ID' 
             and visit_id ='$VISIT_ID' 
             and patient_id = '$PATIENT_ID'") or die(mysql_error());

$result = mysql_query("select b.investigation_name, a.investigation_id,  b.unit, a.value, b.investigation_type
                            from patient_investigation a, investigation_master b
                            where a.investigation_id = b.ID 
                            and a.visit_id = '$VISIT_ID'
                            and a.patient_id = '$PATIENT_ID'" );

while($d = mysql_fetch_object($result)){
    echo "<table width='100%'>";
        echo "<tr>";
            echo "<td  width='240' height='23' align='left' >".$d->investigation_name."</td>";
            echo "<td width='150' align='left'>".$d->value."</td>";
            echo "<td width='150' align='left'>".$d->unit."</td>";
            //echo "<td width='150' align='left'>".$d->investigation_type."</td>";

            //echo "<td class='odd_tb'  align='center'><a href=''>Edit</a></td>";

            echo "<td width='150' align='center'>";
             //   <input type='button'  onclick='deleteInvestigationRow($d->investigation_id ,$VISIT_ID, $PATIENT_ID )' class='delete' ></td>";
            echo "<a id='minus7' href='#' onclick='deleteInvestigationRow($d->investigation_id ,$VISIT_ID, $PATIENT_ID)'>[-]</a></td>"; 

        echo "</tr>";
    echo "</table>"; 
}

//Draw the Table
/*
while($rs = mysql_fetch_array($result)) { 
        echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
        echo "<tr>";
        echo "<td width='240' height='23' align='left'>".$rs['investigation_name']." 
                <input type='hidden' name='investigation_id' value='". $rs['investigation_id']."'/></td>";
        echo "<td width='150' align='left'>".$rs['value']."</td>";
        echo "<td width='150' align='left'>".$rs['unit']."</td>";

        echo "<td width='150' align='left'>".$rs['investigation_type'] ."</td>";
        echo "<td width='60' align='center'>
            <a id='minus7' href='#' onclick='deleteInvestigationRow(".$rs['investigation_id']."
                                        ,".$VISIT_ID .",".$PATIENT_ID.")'>[-]</a>" ;
        echo "</td>";
        echo "</tr>";
        echo "</table>"; 
} */

?>
