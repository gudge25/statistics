<?php

class AuthClass {
    private $_login = ""; //Устанавливаем логин
    private $_password = ""; //Устанавливаем пароль
 
    
    public function isLevel() {
        if (isset($_SESSION["level"])) { //Если сессия существует
            return $_SESSION["level"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        }
        else return 0; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }
     
    
    public function auth($login, $passwors, $db) {
	//require_once('db.php');

		$res = $db->query('SELECT * FROM asteriskcdrdb.user WHERE login ='.$db->quote($login));
		if($res){
			$line = $res->fetch(PDO::FETCH_ASSOC);
			if(strcmp(md5($passwors),$line[password])==0 ){ 
				$_SESSION["login"] = $login;
				$_SESSION["level"] = $line[status]; 
				return 1; 
				}

				else { $_SESSION["level"] = 0; return 0; 
			}
		}
		/*$dbh = new PDO('mysql:host='.$dbHost.';port='.$dbPort.';dbname='.$dbName, $dbUser, $dbPass);
		$dbh->exec('SET CHARACTER SET utf8');
		$log = $_POST[log];
		$pas = $_POST[pas];
		$res = $dbh->query('SELECT ps, level, region FROM users WHERE log='.$dbh->quote($login));
		$Ansv=0;
		if($res){
			$line = $res->fetch(PDO::FETCH_ASSOC);
			if(strcmp($passwors,$line[ps])==0 ){ 
				$_SESSION["login"] = $login;
				$_SESSION["level"] = $line[level];
				$_SESSION["region"] = $line[region];
				$res1 = $dbh->query('SELECT * FROM regions WHERE id='.$line[region]);
				if($res1){
				    $line1 = $res1->fetch(PDO::FETCH_ASSOC);
				   /* if($_SESSION["zoom"]!="") $_SESSION["zoom"]=$line1[zoom];
				    if($_SESSION["lat"]!="") $_SESSION["lat"]=$line1[lat];
				    if($_SESSION["lng"]!="") $_SESSION["lng"]=$line1[lng];
				    $_SESSION["zoom"]=$line1[zoom];
				    $_SESSION["lat"]=$line1[lat];
				    $_SESSION["lng"]=$line1[lng];
				    if($_SESSION["region"]==100) $_SESSION["region_name"]="Украина"; else $_SESSION["region_name"]=$line1[name];
				}
		
            return $_SESSION["level"];
			} else { $_SESSION["level"] = 0; return 0; }
        }
        else { $_SESSION["level"] = 0; return 0; }*/
        //$_SESSION["level"] = 0; return 0; // test
    }
     
    public function getLogin() {
        if ($this->isLevel() > 0) { //Если пользователь авторизован
            return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
        }
    }
     
     
    public function out() {
        $_SESSION = array(); //Очищаем сессию
        session_destroy(); //Уничтожаем
    }
}




?>