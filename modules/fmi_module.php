<?

function fmi($data) 
{
	$saa = ucfirst($data[4]);
	echo $saa;
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
    		//print_r($tag);
    		$saa .= " klo ".substr($tag->nodeValue,10,5).": ";
		}

		foreach ($xpath->query('//span[contains(@class,"parameter-name-value")]') as $tag) {
    		//print_r($tag);
    		$saa .= trim($tag->nodeValue)." - ";
		}
		$saa = str_replace(array("\n", "\r"), '', $saa);
		return $saa;
}
