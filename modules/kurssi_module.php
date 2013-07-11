<?php

function kurssi($data)
	{
	if (is_numeric($data[4]))
	{
		ini_set("user_agent","Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:24.0) Gecko/20100101 Firefox/24.0");	
		$amount = $data[4];			
		$from = $data[5];
		$to = $data[6];
		if ((!is_numeric($from)) and ($from != "") and (!is_numeric($to)) and ($to != ""))
		{
			$dom = new DOMDocument();
			@$dom->loadHTMLFile("https://www.google.com/finance/converter?a=".$amount."&from=".$from."&to=".$to."");

			$xpath = new DOMXPath($dom);

			foreach ($xpath->query('//div[contains(@id,"currency_converter_result")]') as $tag) {
			$result = "";
			$result .= trim($tag->nodeValue);
			return $result;
			}
		}
    }
    }
    
?>