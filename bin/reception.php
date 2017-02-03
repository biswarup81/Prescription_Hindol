<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>:: Dr. Soumyabrata Roy Choudhuri :: Enter Patient Details</title>
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
$patient_id = "";
$fname = "";
$lname = "";
$result ="";
$sql = "";
$visit = "";
$visit_id = "";
$dob = "";
$age = "";
/* GET THE PATIENT DETAILS */
$result = mysql_query("SELECT * FROM patient where patient_first_name='$_POST[fname]' and patient_last_name = '$_POST[lname]' and patient_cell_num = '$_POST[cellnum]'");

if( mysql_num_rows($result) == 0 ){
	/* INSERT INTO PATIENT */
	$sql="INSERT INTO patient (patient_first_name, patient_last_name, patient_address, patient_city, patient_dob, patient_cell_num, patient_alt_cell_num, patient_email, data_entry_date) VALUES ('$_POST[fname]', '$_POST[lname]','$_POST[addr]','$_POST[city]','$_POST[dob]','$_POST[cellnum]','$_POST[altcellnum]','$_POST[email]', sysdate() )";

	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }

} 

$result = mysql_query("SELECT * FROM patient where patient_first_name='$_POST[fname]' and patient_last_name = '$_POST[lname]' and patient_cell_num = '$_POST[cellnum]'");

while($row = mysql_fetch_array($result))
  {
  $patient_id =  $row['patient_id'] ;
  $fname  = $row['patient_first_name'];
  $lname  = $row['patient_last_name'];
  $dob = $row['patient_dob'];

}




/*INSERT INTO VISIT TABLE */

$sql= "insert into VISIT(PATIENT_ID,VISIT_DATE,APPOINTMENT_TO_DOC_NAME) values
('$patient_id', sysdate() , 'Dr. Soumyabrata Roy Choudhuri' )";
if (!mysql_query($sql,$con))
{
  die('Error: ' . mysql_error());
}

/* GET VISIT NUMBER */
$result = mysql_query("SELECT count( patient_id ) FROM visit WHERE patient_id = '$patient_id' ");
while($row = mysql_fetch_array($result))
  {
  $visit =  $row['count( patient_id )'] ;
}

/* Get maximum visit number */
$result = mysql_query("SELECT max( visit_id ) FROM visit");
while($row = mysql_fetch_array($result))
  {
  $visit_id =  $row['max( visit_id )'] ;
}



$_SESSION['visit_id']=$visit_id;
$_SESSION['patient_id'] = $patient_id;

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
                            <li><a href="#"><span>Home</span></a></li>
                            <li class="active"><a href="reception.php"><span>Patient Details</span></a></li>
                            <li ><a href="prescription.php"><span>Presciption</span></a></li>																																
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
                            <td class="blacktext" width="65" align="right" height="35">Patient ID :&nbsp;</td>
                            <td class="whitetext" width="60"><?php echo $patient_id; ?></td>
                            <td class="blacktext" align="right">Patient Name :&nbsp;</td>
                            <td class="whitetext" width="200"><?php echo $fname . " " . $lname ; ?> </td>
                            <td class="blacktext" align="right">AGE</td>
                            <td class="whitetext"><?php echo calcAge( $dob) ; ?></td>
                            <td class="blacktext" align="right">Visit No :&nbsp;</td>
                            <td class="whitetext"><?php echo $visit ; ?></td>
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
                    <form id="form1" name="form1" method="post" action="visit_list.php">
					<input type="hidden" name = "patient_id" value = "<?php echo $patient_id; ?>" />
				<input type="hidden" name = "visit_id" value = "<?php echo $visit_id; ?>" />
                    <!-- Get In Touch Starts -->
                    <h3>Enter Patient Details</h3>
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="items">Height</td>
                        <td class="items_del"><input type="text" name="height" class="input_small"></td>
                      </tr>
                      <tr>
                        <td class="items">Weight</td>
                        <td class="items_del"><input type="text" name="weight" class="input_small"></td></td>
                      </tr>
                      <tr>
                        <td class="items">Basic Metabloc Index</td>
                        <td class="items_del"><input type="text" name="bmi" class="input_small"></td></td>
                      </tr>
					  <tr>
                        <td class="items">Blood Pressure - down</td>
                        <td class="items_del"><input type="text" name="bpdown" class="input_small"></td>
                      </tr>
                      <tr>
                        <td class="items">Blood Pressure - up</td>
                        <td class="items_del"><input type="text" name="bpup" class="input_small"></td></td>
                      </tr>
                      <tr>
                        <td class="items">Fasting Blood Sugar</td>
                        <td class="items_del"><input type="text" name="fbs" class="input_small"></td></td>
                      </tr>
                      <tr>
                        <td class="items">PP-Blood Sugar(Breakfast)</td>
                        <td class="items_del"><input type="text" name="ppbs_bf" class="input_small"></td></td>
                      </tr>
                      <tr>
                        <td class="items">PP-Blood Sugar(Pre-lunch)</td>
                        <td class="items_del"><input type="text" name="ppbs_prelunch" class="input_small"></td></td>
                      </tr>
                      <tr>
                        <td class="items">PP-Blood Sugar(Post-lunch)</td>
                        <td class="items_del"><input type="text" name="ppbs_postlunch" class="input_small"></td></td>
                      </tr>
                      <tr>
                        <td class="items">PP-Blood Sugar(Pre-dinner)</td>
                        <td class="items_del"><input type="text" name="ppbs_predinner" class="input_small"></td></td>
                      </tr>
                      <tr>
                        <td class="items">PP-Blood Sugar(Post-dinner)</td>
                        <td class="items_del"><input type="text" name="ppbs_postdinner" class="input_small"></td></td>
                      </tr>
                      <tr>
                        <td class="items">TSH</td>
                        <td class="items_del"><input type="text" name="tsh" class="input_small"></td>
                      </tr>
                      <tr>
                        <td class="items">T3</td>
                        <td class="items_del"><input type="text" name="t3" class="input_small"></td>
                      </tr>
                      <tr>
                        <td class="items">T4</td>
                        <td class="items_del"><input type="text" name="t4" class="input_small"></td>
                      </tr>
                       <tr>
                        <td class="items">Other Details</td>
                        <td class="items_del"><input type="text" name="others" class="input_small"></td>
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
        <p class="floatleft">&copy; 2012 Dr.Soumyabrata Roy Choudhuri. All Rights Reserved.</p>
        <p class="floatright"><a href="#">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;Designed by: <a href="#">PG Infoservices</a></p>
    <!-- Footer Links Ends -->
    </div>
<!-- Footer Ends -->
</div>
<!-- Wrapper Outer Ends -->

</body>
</html>