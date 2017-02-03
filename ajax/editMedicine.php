<?php

require_once "../inc/config.php";

$medincineID = $_GET["medincineID"];
$mode = $_GET["MODE"];

if($mode == 'DELETE'){

    $query = "UPDATE medicine_master SET MEDICINE_STATUS='INACTIVE' where 
                MEDICINE_ID = '".$medincineID."'";

    mysql_query($query)or die(mysql_error());

    include 'searchMedicine.php';
    
} else if($mode == 'EDIT'){
    $sql1 = "select * from medicine_master where 
                MEDICINE_ID = '".$medincineID."' 
                and MEDICINE_STATUS = 'ACTIVE' ";
    $result1 = mysql_query($sql1)or die(mysql_error());
    $no = mysql_num_rows($result1);
    echo "<table width='600' border='0' cellspacing='0' cellpadding='0'>";
      echo "<td class='head_tbl'>Medicine Name</td>
       
        <td class='head_tbl' colspan='1'>ACTION</td>
        </tr>";
   while($d1 = mysql_fetch_array($result1)){
           echo "<tr>
                <td class='odd'> <input type='text' id='med_name' value='".$d1['MEDICINE_NAME']."' ></td>
                
                <td class='odd'>
                    <input type='button' onclick='upDateMedicine(".$d1['MEDICINE_ID'].") ' class='vlink' value = 'UPDATE'>
                </td>
            </tr>";
            
        }
} else if($mode == 'UPDATE'){
    $med_name = $_GET["med_name"];
    $query = "UPDATE medicine_master SET MEDICINE_NAME='".$med_name."' where 
                MEDICINE_ID = '".$medincineID."'";

    //echo $query;
    mysql_query($query)or die(mysql_error());

    include 'searchMedicine.php';
    
} 

?>
