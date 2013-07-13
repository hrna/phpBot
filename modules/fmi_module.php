<?

function fmi($data) 
{
if (isset($data[4]) == "set" && isset($data[5])) {
	sys_setuserCity(get_nick($data), ucfirst($data[5]));
	return "Kaupunkisi ".ucfirst(trim($data[5]))." on tallennettu!";
}else {

$user_city = sys_getuserCity(get_nick($data));

if(!isset($data[4]) && $user_city == null)
{
	return "Usage: !fmi <city> - !fmi set <city>";
} else {

	include("data/cities_fi.php");
	
	ini_set("user_agent","Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)");
	
	if ($user_city == null || isset($data[4]) && $data[4] != $user_city) { $saa = ucfirst($data[4]); } else { $saa = $user_city; }
	
		if (sys_searchforCity($saa, $cities_fi) != NULL) # Onko kaupunki olemassa?
		{
			$dom = new DOMDocument();
	
			if (preg_match("/Helsinki/i", $saa) == TRUE)
			{
				@$dom->loadHTMLFile("http://ilmatieteenlaitos.fi/saa/".$saa."&station=100971");
			}else if(preg_match("/Oulu/i", $saa) == TRUE) {
				@$dom->loadHTMLFile("http://ilmatieteenlaitos.fi/saa/".$saa."&station=101799");
			}
			else {
				@$dom->loadHTMLFile("http://ilmatieteenlaitos.fi/saa/".$saa);
			}
		
			$xpath = new DOMXPath($dom);

			foreach ($xpath->query('//span[@class="time-stamp"]') as $tag) {
				$temp = explode(" ", $tag->nodeValue);
    			$saa .= " klo ".substr($temp[1], 0, -6).": ";
			}

			foreach ($xpath->query('//span[contains(@class,"parameter-name-value")]') as $tag) {
    			$saa .= trim($tag->nodeValue)." - ";
			}
			$saa = str_replace(array("\n", "\r"), '', $saa);
			return substr($saa, 0, -2); #remove last - 
		}else {
			return "Virheellinen kaupunki";
		}
	}
}#alku else
}

#onko kaupunki olemassa
function sys_searchforCity($city, $array) {

   foreach ($array as $key => $val) {
       if ($val['city'] == trim($city)) {
           return $key;
       }
   }
   return null;
}

#käyttäjän asettama kapunki
function sys_getuserCity($nick) {

	$nick = trim($nick);
	$file = "modules/data/fmi_nicks.txt";
	$array = explode("\n", file_get_contents($file));
	foreach ($array as $line) { 
		if (strpos($line, $nick) === 0) 
		{
			$temp = explode(":", $line);
			return $temp[1]; 
		} 
	
	}
	
}

#Aseta käyttäjän kaupunki
function sys_setuserCity($nick, $city)
{

	$nick = trim($nick);
	$city = trim($city);
	$file = "modules/data/fmi_nicks.txt";
	$contents = file_get_contents($file);
	
	$temp = preg_match("!$nick:.*$!m", $contents); #onko nick tiedostossa?
	
	#jos ei niin appendataan nick ja kaupunki sinne
	if($temp == 0) {
		$contents = $nick.":".$city."\n";
		$fp = fopen($file, "a");
		if ($fp) {
			fwrite($fp, $contents);
			fclose($fp);
		}
	# Jos on niin modataan sen nickin kaupunki ja kirjotetaan tiedosto uudestaan ## performance?
	} else { 
		$contents = preg_replace("!$nick:.*$!m", "$nick:$city", $contents);	
		$fp = fopen($file, "w+");
		if ($fp) {
			fwrite($fp, $contents);
			fclose($fp);	
		}
	}

	return true;
}

?>