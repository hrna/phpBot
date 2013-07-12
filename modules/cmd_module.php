<?php

function cmd($data, $config) 
{
	$cmd = "";
	foreach ($config["modules"] as $mod)
	{
		$cmd .= "!".$mod." ";
	}
	return get_nick($data).": käytössä olevat komennot ovat: ".$cmd." ";

}


?>
