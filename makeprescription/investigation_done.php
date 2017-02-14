<div class="block1" style="margin-right:12px; margin-left:12px;">
    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Examinations</div>
    <div class="inner1">
    <table>    

        <tr><td id="INV" width="100%" colspan="3">

            <?php
                $result = mysqli_query($con,"SELECT b.investigation_name, a.value, b.unit, investigation_id
                    FROM patient_investigation a, investigation_master b
                    WHERE a.patient_id = '$patient_id'
                    AND a.visit_id = '$visit_id'
                    AND a.investigation_id = b.ID");
                //$rsd1 = mysqli_query($con,$q15);

                while($rows = mysqli_fetch_array($result) ){
                    
            ?>
                <table>      
                    <tr>
                    
					<td width='120'><?php echo $rows['investigation_name']; ?></td>
                    <td width='60'><?php echo $rows['value']; ?>&nbsp;<?php echo $rows['unit']; ?></td>   
                     <td><a  href='#' onclick="deletePatientInvestigation('<?php echo $visit_id ; ?>',
                                '<?php echo $rows['investigation_id'] ; ?>')">[-]</a>
                    </td>
                    </tr> 
                </table> 
            <?php    } ?>
            </td>
        </tr> 
      
        <tr>
            <td width="100%"><input class="input_box_small" type='text' id='investigation'/>
                <td width="100%"><input class="input_box_very_small" type='text' id='txtPatientInvval'/>
                
                <td>
                    <a id='plus7' href='#' onclick="addPatientInvestigation('<?php echo $patient_id ; ?>','<?php echo $visit_id ; ?>')">[+]</a>
                </td> 
       </tr>

    </table>

    </div>   

</div>
