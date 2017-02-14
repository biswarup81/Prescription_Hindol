<?php

require_once "../datacon.php";

//echo "CALLED .. RIGHT";


$visit_id = $_GET['VISIT_ID'];

$query = "UPDATE visit SET VISITED = 'cancel' WHERE VISIT_ID = '$visit_id'";

mysqli_query($con,$query) or die(mysqli_error());


$result = mysqli_query($con,"SELECT a.visit_id, b.patient_id, a.visited, b.patient_first_name, 
                        b.patient_last_name, b.patient_name, b.patient_cell_num, a.VISIT_DATE
                        FROM visit a, patient b
                        WHERE a.patient_id = b.patient_id
                        AND a.visit_id
                        IN (
                        SELECT max( visit_id )
                        FROM visit c
                        WHERE c.visited = 'no'
                        GROUP BY patient_id
                        ) order by VISIT_DATE desc");

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>
                    
                                                <tr>
                                                    <td class='head_tbl' width='207'>Patient Name</td>
                                                    <td class='head_tbl' align='left' width='149'>Cell Number</td>
                                                    <td class='head_tbl' align='center' width='150'>Booking Date</td>
                                                    <td class='head_tbl' align='center' width='150'>Booking Time</td>
                                                    <td class='head_tbl' align='center' width='150'>Action</td>
                                                </tr>";
while ($row = mysqli_fetch_array($result)) {
    
                echo "<tr>
                    <td class='odd'><a href='create_prescription.php?patient_id="
                        .$row['patient_id']."&VISIT_ID=".$row['visit_id']."'>";
                if($row['patient_name'] == null || $row['patient_name']  =="" ){
                    echo $row['patient_first_name'] . " " . $row['patient_last_name']."</a></td>";
                } else {
                    echo $row['patient_name'];
                }
                
                    echo "<td class='odd'>". $row['patient_cell_num']."</td>
                    <td class='odd' align='center'>". date('d / m / Y', strtotime($row['VISIT_DATE']))."</td>
                    <td class='odd' align='center'>".date('h:i A', strtotime($row['VISIT_DATE']))."</td>"; ?>
                    
                    <td class='odd' align='center'><input type="button" value="Cancel Booking" onclick="removeVisit(<?php echo $row['visit_id']; ?>)" /> </td>
                </tr>
                <?php
   
}
 echo "</table></td></tr></table>";
?>