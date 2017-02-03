<?php
/* 
 * Add Patient - Page to Modify Patient information
 */

include_once ('./include.php');
include ('./header.php');
include ('./datacon.php');

?>
<div class="content"><!-- content start -->
    <div class="wrapper"><!-- wrapper start -->
        <div class="content-box-frame"><!-- content-box-frame start -->
            
            <?php include './menu.php';  ?>
            
        </div>
        
        <form id="modify_patient_form" action="" method="post">
        <div class="content-box-frame"><!-- content-box-frame start -->
            
                <span><p>Patient ID</p><input id="s_p_id" name="patient_id" type="text" class="input_box_add" value="" /></span>                
                <span><p>Patient Name</p><input id="s_p_name" name="patient_name" type="text" class="input_box_big" value="" /></span>               
                <span><p>&nbsp;</p><input type="submit" value="Search" name="MODIFY_PATIENT_DATA" class="btn" " /></span>
            
            
        </div>
        
        <div class="content-box-frame"><!-- content-box-frame start -->
            <?php include ('./methods/method_search_modify_patient.php');
            ?>
        </div>
        </form>
        
     </div><!-- wrapper end -->
</div><!-- content end -->



<?php
include_once './footer.php';

?>

