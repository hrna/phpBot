<?php


function sys_logger($data)
	{
		ini_set("auto_detect_line_endings", true);
		$previous ="";
		$log = "modules/data/log.txt";		
		$fp = fopen($log, "r");
		while(!feof($fp))
		{
			$previous .= fgets($fp)."\r\n";
			echo $previous."\r\n";
		}
		fclose($fp);

		$nums = count($data);
		$usertxt = "";
		for ($i = 3; $i < $nums; $i++)
		{
			$usertxt .= $data[$i]." ";
		}
		$parseline = get_nick($data)."@".$data[2]." > ".$usertxt."\r\n";

		$fp = fopen($log, "w");
		fwrite($fp, $previous);
		fwrite($fp, $parseline);
		fclose($fp);
		echo "MOTHER FUCKAS\r\n";

	}



?>
