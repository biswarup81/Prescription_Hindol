<?php
 include "classes/admin_class.php"; 
 include "datacon.php";
 if(isset($_POST['DETAILS_SAVE'])){
     
 $update= new admin();
 
 //$patientid = $_POST['PATIENT_ID'];
 $visit_id2 = $_POST['vist_id'];
 $weight = $_POST['weight'];
 $height = $_POST['height'];
 
 /*$query = "select * from patient_health_details_master where NAME = 'BMI'";
 
 $rs = mysql_fetch_object(mysql_query($query));
 
 $bmi_id = $rs->ID;
 $query = "select * from patient_health_details_master where NAME = 'WEIGHT'";
 
 $rs = mysql_fetch_object(mysql_query($query));
 
 $weight_id = $rs->ID;
 $query = "select * from patient_health_details_master where NAME = 'HEIGHT'";
 
 $rs = mysql_fetch_object(mysql_query($query));
 
 $height_id = $rs->ID; */

/* $sql2 = "insert into visit (PATIENT_ID, VISIT_DATE, APPOINTMENT_TO_DOC_NAME) values('$patientid',NOW(),'')";

 mysql_query($sql2) or die(mysql_error());
  $id = mysql_insert_id();*/
  
    
 $bmi = $update->calcBMI($weight, $height);
 

 /*$sql="INSERT INTO PATIENT_HEALTH_DETAILS_BY_RECEPTIONIST 
            (patient_id ,VISIT_ID , BP_UP, BP_DOWN , HEIGHT_IN_CM , weight, 
            BMI, FBS , PPBS_PRE_BREAKFAST , PPBS_POST_BREAKFAST , PPBS_PRE_LUNCH , 
            PPBS_POST_LUNCH , PPBS_PRE_DINNER ,PPBS_POST_DINNER , TSH ,T3 ,T4 , OTHERS) 
        VALUES ('$patientid','$visit_id2','$_POST[bpup]','$_POST[bpdown]','$_POST[height]','$_POST[weight]','$bmi','$_POST[fbs]', '$_POST[fbs]','$_POST[ppbs_bf]', '$_POST[ppbs_prelunch]','$_POST[ppbs_postlunch]', '$_POST[ppbs_predinner]','$_POST[ppbs_postdinner]', '$_POST[tsh]','$_POST[t3]', '$_POST[t4]','$_POST[others]' )";
   */ 
 
 /*$query = "insert into patient_health_details(ID, VALUE, VISIT_ID) 
            values('2' , '$weight', '$visit_id2')";
 mysql_query($query);
 
 $query = "insert into patient_health_details(ID, VALUE, VISIT_ID) 
            values('1' , '$height', '$visit_id2')";
 mysql_query($query);
 
 $query = "insert into patient_health_details(ID, VALUE, VISIT_ID) 
            values('3' , '$bmi', '$visit_id2')";
 mysql_query($query);*/
 
 
 //mysql_query($sql) or die(mysql_error());

    header("location:visit_list.php");
/*echo $sql;
	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }else{
		  header("location:visit_list.php");
	  }*/
 } else {
     header("location:index.php");
 } 

 function calcBMI($weight, $height){
     $bmi = floor(($weight / ($height * $height)) * 10000);
     return $bmi;
 }
 
?>