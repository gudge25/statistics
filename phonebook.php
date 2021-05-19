<?php
 
 require_once('db.php');

 	$dbh = new PDO('mysql:host='.$dbHost.';port='.$dbPort.';charset=utf8;dbname='.$dbName, $dbUser, $dbPass);
    $dbh -> exec("set names utf8");

    if (isset($_POST["action"]))
    	if($_POST["action"] == "add"){
// ******************** Add Phone to PhoneBook ***********************
    $phone = $dbh->quote($_POST["phone"]);
    $name = $dbh->quote($_POST["finame"]);
    $suname = $dbh->quote($_POST["suname"]);
    				
    //$res = $dbh->query("Insert INTO asteriskcdrdb.phonebook ('phone','name','suname') values (".$phone.",".$name.",".$suname.")");
  	$res = $dbh->query("Insert INTO asteriskcdrdb.phonebook set phone=".$phone.", name=".$name.", suname=".$suname) or die("Error insert"); 
    if($res){		
    echo "<script language='JavaScript'>document.location.href='index.php'</script>";
	} else { echo "Error ADD Phone -> ".mysql_error();}
} else {
	if($_POST["action"] == "del"){
// ******************** Delete Phone from PhoneBook ***********************
	$id = $dbh->quote($_POST["id"]);
	$res = $dbh->query("DELETE FROM asteriskcdrdb.phonebook WHERE id=".$id);
	if($res){		
    echo "<script language='JavaScript'>document.location.href='index.php'</script>";
	} else { echo "Error DELETE Phone -> ".mysql_error();}
}
}
		
















?>