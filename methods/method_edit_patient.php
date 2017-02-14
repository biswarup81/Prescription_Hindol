<?php

/* 
 * File to Edit patient Data
 */
$message=''; // Variable To Store Error Message
if(isset($_GET['patient_id_edit'])){
						
$patient_id = $_GET["patient_id_edit"];
$strPatientName = "";
$gender = "";




$sql1 = "select * from patient where patient_id = '". $patient_id. "'" ;
//echo $sql1;
$result1 = mysqli_query($con,$sql1)or die(mysqli_error());
    while($d1 = mysqli_fetch_array($result1)){
      $gender =   $d1['GENDER'];
      $fname = $d1['patient_first_name'];
      $lname = $d1['patient_last_name'];
      $dob = date('d / m / Y', strtotime($d1['patient_dob']));
        $addr = $d1['patient_address'];
        $city = $d1['patient_city'];

        $cellnum = $d1['patient_cell_num'];
        $altcellnum = $d1['patient_alt_cell_num'];
        $email = $d1['patient_email'];
     }
}  

    ?>
