<?php

$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];

include("inc/config.php");

$sql2 = "select * from precribed_medicine where PRESCRIPTION_ID = '$PRESCRIPTION_ID'";
$result = mysql_query($sql2) or die(mysql_error());

echo "<table width='100%'>";
while($d = mysql_fetch_object($result)){
	echo "<tr>";
	echo "<td class='odd_tb'>".$d->MEDICINE_NAME."</td>";
	echo "<td class='odd_tb'>".$d->MEDICINE_DOSE."</td>";
        echo "<td class='odd_tb'>".$d->MEDICINE_DIRECTION."</td>";
	echo "<td class='odd_tb'>".$d->MEDICINE_TIMING."</td>";
	//echo "<td class='odd_tb'  align='center'><a href=''>Edit</a></td>";
	echo "<td class='odd_tb' align='center'><a href='' onclick='del($d->MEDICINE_ID)' class='delete' id=$d->MEDICINE_ID><img src='images/delete.png'></a></td>";
	echo "</tr>";
}

?>