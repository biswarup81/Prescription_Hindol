<?php

require_once "../datacon.php";

$strMedicineName = $_GET["medicine_name"];




$sql1 = "select * from medicine_master where medicine_name like '".$strMedicineName."%' 
        and MEDICINE_STATUS = 'ACTIVE' ";
$result1 = mysqli_query($con,$sql1)or die(mysqli_error());
$no = mysqli_num_rows($result1);
echo "<table width='888' border='0' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='bg_tble'>                    
            <table width='100%' border='0' cellspacing='1' cellpadding='0'>";    
if($no > 0){
        
        echo "<tr>
        <td class='head_tbl'>Medicine Name</td>
       
        <td class='head_tbl'>ACTION</td>
        </tr>";
        
        
        while($d1 = mysqli_fetch_array($result1)){
           echo "<tr>
                <td class='odd'>".$d1['MEDICINE_NAME']."</td>
                
                <td class='odd'><a href='#' onclick='editMedicine(".$d1['MEDICINE_ID'].") ' class='vlink'>EDIT</a>
                    <a href='#' onclick='deleteMedicine(".$d1['MEDICINE_ID'].") ' class='vlink'>DELETE</a>
                </td>
            </tr>";
            
        }
    }else{
            echo "<tr><td colspan='2' align='center' style='color:red'> No Result found.</td></tr>";
    }
    echo "</table>
       </td>
    </tr>
</table>";

?>
