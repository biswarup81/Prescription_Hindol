<?php

/* 
 * File to modify patient Data
 */
$message=''; // Variable To Store Error Message
if(isset($_POST['MODIFY_PATIENT_DATA'])){
						
   $patient_id = $_POST["patient_id"];
$strPatientName = $_POST["patient_name"];

$where = "";
if($patient_id != ""){
        
        $where .= " and patient_id = '$patient_id'";
} 
if($strPatientName != ""){
        
        $where .= " and patient_first_name like '$strPatientName%' OR patient_name like '$strPatientName%' ";
} 


$sql1 = "select * from patient where patient_id != ''".$where;
//echo $sql1;
$result1 = mysqli_query($con,$sql1)or die(mysqli_error());
$no = mysqli_num_rows($result1);
echo "<table width='888' border='0' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='bg_tble'>                    
            <table width='100%' border='0' cellspacing='1' cellpadding='0'>";    
if($no > 0){
        
        echo "<tr>
        <td class='head_tbl'>Sex</td>
        <td class='head_tbl'>Patient ID</td>
        <td class='head_tbl'>First Name</td>
        <td class='head_tbl'>Last Name</td>
        <td class='head_tbl'>Date of Birth</td>
        <td class='head_tbl'>Mobile No</td>
        
        <td class='head_tbl'>Street Address</td>
        
        <td class='head_tbl'>City / Town</td>
        <!--<td class='head_tbl'>Email Address</td>-->
        <td class='head_tbl'></td>
        </tr>";
        
        
        while($d1 = mysqli_fetch_array($result1)){
           echo "<tr>
                <td class='odd'>".$d1['GENDER']."</td>
                <td class='odd'><a href='processData.php?patient_id=".$d1['patient_id']."' class='vlink'>".$d1['patient_id']."</a></td>
                <td class='odd'>".$d1['patient_first_name']."</td>
                <td class='odd'>".$d1['patient_last_name']."</td>
                <td class='odd'>".date('d / m / Y', strtotime($d1['patient_dob']))."</td>
                <td class='odd'>".$d1['patient_cell_num']."</td>
                <td class='odd'>".$d1['patient_address']."</td>
                
                <td class='odd'>".$d1['patient_city']."</td>
                <!--<td class='odd'>".$d1['patient_email']."</td>-->
                <td class='odd'><a href='edit_patient.php?patient_id_edit=".$d1['patient_id']."' class='vlink'>EDIT</a>
                &nbsp; &nbsp; <a href='processdata.php?patient_id=".$d1['patient_id']."' class='vlink'>ADD VISIT</a>
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
}
    ?>
