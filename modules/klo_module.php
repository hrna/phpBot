<?php
function klo ($data) {
	
	$nick = substr($data[0], 1, strpos($data[0], "!"));
	$nick = strstr($nick, "!", true);
	return $nick.": Kello on ".date("H:i:s");

}

?>
