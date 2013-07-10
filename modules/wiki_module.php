<?php
function wiki($haku)
		{
		if (!isset($haku[4]))
		{
			return "Usage: !wiki MS Silja Europa";
		} else {
			$string_num = count($haku);
			$result = array();
			for ($i = 4; $i < $string_num; $i++)
			{
				if (isset($haku[$i])) 
				{
					$result[$i] .= $haku[$i]; #PHP Notice:  Undefined offset: 4 on line 14, En keksi, sylkee silti :(
				}
			}				
			$result = implode("_",$result);
			$result = "http://en.wikipedia.org/wiki/".ucfirst($result); #Eka kirjain isoksi
			return $result;
		}
		}
?>
