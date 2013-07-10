<?php
function wiki($haku)
		{
		if ($haku[4] == "")
		{
			return "Usage: !wiki MS Silja Europa";
		} else {
			$string_num = count($haku);
			$result = array();
			for ($i = 4; $i < $string_num; $i++)
			{
				if ($haku[$i] != "") 
				{
					$result[$i] .= $haku[$i]; #undefined offsetti, fixii tähä...
				}
			}				
			$result = implode("_",$result);
			$result = "http://en.wikipedia.org/wiki/".ucfirst($result); #Eka kirjain isoksi
			return $result;
		}
		}
?>
