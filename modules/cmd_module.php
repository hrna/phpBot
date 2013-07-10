<?php

function cmd($data) 
{
	$nick = get_nick($data);
	return $nick.", käytössä olevat komennot ovat: !cmd, !opme, !op <nick>, !klo, !version, !kurssi <amount> <from> <to>, !credits, !wiki";

}


?>