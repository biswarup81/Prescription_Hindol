<?php
include("inc/config.php");
$MEDICINE_ID = $_GET['MEDICINE_ID'];
$PRESCRIPTION_ID = $_GET['PRES_ID'];
mysql_query("delete from precribed_medicine where MEDICINE_ID = '$MEDICINE_ID' and PRESCRIPTION_ID ='$PRESCRIPTION_ID'") or die(mysql_error());

$result = mysql_query("select * from precribed_medicine where PRESCRIPTION_ID ='$PRESCRIPTION_ID'" );
echo "<table width='100%'>";
while($d = mysql_fetch_object($result)){
	echo "<tr>";
	echo "<td class='odd_tb' width='400'>".$d->MEDICINE_NAME."</td>";
	echo "<td class='odd_tb' align='center' width='149'>".$d->MEDICINE_DOSE."</td>";
        echo "<td class='odd_tb' align='center' width='150'>".$d->MEDICINE_DIRECTION."</td>";
	echo "<td class='odd_tb' align='center' width='150'>".$d->MEDICINE_TIMING."</td>";
	//echo "<td class='odd_tb'  align='center'><a href=''>Edit</a></td>";
        
	echo "<td class='odd_tb' align='center'>
          <a id='minus7' href='#' onclick='del($d->MEDICINE_ID ,$PRESCRIPTION_ID )'>[-]</a> </td> ";
	echo "</tr>";
}
echo "</table>";
?>
