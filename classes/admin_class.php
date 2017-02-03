<?php

class admin{
    function calcAge ($birthday){

	 $birth = strtotime($birthday);

	$age_in_seconds = time() - $birth;
	$AgeYears = floor($age_in_seconds / 31536000); // 31536000 seconds in year
	$AgeMonth  = floor(($age_in_seconds  - $AgeYears * 31536000) / 2628000); // 2628000 seconds in a month
	$AgeDays = floor(($age_in_seconds - $AgeYears * 31536000 - $AgeMonth * 2628000)/ 86400) ; //86400 seconds in a day
		
	//$result = $AgeYears . " years " . $AgeMonth . " months " . $AgeDays . " days";
        $result = $AgeYears . " Y " . $AgeMonth . " M ";
    
    return $result;
    }
    
    function calcAge1 ($birthday, $visitday){

	 $birth = strtotime($birthday);
         $visit = strtotime($visitday);

	$age_in_seconds = $visit - $birth;
	$AgeYears = floor($age_in_seconds / 31536000); // 31536000 seconds in year
	$AgeMonth  = floor(($age_in_seconds  - $AgeYears * 31536000) / 2628000); // 2628000 seconds in a month
	$AgeDays = floor(($age_in_seconds - $AgeYears * 31536000 - $AgeMonth * 2628000)/ 86400) ; //86400 seconds in a day
        
        if($AgeMonth > 6){
            $AgeYears = $AgeYears + 1;
        }
  
		
	//$result = $AgeYears . " years " . $AgeMonth . " months " . $AgeDays . " days";
        //$result = $AgeYears . " Y " . $AgeMonth . " M ";
        $result = $AgeYears . " Y ";
        return $result;
    }
    
    function calcBMI($weight, $height){
        $bmi = floor(($weight / ($height * $height)) * 10000);
        return $bmi;
    }
    function calcEGFR($sex, $cr, $age){
        $k = 0;
        if($sex == 'Male'){
            $k = 1.210;
        } else {
            $k = 0.742 ;
        }
        $eGFR = floor($k * 186 * pow($cr, -1.154) * pow($age,-0.203));
        return $eGFR;
    }
    function deriveClinicalImpressionFromEGFR($eGFR){
        $cf = "";
        if($eGFR >= 90 ){
            $cf = "CKD-1";
        } else if($eGFR < 90 && $eGFR >= 60 ){
            $cf = "CKD-2";
        }else if($eGFR < 60 && $eGFR >= 30 ){
            $cf = "CKD-3";
        }else if($eGFR < 30 && $eGFR >= 15 ){
            $cf = "CKD-4";
        }else if($eGFR < 15 ){
            $cf = "CKD-5";
        }
        return $cf;
    }
    
    function insertUpdatePatientInvestigation($investigation_name, $type, $unit, $value, $patient_id, $visit_id ){
        $admin = new admin();
        if(strtoupper($investigation_name) == "CREATININE" ){
            $patient = $admin->getPatientDetailsPatientId($patient_id);
            $age = $admin->calcAge($patient->patient_dob);
            $sex = $patient->GENDER;
            $cr = $value;
            $eGFR = $admin->calcEGFR($sex, $cr, $age);
            //INSERT $eGFR in C/F
            $admin->insertUpdateCF("eGFR", $eGFR, $visit_id);
            $clinicalImpression = $admin->deriveClinicalImpressionFromEGFR($eGFR);
            
            //GET PRESCRIPTION ID FROM VISIT ID
            $prescription = $admin->getPrescriptionFromVisitId($visit_id);
            $prescription_id = $prescription->PRESCRIPTION_ID;
            $admin->insertUpdateClinicalImpression($prescription_id, $clinicalImpression);
        }
        
        $query_getinvestigation_details_from_master = "select * from investigation_master where  investigation_name  = '".$investigation_name."'" ;

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
            mysql_query("update investigation_master set  unit = '$unit' where ID ='$inv_id'" );

        //INsert into patient_investigation
            $query_insert_into_patient_investigation = "insert into patient_investigation (patient_id, visit_id, investigation_id, value) 
                                                    values ('".$patient_id."','".$visit_id."','".$inv_id."','".$value."')";
            mysql_query($query_insert_into_patient_investigation) or die(mysql_error());
        } else {
            //Investigation does not exists in database
            //Insert into investigation_master 
            $query_insert_into_investigation_master = "insert into investigation_master (investigation_name , investigation_type, unit)
                                                        values('".$investigation_name."','".$type."','".$unit."')";
            mysql_query($query_insert_into_investigation_master) or die(mysql_error());
            //Get the investigation Id
            $inv_id = mysql_insert_id() or die(mysql_error());

            //INsert into patient_investigation
            $query_insert_into_patient_investigation = "insert into patient_investigation (patient_id, visit_id, investigation_id, value) 
                                                    values ('".$patient_id."','".$visit_id."','".$inv_id."','".$value."')";
            mysql_query($query_insert_into_patient_investigation) or die(mysql_error());

        }
    }
    function insertUpdateSocialHistory($prescription_id, $type){
        
        $query = "select ID from social_history_master where TYPE = '$type'";
        $result = mysql_query($query);
        $id = "";
        if(mysql_num_rows($result) > 0){
            //Clinical Impression Type exists in the Database. Get the ID
            while($rs = mysql_fetch_array($result)){
                $id = $rs['ID'];
            }
        } else {
            //Insert into master and then add
            $query = "insert into social_history_master (TYPE, DESCRIPTION) values('$type','$type')";
            mysql_query($query) or die(mysql_error());
            $id = mysql_insert_id();
        }
        $query = "insert into prescribed_social_history(social_history_id, prescription_id) 
                    values('$id' , '$prescription_id')";
        mysql_query($query) or die(mysql_error());
    }
    function deletePatientInvestigation($investigation_id,$visit_id ){
        
        mysql_query("delete from patient_investigation 
                    where investigation_id = '$investigation_id' 
                    and visit_id ='$visit_id' ") or die(mysql_error());
        
        
        $admin = new admin();
        //get prescription id
        $prescription = $admin->getPrescriptionFromVisitId($visit_id);
        $prescription_id = $prescription->PRESCRIPTION_ID;
        
        //get investigation
        $investigation = $admin->getInvestigationFromId($investigation_id);
        $investigation_name = $investigation->investigation_name;
        
       
                
         if(strtoupper($investigation_name) == "CREATININE" ){
            //Delete from clinical impression
             //get ci_id
            $_QUERY12 = "SELECT *
                FROM prescribed_cf
                WHERE clinical_impression_id
                IN (

                SELECT ID
                FROM clinical_impression
                WHERE TYPE IN (
                'CKD-1', 'CKD-2', 'CKD-3', 'CKD-4', 'CKD-5'
                )
                ) and prescription_id = '".$prescription_id."' ";
            
            $result12 = mysql_query($_QUERY12)or die(mysql_error());
            $ci_id = "";
            if(mysql_num_rows($result12) > 0){
                while($rs12 = mysql_fetch_array($result12)){
                    $ci_id = $rs12['clinical_impression_id'];
                }
            }
            
            $admin->deleteClinicalImpression($prescription_id, $ci_id);
            //Delete from Health Details (CF)
            //Get Id from NAME from patient_health_details_master
            $healthDetails = $admin->getHealthDetailsbyName("eGFR");
            $id = $healthDetails->ID;
            $admin->deleteCF("DELETE", $id, $visit_id, "BLANK");
            
        }
        
        

    }
    function getHealthDetailsbyName($name){
        $_QUERY = "select * from patient_health_details_master where NAME = '".$name."'";
        //echo $_QUERY;
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function deleteCF($mode, $cf_id, $visit_id, $cfvalue){
        $result = "";
        $admin = new admin();
        if($mode == 'UPDATE'){
    
            mysql_query("update patient_health_details 
                        set VALUE = '$cfvalue' where VISIT_ID = '$visit_id' 
                        and ID  ='$cf_id' ") or die(mysql_error());
                if (mysql_affected_rows() > 0){
                    $result =  "<tr><td colspan='3'>". mysql_affected_rows() ." item(s) updated</td></tr>";
                }

            } else if($mode == 'DELETE'){
                mysql_query("delete from patient_health_details 
                        where VISIT_ID = '$visit_id' 
                        and ID  ='$cf_id' ") or die(mysql_error());
                if (mysql_affected_rows() > 0){
                    $result =  "<tr><td colspan='3'>". mysql_affected_rows() ." item(s) deleted</td></tr>";
                }
            }

        if($cf_id == '1' || $cf_id = '2'){
            //Modify BMI
            $result1 = mysql_query("select a.VALUE from patient_health_details a 
                    where a.ID = '1' and a.VISIT_ID = '$visit_id'") or die(mysql_error());

            if(mysql_num_rows($result1) > 0){
                $obj = mysql_fetch_object($result1);
                $height = $obj->VALUE;
            }
            $result2 = mysql_query("select a.VALUE from patient_health_details a 
                    where a.ID = '2' and a.VISIT_ID = '$visit_id'") or die(mysql_error());

            if(mysql_num_rows($result2) > 0){
                $obj = mysql_fetch_object($result2);
                $weight = $obj->VALUE;
            }

            if($height != "" && $weight != ""){
                $bmi = $admin->calcBMI($weight, $height);

                $result_id_f = mysql_query("select * from patient_health_details where ID = '3'") or die(mysql_error());
                if(mysql_num_rows($result_id_f) > 0 ){
                    $query_b = "update patient_health_details set VALUE = '$bmi' where ID ='3' and VISIT_ID = '".$visit_id."'";
                } else {
                $query_b = "insert into patient_health_details(ID, VALUE, VISIT_ID) 
                        values('3' , '$bmi', '$visit_id')";
                }
                mysql_query($query_b) or die(mysql_error());
            }
        }
        return $result;
    }
    function getPatientDetailsPatientId($patientId){
        $_QUERY = "select * from patient where patient_id = '".$patientId."'";
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getInvestigationFromId($investigation_id){
        $_QUERY = "select * from investigation_master where ID = '".$investigation_id."'";
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getClinicalImpressionfromName($ci_name){
        $_QUERY = "select * from clinical_impression where TYPE = '".$ci_name."'";
        //echo $_QUERY;
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function insertUpdateCF($cfname,$cfvalue,$visit_id){
        
        $admin = new admin();
        $query = "select ID from patient_health_details_master where NAME = '$cfname'";


        $result = mysql_query($query);
        $id = "";
        $height = "";
        $weight = "";
        $bmi = "";
        if(mysql_num_rows($result) > 0){
            //Clinical Impression Type exists in the Database. Get the ID
            while($rs = mysql_fetch_array($result)){
                $id = $rs['ID'];
            }
        } else {
            //Insert into master and then add
            $query = "insert into patient_health_details_master (NAME) values('$cfname')";
            mysql_query($query);
            $id = mysql_insert_id();
        }
        $query = "insert into patient_health_details(ID, VALUE, VISIT_ID) 
                    values('$id' , '$cfvalue', '$visit_id')";
        mysql_query($query);

        $result1 = mysql_query("select a.VALUE from patient_health_details a 
                where a.ID = '1' and a.VISIT_ID = '$visit_id'") or die(mysql_error());

        if(mysql_num_rows($result1) > 0){
            $obj = mysql_fetch_object($result1);
            $height = $obj->VALUE;
        }
        $result2 = mysql_query("select a.VALUE from patient_health_details a 
                where a.ID = '2' and a.VISIT_ID = '$visit_id'") or die(mysql_error());

        if(mysql_num_rows($result2) > 0){
            $obj = mysql_fetch_object($result2);
            $weight = $obj->VALUE;
        }

        if($height != "" && $weight != ""){
            $bmi = $admin->calcBMI($weight, $height);
            $result_id_f = mysql_query("select * from patient_health_details where 
                ID = '3' and VISIT_ID = '$visit_id'") or die(mysql_error());
            if(mysql_num_rows($result_id_f) > 0 ){
                $query_b = "update patient_health_details set VALUE = '$bmi' where 
                ID ='3' and VISIT_ID = '".$visit_id."'";
            } else {
            $query_b = "insert into patient_health_details(ID, VALUE, VISIT_ID) 
                    values('3' , '$bmi', '$visit_id')";
            }
            mysql_query($query_b) or die(mysql_error());
        }
        
    }
    
    function insertUpdateClinicalImpression($prescription_id, $type){
        
        $query = "select ID from clinical_impression where TYPE = '$type'";
        $result = mysql_query($query);
        $id = "";
        if(mysql_num_rows($result) > 0){
            //Clinical Impression Type exists in the Database. Get the ID
            while($rs = mysql_fetch_array($result)){
                $id = $rs['ID'];
            }
        } else {
            //Insert into master and then add
            $query = "insert into clinical_impression (TYPE, DESCRIPTION) values('$type','$type')";
            mysql_query($query) or die(mysql_error());
            $id = mysql_insert_id();
        }
        $query = "insert into prescribed_cf(clinical_impression_id, prescription_id) 
                    values('$id' , '$prescription_id')";
        mysql_query($query) or die(mysql_error());
    }
    
    function insertUpdatepastMedicalHistory($prescription_id, $type){
        
        $query = "select ID from past_medical_history_master where TYPE = '$type'";
        $result = mysql_query($query);
        $id = "";
        if(mysql_num_rows($result) > 0){
            //Clinical Impression Type exists in the Database. Get the ID
            while($rs = mysql_fetch_array($result)){
                $id = $rs['ID'];
            }
        } else {
            //Insert into master and then add
            $query = "insert into past_medical_history_master (TYPE, DESCRIPTION) values('$type','$type')";
            mysql_query($query) or die(mysql_error());
            $id = mysql_insert_id();
        }
        $query = "insert into prescribed_past_med_history(clinical_impression_id, prescription_id) 
                    values('$id' , '$prescription_id')";
        mysql_query($query) or die(mysql_error());
    }
    
    function deleteClinicalImpression($prescription_id,$ci_id){
        //$message = "";
        mysql_query("delete from prescribed_cf 
             where prescription_id = '$prescription_id' 
             and clinical_impression_id  ='$ci_id' ") or die(mysql_error());
        
        
    }
	
	function deletePastMedicalHistory($prescription_id,$ci_id){
        //$message = "";
        mysql_query("delete from prescribed_past_med_history 
             where prescription_id = '$prescription_id' 
             and clinical_impression_id  ='$ci_id' ") or die(mysql_error());
        
        
    }
    function getPrescriptionFromVisitId($visitid){
        $_QUERY="select * from prescription where VISIT_ID = '".$visitid."'";
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getClinicalImpressionFromId($ci_id){
        $_QUERY="select * from clinical_impression where ID = '".$ci_id."'";
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getVisitFromId($visit_id){
        $_QUERY="select * from visit where VISIT_ID  = '".$visit_id."'";
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
}
?>
