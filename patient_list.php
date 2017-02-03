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


	
</script>
</head>
<body>

<?php include "datacon.php";
$height = "";
$weight = "";
$bmi = "";
$bpup = "";
$bpdown = "";
$fbs ="";
$ppbs_bf = "";
$ppbs_prelunch = "";
$ppbs_postlunch = "";
$ppbs_predinner = "";
$ppbs_postdinner = "";
$tsh = "";
$t3 = "";
$t4 = "";
$others = "";



	/* INSERT INTO PATIENT */
	//$sql="INSERT INTO PATIENT_HEALTH_DETAILS_BY_RECEPTIONIST (patient_id ,VISIT_ID , BP_UP, BP_DOWN , HEIGHT_IN_CM , weight, BMI, FBS , PPBS_PRE_BREAKFAST , PPBS_POST_BREAKFAST , PPBS_PRE_LUNCH , PPBS_POST_LUNCH , PPBS_PRE_DINNER ,PPBS_POST_DINNER , TSH ,T3 ,T4 , OTHERS) VALUES ('$_POST[patient_id]','$_POST[visit_id]','$_POST[bpup]','$_POST[bpdown]','$_POST[height]','$_POST[weight]','$_POST[bmi]','$_POST[fbs]', '$_POST[fbs]','$_POST[ppbs_bf]', '$_POST[ppbs_prelunch]','$_POST[ppbs_postlunch]', '$_POST[ppbs_predinner]','$_POST[ppbs_postdinner]', '$_POST[tsh]','$_POST[t3]', '$_POST[t4]','$_POST[others]' )";

	/*if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }*/

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
                            <li class="active"><a href="visit_list.php"><span>Patient Details</span></a></li>
                            <li ><a href="#"><span>Presciption</span></a></li>																																
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
                    <td valign="top"> </td>
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
                    <p style="color:#777;">Patient List</p>
                    
                    <!-- Form Starts -->
                    <form id="form1" name="form1" method="post" action="result.php">
                    <!-- Get In Touch Starts -->
                    <h3>Patient List</h3>
                   	<table width="720" border="0" cellspacing="1" cellpadding="1" id="datatable">
                          <tr>
                            <td class="head_tbl" width="207">Patient Name</td>
                            <td class="head_tbl" align="center" width="149">Cell Number</td>
                            <td class="head_tbl" align="center" width="150">BOOKING DATE</td>
                            <td class="head_tbl" align="center" width="150">BOOKING TIME</td>
                            
                          </tr>
					<?php
						$result = mysql_query("select * from  patient  order by data_entry_date desc");

						while($row = mysql_fetch_array($result))
						  {
					?>
                          <tr>
                            <td class="blacktext"><a href="prescription2.php?patient_id=<?php echo $row['patient_id']?>"><?php echo $row['patient_first_name'] . " " . $row['patient_last_name']  ; ?></a></td>
                            <td class="blacktext"><?php echo  $row['patient_cell_num']; ?></td>
                            <td class="blacktext" align="center"><?php echo  date("d / m / Y", strtotime($row['data_entry_date'])); ?></td>
                            <td class="blacktext" align="center"><?php echo  date("h:i", strtotime($row['data_entry_date'])); ?></td>
                          </tr>
					<?php 
						}
						mysql_close($con);
					?>
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