<?php 
/**
 * 
 */
class getHex
{
	public $bytes;
	function __construct(String $command,bool $debug = false)
	{
		$a = trim(exec(__DIR__."\\SendPacket.exe ".$command));
		$array = explode(" ", $a);

		foreach ($array as $value) {
			$this->bytes[] = pack("c", hexdec($value));
		}
		if($debug){
			echo "[Send ".count($this->bytes)." bytes] [Opcode:".hexdec($array[3].$array[2])."] ". str_replace(" ", "-", $a).PHP_EOL ;
			sleep(1);
		}
		
	}

}