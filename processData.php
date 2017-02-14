<?php
include "datacon.php";

if(isset($_GET['patient_id'])){ 

$_SESSION['page']='processData';

$patient_id = $_GET['patient_id'];
$_SESSION['patient_id'] = $patient_id;

$result = mysqli_query($con,"select * from visit where patient_id = '$patient_id' and visited = 'no'");


                        
/** START : BLOCK FOR GENERATING VISIT ID   **/
if(mysqli_num_rows($result) > 0){
    //Visit exists. Get the visit id
    while($rows = mysqli_fetch_array($result)){
        $existing_visit_id = $rows['VISIT_ID'];
    }
    
    
} else {
    //No visit for the patient. So create a visit with respect to the patient id.    
    mysqli_query($con,"insert into visit (patient_id,VISIT_DATE ) values('".$patient_id."', NOW())") or die(mysqli_error());
    $existing_visit_id = mysql_insert_id();
}
/** END : BLOCK FOR GENERATING VISIT ID   **/
//Get the last visited record 
$result1 = mysqli_query($con,"select max(visit_id) as visit_id from visit where patient_id = '".$patient_id."' and visited = 'yes'" );


/** START : BLOCK FOR COPYING THE OLD INVESTIGATION REPORT FOR THE PATIENT **/


if(mysqli_num_rows($result1) > 0){
    //Already visited. So fetch the visit id (visited_id) for the last visit
    while($rows = mysqli_fetch_array($result1)){
        $visited_id = $rows['visit_id'];
    }
    
    //Populate patient investigation for old record.
    /** START INSERTING OLD PATIENT INVESTIGATION **/
    //INsert into patient_investigation
    
    $result2 = mysqli_query($con,"select * from patient_investigation where patient_id  = '".$patient_id."'and visit_id='".$visited_id."'");
    
    while($existingRows = mysqli_fetch_array($result2)){
        $inv_id = $existingRows['investigation_id'];
        $VALUE = $existingRows['value'];
        
        //Check if the record already exists or not
        $checkQuery = "select * from patient_investigation where patient_id = '".$patient_id."'
                        and visit_id = '".$existing_visit_id."' and investigation_id = '".$inv_id."'";
        $result = mysqli_query($con,$checkQuery);
        
        if(mysqli_num_rows($result) <= 0) {
        
            $query_insert_into_patient_investigation = "insert into patient_investigation (patient_id, visit_id, investigation_id, value) 
                                                    values ('".$patient_id."','".$existing_visit_id."','".$inv_id."','".$VALUE."')";

            mysqli_query($con,$query_insert_into_patient_investigation) or die(mysqli_error());
        }
    }
    /** END: INSERTING OLD PATIENT INVESTIGATION **/
    
    /** START INSERTING OLD PATIENT INVESTIGATION BY RECEPTIONIST **/
    //INsert into patient_health_details_by_receptionist
    
    $result3 = mysqli_query($con,"select * from patient_health_details where visit_id='".$visited_id."'");
    
    while($existingRows1 = mysqli_fetch_array($result3)){
    
        $id=$existingRows1['ID'] ;
        $value=$existingRows1['VALUE'];
        if($id == 1 || $id == 2){
            
            $checkQuery2 = "select * from patient_health_details where ID = '".$id."'
                        and VISIT_ID = '".$existing_visit_id."' ";
            $result4 = mysqli_query($con,$checkQuery);
            if(mysqli_num_rows($result4) <= 0) {
                $query_insert_into_patient_health_details = "insert into patient_health_details 
                            (ID, VALUE, VISIT_ID) values ('".$id."','".$value."','".$existing_visit_id."')";
                mysqli_query($con,$query_insert_into_patient_health_details) or die(mysqli_error());
            }
        }
               
    }
   
    /** END INSERTING OLD PATIENT INVESTIGATION BY RECEPTIONIST **/
    
} else {
   // There is no visited id. NO OPERATION TO BE PERFORMED
}
/** END : BLOCK FOR COPYING THE OLD INVESTIGATION REPORT FOR THE PATIENT **/

    //header("location:reception.php");
    header("location:visit_list.php");
}

?>
