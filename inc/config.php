<?php
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB_NAME", "myepresc_hindol");

$con = mysql_connect(HOST, USER, PASSWORD) or die(mysqli_error());
mysql_select_db(DB_NAME, $con) or die(mysqli_error);



function query($a){
	$r = mysqli_query($con,$a) or die(mysqli_error());
	return $r;
}
?>