<?php

function cmd($data, $config) 
{
	$nick = get_nick($data);
	foreach ($config["modules"] as $mod)
	{
		if ($mod != "get_nick")
		{
		$komennot .= "!".$mod." ";
		}
	}
	return $nick.": käytössä olevat komennot ovat: ".$komennot." ";

}


?>
