<?php 
// Alerta no console
$host = "192.168.0.100";
$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
while(true){
	$a = pack('v', 22); 
	$a .= pack('C', 0); // type 1|0
	socket_sendto($socket,  $a,strlen($a), 0, $host, 1909);
	echo ".";
	usleep(1000);
}
	
?>