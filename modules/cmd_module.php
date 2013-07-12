<?php

function cmd($data, $config) 
{
	$cmd = "";
	foreach ($config["modules"] as $mod)
	{
		if ($mod != "get_nick")
		{
		$cmd .= "!".$mod." ";
		}
	}
	return get_nick($data).": käytössä olevat komennot ovat: ".$cmd." ";

}


?>
