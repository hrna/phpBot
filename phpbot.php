#!/usr/bin/php
<?

/** BOT CFG BELOW **/
echo "***************************\r\n";
echo "*                         *\r\n";
echo "* Loading the bot config. *\r\n";
echo "*                         *\r\n";
echo "***************************\r\n";

include("config.php"); 

echo "*                         *\r\n";
echo "* ".$config["color"]["lred"].
	"the bot cfg loaded..OK."
	.$config["color"]["end"]." *\r\n";
echo "*                         *\r\n";
echo "***************************\r\n";
/** BOT CFG ABOWE **/


class tsunku {

var $socket;
var $expl = array();
var $command;
var $canlog;
var $hop;

#luo yhteyden ja pitää toimintoja yllä
function __construct($config)
	{
	echo "\r\n".$config["color"]["lblue"]."* ".$config["config"]["version"].$config["color"]["end"]."\r\n";
	echo "* Initializing the connection... *\r\n\r\n";
	$this->socket = fsockopen($config["config"]["host"],$config["config"]["port"]);
	$this->server_auth($config);
	echo "* Sending AUTH to server. => Joining ".$config["color"]["lgreen"].$config["config"]["chans"].$config["color"]["end"]." *\r\n";
	echo "=> Entering the mainloop =>\r\n";
	$this->load_modules($config); #Ladataan moduulit
	echo "Logging is ".$config["color"]["lblue"].$config["config"]["logging"].$config["color"]["end"]."\r\n";
	$this->loop($config);
	}

#tunnistautuu palvelimelle ja liittyy oletuskanavalle
function server_auth($config) 
	{
	echo "* Preparing AUTH info for the server *\r\n";
	$this->send_data("NICK ".$config["config"]["nick"]);
 	$this->send_data("USER ".$config["config"]["ident"]." ".$config["config"]["host"]." liibalaaba :".$config["config"]["realname"]);
	echo $config["color"]["lgreen"]."* AUTH OK *\r\n\r\n".$config["color"]["end"];
	}
	

#Ladataan moduulit, mitenhän tämän tekis?
function load_modules($config)
	{
		echo $config["color"]["lblue"]."LOADING SYSTEM MODULES\r\n".$config["color"]["end"];
		foreach ($config["sysmods"] as $mod)
		{
			if (is_file("modules/".$mod."_system_module.php"))
			{
				echo "Loading module: ".$config["color"]["lgreen"].$mod.$config["color"]["end"]."\r\n";
				include("modules/".$mod."_system_module.php");
			} else { 
				echo $config["color"]["lred"].$mod." module is not available\r\n".$config["color"]["end"]; 
			}
		}
		echo $config["color"]["lblue"]."LOADING MODULES\r\n".$config["color"]["end"];
		foreach ($config["modules"] as $mod)
		{
			if (is_file("modules/".$mod."_module.php"))
			{
				echo "Loading module: ".$config["color"]["lgreen"].$mod.$config["color"]["end"]."\r\n";
				include("modules/".$mod."_module.php");
			} else { 
				echo $config["color"]["lred"].$mod." module is not available\r\n".$config["color"]["end"]; 
			}
		}	
	}

function loop($config)
	{
	
   	while(!feof($this->socket)) { #oistaiseksi käytössä, kunnes todetaan toimimattomaksi...

	#tuleva data palvelimelta ja pilkonta osiin
	$line = fgets($this->socket, 256);
	flush();
	$this->expl = explode(" ", $line);
	
	if (isset($this->expl[1]))
	{
		if ($this->expl[1] == "433") #onko nick käytössä? Vedellään niin kauan että löytyy sopiva nick... #Huonoa koodia?
		{
			$this->nick_check("NICK ".$config["config"]["altnick"]);
			if ($this->expl[1] != "433")
			{
				foreach (explode(",", $config["config"]["chans"]) as $chan)
				{		
					
					$this->join_channel($chan);
					$hop = "true";
				}
			} else {
				while ($this->expl[1] == "433")
				{
					$this->nick_check("NICK ".$config["config"]["nick"].rand(1,10));
					sleep(1);
				}
				foreach (explode(",", $config["config"]["chans"]) as $chan)
				{		
				$this->join_channel($chan);
				$hop = "true";
				}
			} 
		} elseif ($this->expl[1] == "376") {
			foreach (explode(",", $config["config"]["chans"]) as $chan)
			{	
				if(!isset($hop))
				{
					$this->join_channel($chan);
				}
			}
		}
	}
		
	
	#vastaa palvelimen pingiin
	if ($this->expl[0] == "PING")
	{
		$this->send_data("PONG", $this->expl[1]); 
	}
	
	#palauttaa urlin titlen
	if (isset($this->expl[3]) && $this->expl[1] != "372" && preg_match('!(http)(s)?:\/\/[a-zA-Z0-9\-\=.?&_/]+!', $line, $text))
	{
		if (in_array("title",$config["sysmods"]))
		{
			$title = sys_title($text[0],$config);
			if($title != null)
			{
				$this->send_chan($title);
			}
		}
	}

	#console debug, asetuksissa true/false
	if ($config["config"]["debug"] == "true")
	{
		echo $line;
	}
	
	#botin komennot alla
	if (isset($this->expl[3]))
	{
		$command = str_replace(array(chr(10), chr(13)), '', $this->expl[3]);
		
			if (isset($command[1]) && $command[1] == "!") { $this->parse_command($command, $config); } # suoritetaan komento 
			
	}

	#Loggeri ##############
	if(isset($this->expl[1]) && $this->expl[1] == "366")
	{	
		if($config["config"]["logging"] == "true")
		{
			$canlog = true;
		}
	}
		
		
	if(isset($canlog))
	{	
		if(in_array("logger", $config["sysmods"]))
		{
		sys_logger($this->expl);
		}
	}
	#loggeri end ############

	#loopataan uusiksi
	
	} #<--whileloopin lopetussulku ###################################################################################
	} 

#lähettää dataa serverille
function send_data($output, $msg = null)
	{
		if ($msg == null)
		{
			fwrite($this->socket, $output."\r\n");
			echo $output."\r\n";
 		} else {
			fwrite($this->socket, $output." ".$msg."\r\n");
			echo $output." ".$msg."\r\n";
			}
	}
#validoi käyttäjän nickin
function nick_check($input)
	{
			fwrite($this->socket, $input."\r\n");
			$line = fgets($this->socket, 256);
			$this->expl = explode(" ", $line);
	}

#lähettää dataa kanavalle
function send_chan($output)
	{
		fwrite($this->socket, "PRIVMSG ".$this->expl[2]." :".$output."\r\n");
		echo "Sending to ". $this->expl[2].": ".$output."\r\n";
	}

#liittyy kanavalle
function join_channel($chan)
	{
		$this->send_data("join", $chan);
		echo "Joining ".$chan."\r\n";
	}

#Suoritetaan toiminto jos olemassa
function parse_command($command, $config) 
	{
		$command = substr($command, 2);	
		if (function_exists($command) && substr($command, 0, 4) != "sys_") {
			$data = ($command($this->expl, $config));
			if (substr($data, 0, 4 ) === "MODE") ## jos server-komento
			{
				$this->send_data($data);
			}
			elseif (in_array($command,$config["sysmods"]) || substr($command, 0, 4) == "sys_")
			{
				#do nothing...
			}else {
				$this->send_chan($data); 
			}
		}		 
		if (!function_exists($command))
		{	
			$this->send_chan("Tuntematon komento: !".$command);
		}
	}

} #class end#

#käynnistää botin
$tsunku = new tsunku($config);

?>
