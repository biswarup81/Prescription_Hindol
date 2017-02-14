<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($status == 'SAVE'){ ?>
    <p><img src="images/lnc.jpg"  />
                

            <?php
                $result = mysqli_query($con,"SELECT b.investigation_name, a.value, b.unit, investigation_id
                    FROM patient_investigation a, investigation_master b
                    WHERE a.patient_id = '$patient_id'
                    AND a.visit_id = '$visit_id'
                    AND a.investigation_id = b.ID");
                while($rows = mysqli_fetch_array($result) ){

                
            ?>
                <?php echo $rows['investigation_name']; ?> - <?php echo $rows['value']; ?>,&nbsp;&nbsp;
            <?php    } ?>
    </p> 
    <div class="clear"></div>
<?php } else {
?>
<!--<p><img src="images/lnc.jpg"  />Chest Infection, Had fever &amp; caugh, <br />
    Fundalent Exp, Was started an aculubiology, <br />
    Contrary to popular belief, <br />
    Lorem Ipsum is not simply random text, <br />
    Latin professor at Hampden-Sydney</p> -->
<div class="clear"></div>
<table>    

        <tr><td id="INV" width="100%" colspan="3">

            <?php
                $query = "SELECT b.investigation_name, a.value, b.unit, investigation_id
                    FROM patient_investigation a, investigation_master b
                    WHERE a.patient_id = '$patient_id'
                    AND a.visit_id = '$visit_id'
                    AND a.investigation_id = b.ID";
                //echo $query;
                $result = mysql_query( $query ) or die(mysqli_error());
                //$rsd1 = mysqli_query($con,$q15);

                while($rows = mysqli_fetch_array($result) ){
                    
            ?>
                <table>      
                    <tr>
                    
					<td width='120'><?php echo $rows['investigation_name']; ?></td>
                    <td width='80'><?php echo $rows['value']; ?>&nbsp;<?php echo $rows['unit']; ?></td>   
                     <td><a  href='#' onclick="deletePatientInvestigation('<?php echo $visit_id ; ?>',
                                '<?php echo $rows['investigation_id'] ; ?>')">[-]</a>
                    </td>
                    </tr> 
                </table> 
            <?php    } ?>
            </td>
        </tr> 
      
        <tr>
            <td ><input  type='text' id='investigation'/></td>
                <td ><input  type='text' id='txtPatientInvval'/>
                
                <td>
                    <!--<a id='plus7' href='#' onclick="addPatientInvestigation('<?php echo $patient_id ; ?>','<?php echo $visit_id ; ?>')">[+]</a>-->
                    <a class="add_note"  href="#" onclick="addPatientInvestigation('<?php echo $patient_id ; ?>','<?php echo $visit_id ; ?>')"><img src="images/add_note.png"  /></a>

                </td> 
       </tr>

    </table>
<!--
<input type="text" name="examination-findings" class="text" placeholder="Add Examination Finding"  />
<a class="add_note" href="javascript:void();"><img src="images/add_note.png"  /></a>
<a class="modify" href="javascript:void();"><img src="images/modify.png"  /><span>Modify</span></a>-->

<?php 
}
?>