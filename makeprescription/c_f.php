<div class="block1">
    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Patient Health</div>
    <div class="inner1">
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
                            <td width="100%" ><input type="text" id="CF_<?php echo $id ?>" style="width: 40px;" class="input_box_small" value="<?php echo $value; ?>" /></td>
                            <td ><input type="button" class="update_row" onclick="updateDeleteCF('<?php echo $id ; ?>',
                                            '<?php echo $visit_id ; ?>','UPDATE')"/>
                            </td> 
                        </tr> 
                       
                    </table> 
            <?php    } ?>
            </td>
            </tr>
            <tr><td width="100%">
                    <table>
                        <tr>
                                <td >
                                        <input style="width: 140px;" class="input_box_small" type='text' id='txtCFName'/>
                                </td>
                                <td>
                                        <input style="width: 40px;" class="input_box_very_small" type='text' id='txtCFValue'/>
                                </td>	
                                <td>
                                    <input type='button' class="delete_row" onclick="addCF('<?php echo $visit_id ; ?>')"/>
                                </td> 
                        </tr>
                    </table>
                </td>
            </tr>
    </table>



    </div>


</div>