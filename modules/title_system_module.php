<?

function sys_title($data, $config)
{

require_once("lib/simple_html_dom.php");

$url = $data;

if ($config["config"]["debug"] == "true")
{
	echo "DEBUG: ".$url."\r\n";
	echo "DEBUG: ".preg_match('/\.(jpg|jpeg|png|gif|pdf|exe|zip)(?:[\?\#].*)?$/i', $url)."\r\n";
}

#tarkastetaan URL
if (preg_match('/\.(jpg|jpeg|png|gif|pdf|exe|zip)(?:[\?\#].*)?$/i', $url) !== true && filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) !== false)
{
	#ini_set("user_agent","Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:24.0) Gecko/20100101 Firefox/24.0");

 	$curl = curl_init(); 
 	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:24.0) Gecko/20100101 Firefox/24.0");
	curl_setopt($curl, CURLOPT_URL, $url);  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);  
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
	$str = curl_exec($curl);  
	curl_close($curl); 
	
	if (!empty($str)) {
	
 	$html = str_get_html($str);
	
 	foreach($html->find('title') as $element)
 	{
 		$title = trim($element->plaintext);
 		$title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');
 		return "~ ".$title;
	}
	}
} else { return null; }
}

?>
