<?php
include "../datacon.php";
include "../classes/admin_class.php";

$ci = $_GET["CI"];


$sql1 = "SELECT a.clinical_impression_id, a.prescription_id, b.visit_id, c.patient_id,
d.GENDER, d.patient_first_name, d.patient_last_name, d.patient_name, d.patient_city, d.patient_dob, 
d.age, d.patient_cell_num, d.data_entry_date, d.patient_address, d.patient_email, c.visit_date, TIMESTAMPDIFF(YEAR, d.patient_dob, CURDATE()) AS patient_age
FROM prescribed_cf a, prescription b, visit c, patient d, clinical_impression e
WHERE e.TYPE ='".$ci."'
and e.ID = a.clinical_impression_id
and a.prescription_id=b.prescription_id
and b.visit_id = c.visit_id
and c.patient_id = d.patient_id
ORDER BY d.patient_first_name ASC";

//echo $sql1;

//$sql1 = "select * from patient where patient_id != ''".$where;
$result1 = mysql_query($sql1)or die(mysql_error());
$no = mysql_num_rows($result1);
echo "<table width='888' border='0' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='bg_tble'>                    
            <table width='100%' border='0' cellspacing='1' cellpadding='0'>";    
if($no > 0){
        
        echo "
        <tr colspan='7'><td><a href='./util/excelDownloader.php?CI=".$ci."'>Export to Excel</a></td><tr>    
        <tr>
        <td class='head_tbl'>#</td>
        <!--<td class='head_tbl'>Patient ID</td>-->
        <td class='head_tbl'>First Name</td>
        <td class='head_tbl'>Last Name</td>
        <td class='head_tbl'>Age</td>
        <td class='head_tbl'>Mobile No</td>
        
        <!--<td class='head_tbl'>Street Address</td>-->
        
        <td class='head_tbl'>City / Town</td>
        <td class='head_tbl'>Visit Date</td>
        
        <!--<td class='head_tbl'>ACTION</td>-->
        </tr>";
        
        
        while($d1 = mysql_fetch_array($result1)){
           echo "<tr>
                <td class='odd'>".$d1['patient_id']."</td>
                <!--<td class='odd'><a href='processData.php?patient_id=".$d1['patient_id']."' class='vlink'>".$d1['patient_id']."</a></td> -->
                <td class='odd'>".$d1['patient_first_name']."</td>
                <td class='odd'>".$d1['patient_last_name']."</td>
                    

                        
                <td class='odd'>".$d1['patient_age']."</td>
                <td class='odd'>".$d1['patient_cell_num']."</td>
                <!--<td class='odd'>".$d1['patient_address']."</td> --> 
                
                <td class='odd'>".$d1['patient_city']."</td>
               
                
                <td class='odd'><a target='_blank' 
                href='archievedprescription.php?PRESCRIPTION_ID=".$d1['prescription_id']."&visit_id=".$d1['visit_id']."&patient_id=".$d1['patient_id']."'>".date("d-m-y", strtotime($d1['visit_date']))."</a>
            </td>

            </tr>";
            
        }
    }else{
            echo "<tr><td colspan='10' align='center' style='color:red'> No Result found.</td></tr>";
    }
    echo "</table>
       </td>
    </tr>
</table>";

?>