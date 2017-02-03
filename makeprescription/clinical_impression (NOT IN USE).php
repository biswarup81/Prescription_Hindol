<div class="block" style="width: 245px;">
<div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->&nbsp;Clinical Impressions</div>
<div class="inner" style="width: 240px;">

    <table>
        <tr><td id="CI" width="100%">

            <?php
                $q15 = "SELECT b.type, b.ID
                        FROM prescribed_cf a, clinical_impression b
                        WHERE a.clinical_impression_id = b.id
                        AND a.prescription_id = '$PRESCRIPTION_ID'";
                $rsd1 = mysql_query($q15);

                while($rs = mysql_fetch_array($rsd1)) {
                    $type = $rs['type'];
                    $cf_d = $rs['ID'];
            ?>
                <table>      
                    <tr>
                        <td style="width: 180px;"><?php echo $type; ?><a id='minus7' href='#' ></a></td>
                    <td ><a id='minus7' href='#' 
                            onclick="deleteClinicalImpression('<?php echo $cf_d ; ?>',
                                '<?php echo $PRESCRIPTION_ID ; ?>')">[-]</a>
                    </td> 
                    </tr> 
                </table> 
            <?php    } ?>
            </td>
            </tr>
            <tr>
                <td width="100%"><input style="width: 180px;" class="input_box_big" type='text' id='txtCI'/>

                </td>
                <td>
                    <a id='plus7' href='#' onclick="addClinicalImpression('<?php echo $PRESCRIPTION_ID ; ?>')">[+]</a>
                </td> 
            </tr>
    </table>
    </div>
</div>        