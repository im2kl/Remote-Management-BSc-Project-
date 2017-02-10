<?php
	require 'config/db.php';
	
	session_start();
	
	//redirect function
	function returnheader($location){
		$returnheader = header("location: $location");
		return $returnheader;
	}
	
	$errors = array();
	
	if(isset($_POST["iebugaround"])){
		//lets fetch posted details
		$uname = trim(htmlentities($_POST['usern']));
		$passw = trim(htmlentities($_POST['passw']));
		
		//check username is present
		if(empty($uname)){
			//let echo error message
			$errors[] = "Input Username";	
		}
		
		//check password was present
		if(empty($passw)){
			//let echo error message
			$errors[] = "Input Password";
		}
		
		if(!$errors){
			
			//encrypt the password
			$passw = sha1($passw);
			$salt = md5("userlogin");
			$pepper = "kikikikikicbtr";
			
			
			$passencrypt = $salt . $passw . $pepper;
			
			//find out if user and password are present
			$query = "SELECT * FROM users WHERE username='$uname' AND password='$passencrypt'";
			$result = mysql_query($query) OR die(mysql_error());
			
			$result_num = mysql_num_rows($result);
			
			if($result_num > 0){
				
				while($row = mysql_fetch_array($result)){
					
					$idsess = stripslashes($row["id"]);
					$username = stripslashes($row["username"]);
					
					$_SESSION["SESS_USERID"] = $idsess;
					$_SESSION["SESS_USERNAME"] = $username;
					
					setcookie("userloggedin", $username);
					setcookie("userloggedin", $username, time()+43200); // expires in 1 hour
					$errors[] = "sdfsfsd";
					//success lets login to page
					returnheader("dash.php");
				}
				} else {
				//tell there is no username etc
				$errors[] = "Incorrect Credentials";
			}
		}
		
		} else {
		
		$uname = "";
		
	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>CyborTech</title>
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<link href="css/login.css" type="text/css" rel="stylesheet">
		
		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script type='text/javascript' src='scripts/respond.min.js'></script>
	</head>
	<body>
		<div id="wrapper">
			<header>						
				<h1>CyborTech</h1>
			</header>	
			
			<section id="main" >
				
				<?php
					if(count($errors) > 0){
						foreach($errors as $error){
							echo "<h1>" .$error . "</h1>";
						}
						} else {
						echo "<h1>Login</h1>";
					}
				?>
				
				<!-- Login form -->
				<form method="post" action="#">
					<input name="iebugaround" type="hidden" value="1"> 
					<label>Username:</label><input id="passw" type="text" name="usern" value="<?php echo $uname ; ?>"><br>
					<label>Password:</label><input id="passw" type="password" name="passw"><br>
					<input id="subm" type="submit" value="Submit">
				</form>
				
			</section>
		</div>
	</body>
</html>
