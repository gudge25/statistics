<?php

session_start();
require_once('db.php');
require_once('auth.php');




	$MainTitle = 'Statistics';

try{

    $dbh = new PDO('mysql:host='.$dbHost.';port='.$dbPort.';charset=utf8;dbname='.$dbName, $dbUser, $dbPass);

    if( !$dbh ){
        throw new Exception('$dbh Failed');
    } //else echo 'PDO Connecnted!';

}
catch(Exception $e){
    echo $e->getMessage();
}

    $dbh -> exec("set names utf8");

   // echo "Тестова сторінка вітаю Масиме!";
 //echo "Тестова сторінка вітаю Масиме 19.11.2020!" ;
    //echo '  '.__DIR__;
 /*   $DirName = '../../../../var/spool/asterisk/monitor/2020/10/19';
   if(is_dir($DirName)){
        echo "Present";
        $files1 = scandir($DirName);
        print_r($files1);
    }  else echo "Not Present";
    foreach(glob($DirName . "/*1603096043.420937.wav") as $file) {
        
        //$LastModified[] = filemtime($file);
        $FileName[] = $file;
        echo $file. "</br>";
    }
    $lastIndex = count($FileName) - 1;
    echo $lastIndex. "</br>";
    if($lastIndex > -1) echo $FileName[0]; else echo "Not Exist";*/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>

<head>
   <title><?php echo $MainTitle; ?></title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
    <meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style>

body {
    font-family: Arial;
    font-size: 14px;
}

.THead{
   color: white; 
   font-size: 14px;
   background: #33CC9A;
    
} 

.TBody {
   text-align: center; 
   cursor: pointer;
   
}    
.TBody:hover{
   background:  #DAF5EC;
}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #009966;
    color: white;
    border-radius: 10px 10px 0px 0px; 
}

/* Style the buttons that are used to open the tab content */
.tab button {
    background-color: #F2F2F2;
    float: right;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 14px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #FFF;
    color: #009966;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
/* Indicator */
#Ind{
    width: 250px;
    height: 250px;
    margin: auto;
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 100;
 }

.ImgInBody_Left{
    float:left;
    width: 32px;
    height: 32px;
    cursor: pointer;
    margin-left: 10px;
    margin-bottom: 3px;
 }
.ImgInBody_Left:hover{
    width: 35px;
    height: 35px;
    margin-left: 7px;
    margin-bottom: 0;
} 

.ImgInBody_Right{
    float:right;
    width: 32px;
    height: 32px;
    cursor: pointer;
    margin-right: 10px;
    margin-bottom: 3px;
 }
.ImgInBody_Right:hover{
    width: 35px;
    height: 35px;
    margin-right: 7px;
    margin-bottom: 0;
}  

.ImgInBody_Vert{
    width: 32px;
    height: 32px;
    cursor: pointer;
    margin-bottom: 10px;
 } 
.ImgInBody_Vert:hover{
    width: 35px;
    height: 35px;
    margin-bottom: 7px;
 }  

 .But{
    width: 250px;
    cursor: pointer;
    padding: 14px;
    margin:10px;
    font-size: 14px;
    color: white;
    border-radius: 10px;
    border: none;
    outline: none;
    vertical-align: middle;
 }
.But:hover{
    color: yellow;
}
 .ImgButton{
    width: 25px;
    height: 25px;
    margin-left: 10px;
    float:right;
    vertical-align: middle;
 }
 .GroupHeader{
     //width: 200px;
    background: #33CC9A;
    border-radius: 10px 10px 0px 0px; 
    border: none;
    color: white;
    text-align: center;
    padding: 14px;
    margin: 0 10px;
    font-size: 14px;
 }

 .GroupBody{
     //width: 200px;
    background: #DAF5EC;
    border: none;
    color: black;
    text-align: left;
    padding: 14px;
    margin: 0 10px;
    font-size: 14px;
 }
 .GroupSpan{
    float: right;
    font-size: 16px;
 }
 .GroupFoot{
    //width: 200px;
    background: #33CC9A;
    border-radius: 0px 0px 10px 10px; 
    border: none;
    color: white;
    text-align: center;
    padding: 14px;
    margin: 0px 10px 10px 10px;
    font-size: 14px;
    cursor: pointer;
  }
.GroupFoot:hover{
    color: yellow;
}

.InForm{
    position: absolute;
    left: 0; right: 0;
    bottom: 0; top: 0;
    display:block;
    background: #DAF5EC;
    border: 2px solid black;
    border-radius: 10px 10px 10px 10px; 
    width: 400px;
    height: 320px;
    font-size: 18px;
    margin: auto;
    text-align: center;
    overflow: hidden;
    z-index: 100;
}

.AuhthHead{
   font-size: 25px;
   background: #009966;
   //width: 100%; 
   color: white;
   padding: 14px;
}
input[type=text], input[type=password] {
    //width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.B_Submit {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    //width: 100%;
}

.B_Submit:hover {
    opacity: 0.8;
}

#Shadow{
    display: none; 
    z-index: 19; 
    position: fixed; 
    left: 0px; 
    top: 0px; 
    right: 0px; 
    bottom:0; 
    background: black; 
    opacity: 0.4; 
    filter: alpha(Opacity=20);
    cursor: default; 
}

.SelPhone{
    border: 2px solid #009966;
    font-size: 18px;
    padding: 5px;
    width:80%;
    margin: 0 20px 10px 20px;
}

.Player button{
    width: 20px;
    height: 20px;
    cursor: pointer;
    border: none;
    background: url(img/Play.png);
}

#BLost.active{
    background: #F27A3D;
    color:white;
}

#BPerfect.active{
    background: #3E83CA;
    color:white;
}

#BReceived.active{
    background: green;
    color:white;
}
</style> 

<script type="text/javascript">
var PhoneBookName;
var PhoneBookPhone;
var PhoneBookSuname;
var LastAudio;
var WScale;
Config = {
        stateSave: true,
        "ordering": false,
        "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Russian.json"
            }
    }; 

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent"); //$('.tabcontent'); 
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");  //$('.tablinks');
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}   

function CallAction(Iphone,Iname,Icid) {
    var res = $.ajax({type: "POST", url: "actioncall.php", data: {phone:Iphone,name:Iname,cid:Icid}, async: false,}).responseText;
    return res;
}    

function WindowScale(){
    WScale = $(window).width()/1920;
        $('body').css({
            zoom: WScale,
            '-moz-transform': 'scale(' + WScale + ')'
        });
}

$(document).ready(function() {

    WindowScale();

    $(window).resize(function() {  
       /* WScale = $(window).width()/1920;
        $('body').css({
            zoom: WScale,
            '-moz-transform': 'scale(' + WScale + ')'
        });*/
        WindowScale();
    });

    
    $('#Shadow').hide();
    $('#Autorization').show();


    $("#B_AddContakt").on("click",function(){
            $("#AddPhone").show();
        });
    

    $("#AddPhoneClose").on("click",function(){
            $("#AddPhone").hide();
        });

    $("#B_UsersAdd").on("click",function(){
            $("#AddUser").show();
        });
    $("#AddUserClose").on("click",function(){
            $("#AddUser").hide();
        });
    $("#B_UsersDel").on("click",function(){
            $("#DelUser").show();
        });
    $("#DelUserClose").on("click",function(){
            $("#DelUser").hide();
        });


    
    var tablePerfect = $('#TPerfect').DataTable(Config);
    var tableRecived = $('#TReceived').DataTable(Config);
    var tableLost =$('#TLost').DataTable(Config);
    var tableusers = $('#TUsers').DataTable(Config);
    var table = $('#TPhonebook').DataTable(Config);

    $("#B_DeleteKontakt").on("click",function(){
        $("#DelPhone").show();
        });

    $("#DelPhoneClose").on("click",function(){
        $("#DelPhone").hide();
        });

    $("#B_Call").on("click",function(){
        //var rowDataPhone = table.row( this ).data();
        //var Phone = rowData[1];
        //var User = '<?php echo $_SESSION['login']; ?>';
        var User = PhoneBookName;
        var CID = "<?php echo $_SESSION['login'];?>";
        //alert(CID);
        var res = $.ajax({type: "POST", url: "actioncall.php", data: {phone:PhoneBookPhone,name:User,cid:CID}, async: false,}).responseText;
        //alert(res);
        });

    // Клик на таблице телефонных номеров

    $('#TPhonebook').on( 'click', 'tr', function () {
        var rowData = table.row( this ).data();
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            $("#B_DeleteKontakt").hide();
            $("#B_Call").hide();
            $("#SelectedPhohe").html('Контакт не выбран');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var id = rowData[0];
            var phone = rowData[1];
            PhoneBookName = rowData[2];
            PhoneBookPhone = rowData[1];
            PhoneBookSuname = rowData[3];
            $("#SelectedPhohe").html(phone);
            $("#B_DeleteKontakt").show();
            $("#B_Call").show();
            $("#DeletedNum").val(phone);
            $("#DeletedNum_H2").html(phone);
            $("#DeletedId").val(id);
        }
    } );

    // Клик на таблице пользователей

    $('#TUsers').on( 'click', 'tr', function () {
        var rowData = tableusers.row( this ).data();
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            
            //$("#B_Call").hide();
            $("#SelectedUser").html('Пользователь не выбран');
        }
        else {
            tableusers.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var id = rowData[0];
            var login = rowData[1];
            var status = rowData[2];
            if(status === 'User'){
                $("#SelectedUser").html(login);
                $("#DeletedUserLogin").html(login);
                $("#B_UsersDel").show();
                $("#DelUserId").val(id);
                //var H2 = 
                $("#DeletedUser_H2").html('Id='+id+' Логин='+login);
            } else {
                $("#SelectedUser").html('Пользователь не выбран');
                $("#B_UsersDel").hide();
            }
            //$("#B_Call").show();
            //$("#DeletedNum_H2").html(phone);
            //
        }
    } );

    // Клик на таблице входящих сединений

    $('#TReceived tbody').on( 'dblclick', 'td', function (e) {
        if((e.target.className == 'tdPlayer') || (e.target.nodeName == 'BUTTON') ) return ;
        var rowData = tableRecived.row( this ).data();
        PhoneBookPhone = rowData[0];
        PhoneBookName = rowData[1];
        var CID = "<?php echo $_SESSION['login'];?>";
        var Ansv = CallAction(rowData[0],rowData[1],CID);
        //alert('Phone : '+PhoneBookPhone+' Name : '+PhoneBookName+' Res=: '+Ansv);
    });

    // Клик на таблице исходящих сединений

    $('#TPerfect tbody').on( 'dblclick', 'td', function (e) {
        if((e.target.className == 'tdPlayer') || (e.target.nodeName == 'BUTTON') ) return ;
        var rowData = tablePerfect.row( this ).data();
        PhoneBookPhone = rowData[0];
        PhoneBookName = rowData[1];
        var CID = "<?php echo $_SESSION['login'];?>";
        var Ansv = CallAction(rowData[1],rowData[1],CID);
        //alert('Phone : '+PhoneBookPhone+' Name : '+PhoneBookName+' Res=: '+Ansv);
    });

    // Клик на таблице проебаных сединений

    $('#TLost tbody').on( 'dblclick', 'td', function (e) {
        if((e.target.className == 'tdPlayer') || (e.target.nodeName == 'BUTTON') ) return ;
        var rowData = tableLost.row( this ).data();
        PhoneBookPhone = rowData[0];
        PhoneBookName = rowData[1];
        var CID = "<?php echo $_SESSION['login'];?>";
        var Ansv = CallAction(rowData[0],rowData[1],CID);
        if(Ansv == "Ok"){

         //alert(rowData[4]);
         tableLost.row( this ).remove().draw(); 
         var res = $.ajax({type: "POST", url: "actiondeletelost.php", data: {id:rowData[4]}, async: false,}).responseText;
         alert(res);  
        }
    });


    // Клик на плеере

    $('.Player button').click(function (e) {
        var parent = $(this).parent();
        var CL = $('.Player button');
        var button = $(this);
        var audio = $('audio', parent)[0];
        var content = 'pwav.php?wav='+encodeURIComponent(parent.attr('title'));
        var srt = audio.children[0];
        //console.log(srt.nodeName);
    
        // переключение состояния плеера и смена картинки на кнопке - плей или пауза
        if (audio.paused == false) {
            audio.pause();
            $('source').attr("src","");
            audio.load();

            button.css('background', 'url(img/Play.png)');
        } else {

            if(LastAudio != null) LastAudio.pause();   
            $('source').attr("src","");
            audio.load();
            
            $('.Player button').css('background', 'url(img/Play.png)');
            $('source').attr("src",content);
            audio.load();
            audio.play();
            LastAudio = audio;
            button.css('background', 'url(img/Pause.png)');
        }

        $(audio).on('ended', function() {
            button.css('background', 'url(img/Play.png)');
        });
    });

    



    $('#Ind').css('display','none');
     document.getElementById("BReceived").click();
} ); 

</script> 

<?php
    $Agents = Array();
    $res = $dbh->query("SELECT * FROM qstatslite.qagent");
    if($res) {
        while ($line = $res->fetch(PDO::FETCH_ASSOC))
           $Agents[$line[agent_id]] = $line[agent];
        }
    //print_r($Agents);    
    $Names = Array();
    $res = $dbh->query("SELECT * FROM qstatslite.qname");
    if($res) {
        while ($line = $res->fetch(PDO::FETCH_ASSOC))
           $Names[$line[qname_id]] = $line[queue];
        }
    //print_r($Names); 
?>

<body style="WIDTH: 95%; margin: 20px auto;  overflow: auto; ">

<?php
$auth = new AuthClass();
     
    if (isset($_POST["login"]) && isset($_POST["password"])) { //Если логин и пароль были отправлены
    if ($auth->auth($_POST["login"], $_POST["password"],$dbh) == 0) { //Если логин и пароль введен не правильно
        echo '<h1 style="color:red; text-align:center;">Неверный логин или пароль !</h1>';
        }
    }
    
    if (isset($_GET["is_exit"])) { //Если нажата кнопка выхода
    if ($_GET["is_exit"] == 1) {
        $auth->out(); //Выходим
        echo "<script> window.location.href = 'index.php';  </script>";
        }
    }

    if ($_SESSION['level'] > 0) {
        if ($_SESSION['level'] == 100) $UserButtons = 'display:dlock';
        else $UserButtons = 'display:none';

function GetSatus($level){
    if($level==100) return 'Administrator';
    else return 'User';
}

        //Phonebook($dbh,$_POST);
    if (isset($_POST["action"]))
      if($_POST["action"] == "add"){
    
    $phone = $dbh->quote($_POST["phone"]);
    $name = $dbh->quote($_POST["finame"]);
    $suname = $dbh->quote($_POST["suname"]);
    $res = $dbh->query("Insert INTO asteriskcdrdb.phonebook set phone=".$phone.", name=".$name.", suname=".$suname) or die("Error insert to PhoneBook");
    } else {
    if($_POST["action"] == "del"){
    // ******************** Delete Phone from PhoneBook ***********************
    $id = $dbh->quote($_POST["id"]);
    $res = $dbh->query("DELETE FROM asteriskcdrdb.phonebook WHERE id=".$id) or die("Error delete from PhoneBook");
        }
        //header("Location: ".$_SERVER['REQUEST_URI']);
        echo "<script language='JavaScript'>document.location.href='index.php'</script>";
    }


        // User action
    if (isset($_POST["action"]))
        // ******************** Add User ***********************
      if($_POST["action"] == "adduser"){
        $login = $dbh->quote($_POST["userlogin"]);
        $password = $dbh->quote(MD5($_POST["userpass"]));
        $res = $dbh->query("Insert INTO asteriskcdrdb.user set login=".$login.", password=".$password.", status=1") or die("Error insert to User");    

      } else {
        // ******************** Delete User ***********************
        if($_POST["action"] == "deluser"){
            $id = $dbh->quote($_POST["id"]);
            $res = $dbh->query("DELETE FROM asteriskcdrdb.user WHERE id=".$id) or die("Error delete from User");    
      }
      //header("Location: ".$_SERVER['REQUEST_URI']);
      echo "<script language='JavaScript'>document.location.href='index.php'</script>";
    }
?>

    <img src="img\rotor.gif" id="Ind">
    <table align="center" cellspacing="0" cellpadding="1" width="100%" border="0" style="text-align:center;vertical-align: middle; margin-top:20px; " >

    <tr height="40px">
        <td colspan="2">    
        <a href="?is_exit=1"><img src="img\back_black.png" id="MainExit" class="ImgInBody_Left" title="Выход"></a>
        <span id="MainUser" style="font-size: 25px; float:left; margin-left: 20px;"><?php echo $_SESSION['login'].' - '.GetSatus($_SESSION['level']) ?></span>
        </td>
    </tr>    

    <tr>
        <td width="49%" style="vertical-align: top;"><?php include_once 'lp.php';?></td>    
        <td width="49%" style="vertical-align: top;"><?php include_once 'rp.php';?></td>
    </tr> 
       
    </table>

<div id="Shadow" style=""></div>



     <!--************************* Add phone to phonebook ***********************-->
    <div id="AddPhone" class="InForm" style="display:none; height:370px;">
    <form method="post" action="" id="Phone" style="">
        <div class="AuhthHead">Добавить контакт<img src="img\close_red.png" class="ImgInBody_Right" id="AddPhoneClose" title="Закрыть"></div>
        <input type="hidden" name="action" value="add">
        
        <p></p>
        <label for="phone"><b>Номер телефона</b></label>
        <input type="text" id="PhoneNum" name="phone" style="width: 370px; position: relative; margin: 5px auto;"/>
        <label for="finame"><b>Имя</b></label>
        <input type="text" id="PhoneName" name="finame" style="width: 370px; position: relative; margin: 5px auto;" />
        <label for="suname"><b>Фамилия</b></label>
        <input type="text" id="PhoneSuName" name="suname" style="width: 370px; position: relative; margin: 5px auto;" />


        <input id="B_AddPhone" class="B_Submit" type="submit" value="Добавить" style="width: 370px; position: relative; margin: 20px auto;"/>
   
    </form> 
    </div>

    <!-- ************************* Del phone from phonebook ***********************-->
    <div id="DelPhone" class="InForm" style="display:none; height:250px;">
    <form method="post" action="" id="Phone" style="">
        <div class="AuhthHead">Удалить контакт<img src="img\close_red.png" class="ImgInBody_Right" id="DelPhoneClose" title="Закрыть"></div>
        <input type="hidden" name="action" value="del">
        <input id="DeletedId" type="hidden" name="id" value="">
        <p></p>
        <label for="delphone"><b>Удалить контакт с номером телефона?</b></label>
        <input type="hidden" id="DeletedNum" name="delphone" style="width: 370px; position: relative; margin: 5px auto;"/>
        <h2 id="DeletedNum_H2"><H2>
        <input id="B_DeletePhone" class="B_Submit" type="submit" value="Удалить" style="width: 370px; position: relative; margin: 20px auto;"/>
   
    </form> 
    </div>

    <!-- ************************* Add User ***********************-->
    <div id="AddUser" class="InForm" style="display:none; height:350px;">
    <form method="post" action="" id="FAddUser" style="">
        <div class="AuhthHead">Добавить пользователя<img src="img\close_red.png" class="ImgInBody_Right" id="AddUserClose" title="Закрыть"></div>
        <input type="hidden" name="action" value="adduser">
        
        <p></p>
        <label for="userlogin"><b>Логин</b></label>
        <input type="text" id="AddUserLogin" name="userlogin" style="width: 370px; position: relative; margin: 5px auto;"/>
        <label for="userpass"><b>Пароль</b></label>
        <input type="password" id="AddUserPass" name="userpass" style="width: 370px; position: relative; margin: 5px auto;" />
        <!-- <label for="suname"><b>Фамилия</b></label>
        <input type="text" id="PhoneSuName" name="suname" style="width: 370px; position: relative; margin: 5px auto;" /> -->

        <input id="B_AddUserSubmit" class="B_Submit" type="submit" value="Добавить" style="width: 370px; position: relative; margin: 20px auto;"/>
   
    </form> 
    </div>

    <!-- ************************* Del User ***********************-->
    <div id="DelUser" class="InForm" style="display:none; height:250px;">
    <form method="post" action="" id="FDelUser" style="">
        <div class="AuhthHead">Удалить пользователя<img src="img\close_red.png" class="ImgInBody_Right" id="DelUserClose" title="Закрыть"></div>
        <input type="hidden" name="action" value="deluser">
        <input id="DelUserId" type="hidden" name="id" value="">
        <p></p>
        <label for="deluserlogin"><b>Удалить пользователя?</b></label>
        <input type="hidden" id="DeletedUserLogin" name="deluserlogin" style="width: 370px; position: relative; margin: 5px auto;"/>
        <h2 id="DeletedUser_H2"><H2>
        <input id="B_DelUserSubmit" class="B_Submit" type="submit" value="Удалить" style="width: 370px; position: relative; margin: 20px auto;"/>
   
    </form> 
    </div>


<?php
    } else {
?>

    <!-- ************************* Autorization ***********************class="InForm" style="display:none;"-->
    <div id="Autorization" class="InForm" style="display:block;">

    <form method="post" action="" id="Auth" > 
        <div class="AuhthHead">Авторизация</div>

        <p></p>
        <label for="login"><b>Логин</b></label>
        <input type="text" id="Login" name="login" style="width: 350px; position: relative; margin: 5px auto;"/>

        <label for="password"><b>Пароль</b></label>
        <input type="password" id="Pas" name="password" style="width: 350px; position: relative; margin: 5px auto;" />
        <input id="B_Auth" class="B_Submit" type="submit" value="Вход" style="width: 350px; position: relative; margin: 20px auto;"/>

    </form> 
    </div>        
<?php
    }
    exit();
?>
</body>
</html>

<?php
function Phonebook ($db,$post){
if (isset($post["action"]))
        if($POST["action"] == "add"){
// ******************** Add Phone to PhoneBook ***********************
    $phone = $db->quote($POST["phone"]);
    $name = $db->quote($POST["finame"]);
    $suname = $db->quote($POST["suname"]);
    $res = $db->query("Insert INTO asteriskcdrdb.phonebook set phone=".$phone.", name=".$name.", suname=".$suname) or die("Error insert to PhoneBook");
    } else {
    if($POST["action"] == "del"){
// ******************** Delete Phone from PhoneBook ***********************
    $id = $db->quote($POST["id"]);
    $res = $db->query("DELETE FROM asteriskcdrdb.phonebook WHERE id=".$id) or die("Error delete from PhoneBook");
        }
    }
    //echo "Funcnion is Ok";
    return 0;
}

?>


