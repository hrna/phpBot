<?

function fmi($data) 
{
	$saa = "";
	$dom = new DOMDocument();
	@$dom->loadHTMLFile("http://ilmatieteenlaitos.fi/saa/".$data[4]);

	$xpath = new DOMXPath($dom);

		foreach ($xpath->query('//span[contains(@class,"parameter-name-value")]') as $tag) {
    		//print_r($tag);
    		$saa .= trim($tag->nodeValue)." - ";
		}
		return $saa;
}
