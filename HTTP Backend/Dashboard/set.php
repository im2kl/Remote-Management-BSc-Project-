<?php
	session_start();
	require_once("user.cookies.php");
	$user_name = $_SESSION["SESS_USERNAME"]
?>
<?php

	require 'config/db.php';
	

	
	$errors = array();
	
	if(isset($_POST["iebugaround"])){
		
		//lets fetch posted details
		$uname = trim(htmlentities($_POST['username']));
		$rname = trim(htmlentities($_POST['realname']));
		$passw1 = trim(htmlentities($_POST['password']));
		
		
		//encrypt the password
		$rpass = sha1($passw1);
		$salt = md5("userlogin");
		$pepper = "kikikikikicbtr";
		
		$passencrypt = $salt . $rpass . $pepper;
		
		//check for username
		$sql = mysql_query("SELECT * FROM `Users` WHERE `Username` = '$uname'");
		if(mysql_num_rows($sql) > 0){
			$errors[] = "Username is taken";
			exit();
		}
		
		//all checks are ok, insert
		mysql_query("INSERT INTO `users` (`id`, `username`, `password`, `firstname`) VALUES (NUll, '$uname', '$passencrypt', '$rname')") or die(mysql_error());
		
		
		returnheader("set.php");
		
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>CyborTech</title>
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<link href="css/sets.css" type="text/css" rel="stylesheet">
		
		<script src="scripts/jquery-1.7.2.min.js"></script>
		
		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script type='text/javascript' src='scripts/respond.min.js'></script>
	</head>
	<body>
		<div id="wrapper">
			<header>
				
				<h1>CyborTech</h1>
				
				<nav>
					<ul>
						<li class = "navli"><a href="dash.php" title="Home">Dashboard</a></li>
						<li class = "navli"><a href="task.php" title="About">Tasks</a></li>
						<li class = "navli"><a href="set.php" title="Work">Settings</a></li>
						<!-- use php to work out the login and logout script-->
						<li class = "navli"><a href="logout.php" title="Contact">Logout</a></li>
					</ul>
				</nav>
				
			</header>	
			
			<section id="main" >
				
				<!-- page settings-->
				<section class="sets_sec">
					<div class="sets_sec_tit"><h3>Add User</h3></div>
					<div class="sets_sec_con">
						
						<!-- Set form for password and other settings 
							this can include:
							~ password bigger than 5 digits letters and numbers only
							~ possably add usernames or single passwords assosiated with a name
							
						-->
						<form action="#" method="post">
							<input name="iebugaround" type="hidden" value="1"> 
							
							<label>Login</label>
							
							<input type="text" name="username" value="asd"/>
							</br>
				            <label>Real Name</label>
							<input type="text" name="realname" value="real_name"/>
							</br>
				            <label>Password</label>
							<input type="password" name="password" />
							</br>
							<input name="submit" id="submit" value="Submit" type="submit"/>
							
						</form>
						
					</div>
				</section>
				
				<!-- Availale users settings-->
				<section class="sets_sec">
					<div class="sets_sec_tit"><h3>Current Accounts</h3></div>
					<div class="sets_sec_con">
						
						<!-- Set form for password and other settings 
							this can include:
							~ password bigger than 5 digits letters and numbers only
							~ possably add usernames or single passwords assosiated with a name
							
						-->
						
						<?PHP
							
							include 'config/db.php';
							
							$sql = "SELECT * FROM `users`";
							$query = mysql_query($sql);
							echo'Username:Name</br>';
							while ($row=mysql_fetch_array($query)){								
								echo'User: '. $row['firstname']. ' Name: '. $row['firstname']. '</br>';
							}
						?>
						
					</div>
				</section>
				
				<section class="sets_sec">
					<div class="sets_sec_tit"><h3>Bot Settings</h3></div>
					<div class="sets_sec_con">
						
						<!-- Set form for bot settings 
							this can include:
							~bots per page
							~bot cleanup od dead status bots
							
						-->
						Future Development </br>
						~bots per page</br>
						~bot cleanup od dead status bots</br>
						
					</div>
				</section>
				
				<div id="cop">
					<h3>&copy;Cybortech.co.uk Author:M2K</h3>
				</div>
				
			</section>
		</div>
	</body>
</html>
