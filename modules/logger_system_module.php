<?php


function sys_logger($data)
	{
		$log = "modules/data/log.txt";		
		$nums = count($data);
		$usertxt = "";
		for ($i = 3; $i < $nums; $i++)
		{
			$usertxt .= $data[$i]." ";
		}
		$parseline = get_nick($data)."@".$data[2]." > ".$usertxt;

		$fp = fopen($log, "a");
		fwrite($fp, $parseline);
		fclose($fp);

	}



?>
