<?php

/*
 * This method creates prescription
 */
$message = ''; // Variable To Store Error Message
if (isset($_POST['MAKE_PRESCRIPTION'])) {

    $lmp = $_POST['lmp'];
    $other_comment = $_POST['other_comment'];
    $PRESCRIPTION_ID = $_POST['PRESCRIPTION_ID'];

    $VISIT_ID = $_POST['VISIT_ID'];
    $PATIENT_ID = $_POST['PATIENT_ID'];
    //$dob =  $_POST['theDate'];

    $lmp2 = date("Y-m-d", strtotime($_POST['lmp']));

    $result = mysqli_query($con,"select * from lmp where PRESCRIPTION_ID='$PRESCRIPTION_ID' and VISIT_ID='$VISIT_ID' and PATIENT_ID='$PATIENT_ID' ");
    if (mysqli_num_rows($result) > 0) {
        //UPDATE
        mysqli_query($con,"update lmp set LMP_DATE='$lmp2' where PRESCRIPTION_ID='$PRESCRIPTION_ID' and VISIT_ID='$VISIT_ID' and PATIENT_ID='$PATIENT_ID' ");
    } else {
        //insert
        mysqli_query($con,"insert into lmp (PRESCRIPTION_ID, VISIT_ID, PATIENT_ID, LMP_DATE) values ('$PRESCRIPTION_ID','$VISIT_ID','$PATIENT_ID','$lmp2') ");
    }


    mysqli_query($con,"update prescription set VISIT_ID = '$VISIT_ID', STATUS ='SAVE', "
                    . "ANY_OTHER_DETAILS='$other_comment' where PRESCRIPTION_ID = '$PRESCRIPTION_ID' and STATUS='DRAFT'") or die(mysqli_error());



    $id = mysql_insert_id();
    $message = "Prescripotion has been made successfully";

    mysqli_query($con,"update visit set VISITED = 'yes' where VISIT_ID = '" . $VISIT_ID . "'") or die(mysqli_error());

    //echo "<div class='b_success'>$fname $lname data saved successfully<br><h2><a href='processData.php?patient_id=$id'>OK</a></h2></div>";
}