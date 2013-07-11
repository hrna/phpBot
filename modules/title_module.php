<?

function title($data)
{

require_once("lib/simple_html_dom.php");

#$reg_exp = "@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i";

#tuleeko kanavalta, ei komentona
if (trim($data[3]) != ":!title") {
	$url = trim(substr($data[3], 1));
} else {	
	$url = trim($data[4]);
}

#onko URL oikean muotoinen
//if(preg_match($reg_exp, $url) == TRUE)
//{

#lisätään http:// jos ei ole
if(substr($url, 0, 7) != "http://" && substr($url, 0, 8) != "https://")
{
	$url = "http://".$url;
}

#tarkastetaan URL
if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) !== false)
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
 	$html = str_get_html($str);
 	
 	foreach($html->find('title') as $element)
 	{
       return "Title: ".trim($element->plaintext);
	}
} 

//} else {
//	return "Invalid URL";
//}
}

?>