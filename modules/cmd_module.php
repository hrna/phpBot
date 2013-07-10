<?php

function cmd($data) 
{
	$komennot = get_nick($data).", käytössä olevat komennot ovat: !cmd, !opme, !op <nick>, !klo, !version, !g <amount> <from> <to>, !credits, !wiki";
	return $komennot;
}


?>