<div class="block_addiction" id="others" title="Others"
        style="margin-left: 11px;">
    <div class="headings"><!--<img src="images/Briefcase-Medical.png" />-->LMP </div>
    <div class="inner_lmp">

    <!-- Get In Touch Starts -->

    <p>
                

            <?php
                 $q11 = "SELECT b.LMP_DATE
                        FROM prescription a, lmp b
                        WHERE a.PRESCRIPTION_ID = '$PRESCRIPTION_ID' and a.STATUS = 'SAVE'
                        AND a.PRESCRIPTION_ID = b.PRESCRIPTION_ID";
                            //echo $q5;
                    
                            $result = mysqli_query($con,$q11) or die(mysqli_error()); 
                            

                            while($rs = mysqli_fetch_array($result)) {
            ?>
                <?php echo date("d / m / Y", strtotime($rs['LMP_DATE'])); ?> &nbsp; &nbsp;
            <?php    } ?>
    </p> 
    <div class="clear"></div>


<input id="datepicker1" name="theDate" type="text" class="input_box_small" value="" onfocus="myFocus(this);" onblur="myBlur(this);" />


<!-- Get In Touch Ends -->					
    </div>


</div>