<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>:: Dr. Soumyabrata Roy Chaudhuri :: Prescription Management</title>
<meta name="robots" content="all">
<link rel="stylesheet" type="text/css" href="inc/b.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery/themes/base/jquery.ui.all.css" />
<script src="jquery/jquery-1.7.2.js"></script>
<script src="jquery/ui/jquery.ui.core.js"></script>
<script src="jquery/ui/jquery.ui.widget.js"></script>
<script src="jquery/ui/jquery.ui.datepicker.js"></script>

<link rel="stylesheet" href="jquery/demos/demos.css" />
      
<script type='text/javascript' src='inc/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="inc/jquery.autocomplete.css" />

<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script tyepe="text/javascript" src ="js/makeprescription.js"></script>
<script type="text/javascript">
<?php include "classes/admin_class.php"; ?>

</script>


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
<script type="text/javascript" src="js/jquery-dynamic-form.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    
        //Activate two nested dynamic form
        $("#phone2Template").dynamicForm("#plus6", "#minus6", {limit:15,
            createColor:"black"});
        $("#phone2Template1").dynamicForm("#plus7", "#minus7", {limit:15,
            createColor:"black"});
        
                //Defines data to be injected in the form
                var data = [
                    {
                        "adr" : "A",
                        "postal_code" : "B",
                        "ville" : "C",
                        "phoneTemplate" :[
                            {"phone":"1", "phoneType":"pro"}
                        ],
                        "phone2Template" :[
                            {"phone2":"bar", "phonePro":true, more_info:"This is filled with more informations"}
                        ]
                    }
                ];
          //Inject the data in the main form for prefilling
    mainDynamicForm.inject(data);
    });
</script>

</head>

<?php

include "datacon.php";

if(isset($_SESSION['user_type']) ){
    
    
$user_type = $_SESSION['user_type'] == 'DOCTOR';

$patient_id = "";
$visit_id = "";
$lastPrescription = "";

$qery112 = "SELECT MAX( PRESCRIPTION_ID ) as PRESCRIPTION_ID, MAX( VISIT_ID ) as VISIT_ID 
FROM  `prescription`";
$r1 = mysql_query($qery112) or die(mysql_error());
$d1 = mysql_fetch_object($r1) ;

$PRESCRIPTION_ID = $d1->PRESCRIPTION_ID + 1;  
$visit_id = $d1->VISIT_ID + 1;

//$r2 = mysql_query("insert into prescription(VISIT_ID, REFERRED_TO, DIET, NEXT_VISIT, ANY_OTHER_DETAILS) values('', '','', '', '')") or die(mysql_error());
//$PRESCRIPTION_ID = mysql_insert_id();


/*if(!empty($_GET['m_id'])){
	$id = $_GET['m_id'];
	mysql_query("delete from precribed_medicine where MEDICINE_ID = '$id'") or die(mysql_error());
	
}*/
?>

<body >
    
   
<?php



?>
<!--BEGIN wrapper-->
        <div id="wrapper">
            
            <div class="container">
        
            <!--BEGIN header-->
            <?php include("banner.php") ?>
            <!--END of header-->
                <div class="content">
                    <!--BEGIN pateint details-->
                    
                    <div class="inner_name" style="margin-right:12px; margin-left:12px;">
                        <input type="text" name="patient_name" id="patient_name"></input>

                    </div>
                    <div class="inner_sex" style="margin-right:12px; margin-left:12px;">
                        <select type="text" name="sex" id="sex">
                            <option value="0">--SELECT--</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option></option>
                        </select>

                    </div>
                    <div class="inner_age" style="margin-right:12px; margin-left:12px;">
                       <input type="text" name="age" id="age"></input>
                    </div>
                    
                </div>
            <div class="details">
            
                              
                <div class="del_col"><input type="text" name="address" id="address"></input></div>
                <div class="del_col_in"><input type="text" name="cell" id="cell"></input></div>
                
                <input type="button" name="ADD" id="ADD_PATIENT" value="ADD"  
                       class="btn" onclick="addPatient()"/>
                <div id="add_success"></div>
            </div>
            
            <div class="details">
            
                
            
            </div>
            <!--END of patient details-->
            
            <form id="form1" name="form1" method="post" 
                  action="printprescription.php" onsubmit="return validate();" >
            <!--BEGIN content-->
            <div class="content">
            
                <div id="new">
                <!--BEGIN block one-->
                <?php include("makeprescription/clinical_impression.php");?>
                
                
                <!--END of block one-->
                 
                <!--BEGIN block two-->
                <?php include("makeprescription/investigation_done.php");?>
                
                <!--END of block two-->
                
                <!--BEGIN block three-->
                <?php include("makeprescription/c_f.php");?>
                
                
              <!--END of block three-->
               </div>
              
              
              <!--BEGIN block FOUR-->
              <?php include("makeprescription/pre_prescriptions.php");?>
                
              <!--END of block FOUR
              
               <!--BEGIN block FIVE-->
              <?php include("makeprescription/addiction.php");?>
                
              <!--END of block FIVE-->
            
            </div>
            <!--END of content-->
            
            <!--BEGIN doctor comment/advice section-->
            <div class="diet" style="margin-top: 5px;">    
                <div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Comment / Advice</div>
                <div class="diet_inner">        
                <textarea name="other_comment" cols="" rows="" class="areabox" ></textarea>
                </div>
            
            </div>
            <!--END doctor comment/advice section-->
            
            <!--BEGIN diet section-->
            <div class="diet" style="margin-top: 5px;">    
                <div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Diet & Lifestyle Recemmendation</div>
                <div class="diet_inner">        
                <textarea name="diet" cols="" rows="" class="areabox" >Diet 1600 Kcal/day, Cholesterol < 200 gm /day , Saturated Fat < 7%, Brisk walking atleast 30 mins/day, Alerted to hypoglycaemia (CBG < 70 y/dl)</textarea>
                </div>
            
            </div>
            
            <!-- END diet section-->
            
            <!--BEGIN rx section-->
            
            <div class="rx" style="margin-top: 5px; ">    
                <div class="headings" style="margin-bottom: 10px;" ><img src="images/Briefcase-Medical.png" />&nbsp;Rx (Prescription)</div>
                <div class="rx_inner" style="margin-bottom: 10px; ">        
                    
                    <?php
                        
                    //Retrieve last prescription id
                    $q11 = "select * from precribed_medicine where PRESCRIPTION_ID = '".$lastPrescription."'"; 
                    //echo $q11;
                    //$q11 = "SELECT * FROM precribed_medicine WHERE PRESCRIPTION_ID = '".$_POST['PRESCRIPTION_ID']."'";
                            //echo $q5;
                    
                            $result = mysql_query($q11) or die(mysql_error()); 
                    ?>
                   
                    <div  id="medicine" colspan="5">
                       
                        <table id="table-3"> 
                        <?php while($rs = mysql_fetch_array($result)) { ?>

                            <tr>
                                <td>
                                    <img src="images/stock_list_bullet.png"/>&nbsp<strong><?php echo $rs['MEDICINE_NAME'] ?></strong>
                                    <input type="hidden" class="input_box" name="medicine_name" value="<?php echo $rs['MEDICINE_NAME'];?>"/>
                                    <img src="images/arrow-right.png" />
                                        <i><?php echo $rs['MEDICINE_DOSE'] ?></i><input type="hidden" class="input_box_small" name="dose" value="<?php echo $rs['MEDICINE_DOSE'];?>" /></td>
                                <td  align="center" width="90"    >

                                    <a id="minus7" href="#" onclick="del(<?php echo $rs['MEDICINE_ID'] ?>,<?php echo $PRESCRIPTION_ID ?>)">[-]</a> 


                                </td>

                            </tr>

                        <?php } ?>
                        </table>
                    </div>
                    
                    <table width="950" border="0" cellspacing="1" cellpadding="1" id="datatable">
                          <tr>
                            <td class="head_tbl" width="350">Medicine's Names</td>
                            <td class="head_tbl" align="center" width="170">Breakfast</td>
                            <td class="head_tbl" align="center" width="170">Lunch</td>
                            <td class="head_tbl" align="center" width="170">Dinner</td>
                            <td class="head_tbl" align="center" width="90">ACTION</td>
                          </tr>
                          
                          
                          
                            <tr>
                            <td class="head_tbl" width="250">
                            <input type="text" name="medicine_name" id="course" style="width: 330px;" class="input_box_big" />
                            
							</td>
                            <td class="head_tbl" align="center" width="149">
                                <table>
                                    <tr>
                                        
                                        <td><input name="dose1" id="dose1" type="text" size="10" class="input_small"/></td>
                                        <td><input type="radio" name="bfradio" value ="before"/> before<br>
                                        <input type="radio" name="bfradio" value ="after"/> after</td>
                                    </tr>
                                    
                                    
                                </table>
                                
                                
                            </td>
                            <td class="head_tbl" align="center" width="150">
                                 <table>
                                    <tr>
                                        
                                        <td><input name="dose2" id="dose2" type="text" size="10" class="input_small"/></td>
                                        <td><input type="radio" name="lradio" value ="before"/> before<br>
                                        <input type="radio" name="lradio" value ="after"/> after</td>
                                    </tr>
                                    
                                    
                                </table>
                                
                            </td>
                            <td class="head_tbl" align="center" width="150">
                                <table>
                                    <tr>
                                        
                                        <td><input name="dose3" id="dose3" type="text" size="10" class="input_small"/></td>
                                        <td><input type="radio" name="dradio" value ="before"/> before<br>
                                        <input type="radio" name="dradio" value ="after"/> after</td>
                                    </tr>
                                    
                                    
                                </table>
                                
                            </td>
                            <td class="head_tbl" align='center'>
                            <input type="hidden" name="PRESCRIPTION_ID" value="<?php echo $_GET['PRESCRIPTION_ID']; ?>" id="PRESCRIPTION_ID" />
                            <input type="hidden" name="patient_id" value="<?php echo $_GET['patient_id']; ?>" id="patient_id" />
                            <input type="hidden" name="VISIT_ID" value="<?php echo $_GET['VISIT_ID']; ?>" id="VISIT_ID" />
                            
                            
                            <a id="plus7" href="#" onclick="return saveResult()">[+]</a>  
                            
                            </td>
                          </tr>
                        </table> 
                    
                    
                    
                
                </div>
            
            </div>
            <!--END of rx section-->
            
            
            
            
            <!--BEGIN Prescribed Investigation section-->
            <div class="invest" style="margin-top: 5px;">    
                <div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Prescribed Investigation</div>
                
                <?php include("makeprescription/invest.php");?>
            
            

            </div>
            <!--END Prescribed Investigation section-->
            
            
            
            
            
            <div class="diet" style="margin-top: 40px;">    
                <div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Patient's Next Visit</div>
                <div class="diet_inner">        
                    <!--
                    <input id="datepicker" name="nextvisit" type="text"   class="input_box_add" value="DD-MM-YYYY" onfocus="myFocus(this);" onblur="myBlur(this);"/>
                    -->
                    After : <input name="nextvisit" type="text"   
                                   class="input_box_small" value="2" onfocus="myFocus(this);" onblur="myBlur(this);"/> Weeks
                
                </div>
            
            </div>
            
            
            
            <!--BEGIN submit button-->
            
            
                <div class="btn_wrap">
                    <?php if ($user_type == 'DOCTOR') {  ?>
                    <input type="submit" name="MAKE_PRESCIPTION" id="MAKE" value="MAKE PRESCIPTION"  class="btn2" />
                     <?php } ?>
                    <input type="button" name="BACK" id="MAKE" value="Back"  class="btn" onclick="backtoVisit()"/>
                </div>
                
            <!--END of submit button-->
            
           
            
            <!--END of diet section-->
            <!--END of rx special-->
            </form>
            
            <?php include("footer.php"); ?>
            
            </div>
        </div>
        <!--END of wrapper-->
        <?php 
        
        }
?>
</body>
</html>