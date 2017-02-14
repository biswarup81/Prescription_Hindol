<?php include "header.html"; ?> 

<script type="text/ecmascript">
    
function func_print()
{ 
  var disp_setting="toolbar=no,location=no,directories=yes,menubar=no,"; 
      disp_setting+="scrollbars=yes, width=900, height=600, resize=yes"; 
  var content_vlue = document.getElementById("printArea").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>:: Dr. Soumyabrata Roy Chaudhuri :: Prescription Management</title>'); 
   docprint.document.write('<link href="css/style.css" rel="stylesheet" type="text/css">');
   docprint.document.write('<link rel="stylesheet" href="jquery/demos/demos.css" />');
   docprint.document.write('</head><body onLoad="self.print()">');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}

</script>    
    
    


  
<?php
include "datacon.php";
include 'classes/admin_class.php';

//$r2 = mysqli_query($con,"insert into prescription(VISIT_ID, REFERRED_TO, DIET, NEXT_VISIT, ANY_OTHER_DETAILS) values('', '','', '', '')") or die(mysqli_error());
//$PRESCRIPTION_ID = mysql_insert_id();


/*if(!empty($_GET['m_id'])){
	$id = $_GET['m_id'];
	mysqli_query($con,"delete from precribed_medicine where MEDICINE_ID = '$id'") or die(mysqli_error());
	
}*/
?>

<body >

<?php
    
    if(isset($_POST['MAKE_PRESCIPTION'])){ 
    $VISIT_ID = $_POST['VISIT_ID'];
    //$referred_to = $_POST['referred_to'];
    $diet = $_POST['diet'];
    
    //$nextvist = date("Y-m-d", strtotime($_POST['nextvisit']));
    $next_visit = "After ".$_POST['nextvisit']." Weeks";
    //$comments = $_POST['comments'];
    $PRESCRIPTION_ID = $_POST['PRESCRIPTION_ID'];
    $patient_id = $_POST['patient_id'];
    $visit_id = $_POST['VISIT_ID'];
    $other_comment = $_POST['other_comment'];
    $weight = 0;
    $height = 0;
    //update patient_health_details BMI Value
    $result3 = mysqli_query($con,"select * from patient_health_details where ID IN('1','2') and VISIT_ID = '$VISIT_ID'");
    while($rs5 = mysqli_fetch_array($result3)){
        if($rs5['ID'] == 1){
            $height = $rs5['VALUE'];
        } else if ($rs5['ID'] == 2){
            $weight = $rs5['VALUE'];
        } 
    }
    
    if($weight != 0 && $height != 0){
        $update= new admin(); 
        $bmi = $update->calcBMI($weight, $height);

        $udateQueryforph = "insert into patient_health_details (ID, VALUE,VISIT_ID) 
                            values ('3','$bmi','$VISIT_ID')";

        mysqli_query($con,$udateQueryforph);
    }
    
    mysqli_query($con,"update prescription set VISIT_ID = '$VISIT_ID',DIET = '$diet', NEXT_VISIT = '$next_visit', 
                STATUS ='SAVE', ANY_OTHER_DETAILS='$other_comment' where PRESCRIPTION_ID = '$PRESCRIPTION_ID' and STATUS='DRAFT'") or die(mysqli_error());
    
   
    if (isset($_POST['inv'])) {
    
        $inv = $_POST['inv'];
        //$temp = implode(',',$inv);
        //echo "Checked Values" . $temp ;
        if (!empty($inv)) {

            $invarray = array_map('mysql_real_escape_string',$inv);
            //echo "Checked Values" . $invarray ;
            foreach ($invarray as $value) {
                    // Act on $value
                    //insert into prescribed_INVESTIGATION
                //echo "VALUE -> ".$value;
                    mysqli_query($con,"INSERT INTO prescribed_investigation (PRESCRIPTION_ID,INVESTIGATION_ID) 
                            values ('".$PRESCRIPTION_ID."','".$value."')");
            }
        }
    }
    /*if (isset($_POST['cf'])) {
        $cf = $_POST['cf'];
        if (!empty($cf)) {
            $cfarray = array_map('mysql_real_escape_string',$cf);
                foreach ($cfarray as $value) {
                    // Act on $value
                    //insert into prescribed_INVESTIGATION
                //echo "VALUE -> ".$value;
                    mysqli_query($con,"INSERT INTO prescribed_cf (clinical_impression_id,prescription_id) 
                            values ('".$value."','".$PRESCRIPTION_ID."')");
            }
        }
    }*/
        $query = "update visit set VISITED = 'yes' where VISIT_ID = '$VISIT_ID'";
        //$query = "update visit a set a.VISITED = 'yes' where a.PATIENT_ID = 
          //          (select b.PATIENT_ID  from prescription b where b.prescription_id = '$PRESCRIPTION_ID')";
        mysqli_query($con,$query) or die(mysqli_error());
        
        $query = "select * from visit where VISIT_ID = '$VISIT_ID'";
        $result = mysqli_query($con,$query) or die(mysqli_error());
        
        while($row = mysqli_fetch_array($result)){
            mysqli_query($con,"update visit set VISITED = 'yes' where patient_id = '".$row['PATIENT_ID']."'") or die(mysqli_error());
        }
        
        //echo "<div class='b_success'>PRESCRIPTION created successfully<br><h2><a href='visit_list.php'>OK</a></h2></div>";
        //echo "<div class='b_success'>PRESCRIPTION created successfully<br><h2><a href='print.php?patient_id=$_GET[patient_id]&prescription_id=$PRESCRIPTION_ID&visit_id=$VISIT_ID'>OK</a></h2></div>";
    }
?>
<!--BEGIN wrapper-->
<div align="center"><a href="logout.php">Logoff</a></div>
<div id="printArea">
        <div id="wrapper"  >
            
            <div class="container">
        
           <?php include "doc_header.php"; ?> 
            
            
                <?php
                    
                
                $query  = "select a.visit_id, c.patient_id, c.GENDER, c.patient_first_name, 
                        c.patient_last_name, c.patient_address, c.patient_city, c.patient_dob, 
                        c.patient_cell_num, c.patient_alt_cell_num, c.patient_email, c.age , b.visit_date
                        from prescription a, visit b, patient c 
                        where a.visit_id = b.visit_id 
                        and b.patient_id=c.patient_id 
                        and prescription_id = '".$_POST['PRESCRIPTION_ID']."'";
                
                $rsd1 = mysqli_query($con,$query)  or die(mysqli_error());    
                
                while($d1 = mysqli_fetch_object($rsd1) ) {
                    
                ?>
                
             <div class="content">
                    <!--BEGIN pateint details-->
                    <div class="inner_id" style="margin-right:12px; margin-left:12px;">
                        <?php echo $d1->patient_id; ?>

                    </div>
                    <div class="inner_name" style="margin-right:12px; margin-left:12px;">
                        <?php echo $d1->patient_first_name." ".$d1->patient_last_name; ?>

                    </div>
                    <div class="inner_sex" style="margin-right:12px; margin-left:12px;">
                        <?php echo $d1->GENDER ?>

                    </div>
                    <div class="inner_age" style="margin-right:12px; margin-left:12px;">
                       
                        
                         <?php 
                        $update= new admin(); 
                        
                        if($d1->age == 0){
                            print $update->calcAge1($d1->patient_dob, $d1->visit_date) ; 
                        }else {
                            echo $d1->age;
                        }
                        ?>
                            
                    </div>
                    <!-- END Patient Details -->
                
             </div>  
                <!--BEGIN pateint details-->
             <div class="details">
            
                              
                <div class="del_col"><?php echo $d1->patient_address . ", " . $d1->patient_city; ?></div>
                <div class="del_col_in">Ph: <?php echo $d1->patient_cell_num; ?></div>
                
            
            </div>
            <!--END of patient details-->
                
                <?php } ?>
            
           
           
            <!--BEGIN content-->
            <div class="content">
            
                <!--BEGIN block one-->
                <div class="block" > 
                    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Clinical Impressions</div>
                    <div class="inner" >
                        <table>
                        <?php
                            $q15 = "SELECT b.type
                                    FROM prescribed_cf a, clinical_impression b
                                    WHERE a.clinical_impression_id = b.id
                                    AND a.prescription_id = '".$_POST['PRESCRIPTION_ID']."'";
                            $rsd1 = mysqli_query($con,$q15)  or die(mysqli_error()); 
                            while($rs = mysqli_fetch_array($rsd1) ) {
                                $result = $rs['type'];
                                
                                echo "<tr><td>$result</td></tr>" ;
                                
                            }
                        ?>
                        </table>
                    </div>        
                </div>
                <div class='block'><img src="images/lnc.jpg"  /></div>
                <!--BEGIN block two-->
                <div class="block" style="margin-right:12px; margin-left:12px;">
                    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Investigation Done</div>
                    <div class="inner">
                        <table>
                            
                        <?php
    $result = mysqli_query($con,"SELECT b.investigation_name, a.value, b.unit
                            FROM patient_investigation a, investigation_master b
                            WHERE a.patient_id = '$patient_id'
                            AND a.visit_id = '$visit_id'
                            AND a.investigation_id = b.ID ");
   
    while($rows = mysqli_fetch_array($result) ){
    
?>
                           
                      <tr>
                        <td ><?php echo $rows['investigation_name']; ?></td>
                        <td ><?php echo $rows['value']; ?></td>
                        <td ><?php echo $rows['unit']; ?></td>
                        
                      </tr>
                          
                       
                        <?php } ?>
                          
                        </table>
                    </div>   
                
                </div>
                <!--END of block two-->
                
                <!--BEGIN block three-->
                <div class="block">
                    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;C/F </div>
                    <div class="inner">
                        
                    <!-- Get In Touch Starts -->
                    <table>
            <tr><td id="CF" width="100%">

                    <?php
                            $q15 = "select a.VALUE, b.NAME, a.ID from
                                patient_health_details a , patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '$visit_id'";
                            $rsd1 = mysqli_query($con,$q15);

                            while($rs = mysqli_fetch_array($rsd1)) {
                                    $name = $rs['NAME'];
                                    $value = $rs['VALUE'];
                                    $id = $rs['ID'];
                    ?>
                    <table>      
                            <tr>
                                    <td width="100%" ><?php echo $name; ?></td>
                                    <td width="100%" ><?php echo $value; ?></td>
                                    
                            </tr> 
                    </table> 
            <?php    } ?>
            </td>
            </tr>
            
    </table>
                <!-- Get In Touch Ends -->					
                </div>
           
                
              </div>
              <!--END of block three-->
              
              
              
              
            
            </div>
            <!--END of content-->
             <!--BEGIN doctor comment section-->
            <div class="diet" style="margin-top: 5px;">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Comment / Advice</div>
                <div class="diet_inner">        
                <?php echo $other_comment; ?>
                </div>
            
            </div>
            <!--END doctor comment section-->
            
            <!--BEGIN diet section-->
            <?php 
                
            $query = "select * from prescription where PRESCRIPTION_ID = 
                        '".$PRESCRIPTION_ID."' and VISIT_ID = '".$VISIT_ID."'";
            $result = mysqli_query($con,$query);
            $diet1 = "";
            $nextvisit1 = "";
            while($rs = mysqli_fetch_array($result)){
                $diet1 = $rs['DIET'];
                $nextvisit1 = $rs['NEXT_VISIT'];
                $other_comment = $rs['ANY_OTHER_DETAILS'];
            }
            ?>
            <div class="diet" style="margin-top: 5px;">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Diet & Lifestyle Recemmendation</div>
                <div class="diet_inner">        
                <?php echo $diet1; ?>
                </div>
            
            </div>
            
            <!-- END Diet -->
            
            <!--BEGIN rx section-->
            
            <div class="rx" style="margin-top: 5px;">    
                <div class="headings" style="margin-bottom: 10px;"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Rx (Prescription)</div>
                <div class="rx_inner" style="margin-bottom: 10px; ">        
                
                    <?php
                        $q11 = "SELECT * FROM precribed_medicine WHERE PRESCRIPTION_ID = '".$_POST['PRESCRIPTION_ID']."'";
                            //echo $q5;
                
                            $result = mysqli_query($con,$q11) or die(mysqli_error()); 
                    ?>
                    
                    <table id="table-3">
                          
                         
                            <?php while($rs = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><img src="images/stock_list_bullet.png"/>&nbsp<strong><?php echo $rs['MEDICINE_NAME'] ?></strong>
                            <img src="images/arrow-right.png" />
                            <i><?php echo $rs['MEDICINE_DOSE'] ?></i></td>
                                                 
                            
                          </tr>
                            <?php } ?>
                        </table> 
                    
                </div>
            
            </div>
            <!--END of rx section-->
            
            
            
            
            <!--BEGIN special section-->
            <div class="invest" style="margin-top: 20px;">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Prescribed Investigation</div>
                <div class="invest_inner">        
                
                    
                            <div class="check_fields" >
                                <?php
                                $query = "SELECT b.investigation_name
                                        FROM prescribed_investigation a, investigation_master b
                                        WHERE a.investigation_id = b.ID
                                        AND prescription_id = '".$_POST['PRESCRIPTION_ID']."'";
                                $result = mysqli_query($con,$query);
                                    while($rs = mysqli_fetch_array($result)) {
                                            $cname = $rs['investigation_name'];
                                            //$inv_id =$rs['ID'];
                                            echo $cname. ", ";
                                    }
                                ?>
                            </div>      
                                       
                          
                </div>
                
                
            
            </div>
            
            
            
            <div class="diet" style="margin-top: 10px;">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Patient's Next Visit</div>
                <div class="diet_inner">    
                    
                <?php echo $nextvisit1; ?>
                </div>
            
            </div>
            
            
            <!--END of rx special-->
            
            <!--BEGIN submit button-->
                <div class="btn_wrap">
                    
                    
                    &nbsp;</div>
            <!--END of submit button-->
                      
            <!--BEGIN footer-->
            <?php include "footer_pg.html"; ?> 
            <!--END of footer-->
            
            </div>
             
        </div>
    </div>
        <!--END of wrapper-->
        <div class="btn_wrap2">
            <a href="visit_list.php" onclick="return func_print();">PRINT</a>    
            <!--<form id="form2" action="visit_list.php" method="POST">
            <input type="submit" id="PRINT" value="Print" onclick="return func_print();" class="btn"/>
            </form>-->
                 
        </div>
</body>
</html>