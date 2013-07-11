<?php
global $config;
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
	"config" 	=> array(
				"host"		=> "b0xi.eu",
				"port"		=> 6667,
				"nick"		=> "TsunkuBeta",
				"altnick"	=> "TsunkuAlpha", 
				"ident"		=> "Tsunku2",
				"chans"		=> "#tsunku", #Pilkulla erotettuna kanavan nimet
				"realname"	=> "tsunku v2",
				"version"	=> "PHP Tsunku version 0.4.0",
				"debug"		=> "false" #console debugging true/false
				),
	"opers" 	=> array("hrna", "jaska", "etc..."), #operaattorit
	"modules"	=> array("get_nick","wiki","kurssi","cmd","klo","version","op","opme")
	);

?>
