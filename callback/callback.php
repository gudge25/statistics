<?php
$strhost = "localhost"; # укажите IP – адрес вашего Asterisk. Либо localhost/127.0.0.1, если скрипт загружен на сервер Asterisk;
$strport = "5038"; # AMI  - порт, как настроено в секции [general] файла manager.conf;
$timeout = "10";
$num = $_POST['phone']; # получаем номер абонента, который хочет получить callback; 
$name = Callback - <.$_POST[<name<].<<; # формируем строку, которую будем выводить на дисплей оператору, который будет осуществлять коллбэк. Она будет состоять из двух параметров: 1 – callback, чтобы оператор понял, что это не входящая, а потенциально исходящая активность и 2 – имя абонента;
$cid = "111"; # экстеншен оператора;
$c="from-internal";
$p="1";
$errno=0 ;
$errstr=0 ;
$sconn = fsockopen($strhost, $strport, &$errno, &$errstr, $timeout) or die("Connection to $strhost:$strport failed");
if (!$sconn) { echo "$errstr ($errno)
\n"; } 
else {
echo <OK<;
fputs($sconn, "Action: login\r\n");
fputs($sconn, "Username: admin\r\n"); # укажите имя созданного пользователя в файле manager.conf вместо callback;
fputs($sconn, "Secret: P@ssw0rd\r\n"); # укажите пароль созданного пользователя в файле manager.conf вместо P@ssw0rd;
fputs($sconn, "Events: off\r\n\r\n");
usleep(500);
fputs($sconn, "Action: Originate\r\n");
fputs($sconn, "Channel: SIP/$cid\r\n");
fputs($sconn, "Callerid: $name\r\n");
fputs($sconn, "Timeout: 15000\r\n");
fputs($sconn, "Context: $c\r\n");
fputs($sconn, "Exten: $num\r\n");
fputs($sconn, "Priority: $p\r\n");
fputs($sconn, "Async: yes\r\n\r\n" );
fputs($sconn, "Action: Logoff\r\n\r\n");
usleep (500);
$wrets=fgets($sconn,128);
fclose($sconn);
exit; 
}
?>