<?

function programmer ($data, $config)
{
	#You Might Be A Programmer If:

	$lines = file("modules/data/programmer.txt");
	$line_amount = count($lines);
	$random = rand(0, $line_amount-1);
	
	return "You Might Be A Programmer If: ".$lines[$random];

}



?>