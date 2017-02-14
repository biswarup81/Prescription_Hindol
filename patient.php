<?php

/* 
 * Display Patient Information
 */

$query = "SELECT a.patient_id, a.GENDER, a.patient_first_name, a.patient_last_name, a.patient_name,
a.patient_address, a.patient_city, a.patient_dob, a.patient_cell_num, a.patient_alt_cell_num, a.age,
a.patient_email, data_entry_date, b.VISIT_ID, b.PATIENT_ID, b.VISIT_DATE, 
b.APPOINTMENT_TO_DOC_NAME, b.VISITED
FROM patient a, visit b
WHERE b.PATIENT_ID = a.patient_id
AND a.patient_id = '$patient_id'";

$r1 = mysqli_query($con,$query) or die(mysqli_error());
        $d1 = mysqli_fetch_object($r1) ;
        
?>
<!-- Patient Area Starts -->
<div class="header-outsite">
     	<div class="wrapper"><!-- wrapper start -->
        	<div class="header-bottom">
            	<div class="left">
            	<p><strong><?php if($d1->patient_name == null || $d1->patient_name == ""){
                            echo $d1->patient_first_name." ".$d1->patient_last_name; } else { echo $d1->patient_name ; }?></strong>
                    <?php $update= new admin(); 
                        if($d1->age == 0){
                            print $update->calcAge1($d1->patient_dob, $d1->VISIT_DATE) ;
                        }else {
                            echo $d1->age;
                        } ?>, <?php echo $d1->patient_address . ", " . $d1->patient_city; ?> </p>
                <p><img src="images/call.png"  /><?php echo $d1->patient_cell_num; ?><!--<img class="message" src="images/message.png"  />biswarup_ghoshal@yahoo.co.in--></p>
                </div>
                <div class="right tr">
                <p class="font-arial"><strong>2-Feb-2015<br/ >ID # <?php echo $patient_id; ?>/<?php echo $visit_id; ?></strong></p>
                </div>
            </div>
        </div><!-- wrapper end -->
</div>
<!-- Patient area ends -->
