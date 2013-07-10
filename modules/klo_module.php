<?php
function klo ($data) {
	
	$nick = get_nick($data);
	return $nick.": Kello on ".date("H:i:s");

}

?>
