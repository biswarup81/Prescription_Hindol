<?php include "header.html"; ?> 
<?php include "classes/admin_class.php"; ?>

    <?php include "datacon.php"; ?>
    
    <body>
        <!--BEGIN wrapper-->
        <div id="wrapper">
            
            <div class="container">
        
            <?php include "doc_header.php"; ?> 
            
            <!--BEGIN pateint details-->
            <div class="details">
                <?php
                    
                
                $query  = "select a.visit_id, c.patient_id, c.GENDER, c.patient_first_name, 
                        c.patient_last_name, c.patient_address, c.patient_city, c.patient_dob, 
                        c.patient_cell_num, c.patient_alt_cell_num, c.patient_email , b.visit_date
                        from prescription a, visit b, patient c 
                        where a.visit_id = b.visit_id 
                        and b.patient_id=c.patient_id 
                        and prescription_id = '".$_GET['PRESCRIPTION_ID']."'";
                
               $rsd1 = mysql_query($query)  or die(mysql_error());    
                
                while($d1 = mysql_fetch_object($rsd1) ) {
                    
                ?>
                <div class="content">
                    <!--BEGIN pateint details-->
                    <div class="inner_id" style="margin-right:12px; margin-left:12px;">
                        <?php echo $d1->patient_id; ?>

                    </div>
                    <div class="inner_sex" style="margin-right:12px; margin-left:12px;">
                        <?php echo $d1->GENDER ?>

                    </div>
                    <div class="inner_age" style="margin-right:12px; margin-left:12px;">
                        <?php 
                        $update= new admin(); 
                        print $update->calcAge1($d1->patient_dob, $d1->visit_date) ; ?>

                    </div>
                    
                </div>   
                <!--BEGIN pateint details-->
            <div class="details">
            
                <div class="del_col_in"><?php echo $d1->patient_first_name." ".$d1->patient_last_name; ?></div>
                
                <div class="del_col"><?php echo $d1->patient_address . ", " . $d1->patient_city; ?></div>
                <div class="del_col_in">Ph: <?php echo $d1->patient_cell_num; ?></div>
                
            
            </div>
                <?php } ?>
            </div>
            <!--END of patient details-->
           
           
            <!--BEGIN content-->
            <div class="content">
            
                <!--BEGIN block one-->
                <div class="block"> 
                    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Clinical Impressions</div>
                    <div class="inner">
                        <?php
                            $q15 = "SELECT b.type
                                    FROM prescribed_cf a, clinical_impression b
                                    WHERE a.clinical_impression_id = b.id
                                    AND a.prescription_id = '".$_GET['PRESCRIPTION_ID']."'";
                            $rsd1 = mysql_query($q15)  or die(mysql_error()); 
                            while($rs = mysql_fetch_array($rsd1) ) {
                                $result = $rs['type'];
                                
                                echo $result ;
                                echo " , ";
                            }
                        ?>
                    </div>        
                </div>
                
                <!--BEGIN block two-->
                <div class="block" style="margin-right:12px; margin-left:12px;">
                    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Investigation Done</div>
                    <div class="inner">
                        <table>
                            
                        <?php
    $result = mysql_query("SELECT b.investigation_name, a.value, b.unit
                            FROM patient_investigation a, investigation_master b
                            WHERE a.patient_id = '".$_GET['patient_id']."'
                            AND a.visit_id = '".$_GET['visit_id']."'
                            AND a.investigation_id = b.ID ");
    
    while($rows = mysql_fetch_array($result) ){
    
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
                    <?php
					
                    $visit_id = $_GET['visit_id'];
                    
                    $q15 = "select a.VALUE, b.NAME, a.ID from
                                patient_health_details a , patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '".$_GET['visit_id']."' ";
					 $rsd1 = mysql_query($q15);

                            while($rs = mysql_fetch_array($rsd1)) {
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
                <!-- Get In Touch Ends -->					
                </div>
           
                
              </div>
              <!--END of block three-->
              
              
              
              
            
            </div>
            <!--END of content-->
            
            <!--BEGIN rx section-->
            
            <div class="rx">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Rx (Prescription)</div>
                <div class="rx_inner">        
                
                    <?php
                        $q11 = "SELECT * FROM precribed_medicine WHERE PRESCRIPTION_ID = '".$_GET['PRESCRIPTION_ID']."'";
                            //echo $q5;
                
                            $result = mysql_query($q11) or die(mysql_error()); 
                    ?>
                    
                    <table width="720" border="0" cellspacing="1" cellpadding="1" id="datatable">
                          <tr>
                            <td class="head_tbl" width="207">Medicine's Names</td>
                            <td class="head_tbl" align="left" width="149">Dose Details</td>
                            <td class="head_tbl" align="left" width="150">Direction</td>
                            <td class="head_tbl" align="left" width="150">Timing</td>
                            
							</td>
                          </tr>
                          <tr>
                          	<td  id="medicine" colspan="5">
                            	
                            </td>
                          </tr>
                            <?php while($rs = mysql_fetch_array($result)) { ?>
                          <tr>
                            <td class="odd_tb"><?php echo $rs['MEDICINE_NAME'] ?></td>
                            <td class="odd_tb"><?php echo $rs['MEDICINE_DIRECTION'] ?></td>
                            <td class="odd_tb"><?php echo $rs['MEDICINE_DOSE'] ?></td>
                            <td class="odd_tb" ><?php echo $rs['MEDICINE_TIMING'] ?></td>
                            <td>
                           
                            
                          </tr>
                            <?php } ?>
                        </table> 
                    
                </div>
            
            </div>
            <!--END of rx section-->
            
            <!--BEGIN doctor comment section-->
            <div class="diet">    
                <?php 
                    $prescriptionid = $_GET['PRESCRIPTION_ID'] ;
                    
                    $query = "select * from prescription where PRESCRIPTION_ID = 
                        '".$prescriptionid."' and VISIT_ID = '".$visit_id."'";
                    $result = mysql_query($query);
                    $diet1 = "";
                    $nextvisit1 = "";
                    while($rs = mysql_fetch_array($result)){
                        $diet1 = $rs['DIET'];
                        $nextvisit1 = $rs['NEXT_VISIT'];
                        $other_comment = $rs['ANY_OTHER_DETAILS'];
                    }
                ?>
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Other Advice (if any)</div>
                <div class="diet_inner"> <?php echo $other_comment; ?>  </textarea>
                </div>
            
            </div>
           
            
            <!--BEGIN special section-->
            <div class="invest">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Prescribed Investigation</div>
                <div class="invest_inner">        
                
                    <div id="tabvanilla" class="widget">            
                        
                    
                        <!--BEGIN tab1-->
                        <div id="tab1" class="tabdiv">
                            <div class="check_fields" >
                                <?php
                                $query = "SELECT b.investigation_name
                                        FROM prescribed_investigation a, investigation_master b
                                        WHERE a.investigation_id = b.ID
                                        AND prescription_id = '".$_GET['PRESCRIPTION_ID']."'";
                                $result = mysql_query($query);
                                    while($rs = mysql_fetch_array($result)) {
                                            $cname = $rs['investigation_name'];
                                            //$inv_id =$rs['ID'];
                                            echo $cname. ", ";
                                    }
                                ?>
                            </div>      
                                       
                        </div>
                        <!--END of tab1-->
                        
                    </div>   
                </div>
                
                
            
            </div>
            
            <!--BEGIN diet section-->
            
            
            <!--BEGIN diet section-->
           
            <div class="diet">    
                <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Diet & Lifestyle Recemmendation</div>
                <div class="diet_inner">        
                <?php echo $diet1; ?>
                </div>
            
            </div>
            
            <div class="diet">    
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
        <!--END of wrapper-->
    </body>
</html>