<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once './include.php';
include './header.php';

include "classes/admin_class.php"; 

if(isset($_GET['VISIT_ID'])  && isset($_GET['patient_id']) && isset($_GET['PRESCRIPTION_ID']) ) {
    
//$user_type = $_SESSION['user_type'] == 'DOCTOR';

$patient_id = $_GET['patient_id'];
$visit_id = $_GET['VISIT_ID'];



$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
?>
<div class="content"><!-- content start -->
<div class="wrapper"><!-- wrapper start -->
<?php

include ('./methods/create_prescription.php');

$result = mysql_query("select * from prescription where PRESCRIPTION_ID = '$PRESCRIPTION_ID' and VISIT_ID = '$visit_id'");
$status = 'DRAFT';
if(mysql_num_rows($result) > 0){
    while($rs = mysql_fetch_array($result)){
        $status = $rs['STATUS'];
    }
}

if($status == 'DRAFT'){ ?>
    <div class="content-box-frame"><!-- content-box-frame start -->
            <?php include './menu.php'; ?>
        </div>
<?php } else { ?>

<?php }

include './patient.php'; 

?>





<form id="makePrescriptionForm" type="actionForm" action="" method="POST">
    <input type="hidden" name="PRESCRIPTION_ID" value="$PRESCRIPTION_ID" />
    <input type="hidden" name="VISIT_ID" value="$visit_id" />
    <input type="hidden" name="PATIENT_ID" value="$patient_id" />
    
        <div class="content-box-frame">
            <div class="error" style="display:none;">
                    <img src="images/warning.gif" alt="Warning!" width="24" height="24" style="float:left; margin: -5px 10px 0px 0px;">
                    <span></span>.
                    <br clear="all">
            </div>
        </div>
    	<div class="content-box-frame"><!-- content-box-frame start -->
            <div class="content-box"><!-- content-box start -->
            	<div class="title">Symptoms</div>
                <div class="clear"></div>
                <?php include './symptoms.php'; ?>
            </div><!-- content-box end -->
                        
            <div class="content-box"><!-- content-box start -->
            	<div class="title">Examination Findings</div>
                <div class="clear"></div>
                <?php include './examination_findings.php'; ?>
            </div><!-- content-box end -->
            
            <div class="clear"></div>
            
            <div class="content-box"><!-- content-box start -->
            	<div class="title">Patient Health</div>
                <div class="clear"></div> 
                <?php include './patient_health.php'; ?>
            </div><!-- content-box end -->
            
            <div class="content-box"><!-- content-box start -->
            	<div class="title">Medicine</div>
                <div class="clear"></div>
                <?php include './medicine.php' ?>
            </div><!-- content-box end -->
            
            <div class="clear"></div>
            
            <div class="content-box"><!-- content-box start -->
            	<div class="title">Social History/Occupation/Allergy</div>
                <div class="clear"></div>
                <?php include './social_history.php' ?>
            </div><!-- content-box end -->
            
            
            
            <div class="content-box"><!-- content-box start -->
            	<div class="title">Prescribed Investigation</div>
                <div class="clear"></div>
                <?php include './prescribed_investigation.php'; ?>
            </div><!-- content-box end -->
            
            <div class="clear"></div>
            
            <div class="content-box"><!-- content-box start -->
            	<div class="title">Treatment History</div>
                <div class="clear"></div>
                <?php include './treatment_history.php' ?>
            </div><!-- content-box end -->
            
            <div class="content-box"><!-- content-box start -->
            	<div class="title">General Advice</div>
                <div class="clear"></div>
                <?php include './general_advice.php' ?>
            </div><!-- content-box end -->
            
            <div class="clear"></div>
            
            
            
            <div class="content-box"><!-- content-box start -->
                <div class="title">LMP</div>
                <div class="clear"></div>
                <?php include './lmp.php' ?>
            </div><!-- content-box end -->
            
            <div class="clear"></div>
            
            <div class="signature"><!-- content-box start -->
                <p>Dr. H. Dasgupta</p>
            </div><!-- content-box end -->
            </div><!-- content-box-frame end -->
			<br/>
            <?php if($status == 'SAVE'){ ?>
                
                <div class="content-box-frame">
                <a href="visit_list.php" onclick="return func_print();">PRINT PRESCRIPTION</a>
            </div>
<?php } else {
?>
            <div class="content-box-frame">
                <input type="submit" value="MAKE PRESCRIPTION" name="MAKE_PRESCRIPTION"/>
            </div>
<?php } ?>
        
        </form>
</div><!-- wrapper end -->
</div><!-- content end -->

<?php
}
include_once './footer.php';

?>

