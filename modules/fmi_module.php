<?

function fmi($data) 
{
	$saa = ucfirst($data[4]);
	$dom = new DOMDocument();
	@$dom->loadHTMLFile("http://ilmatieteenlaitos.fi/saa/".$data[4]);

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
