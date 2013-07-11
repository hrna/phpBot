<?php
function klo ($data) {

	date_default_timezone_set('Europe/Helsinki');
	return get_nick($data).": Kello on ".date("H:i:s");
		
}

?>
