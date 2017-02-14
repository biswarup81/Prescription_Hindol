<?php 
session_start(); 
      
/* script to connect fo Mandir Database and pick up neccesary Information to display on screen */
      /* declare some relevant variables */
      $hostname = "localhost";
      $username = "root";
      $passwordsc = "";
      $dbName = "myepresc_hindol";

      $con = mysqli_connect($hostname,$username,$passwordsc,$dbName);

		if (!$con)
		  {
		  die('Could not connect: ' . mysqli_error());
		  }
?>