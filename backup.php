<?php

$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$dbname = 'doctors';


$backup_file = $dbname . date("Y-m-d-H-i-s") . '.gz';
$command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpass ".
           "doctors | gzip > $backup_file";

system($command);

?>
