<?php

/* 
 * Get the list of Old Prescription
 */

?>
<!--<p><u>20-Jan-13</u>, <u>31-Mar-13</u>, <u>20-Jun-13</u>, <u>21-Oct-13</u>,<br />
                <u>12-Jan-14</u>, <u>13-Mar-14</u>, <u>15-May-14</u>, <u>21-Nov-14</u>,<br />
                <u>10-Jan-15</u></p>
<p>-->
<!-- Get In Touch Starts -->
    <?php
    $lastPrescription = 0;
    
    $query = "SELECT a.VISIT_ID, a.PATIENT_ID, a.VISIT_DATE, b.prescription_id, a.visit_id 
                FROM visit a, prescription b
                WHERE a.patient_id = '$patient_id'
                AND a.visited = 'YES'
                AND a.visit_id = b.visit_id
                AND b.STATUS = 'SAVE' order by VISIT_DATE desc LIMIT 0 , 5";


                        //echo $q5;
                        $r5 = mysqli_query($con,$query) or die(mysqli_error());
                        if(mysqli_num_rows($r5) > 0){
                            echo "<p>";
                            while($d5 = mysqli_fetch_array($r5)) {
                                $lastPrescription = $d5['prescription_id'] ;
        ?>
<a target='_blank' 
                href='make_prescription.php?PRESCRIPTION_ID=<?php echo $d5['prescription_id'] ?>&VISIT_ID=<?php echo $d5['visit_id']; ?>&patient_id=<?php echo $d5['PATIENT_ID']; ?>'>
                    <?php echo date("d-m-y", strtotime($d5['VISIT_DATE'])); ?>
</a>,&nbsp;
            
    <?php
                            }
                            echo "</p>";
                        }else {
                            echo"<p>First Visit. No Stored prescription</td></tr></p>";
                        }

    ?>