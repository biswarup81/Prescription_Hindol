<?php
include "datacon.php";
$patient_id = $_GET['patient_id'];

$VISIT_ID = $_GET['VISIT_ID'];

// Get Prescription ID from VISIT_ID
$query2 = "select * from prescription where VISIT_ID = '".$VISIT_ID."' and STATUS = 'DRAFT'";
$result = mysqli_query($con,$query2) or die(mysqli_error());

if(mysqli_num_rows($result) > 0){
    while($rows = mysqli_fetch_array($result)){
        $PRESCRIPTION_ID = $rows['PRESCRIPTION_ID'];
    }
} else {
    mysqli_query($con,"insert into prescription(VISIT_ID, REFERRED_TO, DIET, NEXT_VISIT, ANY_OTHER_DETAILS) values('".$VISIT_ID."', '','', '', '')") or die(mysqli_error());
    $PRESCRIPTION_ID = mysql_insert_id();
    
    //Create Prescription with existing Clinical Expression of the patient
  //  $query_select_clinical_impression = "select * from prescribed_cf where  prescription_id in (
    //                                select prescription_id  from prescription where visit_id in (
      //                                  select max(visit_id)  from visit where patient_id = '$patient_id' and visited='yes'))";
    
	 $query_select_clinical_impression = "SELECT *
                                                FROM prescribed_cf
                                                WHERE prescription_id = (
                                                SELECT prescription_id
                                                FROM prescription
                                                WHERE visit_id = (
                                                SELECT max( visit_id )
                                                FROM visit
                                                WHERE patient_id = '$patient_id'
                                                AND visited = 'yes' ) ) " ;

    $r3 = mysqli_query($con,$query_select_clinical_impression) or die(mysqli_error());
    while($row = mysqli_fetch_array($r3)) {
        mysqli_query($con,"insert into prescribed_cf (clinical_impression_id 	, prescription_id) 
                    values('".$row['clinical_impression_id']."','".$PRESCRIPTION_ID."')");
    }

    //Create Prescription with existing records of a patient
    $query_pres_history = "select * from precribed_medicine 
                                where  prescription_id = (
                                    select prescription_id  from prescription where visit_id = (
                                        select max(visit_id)  from visit where patient_id = '$patient_id' and visited='yes'))";

    $r3 = mysqli_query($con,$query_pres_history) or die(mysqli_error());
    while($row = mysqli_fetch_array($r3)) {
        mysqli_query($con,"insert into precribed_medicine (PRESCRIPTION_ID, MEDICINE_NAME, MEDICINE_DIRECTION, MEDICINE_DOSE, MEDICINE_TIMING) 
                    values('".$PRESCRIPTION_ID."','".$row['MEDICINE_NAME']."', '".$row['MEDICINE_DIRECTION']."', '".$row['MEDICINE_DOSE']."', '".$row['MEDICINE_TIMING']."')");
    }
}





header("location:prescription2.php?VISIT_ID=$VISIT_ID&patient_id=$patient_id&PRESCRIPTION_ID=$PRESCRIPTION_ID");

?>