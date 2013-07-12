<?
#SimpleStats
function stats($data)
	{	
		if(isset($data[4]))
		{
			$nick = trim($data[4]);
			$counts = "";
			$log = "logs/logger.log";
			if (file_exists($log))
			{
				$fh = fopen($log, "r");
				while (!feof($fh)) 
				{
					$line = fgets($fh);
					$parts = explode(" ", $line);
					if(isset($parts[2]))
					{
						$name = strstr($parts[2], "@", true); 
						if (trim($name) == $nick)
						{
							$counts = $counts+1;
						}
					}
					if ($line === false) 
					{
						#some error handling ?
				 	}
				}
			} 
			if($counts != "")
			{
				return $nick." has written ".$counts." lines";
			} 
			else 
			{
				return "I dont remember ".$nick." being active on this channel";
			}
		} else { return "Usage: !stats <nick>"; }
		
	}


?>
