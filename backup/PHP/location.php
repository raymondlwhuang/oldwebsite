<?php
include("geoip.inc");
include("geoipcity.inc");
include("geoipregionvars.php");
function getIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    // Check if the IP is passed from a proxy.
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
$ip = getIpAddr();
$gi = geoip_open("GeoLiteCity.dat", GEOIP_STANDARD);
$rsGeoData = geoip_record_by_addr($gi, $ip);
geoip_close($gi);	
print "<pre>";
print_r($rsGeoData);
print "</pre>";
$location =  $rsGeoData->city.','.$rsGeoData->region;
echo $location;
?>		