<?php
function get_nick($a) 
	{
	$nick = substr($a[0], 1, strpos($a[0], "!"));
	$nick = strstr($nick, "!", true);
	return $nick;
	}
?>
