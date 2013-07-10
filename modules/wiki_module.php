<?php

function wiki($haku)
{
			$result = "http://en.wikipedia.org/wiki/".ucfirst($haku); #Eka kirjain isoksi
			return $result;
}


?>
