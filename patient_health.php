<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if($status == 'SAVE'){ ?>
    <p>
                

            <?php
                 $q15 = "select a.VALUE, b.NAME, a.ID from
                                patient_health_details a , patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '$visit_id'";
                            $rsd1 = mysqli_query($con,$q15);

                            while($rs = mysqli_fetch_array($rsd1)) {
            ?>
                <?php echo $rs['NAME']; ?> - <?php echo $rs['VALUE']; ?>,&nbsp;&nbsp;
            <?php    } ?>
    </p> 
    <div class="clear"></div>
<?php } else {
?>
<!--
<p>There are many variations of passages of Lorem,<br />
    Ipsum available, but the majority have suffered ,<br />
    alteration in some form,, by injected humour, or randomised <br />
    words, sure there isn't anything,<br />
    embarrassing hidden in the middle of text.</p>
<div class="clear"></div>
<input type="text" name="medical-history" class="text" placeholder="Add Medical History"  />
<a class="add_note" href="javascript:void();"><img src="images/add_note.png"  /></a>
<a class="modify" href="javascript:void();"><img src="images/modify.png"  /><span>Modify</span></a> -->



<table style="width: 50%">
            <tr><td id="CF" >

                    <?php
                        
                            $q15 = "select a.VALUE, b.NAME, a.ID from
                                patient_health_details a , patient_health_details_master b
                                where
                                a.ID = b.ID
                                and a.VISIT_ID = '$visit_id'";
                            //echo $q15;
                            $rsd1 = mysqli_query($con,$q15) or die (mysqli_error());

                            while($rs = mysqli_fetch_array($rsd1)) {
                                    $name = $rs['NAME'];
                                    $value = $rs['VALUE'];
                                    $id = $rs['ID'];
                    ?>
                    <table>      
                        
                        <tr>
                            <td  ><?php echo $name; ?></td>
                            <td ><input type="text" id="CF_<?php echo $id ?>" value="<?php echo $value; ?>" /></td>
                            <td ><input type="button" value="UPDATE" onclick="updateDeleteCF('<?php echo $id ; ?>',
                                            '<?php echo $visit_id ; ?>','UPDATE')"/>
                            </td> 
                        </tr> 
                       
                    </table> 
            <?php    } ?>
            </td>
            </tr>
            <tr><td >
                    <table>
                        <tr>
                                <td >
                                        <input type='text' id='txtCFName'/>
                                </td>
                                <td>
                                        <input type='text' id='txtCFValue'/>
                                </td>	
                                <td>
                                    <!--<input type='button' class="add" value="ADD" onclick="addCF('<?php echo $visit_id ; ?>')"/>-->
                                    <a class="add_note" href="#" onclick="addCF('<?php echo $visit_id ; ?>')"><img src="images/add_note.png"  /></a>
                                </td> 
                        </tr>
                    </table>
                </td>
            </tr>
    </table>
<?php } ?>