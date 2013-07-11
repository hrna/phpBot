<?php

function op ($data, $config)
	{
		if (oper_auth($data,$config))
		{
			if (isset($data[4]))
			{
				$mode = "MODE ".$data[2]." +o ".$data[4]."\r\n";
				return $mode;
			} else {
				$msg = "Usage: !op <nick>";
				return $msg;	
			}
		} else {
			return get_nick($data).", Ei taida sun natsat riittää :(\r\n"; 
		}
	}			

?>
