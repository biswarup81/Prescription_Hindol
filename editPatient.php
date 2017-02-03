<?php include "header.html"; ?>  
<script type="text/javascript">
   function myFocus(element) {
     if (element.value == element.defaultValue) {
       element.value = '';
     }
   }
   function myBlur(element) {
     if (element.value == '') {
       element.value = element.defaultValue;
     }
   }
$(function() {
		$( "#datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: "dd-mm-yy"
		});
	});

</script>

<?php 
include "datacon.php"; 

if(isset($_SESSION['user_type'])) {
if($_SESSION['user_type'] == 'DOCTOR' || $_SESSION['user_type'] == 'RECEPTIONIST'){
   $patientId = $_GET['patient_id'];
    
   modify();
   
?>
    <body>
        <div id="wrapper">
	<div class="container">
            <?php include("banner.php"); ?>
        <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING'] ?>" >
                
            <div><?php echo @$_SESSION['form1']['message'] ?></div>
            <input type="hidden" name="do" value="modify" />       
            <input type="hidden" name="patientId" value="<?php echo $patientId ?>"/>
                    <!--BEGIN form-->
                    <div class="patientDetails">
                    <?php 
                    
                    $sql1 = "select * from patient where patient_id = '".$patientId."'";
    
                    $result = mysql_query($sql1) or die(mysql_error());
                    while( $rs = mysql_fetch_array($result)){ ?>
                    	<span><p>Gender</p>
                            <select name="gender" value="<?php echo $rs['GENDER']?>" class="drop_box_small" style="width:80px;" >
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </span>                    
                    	<span><p>First Name</p><input name="fname" type="text" class="input_box_big" value="<?php echo $rs['patient_first_name']?>" /></span>                
                    	<span><p>Last Name</p><input name="lname" type="text" class="input_box_big" value="<?php echo $rs['patient_last_name']?>" /></span>                
                    	<span><p>Date of Birth</p>
                            <input id="datepicker1" name="theDate" type="text" class="input_box_add" value="<?php echo $rs['patient_dob']?>" onfocus="myFocus(this);" onblur="myBlur(this);" /></span>                
                    	<span><p>Mobile No</p><input name="cellnum" type="text" class="input_box_add" value="<?php echo $rs['patient_cell_num']?>" /></span>                
                    	<span><p>Landline No</p><input name="altcellnum" type="text" class="input_box_add" value="<?php echo $rs['patient_alt_cell_num']?>" /></span>                  
                    	<span><p>Street Address</p><textarea name="addr" cols="" rows=""><?php echo $rs['patient_address']?></textarea></span>            
                    	                        
                    	<span><p>City / Town</p><input name="city" type="text" class="input_box_big" value="<?php echo $rs['patient_city']?>" /></span>                
                    	<span><p>Email Address</p><input name="email" type="text" class="input_box_big" value="" /></span>           
                    	<span><p>&nbsp;</p><input name="EDIT_PATIENT_DATA" id="EDIT" type="submit" class="btn" value="MODIFY" /></span>
                    
                    <?php }?>
                        <span><p>&nbsp;</p><a href="index.php">BACK</a></span>
                    </div>
                    <!--END of form-->
                    
                 </form>
        
        <!--BEGIN footer-->
            <?php include("footer.php"); ?>
        <!--END of footer right-->
            
    </div>
        </div>
        </div>
   <?php } }else {
    header("location:visit_list.php");
} ?>     
    </body>
</html>
 
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
        mysql_query($sql1) or die(mysql_error());
        //echo $sql1;
        $_SESSION['form1']['message'] = "Updated Successfully";

        
    }
}

?>

