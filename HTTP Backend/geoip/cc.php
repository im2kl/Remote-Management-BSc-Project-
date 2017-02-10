<?php
$ip = "81.133.125.18";
// This code demonstrates how to lookup the country by IP Address

		//
		include("geoip/geoip.inc");
		
		$gi = geoip_open("geoip/geo.dat", GEOIP_STANDARD);
		
		$flag = geoip_country_code_by_addr($gi, $wan) . "\t" .
		$country =  geoip_country_name_by_addr($gi, $ip) . "\n";
		
		geoip_close($gi);



/*



include("geoip.inc");
// Uncomment if querying against GeoIP/Lite City.
// include("geoipcity.inc");
$gi = geoip_open("geo.dat", GEOIP_STANDARD);
echo geoip_country_code_by_addr($gi, $ip) . "\t" .
//  geoip_country_name_by_addr($gi, $ip) . "\n";
geoip_close($gi); */
?>