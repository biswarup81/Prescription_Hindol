<?php
/* 
 * Add Patient - Page to add Patient information
 */

include_once ('./include.php');
include ('./header.php');
include ('./datacon.php');

?>
<div class="content"><!-- content start -->
    <div class="wrapper"><!-- wrapper start -->
        <div class="content-box-frame"><!-- content-box-frame start -->
            
            <?php include './menu.php'; 
                  include './methods/method_edit_patient.php'  ;
                  include ('./methods/method_add_patient.php');
            ?>
            
        </div>
        
        
        <div class="content-box-frame"><!-- content-box-frame start -->
            <form id="add_patient_form" action="" method="post">
            
                    
                <span><p>Gender</p>
                    <select name="gender" class="drop_box_small" style="width:80px;">
                        <option>Select</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </span>                    
                <span><p>First Name</p><input name="fname" type="text" class="input_box_big" value="" /></span>                
                <span><p>Last Name</p><input name="lname" type="text" class="input_box_big" value="" /></span>                
                <span><p>Date of Birth</p>
                    <input id="date_patient_form" name="theDate" type="text" class="input_box_add" placeholder="DD-MM-YYYY" value="" /></span>                
                <span><p>Mobile No</p><input name="cellnum" type="text" class="input_box_add" value="" /></span>                
                <span><p>Landline No</p><input name="altcellnum" type="text" class="input_box_add" value="" /></span>                  
                <span><p>Street Address</p><textarea name="addr" cols="" rows=""></textarea></span>            

                <span><p>City / Town</p><input name="city" type="text" class="input_box_big" value="" /></span>                
                <span><p>Email Address</p><input name="email" type="text" class="input_box_big" value="" /></span>           
                <span><p>&nbsp;</p><input name="CREATE_PATIENT_DATA" id="MAKE" type="submit" class="btn" value="Add" /></span>

            </form>
            
        </div>
        
        
        
     </div><!-- wrapper end -->
</div><!-- content end -->



<?php
include_once './footer.php';

?>

