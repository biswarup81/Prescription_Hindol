<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prescription :: Dr. Soumyabrata Roy Chaudhuri ::</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

<script src="calender/js/jquery-1.5.1.js"></script>
<script type='text/javascript' src='inc/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="inc/jquery.autocomplete.css" />

<script type="text/javascript"> 
    $(document).ready(function(){
        $("#investigation").autocomplete("get_investigation_list.php", 
            
        {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#investigation_type").autocomplete("get_investigation_type_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        
    });
    
</script>


<link rel="stylesheet" href="calender/themes/base/jquery.ui.all.css">
<script src="calender/ui/jquery.ui.core.js"></script>
<script src="calender/ui/jquery.ui.widget.js"></script>
<script src="calender/ui/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="calender/css/demos.css">

<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>




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
</script>

    <script language="javascript">         
	
	
    function deleteInvestigationRow(invest_id,vis_id,patient_id){
	//alert(invest_id);
        //alert(vis_id);
        //alert(patient_id)
        if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

                    xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("medition").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "delete_patient_investigation.php?INVESTIGATION_ID="+invest_id+"&VISIT_ID="+vis_id+"&PATIENT_ID="+patient_id ;   
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
    }
    function insertInvestigationRow(visit_id, patient_id){
        
        var inv_name = document.getElementById('investigation').value ;
        var inv_id = document.getElementById('investigation_id').value ;
        var inv_val = document.getElementById('value').value ;
        var inv_unit = document.getElementById('unit').value ;
        //var inv_type = document.getElementById('investigation_type').value ;
        
        
        
        if(inv_name == ""){
	  alert("Investigation Name should not be Blank");
	  return false;
        }else if(inv_val == ""){
                alert("Value Should not be blank");
                return false;
        }
        
        
        if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

                    xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("medition").innerHTML=xmlhttp.responseText;
                        //alert('SUCCESS');
                        
                        document.getElementById('investigation').value  = "";
                        //var inv_id = document.getElementById('investigation_id').value ;
                        document.getElementById('value').value = "";
                        document.getElementById('unit').value = "" ;
                        //document.getElementById('investigation_type').value = "" ;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "insert_patient_investigation.php?VISIT_ID="+visit_id+"&PATIENT_ID="+patient_id+"&INVESTIGATION_NAME="+inv_name+
                        "&VALUE="+inv_val+"&UNIT="+inv_unit+"&TYPE=";   
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
            return false;
    }
    
    function getInvestigationDetails(){
       
        var inv_name = document.getElementById('investigation').value ;
        //alert(inv_name);
        
        if (inv_name.length == 0){
            alert("No Value in Investigation Name");
            
        } else {
            //Call Ajax
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    var strresponsetext = xmlhttp.responseText;
                    // alert(strresponsetext);
                    if(strresponsetext.length > 0) {
                        var arr = strresponsetext.split(",");
                        document.getElementById("investigation_id").innerHTML=arr[1];    
                        document.getElementById("unit").innerHTML=arr[1];
                        document.getElementById("investigation_type").innerHTML=arr[2];
                        }
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "getinvestigation_unit_and_type.php?INVESTIGATION_NAME="+inv_name;   
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
            }
        
        
       return false;
        
        //Call Ajax to get the value;
    }
    
    function update_patient_weight_height(visit_id){
        var height = document.getElementById('id_height').value ;
        var weight = document.getElementById('id_weight').value ;
        //alert('height ->'+height);
        //alert('weight ->'+weight);
        alert(visit_id);
        var objheight_weight_div = document.getElementById('height_weight_div');
        
        //alert(inv_name);
        
        if (height.length == 0){
            alert("Provide some value in height");
            
        } else if(weight.length == 0){
            alert("Provide some value in height");
            
        } else {
            //Call Ajax
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    alert(xmlhttp.responseText);
                    //objheight_weight_div.innerHTML = xmlhttp.responseText;
                    
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "height_weight_save.php?MODE=UPDATE&WEIGHT="+weight+"&HEIGHT="+height+"&VISIT_ID="+visit_id;   
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
            }
        
        
       return false;
    }
    
</script>
</head>
<body>
<?php 
include "datacon.php";
if(isset($_SESSION['page']) && isset($_SESSION['patient_id'])){ 

    if($_SESSION['page'] == 'processData') {
    $patient_id = $_SESSION['patient_id'];

//$visit_id = $_GET['visit_id'];
/*
$sql1 = mysql_query("select * from patient where patient_id = '$patient_id'") or die(mysql_error());
$d1 = mysql_fetch_object($sql1) or die(mysql_error());

$r2 = mysql_query("select * from visit where PATIENT_ID = '$patient_id'") or die(mysql_error());
$n2 = mysql_num_rows($r2) + 1; */

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

<!--BEGIN wrapper-->
<div id="wrapper">
	<div class="container">

	<!--BEGIN header-->
    <div id="header">
    
    	<!--BEGIN logo-->
        <div id="logo">        
        	<div class="black">
            <img src="images/logo.png" /><br/>
            <b>MBBS</b>, <b>DTM&amp;H</b>, <b>MD</b> (Medicine), <b>DM</b> (Endocrinology), <b>MRCP</b><br/>
            Consultant Endocrinologist & Diabetologist & Physician</div>
            <div class="gray"><b>Member</b> : Endocrine Society (<b>USA</b>), AACE (<b>USA</b>)<br/>
            <span style="padding-left:56px;">Endocrine Society of Bengal</span><br/>
            <span style="padding-left:56px;">Diabetic Association of India (<b>W.B.</b>)</span>
            </div>        
        </div>
        <!--END of logo-->
        
        <!--BEGIN info-->
   		 <div id="info">
        	<div>
            <img src="images/phone.png" align="absmiddle"/>&nbsp;<b>+91.9830118338 (M)</b><br/>
            <b>Ananda Clinic</b> (By Appointment)<br/>
            567, Diamond Harbour Road, Kolkata - 34<br/>
            Phone : 23991153 / 24071765<br/><br/>
            <b>Residence</b> (By Appointment)<br/>
            36, Block H, New Alipore, Kolkata - 53
            </div>
        
        </div>
        <!--END of info-->
    
    
    </div>
    <!--END of header-->
    <form id="form1" name="form1" method="post" action="details_save.php">
    <!--BEGIN details-->
    <div class="invest">    
    	
        <?php 
        $query_maxvisit = "SELECT max( visit_id ) AS max_visit
                            FROM visit
                            WHERE PATIENT_ID = '$patient_id' and visited = 'no' ";

            $result_maxvisits = mysql_query($query_maxvisit) or die(mysql_error());

            if ( mysql_num_rows($result_maxvisits) > 0){

                while($visitarr1 = mysql_fetch_array($result_maxvisits)){
                        $current_visit_id = $visitarr1['max_visit'];
                } 
        ?>
        <div class="invest_inner">        
        
       <div class="diet">    
                <div class="headings"><img src="images/Briefcase-Medical.png" />Patient's Basic investigation</div>
                <div class="rx_inner">        
               <input type="hidden" name="PATIENT_ID" value="<?php echo $patient_id; ?>" /> 
                            <input type="hidden" name="vist_id" value="<?php echo $current_visit_id ;?>"/>    
            <table>
            <tr><td id="CF" width="100%">

                    <?php
                    $weight = "" ;
                    $height = "";
                    $bmi = "";
                    
                    $q15 = "select a.VALUE, b.NAME, a.ID from
                                PATIENT_HEALTH_DETAILS a , patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '$current_visit_id'
                                and a.ID = '2'";
                            
                            $rsd1 = mysql_query($q15);
                           
                            while($rs = mysql_fetch_array($rsd1)){
                                $weight = $rs['VALUE'];
                            }
                            
                            
                                    
                            $q15 = "select a.VALUE, b.NAME, a.ID from
                                PATIENT_HEALTH_DETAILS a , patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '$current_visit_id'
                                and a.ID = '1'";
                            
                            $rsd1 = mysql_query($q15);
                           
                           while($rs = mysql_fetch_array($rsd1)){
                                $height = $rs['VALUE'];
                            } 
                            
                            $q15 = "select a.VALUE, b.NAME, a.ID from
                                PATIENT_HEALTH_DETAILS a , patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '$current_visit_id'
                                and b.NAME = 'BMI'";
                            
                            $rsd1 = mysql_query($q15);
                           
                           while($rs = mysql_fetch_array($rsd1)){
                                $bmi = $rs['VALUE'];
                            }     
                                   
                    ?>
                    <table>  
                        <tr id="height_weight_div">
                                    <td width="100%" >WEIGHT(KG)</td>
                                    <td width="100%" ><input id="id_weight" type="text"  name="weight" class="input_box_small" value="<?php echo $weight; ?>" /></td>
                      
                                    <td width="100%" >HEIGHT(CM)</td>
                                    <td width="100%" ><input id="id_height" type="text"  name="height" class="input_box_small" value="<?php echo $height; ?>" /></td>
                                    <td width="100%" ><input type="button"  value="Update" onclick="update_patient_weight_height('<?php echo $current_visit_id ;?>');" /></td>
                                    
                       </tr> 
                       
                    </table> 
            
                      
            </td>
            </tr>
            
            </table>
                </div>
</div>     
            
        <div class="rx">    
	<div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Patient's Investigation Results</div>
	<div class="rx_inner">        
		
		<?php
                            
                    $q11 = "select b.investigation_name, a.investigation_id,  b.unit, a.value, b.investigation_type 
                            from patient_investigation a, investigation_master b
                            where a.investigation_id = b.ID 
                            and a.visit_id = '$current_visit_id'
                            and a.patient_id = '$patient_id'"; 
                    
                    //$q11 = "SELECT * FROM precribed_medicine WHERE PRESCRIPTION_ID = '".$_POST['PRESCRIPTION_ID']."'";
                            //echo $q5;
                    
                            $result = mysql_query($q11) or die(mysql_error()); 
                    ?>
		
		<table width="720" border="0" cellspacing="1" cellpadding="1" id="datatable">
                          <tr>
                            
                            <td class="head_tbl" width="240">Investigation Name</td>
                                    <td class="head_tbl" width="150">Value</td>
                                    <td class="head_tbl" width="150">Unit</td>
                                    <!--<td class="head_tbl" width="150">Type</td>-->
                                    <td class="head_tbl" width="60" align="center">Action</td>
                          </tr>
                          
                          
                          <tr>
                          	<td id="medition" colspan="5">
                                    
                                    <?php while($rs = mysql_fetch_array($result)) { ?>
                                        <table  width="720" border="0" cellspacing="0" cellpadding="0"> 
                                            <tr>
                                                <td width="240" height="23" align="left"><?php echo $rs['investigation_name'] ?><input type="hidden" name="investigation_id" value="<?php echo $rs['investigation_id'];?>"/></td>

                                                <td width="150" align="left"><?php echo $rs['value'] ?><input type="hidden" name="dose" value="<?php echo $rs['value'];?>" /></td>
                                                <td width="150" align="left"><?php echo $rs['unit'] ?><input type="hidden" name="direction" value="<?php echo $rs['unit'];?>" /></td>
                                                <!--<td width="150" align="left"><?php echo $rs['investigation_type'] ?><input type="hidden" name="direction" value="<?php echo $rs['investigation_type'];?>" /></td> -->
                                                <td width="60" align="center">
                                                    
                                                    <a id="minus7" href="#" onclick="deleteInvestigationRow(<?php echo $rs['investigation_id']; ?>
                                                                                ,<?php echo $current_visit_id; ?>, <?php echo $patient_id; ?>)">[-]</a> 
                                                    
                                                    
                                                </td>

                                            </tr>
                                        </table>
                                     <?php } ?>
                                    
                                    
                                </td>
                          </tr>
                          <tr>
                            <td width="240" height="23" align="left">
                                <input type="text" name="investigation_name" id="investigation" class="input_box_add" />
                                <input type="hidden" id="investigation_id" name="investigation_id" value=""/>
                            </td>
                            <td width="150" align="left">
                               <!-- <input type="text" name="value" id="value"  size="10" class="input_small" onfocus="getInvestigationDetails()" /> -->
                                <input type="text" name="value" id="value"  size="10" class="input_box_small" />
                            </td>
                            <td width="150" align="left">
                                <input type="text" name="unit" id="unit" class="input_box_small"/>
                            </td>
                            <!--
                            <td width="150" align="left">
                                <input type="text" name="type" id="investigation_type" class="input_box_small"/>
                            </td>
                            -->
                            <input type="hidden" name="visit_id" value="<?php echo $current_visit_id; ?>" id="v_id" />
                            <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>" id="p_id" />
                            
                            <td width="60" align="center">                                
                                 <a id="plus7" href="#" onclick="return insertInvestigationRow(<?php echo $current_visit_id; ?>, 
                                                        <?php echo $patient_id; ?>)">[+]</a>       
                            </td>
                          </tr>
                        </table>	
		
		
		
	
	</div>

</div>

 <!--BEGIN submit button-->
<div class="btn_wrap2">
	<input type="submit" name="DETAILS_SAVE" id="MAKE" value="SAVE"  class="btn"/>
	<input type="hidden" id="hiddenstr" name="inputXML" value=""/>
	


</div>
<!--END of submit button-->
            
    
    </div>
    <?php } else {
        echo "<div>Error Occured. Please try from the begining <a href='index.php'>click</a> to start over</div>";
    }?>
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
    </form>
</div>
</div>

<!--END of wrapper-->
<?php } else {

     header("location:index.php");
} }else {
    header("location:index.php");
}
?>

</body>
</html>