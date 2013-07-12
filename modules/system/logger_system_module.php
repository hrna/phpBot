<?php


function sys_logger($data)
	{
		$log = "logs/logger.log";		
		$nums = count($data);
		$usertxt = "";
		for ($i = 3; $i < $nums; $i++)
		{
			$usertxt .= $data[$i]." ";
		}
		$parseline = "[".date("H:i:s")."]"." ".get_nick($data)."@".$data[2]." > ".$usertxt;

		$fp = fopen($log, "a");
		fwrite($fp, $parseline);
		fclose($fp);

	}



?>
