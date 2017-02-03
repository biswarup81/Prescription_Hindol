<?php

require_once "inc/config.php";
$patient_id = $_GET["patient_id"];
$strPatientName = $_GET["patient_name"];

$where = "";
if($patient_id != ""){
        
        $where .= "and patient_id = '$patient_id'";
} 
if($strPatientName != ""){
        
        $where .= "and patient_first_name like '$strPatientName%'";
}

$sql1 = "select * from patient where patient_id != ''".$where;
$result1 = mysql_query($sql1)or die(mysql_error());
$no = mysql_num_rows($result1);
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
        <td class='head_tbl'>Landline No</td>
        <td class='head_tbl'>Street Address</td>
        
        <td class='head_tbl'>City / Town</td>
        <td class='head_tbl'>Email Address</td>
        <td>ACTION</td>
        </tr>";
        
        
        while($d1 = mysql_fetch_array($result1)){
           echo "<tr>
                <td class='odd'>".$d1['GENDER']."</td>
                <td class='odd'><a href='processData.php?patient_id=".$d1['patient_id']."' class='vlink'>".$d1['patient_id']."</a></td>
                <td class='odd'>".$d1['patient_first_name']."</td>
                <td class='odd'>".$d1['patient_last_name']."</td>
                <td class='odd'>".date('d / m / Y', strtotime($d1['patient_dob']))."</td>
                <td class='odd'>".$d1['patient_cell_num']."</td>
                <td class='odd'>".$d1['patient_cell_num']."</td>
                <td class='odd'>".$d1['patient_alt_cell_num']."</td>
                
                <td class='odd'>".$d1['patient_city']."</td>
                <td class='odd'>".$d1['patient_email']."</td>
                <td><input type='button' value='MAKE' onclick='startPrescription(".$d1['patient_id'].")'/></td>    

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
