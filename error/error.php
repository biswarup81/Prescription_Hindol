<?php ob_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prescription :: Dr.Soumyabrata Roy Choudhuri ::</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" scr="../js/makeprescription.js" ></script>


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
                
            
                <!--BEGIN tab2-->
                <div id="tab2" class="tabdiv">
                	
                    
                    
                    <!--BEGIN search-->
                    <div class="patientDetails">
                                      
                    	Error Occured
                    </div>
                    <!--END of search-->
                    
                    
                    <!--END of results-->
                    
                </div>
                <!--END of tab2-->
				
				<!--BEGIN tab1-->
                
            
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