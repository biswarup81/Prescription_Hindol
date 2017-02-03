<?php
$q=$_GET["q"];

include("inc/config.php");

$sql = "select * from patient where patient_id = ".$q;
$result = mysql_query($sql) or die(mysql_error());
$no = mysql_num_rows($result);
if($no > 0){
$d = mysql_fetch_object($result);

/*echo "<table border="0">
	  <tr>
		<td>Patient ID :</td>
		<td>$q</td>
	  </tr>
	  <tr>
		<td>Name :</td>
		<td>$d->patient_first_name $d->patient_last_name</td>
	  </tr>
	  <tr>
		<td>Address :</td>
		<td>$d->patient_address</td>
	  </tr>
	  <tr>
		<td>City :</td>
		<td>$d->patient_city</td>
	  </tr>
	  <tr>
		<td>DOB :</td>
		<td>$d->patient_dob</td>
	  </tr>
	  <tr>
		<td>Mobile No :</td>
		<td>$d->patient_cess_num</td>
	  </tr>
	  <tr>
		<td>Mobile No (II) :</td>
		<td>$d->patient_alt_cell_num</td>
	  </tr>
	  <tr>
		<td>Patient Email :</td>
		<td>$d->patient_email</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	</table>";*/
	echo "Success";
}else{
	echo "No Result Found";
}