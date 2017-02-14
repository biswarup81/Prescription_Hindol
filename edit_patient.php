<?php
/* 
 * Edit Patient - Page to Edit Patient information
 */

include_once ('./include.php');
include ('./header.php');
include ('./datacon.php');

?>
<div class="content"><!-- content start -->
    <div class="wrapper"><!-- wrapper start -->
        <div class="content-box-frame"><!-- content-box-frame start -->
            
            <?php include './menu.php'; 
                $patientId = $_GET["patient_id_edit"];
                modify();
               
            ?>
            
        </div>
        
        
        <div class="content-box-frame"><!-- content-box-frame start -->
            <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING'] ?>" >
                
            <div><?php echo @$_SESSION['form1']['message'] ?></div>
            <input type="hidden" name="do" value="modify" />       
            <input type="hidden" name="patientId" value="<?php echo $patientId ?>"/>
                    <!--BEGIN form-->
                    <div class="patientDetails">
                    <?php 
                    
                    $sql1 = "select * from patient where patient_id = '".$patientId."'";
    
                    $result = mysqli_query($con,$sql1) or die(mysqli_error());
                    while( $rs = mysqli_fetch_array($result)){ ?>
                    	<span><p>Gender</p>
                            <select name="gender" value="<?php echo $rs['GENDER']?>" class="drop_box_small" style="width:80px;" >
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </span>                    
                    	<span><p>First Name</p><input name="fname" type="text" class="input_box_big" value="<?php echo $rs['patient_first_name']?>" /></span>                
                    	<span><p>Last Name</p><input name="lname" type="text" class="input_box_big" value="<?php echo $rs['patient_last_name']?>" /></span>                
                    	<span><p>Date of Birth</p>
                            <input id="datepicker1" name="theDate" 
                                   type="text" class="input_box_add" value="<?php echo date('d / m / Y', strtotime($rs['patient_dob'])) ;?>" 
                                   onfocus="myFocus(this);" onblur="myBlur(this);" /></span>                
                    	<span><p>Mobile No</p><input name="cellnum" type="text" class="input_box_add" value="<?php echo $rs['patient_cell_num']?>" /></span>                
                    	<span><p>Landline No</p><input name="altcellnum" type="text" class="input_box_add" value="<?php echo $rs['patient_alt_cell_num']?>" /></span>                  
                    	<span><p>Street Address</p><textarea name="addr" cols="30" rows="3"><?php echo $rs['patient_address']?></textarea></span>            
                    	                        
                    	<span><p>City / Town</p><input name="city" type="text" class="input_box_big" value="<?php echo $rs['patient_city']?>" /></span>                
                    	<span><p>Email Address</p><input name="email" type="text" class="input_box_big" value="<?php echo $rs['patient_email']?>" /></span>           
                    	<span><p>&nbsp;</p><input name="EDIT_PATIENT_DATA" id="EDIT" type="submit" class="btn" value="MODIFY" /></span>
                    
                    <?php }?>
                        <span><p>&nbsp;</p><a href="index.php">BACK</a></span>
                    </div>
                    <!--END of form-->
                    
                 </form>
            
        </div>
        
        
        
     </div><!-- wrapper end -->
</div><!-- content end -->



<?php

function modify(){
    $_SESSION['form1'] = array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['do'] == 'modify') {
  	// if the form has been submitted
        $gender = $_POST['gender'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = date("Y-m-d", strtotime($_POST['theDate']));
        $addr = $_POST['addr'];
        $city = $_POST['city'];
        //$dob =  $_POST['theDate'];

        $cellnum = $_POST['cellnum'];
        $altcellnum = $_POST['altcellnum'];
        $email = $_POST['email'];
        $patient_id = $_POST['patientId'];
        $sql1 = "UPDATE patient set GENDER = '$gender' , patient_first_name = '$fname' ,  	
                    patient_last_name = '$lname' , patient_address = '$addr' , 
                    patient_city = '$city' , patient_dob = '$dob' , patient_cell_num = '$cellnum' ,
                    patient_alt_cell_num = '$altcellnum' , patient_email = '$email' where patient_id = '".$patient_id."'";
        mysqli_query($con,$sql1) or die(mysqli_error());
        //echo $sql1;
        $_SESSION['form1']['message'] = "Updated Successfully";

        
    }
}

include_once './footer.php';

?>

