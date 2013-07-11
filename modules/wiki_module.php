<?php
function wiki($haku)
		{
		if (!isset($haku[4]))
		{
			return "Usage: !wiki MS Silja Europa";
		} else {
		
			$result = "";
			$string_num = count($haku);
			
			for ($i = 4; $i < $string_num; $i++)
			{
					$result .= $haku[$i]."_"; 	
			}				
			return "http://en.wikipedia.org/wiki/".ucfirst($result); #Eka kirjain isoksi
		}
		}
?>
