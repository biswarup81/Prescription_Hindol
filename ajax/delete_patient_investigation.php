<?php
include "../datacon.php";
include '../classes/admin_class.php';
$admin = new admin();
$INVESTIGATION_ID = $_GET['INVESTIGATION_ID'];
$VISIT_ID = $_GET['VISIT_ID'];
//$PATIENT_ID = $_GET['PATIENT_ID'];

$admin->deletePatientInvestigation($INVESTIGATION_ID,$VISIT_ID );

$result = mysql_query("select b.investigation_name, a.investigation_id,  b.unit, a.value, b.investigation_type
                            from patient_investigation a, investigation_master b
                            where a.investigation_id = b.ID 
                            and a.visit_id = '$VISIT_ID'" );

while($d = mysql_fetch_object($result)){
    echo "<table width='100%'>";
        echo "<tr>";
            echo "<td  width='120' >".$d->investigation_name."</td>";
            echo "<td width='60' >".$d->value." ".$d->unit."</td>";
           
            //echo "<td width='150' align='left'>".$d->investigation_type."</td>";

            //echo "<td class='odd_tb'  align='center'><a href=''>Edit</a></td>";

            echo "<td>";
             //   <input type='button'  onclick='deleteInvestigationRow($d->investigation_id ,$VISIT_ID, $PATIENT_ID )' class='delete' ></td>";
            echo "<a id='minus7' href='#' onclick='deletePatientInvestigation($VISIT_ID,$d->investigation_id)'>[-]</a></td>"; 

        echo "</tr>";
    echo "</table>"; 
}

/*

$visit = $admin->getVisitFromId($VISIT_ID);
$patient_id = $visit->PATIENT_ID;

$result = "";
//CLINICAL IMPRESSION STARTED
$result=$result."<div class='block' style='width: 245px;'>
<div class='headings'><img src='images/Briefcase-Medical.png' />&nbsp;Clinical Impressions</div>
<div class='inner' style='width: 240px;'>

    <table>
        <tr><td id='CI' width='100%'>";
$prescription = $admin->getPrescriptionFromVisitId($VISIT_ID);
$PRESCRIPTION_ID = $prescription->PRESCRIPTION_ID;
$result=$result. '<table>';
       $q15 = "SELECT b.type, b.ID
                        FROM prescribed_cf a, clinical_impression b
                        WHERE a.clinical_impression_id = b.id
                        AND a.prescription_id = '$PRESCRIPTION_ID'";
        $rsd1 = mysql_query($q15) or die(mysql_error());

        while($rs = mysql_fetch_array($rsd1)) {
            $type = $rs['type'];
            $cf_d = $rs['ID'];
            $result=$result. "<tr><td style='width: 180px;'>".$type."<a id='minus7' href='#' ></a></td>".
                "<td><a id='minus7' href='#' onclick='deleteClinicalImpression($cf_d,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

        }         
        
$result=$result.'</table>';
$result=$result."</td>
            </tr>
            <tr>
                <td width='100%'><input style='width: 180px;' class='input_box_big' type='text' id='txtCI'/>

                </td>
                <td>
                    <a id='plus7' href='#' onclick='addClinicalImpression('$PRESCRIPTION_ID')'>[+]</a>
                </td> 
            </tr>
    </table>
    </div>
</div>";
//CLINICAL IMPRESSION ENDS

//INVESTIGATION DONE - STARTED
$result0 = mysql_query("select b.investigation_name, a.investigation_id,  b.unit, a.value, b.investigation_type
                            from patient_investigation a, investigation_master b
                            where a.investigation_id = b.ID 
                            and a.visit_id = '$VISIT_ID'" ) or die(mysql_error());
$result="<div class='block1' style='margin-right:12px; margin-left:12px;'>
    <div class='headings'><img src='images/Briefcase-Medical.png' />&nbsp;Investigation Done</div>
    <div class='inner1'>
    <table>    

        <tr><td id='INV' width='100%' colspan='3'>";
if(mysql_num_rows($result0) > 0 ){
    while($d = mysql_fetch_object($result0)){
        $result=$result. "<table width='100%'>";
            $result=$result. "<tr>";
                $result=$result. "<td  width='120' >".$d->investigation_name."</td>";
                $result=$result. "<td width='60' >".$d->value." ".$d->unit."</td>";

                //echo "<td width='150' align='left'>".$d->investigation_type."</td>";

                //echo "<td class='odd_tb'  align='center'><a href=''>Edit</a></td>";

                $result=$result. "<td>";
                //   <input type='button'  onclick='deleteInvestigationRow($d->investigation_id ,$VISIT_ID, $PATIENT_ID )' class='delete' ></td>";
                $result=$result. "<a id='minus7' href='#' onclick='deletePatientInvestigation($VISIT_ID,$d->investigation_id)'>[-]</a></td>"; 

            $result=$result. "</tr>";
        $result=$result. "</table>"; 
    }
}
$result=$result. "</td>
        </tr> 
        <tr>
            <td width='100%'><input style='width: 120px;' class='input_box_small' type='text' id='investigation'/>
                <td width='100%'><input class='input_box_small' type='text' id='txtPatientInvval'/>
                
                <td>
                    <a id='plus7' href='#' onclick='addPatientInvestigation('$patient_id','$VISIT_ID')'>[+]</a>
                </td> 
       
        </tr>

    </table>

    </div>   

</div>";
//INVESTIGATION DONE - ENDS

//CF STARTED
$result=$result. "<div class='block1'>
    <div class='headings'><img src='images/Briefcase-Medical.png' />&nbsp;C/F </div>
    <div class='inner1'>
        <table>
            <tr><td id='CF' width='100%'>";

$q15 = "select a.VALUE, b.NAME, a.ID from
                                PATIENT_HEALTH_DETAILS a ,patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '$VISIT_ID'";
$rsd1 = mysql_query($q15) or die(mysql_error());
while($rs = mysql_fetch_array($rsd1)) {
    $name = $rs['NAME'];
    $value = $rs['VALUE'];
    $id = $rs['ID'];

    $result=$result."<table>";

    $result=$result."<tr>";

    $result=$result. "<td width='100%' >$name</td>";
    $result=$result. "<td width='100%' ><input type='text'  class='input_box_small' 
        id='CF_".$id."' style='width: 40px;' value='".$value."' />
            <a id='minus7' href='#' ></a></td>";

    $updatestr = 'UPDATE';

    $result=$result."<td><input type='button' class='update_row' onclick='updateDeleteCF($id,$VISIT_ID,$updatestr)'/>";
    $result=$result."</td>";
        
    $result=$result."</tr>";

    $result=$result. "</table>";
}
$result=$result."</td>
            </tr>
            <tr><td width='100%'>
                    <table>
                        <tr>
                                <td >
                                        <input style='width: 140px;' class='input_box_small' type='text' id='txtCFName'/>
                                </td>
                                <td>
                                        <input style='width: 40px;' class='input_box_small' type='text' id='txtCFValue'/>
                                </td>	
                                <td>
                                    <input type='button' class='delete_row' onclick='addCF('".$VISIT_ID."')'/>
                                </td> 
                        </tr>
                    </table>
                </td>
            </tr>
    </table>



    </div>";
//CF ENDS

echo $result; */
?>