<?php
require 'config/db.php';
session_start();

//redirect function
function returnheader($location){
	$returnheader = header("location: $location");
	return $returnheader;
}

// destroy cookies and sessions
setcookie("userloggedin", "");
$username = "";
session_destroy();

//redirect
returnheader("index.php");

?>