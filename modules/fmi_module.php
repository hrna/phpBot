<?

function fmi($data) 
{
if(!isset($data[4]))
{
	return "Usage: !fmi city";
} else {

	include("data/cities_fi.php");
	
	ini_set("user_agent","Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:24.0) Gecko/20100101 Firefox/24.0");
	$saa = ucfirst($data[4]);
	
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
    			$saa .= " klo ".substr($tag->nodeValue,10,5).": ";
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

?>