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

#luo yhteyden ja pitää toimintoja yllä
function __construct($config)
	{
	echo "\r\n".$config["color"]["lblue"]."* ".$config["config"]["versio"].$config["color"]["end"]."\r\n";
	echo "* Initializing the connection... *\r\n\r\n";
	$this->socket = fsockopen($config["config"]["host"],$config["config"]["port"]);
	$this->server_auth($config);
	echo "* Sending AUTH to server. => Joining ".$config["color"]["lred"].$config["config"]["chan"].$config["color"]["end"]." *\r\n";
	echo "=> Entering the mainloop =>\r\n";
	$this->load_modules($config); #Ladataan moduulit
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
		foreach ($config["modules"] as $mod)
		{
			echo "Loading module: ".$mod."\r\n";
			include("modules/".$mod."_module.php");
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
			$nick = $this->send_data("NICK ".$config["config"]["altnick"]);
			if ($nick != "433")
			{
				foreach (explode(",", $config["config"]["chans"]) as $chan)
				{		
					$this->join_channel($chan);
				}
			} else {
				while ($nick == "433")
				{
					$nick = $this->send_data("NICK ".$config["config"]["nick"].rand(1,10));
					sleep(1);
				}
				foreach (explode(",", $config["config"]["chans"]) as $chan)
				{		
				$this->join_channel($chan);
				}
			} 
		} else if ($this->expl[1] == "376") {
			foreach (explode(",", $config["config"]["chans"]) as $chan)
			{		
				$this->join_channel($chan);
			}
		}
	}
		
	
	#vastaa palvelimen pingiin
	if ($this->expl[0] == "PING")
	{
		$this->send_data("PONG", $this->expl[1]); 
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

		if ($command[1] == "!") { $this->parse_command($command); }
		switch($command)
		{

			case ":!opme":
				if (in_array($this->get_nick($line), $config["opers"]))
				{
					$this->send_data("MODE ".$this->expl[2]." +o ".$this->get_nick($line)."\r\n");
					break;
				} else { $this->send_chan($this->get_nick($line).", Ei taida sun natsat riittää :(\r\n"); }

			/*case ":!op":
				if (in_array($this->get_nick($line),$config["opers"]))
				{
					$this->send_data("MODE ".$this->expl[2]." +o ".$this->expl[4]."\r\n");
					break;
				} else { $this->send_chan($this->get_nick($line).", Ei taida sun natsat riittää :(\r\n"); }
				*/
		}
		
	}

	#loopataan uusiksi
	#$this->loop($config);
	} #<--whileloopin lopetussulku
	} 

#lähettää dataa serverille
function send_data($output, $msg = null)
	{
		if ($msg == null)
		{
			fwrite($this->socket, $output."\r\n");
			echo $output."\r\n";
			$line = fgets($this->socket, 256);
			$this->expl = explode(" ", $line);
			return $this->expl[1];
			
 		} else {
			fwrite($this->socket, $output." ".$msg."\r\n");
			echo $output." ".$msg."\r\n";
			}
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
		if (function_exists($command)) {
			$this->send_chan($command($this->expl, $config));		
		} else {
    		$this->send_chan("Tuntematon komento: !".$command);
		}
	}
#googlevaluutta By Jaska
function valuutta($amount,$from,$to)
	{
	$dom = new DOMDocument();
	@$dom->loadHTMLFile("https://www.google.com/finance/converter?a=".$amount."&from=".$from."&to=".$to."");

	$xpath = new DOMXPath($dom);

		foreach ($xpath->query('//div[contains(@id,"currency_converter_result")]') as $tag) {
		$result = "";
		$result .= trim($tag->nodeValue);
		return $result;
		}
    	}

} #class end#

#käynnistää botin

$tsunku = new tsunku($config);

#hakee käyttäjän nickin
function get_nick($a) 
	{
	//$exp = explode(" ", $a);
	$nick = substr($a[0], 1, strpos($a[0], "!"));
	$nick = strstr($nick, "!", true);
	return $nick;
	}

?>
