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
function check(){
	if(document.s_form.patient_id.value == "" && document.s_form.patient_name.value == ""){
		alert("Please Give some Input");
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
                            <li><a href="index.php"><span>Home</span></a></li>
                            <li><a href="visit_list.php"><span>Patient List</span></a></li>
                            <li ><a href="#"><span>Presciption</span></a></li>	
                            <li  class="active"><a href="search.php"><span>Search</span></a></li>																																
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
                    <!--<h2>Rx</h2>
                    <p style="color:#777;">Please Patient details and save</p>-->
                    <!-- Form Starts -->
                     <form action="" method="post" style="margin-top:25px;" onsubmit="return check()" name="s_form">
                     	<table border="0" cellspacing="12" cellpadding="12">
                          <tr>
                            <td>Patient Id</td>
                            <td><input type="text" name="patient_id" class="input_small" /></td>
                            <td>Patient Name</td>
                            <td><input type="text" name="patient_name" class="input_small" /></td>
                            <td><input type="submit" value="Search" name="search" class="submit-btn" /></td>
                          </tr>
                        </table>

                     </form>
                    <?php
					if(isset($_POST['search'])){
						include("inc/config.php");
						
						$where = "";
						if($_POST['patient_id'] != ""){
							$patient_id = $_POST['patient_id'];
							$where .= "and patient_id = '$patient_id'";
						}
						if($_POST['patient_name'] != ""){
							$patient_name = $_POST['patient_name'];
							$where .= "and patient_first_name like '$patient_name%'";
						}
						
						
						$patient_id = $_POST['patient_id'];
						
						echo "<table border='1' cellpadding='5' width='500' align='center'><tr><th>Name</th><th> Address </th><th> Mobile No. </th><th> Date Added </th></tr>";
						//$sql1 = "select * from patient where patient_id = '$patient_id'";
						$sql1 = "select * from patient where patient_id != ''".$where;
						$result1 = mysql_query($sql1) or die(mysql_error());
						$no = mysql_num_rows($result1);
						if($no > 0){
						
					while($d1 = mysql_fetch_object($result1)){
						echo "<tr><td><a href='reception.php?patient_id=$d1->patient_id'>".$d1->patient_first_name." ".$d1->patient_last_name."</a></td><td>".$d1->patient_address."</td>
								<td>".$d1->patient_cell_num."</td><td>".date('d / m / Y', strtotime($d1->data_entry_date))."</td></tr>";
					}
						}else{
							echo "<tr><td colspan='4' align='center' style='color:red'> No Result found.</td></tr>";
						}
						echo "</table>";
					}
					?>								    
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