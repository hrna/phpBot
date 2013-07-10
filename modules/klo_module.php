<?php
function klo ($data) {
	
	$nick = substr($data[0], 1, strpos($data[0], "!"));
	$nick = strstr($nick, "!", true);
	$nick .= get_nick($data[0]);
	return $nick.": Kello on ".date("H:i:s");

}

?>
