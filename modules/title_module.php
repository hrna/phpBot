<?

function title($data)
{

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
#echo filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
#tarkastetaan URL
if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) !== false)
{
	ini_set("user_agent","Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:24.0) Gecko/20100101 Firefox/24.0");
	$dom = new DOMDocument();
	#echo $url;
	$dom->strictErrorChecking = FALSE;
	@$dom->loadHTMLFile($url);
	#echo $dom->saveHTML();
	// find the title
	$titlelist = $dom->getElementsByTagName("title");
	print_r($titlelist);
	if($titlelist->length > 0){
  		return "Title: ".$titlelist->item(0)->nodeValue;
 	}

} 

//} else {
//	return "Invalid URL";
//}
}


?>