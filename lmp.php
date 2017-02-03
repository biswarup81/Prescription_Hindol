<?php
/*
 * Add / Edit LMP
 */
if($status == 'SAVE'){ ?>
    <p>
                

            <?php
                 $q11 = "SELECT b.LMP_DATE
                        FROM prescription a, lmp b
                        WHERE a.PRESCRIPTION_ID = '$PRESCRIPTION_ID' and a.STATUS = 'SAVE'
                        AND a.PRESCRIPTION_ID = b.PRESCRIPTION_ID";
                            //echo $q5;
                    
                            $result = mysql_query($q11) or die(mysql_error()); 
                            

                            while($rs = mysql_fetch_array($result)) {
            ?>
                <?php echo date("d / m / Y", strtotime($rs['LMP_DATE'])); ?> &nbsp; &nbsp;
            <?php    } ?>
    </p> 
    <div class="clear"></div>
<?php } else {
?>
<div class="calender" href="javascript:void();">
    <span>LMP</span><img src="images/calender.png"  /><span class="itl">14-Feb-2015</span>
    <a class="modify" href="javascript:void();"><img src="images/modify.png"  /><span>Modify</span></a>
</div>

<input id="lmp" name="lmp" type="text" class="input_box_add" placeholder="DD-MM-YYYY" value="" />

<?php } ?>