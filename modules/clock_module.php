<?

function clock($data, $config) {

require_once("lib/simple_html_dom.php");

	date_default_timezone_set('Europe/Helsinki'); #hide notice about the timezone
	
	if(!isset($data[4])) {
		return "World Clock - Usage: !clock <city>";
	}
	$city = ucfirst($data[4]);
	if(isset($data[5])) { $city .= " ".$data[5]; }
	if(isset($data[6])) { $city .= " ".$data[6]; }

	$url = "http://dateandtime.info/citysearch.php?city=".$city;

 	$curl = curl_init(); 
 	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)");
	curl_setopt($curl, CURLOPT_URL, $url);  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);  
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
	$str = curl_exec($curl);  
	curl_close($curl); 
	
	if (!empty($str)) {
	
 	$html = str_get_html($str);
	
	$str = $html->find('time[class=dhms]');
	
	#If got redirected to the city page, we get other class
	if (empty($str)) {
		$str = $html->find('time[class=hms_fulldate results]');
	}
 		$temp = $str[0]->datetime;
 		$temp2 = substr_replace($temp," ",11,0);
 		$temp2 = substr($temp, 0, -6); 
 		$time = date("l H:i", strtotime($temp2));
 		return "Time in ".trim($city).": ".$time;
	}

}

?>
