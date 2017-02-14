<?php
include "../datacon.php";
include "../classes/admin_class.php";

$medicine_name = $_GET["MEDICINE_NAME"];


$sql1 = "select pm.PRESCRIPTION_ID, pm.MEDICINE_NAME, v.visit_date,  p.patient_first_name, p.patient_last_name, p.GENDER, 
			TIMESTAMPDIFF(YEAR, p.patient_dob, CURDATE()) AS age, p.patient_id, v.visit_id
			from precribed_medicine pm, prescription pres, visit v, patient p 
			where MEDICINE_NAME like '%".$medicine_name."%' and
			pm.PRESCRIPTION_ID=pres.PRESCRIPTION_ID and
			pres.visit_id = v.visit_id and
			v.patient_id = p.patient_id";

//echo $sql1;

//$sql1 = "select * from patient where patient_id != ''".$where;
$result1 = mysqli_query($con,$sql1)or die(mysqli_error());
$no = mysqli_num_rows($result1);
echo "<table width='888' border='0' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='bg_tble'>                    
            <table width='100%' border='1' cellspacing='1' cellpadding='0'>";    
if($no > 0){
        
        echo "
        <tr colspan='7'><td><a href='./util/excelDownloader.php?MEDICINE_NAME=".$medicine_name."'>Export to Excel</a></td><tr>    
        <tr>
        <td class='head_tbl'>#</td>
        <td class='head_tbl'>First Name</td>
        <td class='head_tbl'>Last Name</td>
        <td class='head_tbl'>AGE</td>
        <td class='head_tbl'>Gender</td>
		<td class='head_tbl'>Medicine</td>
        <td class='head_tbl'>Visit Date</td>
        </tr>";
        
        
        while($d1 = mysqli_fetch_array($result1)){
           echo "<tr>
                <td class='odd'>".$d1['patient_id']."</td>
                <!--<td class='odd'><a href='processData.php?patient_id=".$d1['patient_id']."' class='vlink'>".$d1['patient_id']."</a></td> -->
                <td class='odd'>".$d1['patient_first_name']."</td>
                <td class='odd'>".$d1['patient_last_name']."</td>
                    

                        
                <td class='odd'>".$d1['age']."</td>
                <td class='odd'>".$d1['GENDER']."</td>
                
                
                <td class='odd'>".$d1['MEDICINE_NAME']."</td>
               
                
                <td class='odd'><a target='_blank' 
                href='archievedprescription.php?PRESCRIPTION_ID=".$d1['PRESCRIPTION_ID']."&visit_id=".$d1['visit_id']."&patient_id=".$d1['patient_id']."'>".date("d-m-y", strtotime($d1['visit_date']))."</a>
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