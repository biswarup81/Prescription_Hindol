<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$message=''; // Variable To Store Error Message
if(isset($_POST['CREATE_PATIENT_DATA'])){
						
    $gender = $_POST['gender'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $addr = $_POST['addr'];
    $city = $_POST['city'];
    //$dob =  $_POST['theDate'];

    $cellnum = $_POST['cellnum'];
    $altcellnum = $_POST['altcellnum'];
    $email = $_POST['email'];
    $dob = date("Y-m-d", strtotime($_POST['theDate']));

    $sql1 = "insert into patient (GENDER,patient_first_name, 	
            patient_last_name, patient_address, patient_city, patient_dob, patient_cell_num,
            patient_alt_cell_num, patient_email, data_entry_date) 
            values('$gender','$fname', '$lname', '$addr', '$city', '$dob' ,'$cellnum', '$altcellnum', '$email', NOW())";
    mysql_query($sql1) or die(mysql_error());

    $id = mysql_insert_id();
    //$sql2 = "insert into visit (PATIENT_ID, VISIT_DATE, APPOINTMENT_TO_DOC_NAME) values('$id', NOW(), '')";
    //mysql_query($sql2) or die(mysql_error());
    //$visit_id = mysql_insert_id();

    /*$sql3 = "insert into patient_health_details_by_receptionist (patient_id) values('$id')";
    mysql_query($sql3) or die(mysql_error());*/
    $message = $fname . ' ' .$lname .' inserted successfully';
    //echo "<div class='b_success'>$fname $lname data saved successfully<br><h2><a href='processData.php?patient_id=$id'>OK</a></h2></div>";
}