<?php


function sys_logger($data)
	{
		$channel = trim($data[2]);
		$hashtag = strpos($channel,"#");
		if ($hashtag == 1)
		{
			$channel = substr($channel,1);
		}
		if (strpos($channel,"#") == 0)
		{
			$log = "logs/". $channel.".log";		
			$nums = count($data);
			$usertxt = "";
			if(trim(get_nick($data)) != null)
			{
				for ($i = 3; $i < $nums; $i++)
				{
					$usertxt .= $data[$i]." ";
				}
				if ($usertxt != " " or $usertxt != "")
				{
					$parseline = "[".date("H:i:s")."]"." ".get_nick($data)."@".$channel." > ".trim($usertxt)."\n";

					$fp = fopen($log, "a");
					fwrite($fp, $parseline);
					fclose($fp);
				}
			}
		}

	}



?>
