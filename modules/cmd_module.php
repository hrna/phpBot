<?php

function cmd($data, $config) 
{
	foreach ($config["modules"] as $mod)
	{
		if ($mod != "get_nick")
		{
		$komennot .= "!".$mod." ";
		}
	}
	return get_nick($data).": käytössä olevat komennot ovat: ".$komennot." ";

}


?>
