<?php

function cmd($data) 
{
	$nick = substr($data[0], 1, strpos($data[0], "!"));
	$nick = strstr($nick, "!", true);
	$komennot = $nick.", käytössä olevat komennot ovat: !cmd, !opme, !op <nick>, !klo, !version, !kurssi <amount> <from> <to>, !credits, !wiki";
	return $komennot;
}


?>