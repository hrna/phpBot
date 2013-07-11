<?php

function op ($data, $config)
	{
		if (in_array(get_nick($data), $config["opers"]))
		{
			$mode = "MODE ".$data[2]." +o ".$data[4]."\r\n";
			return $mode;
		} else {
			return get_nick($data).", Ei taida sun natsat riittää :(\r\n"; 
		}
	}			

?>
