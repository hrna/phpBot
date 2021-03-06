<?php

$config = array(
	"color"		=> array(
				"blue" 		=> "\033[0;34m",
				"lblue"		=> "\033[1;34m",
				"red"		=> "\033[0;31m",
				"lred"		=> "\033[1;31m",
				"green"		=> "\033[0;32m",
				"lgreen"	=> "\033[1;32m",
				"end"		=> "\033[0m"
				),
	"sysmods" 	=> array("get_nick","oper_auth","logger","title"), #SYSTEM MODULES, dont touch.
	"config" 	=> array(
				"host"		=> "b0xi.eu",
				"port"		=> 6667,
				"nick"		=> "TsunkuBeta",
				"altnick"	=> "TsunkuAlpha", 
				"ident"		=> "Tsunku2",
				"chans"		=> "#tsunku", #Pilkulla erotettuna kanavan nimet
				"realname"	=> "tsunku v2",
				"version"	=> "PHP Tsunku version 0.4.4",
				"debug"		=> "false", #console debugging true/false
				"logging"	=> "false", #logging true/false
				),
	"opers" 	=> array("hrna@oper.aquanet.fi", "jaska@127.0.0.1",), #operaattorit
	"modules"	=> array(	#Place your modules below here.
				"wiki",
				"kurssi",
				"cmd",
				"klo",
				"version",
				"op",
				"programmer",
				"fmi",
				"clock",
				"stats"
				) 
	);

?>
