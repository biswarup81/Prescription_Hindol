<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>:: Dr. Soumyabrata Roy Chaudhuri :: Enter Patient Details</title>
<meta name="robots" content="all">
<link rel="stylesheet" href="./images/style.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="inc/b.css" />
<link type="text/css" rel="stylesheet" href="inc/calender/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="inc/calender/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
#ad{
		padding-top:220px;
		padding-left:10px;
	}
</style>
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

function retreve(){
	var str = document.patient_id_search.patient_id.value;
	if(str == ""){
		alert("Please Give Patient Id");
		return false;
	}
	
	
}
</script>
</head>
<body>


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
                            <td class="blacktext" width="65" align="right" height="35">&nbsp;</td>
                            <td class="whitetext" width="60">&nbsp;</td>
                            <td class="blacktext" align="right">&nbsp;</td>
                            <td class="whitetext" width="200">&nbsp;</td>
                            <td class="blacktext" align="right">&nbsp;</td>
                            <td class="whitetext">&nbsp;</td>
                            <td class="blacktext" align="right">&nbsp;</td>
                            <td class="whitetext">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blacktext" align="right" height="35" valign="top">&nbsp;</td>
                            <td class="whitetext" colspan="7" valign="top" style="font-weight:normal;">&nbsp;</td>
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
                    <p style="color:#777;">Please Insert Patient ID and Go for Existing Members</p>
                    <?php
					if(isset($_POST['search'])){
						include("inc/config.php");
						$patient_id = $_POST['patient_id'];
						
						$sql = "select * from patient where patient_id = '$patient_id'";
						$result = query($sql);
						$no = mysql_num_rows($result);
						if($no > 0){
						$d = mysql_fetch_object($result);
						$rr = "<table border='0' cellspacing='10'>
	  <tr>
		<td><strong>Patient ID :</strong></td>
		<td>$patient_id</td>
	  </tr>
	  <tr>
		<td><strong>Name :</strong></td>
		<td>".ucwords($d->patient_first_name." ".$d->patient_last_name)."</td>
	  </tr>
	  <tr>
		<td><strong>Address :</strong></td>
		<td>$d->patient_address</td>
	  </tr>
	  <tr>
		<td><strong>City :</strong></td>
		<td>$d->patient_city</td>
	  </tr>
	  <tr>
		<td><strong>DOB :</strong></td>
		<td>$d->patient_dob</td>
	  </tr>
	  <tr>
		<td><strong>Mobile No :</strong></td>
		<td>$d->patient_cell_num</td>
	  </tr>
	  <tr>
		<td><strong>Mobile No (II) :</strong></td>
		<td>$d->patient_alt_cell_num</td>
	  </tr>
	  <tr>
		<td><strong>Patient Email :</strong></td>
		<td>$d->patient_email</td>
	  </tr>
	  <tr>
		<td><strong>Date :</strong></td>
		<td>".date('d/m/Y', strtotime($d->data_entry_date))."</td>
	  </tr>
	  
	</table>";
						}else{
						$rr = "<div class='b_falure'>No Result Found.</div>";
						}
					}
					?>
                    <!-- Form Starts -->
                    <div class="b_home_box">
                    <div class="b_s_form">
                     <form action="" method="post" onsubmit="return retreve()" name="patient_id_search">
                     	<span class="">Patient Id :</span> <input type="text" name="patient_id" class="input_small" />
                        <input type="submit" name="search" value="GO"  class="submit-btn" />
                     </form><div class="search_result"><?php if(!empty($rr)){ echo $rr;}?></div>
                     </div>
                     <div class="b_a_exist"><a href="index.php">New Member</a></div>
                    </div> 
                     
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