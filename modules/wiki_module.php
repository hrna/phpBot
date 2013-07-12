<?php
function wiki($data)
		{
		if (!isset($data[4]))
		{
			return "Usage: !wiki MS Silja Europa";
		} else {
		
			$result = "";
			$string_num = count($data);
			
			for ($i = 4; $i < $string_num; $i++)
			{
					$result .= $data[$i]."_"; 	
			}				
			return "http://en.wikipedia.org/wiki/".ucfirst($result); #Eka kirjain isoksi
		}
		}
?>
