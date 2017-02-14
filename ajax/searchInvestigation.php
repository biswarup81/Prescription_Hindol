<?php

require_once "../datacon.php";

$invest_name = $_GET["invest_name"];




$sql1 = "select * from investigation_master where investigation_name like '".$invest_name."%' 
        and STATUS = 'ACTIVE' ";
$result1 = mysqli_query($con,$sql1)or die(mysqli_error());
$no = mysqli_num_rows($result1);
echo "<table width='888' border='0' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='bg_tble'>                    
            <table width='100%' border='1' cellspacing='1' cellpadding='0'>";    
if($no > 0){
        
        echo "<tr>
        <td class='head_tbl'>Investigation Name</td>
		<td class='head_tbl'>Type</td>
        <td class='head_tbl'>ACTION</td>
        </tr>";
        
        
        while($d1 = mysqli_fetch_array($result1)){
           echo "<tr>
                <td class='odd'>".$d1['investigation_name']."</td>
                <td class='odd'>".$d1['investigation_type']."</td>
                <td class='odd'><a href='#' onclick='editInvest(".$d1['ID'].") ' class='vlink'>EDIT</a>
                    <a href='#' onclick='deleteInvest(".$d1['ID'].") ' class='vlink'>DELETE</a>
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
