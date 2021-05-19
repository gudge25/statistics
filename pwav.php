<?php

	header('Content-Type: audio/wav');

	// Рабочая тестовая версия
	//readfile("../../../../var/spool/asterisk/monitor/2020/10/21/" . urlencode($_GET['wav']));

	// Рабочая боевая версия
	//readfile("../../../../var/spool/asterisk/monitor/" . urlencode($_GET['wav']));
	//readfile(urlencode($_GET['wav']));
	readfile($_GET['wav']);
?>