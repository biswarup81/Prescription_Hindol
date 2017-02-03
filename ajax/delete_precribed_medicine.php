<?php

include "../datacon.php";
$MEDICINE_ID = $_GET['MEDICINE_ID'];
$PRESCRIPTION_ID = $_GET['PRES_ID'];
mysql_query("delete from precribed_medicine where MEDICINE_ID = '$MEDICINE_ID' and PRESCRIPTION_ID ='$PRESCRIPTION_ID'") or die(mysql_error());

$result = mysql_query("select * from precribed_medicine where PRESCRIPTION_ID ='$PRESCRIPTION_ID'" );
echo "<table id='table-3'>";
while($d = mysql_fetch_object($result)){
	echo "<tr>
                <td>
                    <img src='images/stock_list_bullet.png'/>&nbsp;<strong>".$d->MEDICINE_NAME."</strong>&nbsp;<img src='images/arrow-right.png' />
                                        <i>".$d->MEDICINE_DOSE."</i></td>";
       
	//echo "<td class='odd_tb'  align='center'><a href=''>Edit</a></td>";
        
	echo "<td align='center' width='90'>
          <a id='minus7' href='#' onclick='del($d->MEDICINE_ID ,$PRESCRIPTION_ID )'>[-]</a> </td> ";
	echo "</tr>";
}
echo "</table>";
?>