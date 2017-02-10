
<?php

$split = ';';

$DB_HOST = 'localhost';
$DB_USER = 'root'; 
$DB_PASSWORD = ''; 
$DB_NAME = 'cybortech'; //name of the database

// Make connection
$conn= @mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD); 
 if(!$conn) 
  {
	//display error if the database is not connected
	die('Did not connect to MySQL: ' . mysql_error()); 
  }

@mysql_select_db("$DB_NAME", $conn); 
?>
