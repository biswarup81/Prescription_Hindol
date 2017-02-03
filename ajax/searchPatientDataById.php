<?php
include "../datacon.php";
include "../classes/admin_class.php";

$patient_id = $_GET["PATIENT_ID"];


$sql1 = "SELECT a.PRESCRIPTION_ID, a.VISIT_ID, b.PATIENT_ID , b.VISIT_DATE, p.patient_first_name, p.patient_last_name
        from prescription a, visit b, patient p
        where a.VISIT_ID = b.VISIT_ID and
		b.patient_id = p.patient_id and
		b.VISITED = 'yes' and
        b.PATIENT_ID = '".$patient_id."' order by b.VISIT_DATE asc";
$result1 = mysql_query($sql1)or die(mysql_error());
$no = mysql_num_rows($result1);

echo "<table width='888' border='0' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='bg_tble'>                    
            <table width='100%' border='1' cellspacing='1' cellpadding='0'>";    
if($no > 0){
    echo "
        <!--<tr colspan='4'><td><a href='./util/excelDownloader.php?PATIENT_ID=".$patient_id."&MODE=PATIENTDATA'>Export to Excel</a></td><tr> -->   
        <tr>
		<td class='head_tbl'>Name</td>
        <td class='head_tbl'>Visit date</td>
        
        <td class='head_tbl'>Clinical Impression</td>
        <td class='head_tbl'>Investigation Result</td>
        <td class='head_tbl'>Medicine</td>
        
        </tr>";

while($d1 = mysql_fetch_array($result1)){
    echo "<tr>";
	 echo "<td>".$d1['patient_first_name']." ".$d1['patient_last_name']."</td>";
    echo "<td>".date("d / m / Y", strtotime($d1['VISIT_DATE']))."</td>";
    echo "<td>";
    $sql2 = "SELECT a.prescription_id, a.clinical_impression_id, b.TYPE 
        from prescribed_cf a, clinical_impression b
        where a.clinical_impression_id 	 = b.ID and
        a.prescription_id = '".$d1['PRESCRIPTION_ID']."' order by b.TYPE asc";
    $result2 = mysql_query($sql2)or die(mysql_error());
    echo "<table>";
    while($d2 = mysql_fetch_array($result2)){
        echo"<tr>";
        echo "<td>".$d2['TYPE']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</td>";
    
    echo "<td>";
    $sql3 = "SELECT a.value, b.investigation_name
        from patient_investigation a, investigation_master b
        where a.investigation_id = b.ID and
        a.visit_id = '".$d1['VISIT_ID']."' order by b.investigation_name asc";
    $result3 = mysql_query($sql3)or die(mysql_error());
    echo "<table>";
    while($d3 = mysql_fetch_array($result3)){
        echo"<tr>";
        echo "<td>".$d3['investigation_name']."  ".$d3['value']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</td>";
    
    echo "<td>";
    $sql4 = "SELECT a.MEDICINE_NAME
        from precribed_medicine a
        where a.PRESCRIPTION_ID = '".$d1['PRESCRIPTION_ID']."' order by a.MEDICINE_NAME asc";
    $result4 = mysql_query($sql4)or die(mysql_error());
    echo "<table>";
    while($d4 = mysql_fetch_array($result4)){
        echo"<tr>";
        echo "<td>".$d4['MEDICINE_NAME']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</td>";
    
    
    
    echo "</tr>";
}

}else{
            echo "<tr><td colspan='10' align='center' style='color:red'> No Result found.</td></tr>";
    }
    echo "</table>
       </td>
    </tr>
</table>";
/*
$sql1 = "SELECT a.clinical_impression_id, a.prescription_id, b.visit_id, c.patient_id,
d.GENDER, d.patient_first_name, d.patient_last_name, d.patient_name, d.patient_city, d.patient_dob, 
d.age, d.patient_cell_num, d.data_entry_date, d.patient_address, d.patient_email, c.visit_date
FROM prescribed_cf a, prescription b, visit c, patient d, clinical_impression e
WHERE e.TYPE ='".$ci."'
and e.ID = a.clinical_impression_id
and a.prescription_id=b.prescription_id
and b.visit_id = c.visit_id
and c.patient_id = d.patient_id
ORDER BY d.patient_first_name ASC";




//echo $sql1;

//$sql1 = "select * from patient where != ''".$where;
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
        <td class='head_tbl'>Sex</td>
        <!--<td class='head_tbl'>Patient ID</td>-->
        <td class='head_tbl'>First Name</td>
        <td class='head_tbl'>Last Name</td>
        <td class='head_tbl'>Date of Birth</td>
        <td class='head_tbl'>Mobile No</td>
        
        <!--<td class='head_tbl'>Street Address</td>-->
        
        <td class='head_tbl'>City / Town</td>
        <td class='head_tbl'>Visit Date</td>
        
        <!--<td class='head_tbl'>ACTION</td>-->
        </tr>";
        
        
        while($d1 = mysql_fetch_array($result1)){
           echo "<tr>
                <td class='odd'>".$d1['GENDER']."</td>
                <!--<td class='odd'><a href='processData.php?patient_id=".$d1['patient_id']."' class='vlink'>".$d1['patient_id']."</a></td> -->
                <td class='odd'>".$d1['patient_first_name']."</td>
                <td class='odd'>".$d1['patient_last_name']."</td>
                    

                        
                <td class='odd'>";
           $update= new admin(); 
                        if($d1['age'] == 0){
                            print $update->calcAge1($d1['patient_dob'], $d1['visit_date']) ;
                        }else {
                            echo $d1['age'];
                        }
                        
                echo "</td>
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
*/
?>