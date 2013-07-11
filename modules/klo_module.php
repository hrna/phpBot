<?php
function klo ($data) {

	date_default_timezone_set('Europe/Helsinki');
	$nick = get_nick($data);
	return $nick.": Kello on ".date("H:i:s");
		
}

?>
