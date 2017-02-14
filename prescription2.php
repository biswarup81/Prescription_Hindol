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
include "classes/admin_class.php";


if(isset($_SESSION['user_type']) ){
if(isset($_SESSION['NAVIGATION'])){
if( $_SESSION['NAVIGATION'] == 'visit_list'){
    
    if(isset($_GET['VISIT_ID'])  && isset($_GET['patient_id']) && isset($_GET['PRESCRIPTION_ID']) ) {
    
$user_type = $_SESSION['user_type'] == 'DOCTOR';

$patient_id = $_GET['patient_id'];
$visit_id = $_GET['VISIT_ID'];


//$r2 = mysqli_query($con,"insert into prescription(VISIT_ID, REFERRED_TO, DIET, NEXT_VISIT, ANY_OTHER_DETAILS) values('', '','', '', '')") or die(mysqli_error());
//$PRESCRIPTION_ID = mysql_insert_id();
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];

/*if(!empty($_GET['m_id'])){
	$id = $_GET['m_id'];
	mysqli_query($con,"delete from precribed_medicine where MEDICINE_ID = '$id'") or die(mysqli_error());
	
}*/
?>

<body >
    
   
<?php


//$r1 = mysqli_query($con,"select * from patient where patient_id = '$patient_id'") or die(mysqli_error());

$query = "SELECT a.patient_id, a.GENDER, a.patient_first_name, a.patient_last_name, a.patient_name,
a.patient_address, a.patient_city, a.patient_dob, a.patient_cell_num, a.patient_alt_cell_num, a.age,
a.patient_email, data_entry_date, b.VISIT_ID, b.PATIENT_ID, b.VISIT_DATE, 
b.APPOINTMENT_TO_DOC_NAME, b.VISITED
FROM patient a, visit b
WHERE b.PATIENT_ID = a.patient_id
AND a.patient_id = '$patient_id'
AND b.visited = 'no'";

$r1 = mysqli_query($con,$query) or die(mysqli_error());
        $d1 = mysqli_fetch_object($r1) ;
//$r2 = mysqli_query($con,"select * from visit where PATIENT_ID = '$patient_id'");
//$n2 = mysqli_num_rows($r2);
?>
<!--BEGIN wrapper-->
        <div id="wrapper">
            
            <div class="container">
        
            <!--BEGIN header-->
            <?php include("banner.php") ?>
            <!--END of header-->
                
            <div class="details">
            
                              
                <div class="del_col">ID # <?php echo $d1->patient_id; ?>, <?php if($d1->patient_name == null || $d1->patient_name == ""){
                            echo $d1->patient_first_name." ".$d1->patient_last_name; } else { echo $d1->patient_name ; }?>, <?php echo $d1->GENDER ?>, <?php 
                        $update= new admin(); 
                        if($d1->age == 0){
                            print $update->calcAge1($d1->patient_dob, $d1->VISIT_DATE) ;
                        }else {
                            echo $d1->age;
                        }
                        ?>, <?php echo $d1->patient_address . ", " . $d1->patient_city; ?></div>
                <div class="del_col_in">Ph: <?php echo $d1->patient_cell_num; ?></div>
                
            
            </div>
            
            <!--END of patient details-->
            
            <form id="form1" name="form1" method="post" action="printprescription.php" onsubmit="return validate();" >
            <!--BEGIN content-->
            <div class="content">
            
                <!--BEGIN block one-->
                <?php /* include("makeprescription/clinical_impression.php"); */?>
                <?php include("makeprescription/symptoms.php"); ?>
                
                <!--END of block one-->

				<!--BEGIN block two-->
                <?php /* include("makeprescription/investigation_done.php"); */?>
                <?php include("makeprescription/past_medical_history.php"); ?>

                <!--END of block two-->

				 <!--BEGIN block three-->
                <?php include("makeprescription/social_history.php");?>
                
                
              <!--END of block three-->
               <!--BEGIN block FOUR-->
              <?php include("makeprescription/lmp.php"); ?>
               
              <!--END of block FOUR-->
               
              <!--BEGIN block FOUR-->
              <?php include("makeprescription/allergy.php"); ?>
               
              <!--END of block FOUR-->
              
			    

				<!--BEGIN block two-->
                <?php include("makeprescription/investigation_done.php");?>
                
                <!--END of block two-->

				 <!--BEGIN block three-->
                <?php include("makeprescription/c_f.php");?>
                
                
              <!--END of block three-->
               <!--BEGIN block FOUR-->
              <?php include("makeprescription/addiction.php");?>
                
              <!--END of block FOUR-->

			    <!--BEGIN block FIVE-->
              <?php include("makeprescription/pre_prescriptions.php");?>
                
              <!--END of block FVE -->
            
            </div>
            <!--END of content-->
            
            <!--BEGIN doctor comment/advice section-->
            <div class="diet" style="margin-top: 5px;">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Comment / Advice</div>
                <div class="diet_inner">        
                <textarea name="other_comment" cols="" rows="" class="areabox" ></textarea>
                </div>
            
            </div>
            <!--END doctor comment/advice section-->
            
            <!--BEGIN diet section-->
            <div class="diet" style="margin-top: 5px;">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Diet & Lifestyle Recemmendation</div>
                <div class="diet_inner">        
                <textarea name="diet" cols="" rows="" class="areabox" >Diet 1600 Kcal/day, Cholesterol < 200 gm /day , Saturated Fat < 7%, Brisk walking atleast 30 mins/day, Alerted to hypoglycaemia (CBG < 70 y/dl)</textarea>
                </div>
            
            </div>
            
            <!-- END diet section-->
            
            <!--BEGIN rx section-->
            
            <div class="rx" style="margin-top: 5px; ">    
                <div class="headings" style="margin-bottom: 10px;" ><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Rx (Prescription)</div>
                <div class="rx_inner" style="margin-bottom: 10px; ">        
                    
                    <?php
                        
                    //Retrieve last prescription id
                    //$q11 = "select * from precribed_medicine where PRESCRIPTION_ID = '".$lastPrescription."'"; 
                    //echo $q11;
                    $q11 = "SELECT * FROM precribed_medicine WHERE PRESCRIPTION_ID = '".$PRESCRIPTION_ID."'";
                            //echo $q5;
                    
                            $result = mysqli_query($con,$q11) or die(mysqli_error()); 
                    ?>
                   
                    <div  id="medicine" colspan="5">
                       
                        <table id="table-3"> 
                        <?php while($rs = mysqli_fetch_array($result)) { ?>

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
                    
                    <table width="954" border="0" cellspacing="1" cellpadding="1" id="datatable">
                          <tr>
                            <td class="head_tbl" >Medicine's Names</td>
                            <td class="head_tbl" align="center" >Breakfast</td>
                            <td class="head_tbl" align="center" >Lunch</td>
                            <td class="head_tbl" align="center" >Dinner</td>
                            <td class="head_tbl" align="center" >Duration</td>
                            <td class="head_tbl" align="center" >ACTION</td>
                          </tr>
                          
                          
                          
                            <tr>
                            <td class="head_tbl" >
                            <input type="text" name="medicine_name" id="course"  class="input_box_very_big" />
                            
							</td>
                            <td class="head_tbl" align="center" >
                                <table>
                                    <tr>
                                        
                                        <td><input name="dose1" id="dose1" type="text" size="10" class="input_box_very_small"/></td>
                                        <td><input type="radio" name="bfradio" value ="before"/> before<br>
                                        <input type="radio" name="bfradio" value ="after"/> after</td>
                                    </tr>
                                    
                                    
                                </table>
                                
                                
                            </td>
                            <td class="head_tbl" align="center" >
                                 <table>
                                    <tr>
                                        
                                        <td><input name="dose2" id="dose2" type="text" size="10" class="input_box_very_small"/></td>
                                        <td><input type="radio" name="lradio" value ="before"/> before<br>
                                        <input type="radio" name="lradio" value ="after"/> after</td>
                                    </tr>
                                    
                                    
                                </table>
                                
                            </td>
                            <td class="head_tbl" align="center" >
                                <table>
                                    <tr>
                                        
                                        <td><input name="dose3" id="dose3" type="text" size="10" class="input_box_very_small"/></td>
                                        <td><input type="radio" name="dradio" value ="before"/> before<br>
                                        <input type="radio" name="dradio" value ="after"/> after</td>
                                    </tr>
                                    
                                    
                                </table>
                                
                            </td>
                            <td class="head_tbl" align='center'>
                                <table>
                                    <tr>
                                        
                                        <td><input name="duration_count" id="duration_count" type="text" class="input_box_very_small"/></td>
                                        <td><select name="duration_type" id="duration_type">
                                                <option value="Days">Days</option>
                                                <option value="Weeks">Weeks</option>
                                                <option value="Months">Months</option>
                                            </select>
                                            </td>
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
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Prescribed Investigation</div>
                
                <?php include("makeprescription/invest.php");?>
            

            </div>
            <!--END Prescribed Investigation section-->
            
            
            
            
            
            <div class="diet" style="margin-top: 40px;">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Patient's Next Visit</div>
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
        <?php }else {
            header("location:blank_prescription.php");
        }
        
        }}else{ 
    header("location:visit_list.php");
        }} else {
            header("location:index.php");
        }
?>
</body>
</html>