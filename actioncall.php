<?php

//echo 'Phone='.$_POST[phone].' Name='.$_POST[name];


$strhost = "127.0.0.1"; # укажите IP – адрес вашего Asterisk. Либо localhost/127.0.0.1, если скрипт загружен на сервер Asterisk;
$strport = "5038"; # AMI  - порт, как настроено в секции [general] файла manager.conf;
$timeout = "10";
$num = $_POST[name]; # получаем номер абонента, который хочет получить callback; 
$phone = $_POST[phone];
$name = "Callback - ".$_POST[phone]; # формируем строку, которую будем выводить на дисплей оператору, который будет осуществлять коллбэк. Она будет состоять из двух параметров: 1 – callback, чтобы оператор понял, что это не входящая, а потенциально исходящая активность и 2 – имя абонента;
//$cid = "111"; # экстеншен оператора; <-- это номер оператора?
$cid = $_POST[cid];
//$c="from-script";
$c="from-internal";
//$strChannel = "Local/s@from-script-n";
$strChannel = "Local/s@from-script-n";
$p="1";
$errno=0 ;
$errstr=0 ;
$sconn = fsockopen($strhost, $strport, $errno, $errstr, $timeout) or die("Connection to $strhost:$strport failed");
if (!$sconn) { echo $errstr." (".$errno.")\n"; }
 
else {
//echo "OK";
$res = Array();
$res[] = fputs($sconn, "Action: login\r\n");
$res[] = fputs($sconn, "Username: admin\r\n"); # укажите имя созданного пользователя в файле manager.conf вместо callback;
$res[] = fputs($sconn, "Secret: P@ssw0rd\r\n"); # укажите пароль созданного пользователя в файле manager.conf вместо P@ssw0rd;
$res[] = fputs($sconn, "Events: off\r\n\r\n");
usleep(500);
$res[] = fputs($sconn, "Action: originate\r\n");
//
$res[] = fputs($sconn, "Channel: SIP/$cid\r\n");
$res[] = fputs($sconn, "Callerid: ".$name."\r\n");
$res[] = fputs($sconn, "Timeout: 15000\r\n");
$res[] = fputs($sconn, "Context: ".$c."\r\n");
$res[] = fputs($sconn, "Exten: ".$phone."\r\n");
$res[] = fputs($sconn, "Priority: ".$p."\r\n");
$res[] = fputs($sconn, "Async: yes\r\n\r\n" );
$res[] = fputs($sconn, "Action: Logoff\r\n\r\n");
usleep (500);
$wrets=fgets($sconn,128);
fclose($sconn);
//$Error = "None";
//for($i=0;$i<count($res);$i++) if(!$res[$i]) $Error = $i;
//echo "Call sending!\r\nNumber = $num\r\nName = ".$name."\r\nCID = ".$cid."\r\nWgets=".$wrets."\r\nError=".$Error;
echo "Ok";
exit; 
}


?>