<?php
//class op extends tsunku {
function op ($data, $config)
	{
		//if (in_array(get_nick($data), $config["opers"]))
		//{
			print_r($data);
			$pylly = "MODE ".$data[2]." +o ".$data[4]."\r\n";
			return $pylly;
		//} else { return get_nick($data).", Ei taida sun natsat riittää :(\r\n"; }
	}			
//}
?>