<?
#SimpleStats
function stats($data)
	{	
		if(isset($data[4]))
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
				$nick = trim($data[4]);
				$counts = "";
					
				if (file_exists($log))
				{
					$fh = fopen($log, "r");
					while (!feof($fh)) 
					{
						$line = fgets($fh);
						$parts = explode(" ", $line);print_r($parts);
						if(isset($parts[2]))
						{
							$name = strstr($parts[2], "@", true); 
							if (trim($name) == $nick)
							{
								$counts = $counts+1;
							}
						} else {  }
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
			 }
		} else { return "Usage: !stats <nick>"; }
		
	}


?>
