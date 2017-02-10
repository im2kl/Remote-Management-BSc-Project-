<?php
	session_start();
	require_once("user.cookies.php");
	$user_name = $_SESSION["SESS_USERNAME"]
?>
<?php
	
	include 'config/db.php';
	$errors = array();
	
	if(isset($_POST["iebugaround"])){
		
		//lets fetch posted details
		$uname = trim(htmlentities($_POST['task']));
		$rname = trim(htmlentities($_POST['params']));
		
		//all checks are ok, insert
		mysql_query("INSERT INTO `tasks` (`task_id`, `task`, `tparam`) VALUES (NUll, '$uname', '$rname')") or die(mysql_error());
		
		
		returnheader("task.php");
		
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
					<div class="sets_sec_tit"><h3>Add Tasks</h3></div>
					<div class="sets_sec_con">
						
						<!-- display all of the tasks available on the database
						-->
						
						<form action="#" method="post">
							<input name="iebugaround" type="hidden" value="1"> 
							<label>Select Task:</label>
							<select id="task" name="task">                      
								<option value="msg">Message Box</option>
								<option value="t1">Task[1]</option>
								<option value="t2">Task[2]</option>
							</select></br>
							<label>Task Parameters</label>	
							<input type="text" name="params" value="params"/>
							<!-- br line-->
							<br>
							<input name="submit" id="submit" value="Submit" type="submit"/>
						</form>
						
					</div>
				</section>
				
				<section class="sets_sec">
					<div class="sets_sec_tit"><h3>Current Task</h3></div>
					<div class="sets_sec_con">
						
						<!-- add new task
							
							set this back to a bigger screen as more tasks need to be added and space for them to be shown
						-->
							<?PHP
								
								include 'config/db.php';
								
								$sql = "SELECT * FROM `tasks`";
								$query = mysql_query($sql);
								echo'ID:Task:Params</br>';
								while ($row=mysql_fetch_array($query)){
									
									echo'ID: '. $row['task_id']. ' 
									Task: '. $row['task']. ' 
									Params: '. $row['tparam'].'  </br>
									';
								}
							?>

						</div>
					</section>
					
					<div id="cop">
						<h3>&copy;Cybortech.co.uk Author:M2K</h3>
					</div>
					
				</section>
			</div>
		</body>
	</html>
