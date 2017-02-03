<?php

/*
 * THIS IS A COMMON AJAX PHP FILE WHICH IS CONTAINING ALL AJAX FUNCTIONS
 */


if(isset($_GET['mode'])) {
    $MODE = $_GET['mode'];

    //WHEN MODE IS ADD_CLINICAL_IMPRESSION

    if($MODE == 'ADD_CLINICAL_IMPRESSION') {
        include("add_clinical_impression.php");
        
    } 
    
    //WHEN MODE IS DELETE_CLINICAL_IMPRESSION
    else if($MODE == 'DELETE_CLINICAL_IMPRESSION') {
        include("delete_clinical_impression.php");
    }
    
    //WHEN MODE IS ADD_CF
    else if($MODE == 'ADD_CF') {
        include("add_cf.php");
    }
    //WHEN MODE IS DELETE_CF
    else if($MODE == 'DELETE_CF') {
        include("delete_cf.php");
    } 
    //WHEN MODE IS ADD_MEDICINDE
    else if($MODE == 'ADD_MEDICINDE'){
        include("livesearch.php");
    }
    //WHEN MODE IS DELETE_MEDICINE
    else if($MODE == 'DELETE_MEDICINE'){
        include("delete_precribed_medicine.php");
    }
    
    //WHEN MODE IS ADD_INVESTIGATION
     else if($MODE == 'ADD_INVESTIGATION'){
        include("inserintoinvmaster.php");
    } 
    //WHEN MODE IS REMOVE_VISIT
    else if($MODE == 'REMOVE_VISIT'){
        include("removevisit.php");
        //echo "removeisite";
    } 
    //WHEN MODE IS SEARCH_PATIENT
    else if($MODE == 'SEARCH_PATIENT'){
        include("searchPatient.php");
        //echo "removeisite";
    } 
    
}
?>
