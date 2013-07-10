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
	"config" 	=> array(
				"host"		=> "b0xi.eu",
				"port"		=> 6667,
				"nick"		=> "TsunkuBot",
				"altnick"	=> "TsunkuBotti", 
				"ident"		=> "Tsunku2",
				"chans"		=> "#tsunku", #pilkulla erottaa muut kanavat esim: "#tsunku,#chan2", multichan support not tested.
				"realname"	=> "tsunku v2",
				"versio"	=> "PHP Tsunku version 0.3.4",
				"debug"		=> "true" #console debugging true/false
				),
	"opers" 	=> array("hrna", "jaska", "etc...") #operaattorit
	);

?>
