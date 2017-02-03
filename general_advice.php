<?php
/*
 * Section to add Genral Advice
 */

if($status == 'SAVE'){ ?>
    <p>
                

            <?php
                 $q11 = "SELECT *
                        FROM prescription a
                        WHERE a.PRESCRIPTION_ID = '$PRESCRIPTION_ID' and a.STATUS = 'SAVE'";
                            //echo $q5;
                    
                            $result = mysql_query($q11) or die(mysql_error()); 
                            

                            while($rs = mysql_fetch_array($result)) {
            ?>
                <?php echo $rs['ANY_OTHER_DETAILS'] ?>, &nbsp; &nbsp;
            <?php    } ?>
    </p> 
    <div class="clear"></div>
<?php } else {
?>
<textarea name="other_comment" id="other_comment" cols="57" rows="4" class="areabox" ></textarea>
<?php } ?>

