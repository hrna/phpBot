<?php
function oper_auth($data, $config) 
	{
		$host = strstr($data[0], "!");
		$host = substr($host, 1);
		#print_r($config["opers"]);
		#echo $host."\r\n";
		if (in_array($host, $config["opers"]))
		{
			return true;
		}
	
	}
?>
