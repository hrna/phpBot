<?php

function op ($data, $config)
	{
		if (oper_auth($data,$config))
		{
			$mode = "MODE ".$data[2]." +o ".$data[4]."\r\n";
			return $mode;
		} else {
			return get_nick($data).", Ei taida sun natsat riittää :(\r\n"; 
		}
	}			

?>
