<?php ob_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prescription :: Dr. Soumyabrata Roy Chaudhuri ::</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="jquery/themes/base/jquery.ui.all.css">
<script src="jquery/jquery-1.7.2.js"></script>
<script src="jquery/ui/jquery.ui.core.js"></script>
<script src="jquery/ui/jquery.ui.widget.js"></script>
<script src="jquery/ui/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="jquery/demos/demos.css">

<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script tyepe="text/javascript" src ="js/makeprescription.js"></script>


</head>
    
<body>
    
<!--BEGIN wrapper-->
<?php 
include "datacon.php";
if(isset($_SESSION['user_type'])) {
/*if($_SESSION['user_type'] == 'DOCTOR'){
    header("location:visit_list.php");
} else if($_SESSION['user_type'] == 'RECEPTIONIST'){*/
?>

<div id="wrapper">
	<div class="container">
    <!--BEGIN header-->
    <?php include("banner.php"); ?>
    <!--END of header-->
    
    <!--BEGIN details-->
    <div class="invest">    
    	<div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Patient Details</div>
        <div class="invest_inner">        
        
            <div id="tabvanilla" class="widget">            		
				<!--BEGIN tab1-->
                <div id="tab1" class="tabdiv">
                    
                    
                   
                    <!--BEGIN form-->
                    <div class="patientDetails">
                        <form action="./ajax/add_patient.php" method="GET">
                    	<span><p>Gender</p>
                            <select type="text" name="sex" id="sex">
                            <option value="0">--SELECT--</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            
                        </select>
                        </span>                    
                    	<span><p>Name</p><input type="text" name="patient_name" id="patient_name" ></input></span>                
                    	<!--<span><p>Last Name</p><input name="lname" type="text" class="input_box_big" value="" /></span>-->                
                    	<!--<span><p>Date of Birth</p>
                            <input id="datepicker" name="theDate" type="text" class="input_box_add" value="DD-MM-YYYY" onfocus="myFocus(this);" onblur="myBlur(this);" /></span> -->               
                    	<span><p>Age</p><input type="text" name="age" id="age"></input></span>   
                        <span><p>Mobile No</p><input type="text" name="cell" id="cell"></input></span>                
                    	<!--<span><p>Landline No</p><input name="altcellnum" type="text" class="input_box_add" value="" /></span>-->                  
                    	<!--<span><p>Address</p><textarea name="addr" id ="address" cols="" rows=""></textarea></span>-->
                    	                        
                    	<!--<span><p>City / Town</p><input name="city" type="text" class="input_box_big" value="" /></span>        -->        
                    	<!--<span><p>Email Address</p><input name="email" type="text" class="input_box_big" value="" /></span>           -->
                    	<span><p>&nbsp;</p>
                            
                        <input name="ADD" id="ADD_PATIENT" type="submit" class="btn" value="ADD" onclick="addPatient()"/></span>
                    
                        </form>
                    </div>
                    <!--END of form-->
                    
                 
                   
                </div>
                <!--END of tab1-->
            
                <div align="center"><a href="visit_list.php">Click Here to go to VISIT LIST</a></div>
            
            </div>   
        </div>
    
    </div>
    <!--END of details-->
    
    <!--BEGIN footer-->
    <div class="footer">
    	
        <!--BEGIN footer left-->
        <div class="f_left">
        &copy; 2012 <b>Prescription</b>
        </div>
        <!--END of footer left-->
    	
        <!--BEGIN footer right-->
        <div class="f_right">
        Developed by : <b>P.G.Infoservices</b>
        </div>
        <!--END of footer right-->
            
    </div>
    <!--END of footer-->
    
	</div>
</div>
<!--END of wrapper-->
<?php } /*}*/ else {
     header("location:index_login.php");
}
?>
</body>
</html>
<?php ob_flush() ?>