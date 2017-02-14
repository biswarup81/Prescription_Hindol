<?php ob_start() ?>
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
   function check(){
	if(document.form1.fname.value == ""){
		alert("Please Insert First Name.");
		return false;
	}else if(document.form1.lname.value == ""){
		alert("Please Insert Last Name Name.");
		return false;
	}else if(document.form1.cellnum.value == ""){
		alert("Please Insert Mobile Number.");
		return false;
	}else{
		return true;
	}
    }
    function checkSearch(){
	if(document.s_form.patient_id.value == "" && document.s_form.patient_name.value == ""){
		alert("Please Give some Input");
		return false;
	}
    }
    function search1(){
        //alert(document.getElementById("s_p_id").value);
        //alert(document.getElementById("s_p_name").value);
        if(document.getElementById("s_p_id").value == "" && document.getElementById("s_p_name").value == ""){
		alert("Please Give some Input");
		return false;
	} else {
            var patient_id = document.getElementById("s_p_id").value;
            var patient_name = document.getElementById("s_p_name").value;
            
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

                    xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("searchDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/searchPatient.php?mode=SEARCH_PATIENT&patient_id="+patient_id+"&patient_name="+patient_name;   
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
        }
        
    }
</script>
<script>

$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: "dd-mm-yy"
		});
	});

</script>


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
                <ul class="tabnav">
                    <li><a href="#tab2">Search Patient</a></li>
					<li><a href="#tab1">Add New Patient</a></li>
                </ul>
            
                <!--BEGIN tab2-->
                <div id="tab2" class="tabdiv">
                	
                    
                    
                    <!--BEGIN search-->
                    <div class="patientDetails">
                                      
                    	<span><p>Patient ID</p><input id="s_p_id" name="patient_id" type="text" class="input_box_add" value="" /></span>                
                    	<span><p>Patient Name</p><input id="s_p_name" name="patient_name" type="text" class="input_box_big" value="" /></span>               
                        <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="search1();" /></span>
                        
                    
                    </div>
                    <!--END of search-->
                    
                    <!--BEGIN search results-->
                    <div class="searchResults" id="searchDiv">
                    
                        <!--RESULT OF SEARCH -->

                    
                    </div>
                    <!--END of results-->
                    
                </div>
                <!--END of tab2-->
				
				<!--BEGIN tab1-->
                <div id="tab1" class="tabdiv">
                    
                   <!-- If Doctor-->
                   <?php if($_SESSION['user_type'] == 'DOCTOR'){ ?>
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
                    
                    <?php }  else if($_SESSION['user_type'] == 'RECEPTIONIST'){?>
                    
                    <form id="form1" name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return check()">
                    <?php
					if(isset($_POST['CREATE_PATIENT_DATA'])){
						include("inc/config.php");
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
						mysqli_query($con,$sql1) or die(mysqli_error());
						
						$id = mysql_insert_id();
						//$sql2 = "insert into visit (PATIENT_ID, VISIT_DATE, APPOINTMENT_TO_DOC_NAME) values('$id', NOW(), '')";
						//mysqli_query($con,$sql2) or die(mysqli_error());
						//$visit_id = mysql_insert_id();
						
						/*$sql3 = "insert into patient_health_details_by_receptionist (patient_id) values('$id')";
						mysqli_query($con,$sql3) or die(mysqli_error());*/
						
						echo "<div class='b_success'>$fname $lname data saved successfully<br><h2><a href='processData.php?patient_id=$id'>OK</a></h2></div>";
					}else{
					?>    
                    <!--BEGIN form-->
                    <div class="patientDetails">
                    
                    	<span><p>Gender</p>
                            <select name="gender" class="drop_box_small" style="width:80px;">
                                <option>Select</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </span>                    
                    	<span><p>First Name</p><input name="fname" type="text" class="input_box_big" value="" /></span>                
                    	<span><p>Last Name</p><input name="lname" type="text" class="input_box_big" value="" /></span>                
                    	<span><p>Date of Birth</p>
                            <input id="datepicker" name="theDate" type="text" class="input_box_add" value="DD-MM-YYYY" onfocus="myFocus(this);" onblur="myBlur(this);" /></span>                
                    	<span><p>Mobile No</p><input name="cellnum" type="text" class="input_box_add" value="" /></span>                
                    	<span><p>Landline No</p><input name="altcellnum" type="text" class="input_box_add" value="" /></span>                  
                    	<span><p>Street Address</p><textarea name="addr" cols="" rows=""></textarea></span>            
                    	                        
                    	<span><p>City / Town</p><input name="city" type="text" class="input_box_big" value="" /></span>                
                    	<span><p>Email Address</p><input name="email" type="text" class="input_box_big" value="" /></span>           
                    	<span><p>&nbsp;</p><input name="CREATE_PATIENT_DATA" id="MAKE" type="submit" class="btn" value="Add" /></span>
                    
                    </div>
                    <!--END of form-->
                    <?php }?>
                 </form>
                   <?php } ?>
                </div>
                <!--END of tab1-->
            
                <div align="center"><a href="visit_list.php">Click Here to go to VISIT LIST</a></div>
            
            </div>   
        </div>
    
    </div>
    <!--END of details-->
    
    <!--BEGIN footer-->
    <?php include("footer.php"); ?>
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