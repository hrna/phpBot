<?php

function op ($data, $config)
	{
		if (in_array(get_nick($data), $config["opers"]))
		{
			return send_data("MODE ".$data[2]." +o ".get_nick($data)."\r\n");
		} else { return get_nick($data).", Ei taida sun natsat riittää :(\r\n"; }
	}			
?>