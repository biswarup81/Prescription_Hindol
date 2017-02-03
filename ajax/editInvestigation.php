<?php

include "../datacon.php";

$investID = $_GET["investID"];
$mode = $_GET["MODE"];

if($mode == 'DELETE'){

    $query = "UPDATE investigation_master SET STATUS='INACTIVE' where 
                ID = '".$investID."'";

    mysql_query($query)or die(mysql_error());

    include 'searchInvestigation.php';
    
} else if($mode == 'EDIT'){	
    $sql1 = "select * from investigation_master where 
                ID = '".$investID."' 
                and STATUS = 'ACTIVE' ";
    $result1 = mysql_query($sql1)or die(mysql_error());
    $no = mysql_num_rows($result1);
    echo "<table width='600' border='0' cellspacing='0' cellpadding='0'>";
      echo "<td class='head_tbl'>Investigation Name</td>
       
        <td class='head_tbl'>ACTION</td>
        </tr>";
   while($d1 = mysql_fetch_array($result1)){
           echo "<tr>
                <td class='odd'> <input type='text' id='inv_name' value='".$d1['investigation_name']."' ></td>
                 <td class='odd'> 
					<select name='investigation_type' id='investigation_type'>
						<option value='TYPE1'>Diabetes</option>
						<option value='TYPE2'>Thyroid</option>
						<option value='TYPE3'>Hypertension</option>
						<option value='TYPE4'>PCOS/Hirsutism</option>
						<option value='TYPE5'>Short Stature</option>
						<option value='TYPE6'>Hypogonadism</option>
						<option value='TYPE7'>Infertility</option>
						<option value='TYPE8'>Precocity</option>
						<option value='TYPE9'>Achenol</option>
						<option value='TYPE10'>Bone</option>
						<option value='TYPE11'>Lung GI</option>
						<option value='TYPE12'>Sexual</option>
						<option value='TYPE13'>Others</option>
					</select>
				</td>
                <td class='odd'>
                    <input type='button' onclick='upDateInvest(".$d1['ID'].") ' class='vlink' value = 'UPDATE'>
                </td>
            </tr>";
            
        }
} else if($mode == 'UPDATE'){
    $inv_name = $_GET["inv_name"];
	$inv_type = $_GET["inv_type"];
    $query = "UPDATE investigation_master SET investigation_name='".$inv_name."' , investigation_type= '".$inv_type."' where 
                ID = '".$investID."'";

    //echo $query;
    mysql_query($query)or die(mysql_error());

    include 'searchInvestigation.php';
    
} 

?>
