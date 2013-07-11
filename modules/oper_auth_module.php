<?php
function oper_auth($data, $config) 
	{
		$host = strstr($data[0], "!");
		$host = substr($host, 1);
		#print_r($config["opers"]);
		#echo $host."\r\n";
		
		$temp = in_array($host, $config["opers"]);
		#echo $temp;
		if ($temp == true)
		{
			return true;
		} else {
		
			return false;
		}
	
	}
?>
