<?php
/*
 * Add / Edit Prescribed Investigation
 */
if($status == 'SAVE'){ ?>
    <p>
                

            <?php
                 $q11 = "SELECT b.investigation_name, b.ID
                        FROM prescribed_investigation a, investigation_master b
                        WHERE a.INVESTIGATION_ID = b.ID
                        AND a.prescription_id = '$PRESCRIPTION_ID'";
                            //echo $q5;
                    
                            $result = mysqli_query($con,$q11) or die(mysqli_error()); 
                            

                            while($rs = mysqli_fetch_array($result)) {
            ?>
                <?php echo $rs['investigation_name']; ?>, &nbsp;
            <?php    } ?>
    </p> 
    <div class="clear"></div>
<?php } else {
?>

<div class="clear"></div>
<table>
        <tr><td id="prescribed_investigation" width="100%">

            <?php
                $q15 = "SELECT b.investigation_name, b.ID
                        FROM prescribed_investigation a, investigation_master b
                        WHERE a.INVESTIGATION_ID = b.ID
                        AND a.prescription_id = '$PRESCRIPTION_ID'";
                $rsd1 = mysqli_query($con,$q15);

                while($rs = mysqli_fetch_array($rsd1)) {
                   $cname = $rs['investigation_name'];
                   $inv_id =$rs['ID'];
            ?>
                <table>      
                    <tr>
                        <td style="width: 180px;"><?php echo $cname; ?><a id='minus7' href='#' ></a></td>
                    <td ><a id='minus7' href='#' 
                            onclick="deletePrescribedInvestigation('<?php echo $inv_id ; ?>',
                                '<?php echo $PRESCRIPTION_ID ; ?>')">[-]</a>
                    </td> 
                    </tr> 
                </table> 
            <?php    } ?>
            </td>
            </tr>
    </table>

 <div  class="addfileds">
    <input id="invest11" type="text" value="" class="input_box_big"/>
    <input type="button" class="delete_row" name="" onclick="return addPrescribedInvestigation('<?php echo $PRESCRIPTION_ID ; ?>')" value="" />

</div> 
<?php } ?>