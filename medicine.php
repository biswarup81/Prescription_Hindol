<?php
/*
 * Writes Prescription here
 */
if($status == 'SAVE'){ ?>
    <p>
                

            <?php
                 $q11 = "SELECT * FROM precribed_medicine WHERE PRESCRIPTION_ID = '".$PRESCRIPTION_ID."'";
                            //echo $q5;
                    
                            $result = mysqli_query($con,$q11) or die(mysqli_error()); 
                            

                            while($rs = mysqli_fetch_array($result)) {
            ?>
                <?php echo $rs['MEDICINE_NAME'] ?> - <?php echo $rs['MEDICINE_DOSE'] ?><br/>
            <?php    } ?>
    </p> 
    <div class="clear"></div>
<?php } else {
?>
<!--
<p>Chest Infection, Had fever &amp; caugh, <br />
    Fundalent Exp, Was started an aculubiology, <br />
    Contrary to popular belief, <br />
    Lorem Ipsum is not simply random text, <br />
    Latin professor at Hampden-Sydney,<br />
    Chest Infection, Had fever &amp; caugh, <br />
    Fundalent Exp, Was started an aculubiology, <br />
    Contrary to popular belief, <br />
    Lorem Ipsum is not simply random text, <br />
    Latin professor at Hampden-Sydney</p>
<div class="clear"></div>
<input type="text" name="medicine" class="text" placeholder="Add Medicine"  />
<a class="add_note" href="javascript:void();"><img src="images/add_note.png"  /></a>
<a class="modify" href="javascript:void();"><img src="images/modify.png"  /><span>Modify</span></a>-->


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
                    
                    <table width="430" border="0" cellspacing="1" cellpadding="1" id="datatable">
                          <tr>
                            <td class="head_tbl" width="180">Medicine's Names</td>
                            <td class="head_tbl" align="center" width="50">Breakfast</td>
                            <td class="head_tbl" align="center" width="50">Lunch</td>
                            <td class="head_tbl" align="center" width="50">Dinner</td>
                            <td class="head_tbl" align="center" width="15"></td>
                          </tr>
                          
                          
                          
                            <tr>
                            <td class="head_tbl" width="180">
                                <table>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr>
                                        
                                        <td><input type="text" name="course" id="course" style="width: 150px;" /></td>
                                        
                                    </tr>
                                    
                                    
                                </table>
                            
                            
							</td>
                            <td class="head_tbl" align="center" width="50">
                                <table>
                                    <tr><td><input type="radio" name="bfradio" value ="before"/> B
                                        <input type="radio" name="bfradio" value ="after"/> A</td></tr>
                                    <tr>
                                        
                                        <td><input name="dose1" id="dose1" type="text" size="10" /></td>
                                        
                                    </tr>
                                    
                                    
                                </table>
                                
                                
                            </td>
                            <td class="head_tbl" align="center" width="50">
                                 <table>
                                     <tr><td><input type="radio" name="lradio" value ="before"/> B
                                        <input type="radio" name="lradio" value ="after"/> A</td></tr>
                                    <tr>
                                        
                                        <td><input name="dose2" id="dose2" type="text" size="10" /></td>
                                        
                                    </tr>
                                    
                                    
                                </table>
                                
                            </td>
                            <td class="head_tbl" align="center" width="50">
                                <table>
                                    <tr><td><input type="radio" name="dradio" value ="before"/> B
                                        <input type="radio" name="dradio" value ="after"/> A</td></tr>
                                    <tr>
                                        
                                        <td><input name="dose3" id="dose3" type="text" size="10" /></td>
                                        
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
                    
<?php } ?>                    
                    
                
