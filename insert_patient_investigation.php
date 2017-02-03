<?php
include("inc/config.php");
$PATIENT_ID = $_GET['PATIENT_ID'];
$VISIT_ID = $_GET['VISIT_ID'];
$INVESTIGATION_NAME = $_GET['INVESTIGATION_NAME'];
$VALUE = $_GET['VALUE'];
$UNIT = mysql_real_escape_string($_GET['UNIT']);
$TYPE = $_GET['TYPE'];

//get the investigation id from investigation master

$query_getinvestigation_details_from_master = "select * from investigation_master where  investigation_name  = '".$INVESTIGATION_NAME."'" ;

$result = mysql_query($query_getinvestigation_details_from_master) or die(mysql_error());
if (mysql_num_rows($result) > 0){
    //Investigation exists in Master. Only insert into patient_investigation table
    $rowresult = mysql_fetch_object($result) or die(mysql_error());
    //Get the investigation Id
    $inv_id = $rowresult->ID;
    //Update investigation_master with the updated value
    /*$query_update_into_investigation_master = "update investigation_master set investigation_type = '".$TYPE."', unit = '".$UNIT."'
                                                 where ID = '"+$inv_id+"'";
    
    mysql_query($query_update_into_investigation_master) or die(mysql_error());*/
    //update investigation master
    mysql_query("update investigation_master set  unit = '$UNIT' where ID ='$inv_id'" );

//INsert into patient_investigation
    $query_insert_into_patient_investigation = "insert into patient_investigation (patient_id, visit_id, investigation_id, value) 
                                            values ('".$PATIENT_ID."','".$VISIT_ID."','".$inv_id."','".$VALUE."')";
    mysql_query($query_insert_into_patient_investigation) or die(mysql_error());
} else {
    //Investigation does not exists in database
    //Insert into investigation_master 
    $query_insert_into_investigation_master = "insert into investigation_master (investigation_name , investigation_type, unit)
                                                values('".$INVESTIGATION_NAME."','".$TYPE."','".$UNIT."')";
    mysql_query($query_insert_into_investigation_master) or die(mysql_error());
    //Get the investigation Id
    $inv_id = mysql_insert_id() or die(mysql_error());
    
    //INsert into patient_investigation
    $query_insert_into_patient_investigation = "insert into patient_investigation (patient_id, visit_id, investigation_id, value) 
                                            values ('".$PATIENT_ID."','".$VISIT_ID."','".$inv_id."','".$VALUE."')";
    mysql_query($query_insert_into_patient_investigation) or die(mysql_error());

}

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

while($d = mysql_fetch_object($result)){
    echo "<table width='100%'>";
        echo "<tr>";
            echo "<td  width='240' height='23' align='left' >".$d->investigation_name."</td>";
            echo "<td width='150' align='left'>".$d->value."</td>";
            echo "<td width='150' align='left'>".$d->unit."</td>";
           // echo "<td width='150' align='left'>".$d->investigation_type."</td>";

            //echo "<td class='odd_tb'  align='center'><a href=''>Edit</a></td>";

            echo "<td width='150' align='center'>";
                //<input type='button'  onclick='deleteInvestigationRow($d->investigation_id ,$VISIT_ID, $PATIENT_ID )' class='delete' ></td>";
            
            echo "<a id='minus7' href='#' onclick='deleteInvestigationRow($d->investigation_id ,$VISIT_ID, $PATIENT_ID)'>[-]</a></td>"; 
            
            
        echo "</tr>";
    echo "</table>"; 
}

?>
