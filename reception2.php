<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>:: Dr. Soumyabrata Roy Chaudhuri :: Enter Patient Details</title>
<meta name="robots" content="all">
<link rel="stylesheet" href="./images/style.css" type="text/css" media="screen">
<script language="javascript">         
	function addRow(tableID) {     
		alert(tableID);
		var table = document.getElementById(tableID);               
		var rowCount = table.rows.length;         
		var row = table.insertRow(rowCount);     
		var colCount = table.rows[0].cells.length;        
		for(var i=0; i<colCount; i++) {         
			var newcell = row.insertCell(i);      
			newcell.innerHTML = table.rows[1].cells[i].innerHTML;
			
			row.className = "odd_tb";   
			//row.className = "even_tb";      
			//alert(newcell.childNodes);               
			switch(newcell.childNodes[0].type) {       
				case "text":                         
					newcell.childNodes[0].value = "";    
				break;                    
				case "checkbox":                           
					newcell.childNodes[0].checked = false;                          
				break;                    
				case "select-one":                            
					newcell.childNodes[0].selectedIndex = 0;       
				break; 
				
				               
			}           
		}            
	} 
	
	

	function deleteRow(tableID) {             
		try {             
			var table = document.getElementById(tableID);             
			var rowCount = table.rows.length;               
			for(var i=0; i<rowCount; i++) {                 
				var row = table.rows[i];                 
				var chkbox = row.cells[0].childNodes[0];                 
				if(null != chkbox && true == chkbox.checked) {                     
					table.deleteRow(i);                     
					rowCount--;                     
					i--;                 
				}               
			}             
		}catch(e) {                 
			alert(e);             
		}         
	}       


	function calcAge(dob){
		
		var DoB  = new Date(dob);
		var DoC    = new Date();
		var mSecDiff   = DoC - DoB;
		var AgeDays  = mSecDiff / 86400000;
		
		var AgeYears = AgeDays / 365.24;    
		AgeYears = Math.floor(AgeYears);
		var AgeMonth  = (AgeDays - AgeYears * 365.24) / 30.4375;
		AgeMonth = Math.floor(AgeMonth);
		var AgeDays = (AgeDays - AgeYears * 365.24 - AgeMonth * 30.4375) ;
		AgeDays = Math.floor(AgeDays);
	 
	 /*
		var AgeDays  = Math.round(AgeDays * 10) / 10;
		var AgeWeeks = Math.round(AgeWeeks * 10) / 10;
		var AgeMonth = Math.round(AgeMonth * 10) / 10;
		
	 */
		return AgeYears +" yrs "+AgeMonth+" months "+AgeDays+" days";
	}
</script>
</head>
<body>

<?php 
include "datacon.php";
$patient_id = $_GET['patient_id'];

// For show the Visit No on the top right.
$r2 = mysql_query("select * from visit where PATIENT_ID = '$patient_id'") or die(mysql_error());
$n2 = mysql_num_rows($r2);

// For check if the row is exist or not in the below table
$sql0 = "select * from patient_health_details_by_receptionist where patient_id = '$patient_id'";
$r0 = mysql_query($sql0) or die(mysql_error());
$n0 = mysql_num_rows($r0);
if($n0 < 1){
	$d2 = mysql_fetch_array($r2) or die(mysql_error());
	mysql_query("insert into patient_health_details_by_receptionist (patient_id, VISIT_ID) values('$patient_id','$d2[VISIT_ID]')");
}

$sql1 = mysql_query("select * from patient where patient_id = '$patient_id'") or die(mysql_error());
$d1 = mysql_fetch_object($sql1) or die(mysql_error());


$sql2 = "select * from patient_health_details_by_receptionist where patient_id = '$patient_id' order by VISIT_ID desc limit 0,1";

$result2 = mysql_query($sql2) or die(mysql_error());
$d2 = mysql_fetch_object($result2) or die(mysql_error());



// For get the visit Id 
$sql3 = "select * from patient_health_details_by_receptionist where patient_id='$patient_id' order by VISIT_ID desc limit 0,1";
$r3 = mysql_query($sql3) or die(mysql_error());
$d3 = mysql_fetch_array($r3) or die(mysql_error());
$visit_id = $d3['VISIT_ID']+1;


mysql_close($con);
?>

<?php
	//calculate years of age (input string: YYYY-MM-DD)
  function calcAge ($birthday){

	 $birth = strtotime($birthday);

	$age_in_seconds = time() - $birth;
	$AgeYears = floor($age_in_seconds / 31536000); // 31536000 seconds in year
	$AgeMonth  = floor(($age_in_seconds  - $AgeYears * 31536000) / 2628000); // 2628000 seconds in a month
	$AgeDays = floor(($age_in_seconds - $AgeYears * 31536000 - $AgeMonth * 2628000)/ 86400) ; //86400 seconds in a day
 
  
		
	$result = $AgeYears . " years " . $AgeMonth . " months " . $AgeDays . " days";
    
    return $result;
  }


?>

<!-- Weapper Outer Starts -->
<div id="wrapper-outer">
    <!-- Wrapper Starts -->
    <div id="wrapper">
        <!-- Wrapper Inner Starts -->
        <div id="wrapper-inner">
            <!-- Header Wrap Starts -->
            <div id="header-wrap">
                <!-- Header Starts -->
                <div id="header" class="clearfix">
                    <!-- Logo Starts -->
                    <div id="logo"><img src="images/logo.jpg" width="138" height="17" /></div>
                    <!-- Logo Ends -->
                    <!-- Menu Starts -->
                    <div id="menu">
                        <!-- Menu Item Starts -->
                        <ul>
                            <li><a href="index.php"><span>Home</span></a></li>
                            <li><a href="visit_list.php"><span>Patient List</span></a></li>
                            <li ><a href="#"><span>Presciption</span></a></li>		
                            <li ><a href="search.php"><span>Search</span></a></li>																														
                        </ul>
                    <!-- Menu Item Ends -->
                    </div>
                <!-- Menu Ends -->
                </div>
            <!-- Header Ends -->
            
            <!-- Slider Wrap Starts -->
            <div id="slider-wrap">
				
                <table width="920" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="images/image.jpg" style="padding-right:10px;"></td>
                    <td valign="top">                
                        <table width="820" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="blacktext" width="65" align="right" height="35">Patient ID : &nbsp;</td>
                            <td class="whitetext" width="60"><?php echo $d1->patient_id ?></td>
                            <td class="blacktext" align="right">Patient Name :&nbsp;</td>
                            <td class="whitetext" width="200"><?php echo $d1->patient_first_name." ".$d1->patient_last_name; ?></td>
                            <td class="blacktext" align="right">Date / Time :&nbsp;</td>
                            <td class="whitetext"><?php echo date("d M Y h:i A", strtotime($d1->data_entry_date)); ?><!--12th Feb, 2012 14:45 Hrs--></td>
                            <td class="blacktext" align="right">Visit No :&nbsp;</td>
                            <td class="whitetext"><?php echo $n2; ?></td>
                          </tr>
                          <tr>
                            <td class="blacktext" align="right" height="35" valign="top">Others :&nbsp;</td>
                            <td class="whitetext" colspan="7" valign="top" style="font-weight:normal;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</td>
                          </tr>
                        </table>                    </td>
                  </tr>
                </table>
            </div>
            <!-- Slider Wrap Ends -->
            
            </div>                
            <!-- Header Wrap Ends -->
            
            <!-- Container Starts -->
            <div id="container" class="clearfix">
            
                <!-- Mainarea Starts -->
                <div id="mainarea">
                    <h2>Rx</h2>
                    <p style="color:#777;">Please Patient details and save</p>
                    
                    <!-- Form Starts -->
                    <form id="form1" name="form1" method="post" action="details_save.php">
					<input type="hidden" name = "patient_id" value = "<?php echo $patient_id; ?>" />
				<input type="hidden" name = "visit_id" value = "<?php echo $visit_id; ?>" />
                    <!-- Get In Touch Starts -->
                    <h3>Enter Patient Details</h3>
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="items">Height</td>
                        <td class="items_del"><input type="text" name="height" class="input_box_small" value="<?php echo $d2->HEIGHT_IN_CM;?>"></td>
                      </tr>
                      <tr>
                        <td class="items">Weight</td>
                        <td class="items_del"><input type="text" name="weight" class="input_box_small" value="<?php echo $d2->weight;?>"></td></td>
                      </tr>
                      <tr>
                        <td class="items">Basic Metabloc Index</td>
                        <td class="items_del"><input type="text" name="bmi" class="input_box_small" value="<?php echo $d2->BMI;?>"></td></td>
                      </tr>
					  <tr>
                        <td class="items">Blood Pressure - down</td>
                        <td class="items_del"><input type="text" name="bpdown" class="input_box_small" value="<?php echo $d2->BP_DOWN;?>"></td>
                      </tr>
                      <tr>
                        <td class="items">Blood Pressure - up</td>
                        <td class="items_del"><input type="text" name="bpup" class="input_box_small" value="<?php echo $d2->BP_UP;?>"></td></td>
                      </tr>
                      <tr>
                        <td class="items">Fasting Blood Sugar</td>
                        <td class="items_del"><input type="text" name="fbs" class="input_box_small" value="<?php echo $d2->FBS;?>"></td></td>
                      </tr>
                      <tr>
                        <td class="items">PP-Blood Sugar(Breakfast)</td>
                        <td class="items_del"><input type="text" name="ppbs_bf" class="input_box_small" value="<?php //echo $d2->;?>"></td></td>
                      </tr>
                      <tr>
                        <td class="items">PP-Blood Sugar(Pre-lunch)</td>
                        <td class="items_del"><input type="text" name="ppbs_prelunch" class="input_box_small" value="<?php echo $d2->PPBS_PRE_LUNCH;?>"></td></td>
                      </tr>
                      <tr>
                        <td class="items">PP-Blood Sugar(Post-lunch)</td>
                        <td class="items_del"><input type="text" name="ppbs_postlunch" class="input_box_small" value="<?php echo $d2->PPBS_POST_LUNCH;?>"></td></td>
                      </tr>
                      <tr>
                        <td class="items">PP-Blood Sugar(Pre-dinner)</td>
                        <td class="items_del"><input type="text" name="ppbs_predinner" class="input_box_small" value="<?php echo $d2->PPBS_PRE_DINNER;?>"></td></td>
                      </tr>
                      <tr>
                        <td class="items">PP-Blood Sugar(Post-dinner)</td>
                        <td class="items_del"><input type="text" name="ppbs_postdinner" class="input_box_small" value="<?php echo $d2->PPBS_POST_DINNER;?>"></td></td>
                      </tr>
                      <tr>
                        <td class="items">TSH</td>
                        <td class="items_del"><input type="text" name="tsh" class="input_box_small" value="<?php echo $d2->TSH;?>"></td>
                      </tr>
                      <tr>
                        <td class="items">T3</td>
                        <td class="items_del"><input type="text" name="t3" class="input_box_small" value="<?php echo $d2->T3;?>"></td>
                      </tr>
                      <tr>
                        <td class="items">T4</td>
                        <td class="items_del"><input type="text" name="t4" class="input_box_small" value="<?php echo $d2->T4;?>"></td>
                      </tr>
                       <tr>
                        <td class="items">Other Details</td>
                        <td class="items_del"><input type="text" name="others" class="input_box_small" value="<?php echo $d2->OTHERS;?>"></td>
                      </tr>
                    </table>
                    <table width="720" border="0" cellspacing="0" cellpadding="0">
                      
                      <tr>
                      	<td class="bg_tble2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td><img src="images/blank.gif" width="1" height="10" /></td>
                      </tr>
                      <tr>
                        <td class="errors">All medicines to continue uninterruptedly unless stopped or mentioned till next visit. Patient made aware of Hypoglycemia.</td>
                      </tr>
                      <tr>
                        <td align="center" height="50" valign="bottom"><input name="input" type="reset" value="Reset" class="submit-btn" />&nbsp;
                        <input type="submit" name="MAKE PRESCIPTION" id="MAKE" value="Save"  class="submit-btn"/>
                        <input type="hidden" id="hiddenstr" name="inputXML" value=""/></td>
                      </tr>
                    </table>
                                                
                    </form> 								    
                    <!-- Form Ends --> 
                </div>
                <!-- Mainarea Ends -->
            
                <!-- Sidearea Starts -->
                <div id="sidearea">
                    

                <!-- Get In Touch Ends -->					
                </div>
            <!-- Sidearea Ends -->
            </div>
        <!-- Container Ends -->			
        </div>
    <!-- Wrapper Inner Ends -->
    </div>
    <!-- Wrapper Ends -->
    
    <!-- Footer Starts -->
    <div id="footer">
        <!-- Footer Links Starts -->
        <p class="floatleft">&copy; 2012 Dr. Soumyabrata Roy Chaudhuri. All Rights Reserved.</p>
        <p class="floatright"><a href="#">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;Designed by: <a href="#">PG Infoservices</a></p>
    <!-- Footer Links Ends -->
    </div>
<!-- Footer Ends -->
</div>
<!-- Wrapper Outer Ends -->

</body>
</html>