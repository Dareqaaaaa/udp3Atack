<?php 
require("_public/class/int_byte.php");
$write = new SendPacket();
$write->addr = "10.10.10.100";
$write->port = 1909;

while (true) {
	$write->int16(4);
	$write->int16(0); #roomId (Id da sala -1)
	$write->int16(1); # channelId
	$write->int8(1); #killerIdx [SLOT??]
	$write->int8(rand(5,10)); // deatType
	$write->int8(rand(0,3)); // hitEnum
	$write->int16(rand(0,100)); // damage
	$write->Send();
	$write->clear();

	usleep(100000);
	echo ".";
}

?>