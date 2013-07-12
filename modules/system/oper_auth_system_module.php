<?php
function oper_auth($data, $config) 
	{
		$host = strstr($data[0], "!");
		$host = substr($host, 1);
		
		$temp = in_array($host, $config["opers"]);

		if ($temp == true)
		{
			return true;
		} else {
		
			return false;
		}
	
	}
?>
