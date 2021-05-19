<div id="LeftPanel" style="width: auto; padding: 10px; ">    
<!-- Tab links -->
<div class="tab">
  <p style="float:left; color:white;margin-left: 20px; font-size: 14px;">История звонков</p> 
  <button id="BLost" class="tablinks" onclick="openCity(event, 'Lost')">Пропущенные</button>
  <button id="BPerfect" class="tablinks" onclick="openCity(event, 'Perfect')">Исходящие</button>
  <button id="BReceived" class="tablinks" onclick="openCity(event, 'Received')" >Входящие</button>
</div> 

<!-- ************************ Совершенные звонки (Исходящие) **********************************-->
<div id="Perfect" class="tabcontent">
    <h2 style="color:#3E83CA;">Исходящие</h2>
<table  id="TPerfect" align="center" cellspacing="0" cellpadding="1" width="100%" border="1" style="text-align:left;vertical-align: middle; margin-top:20px;" >
    <thead>
    <tr Class="THead" style="background:#3E83CA;">
        <td align="center" style="width:20%; vertical-align: middle;">Абонент</td>
        <td align="center" style="width:20%; vertical-align: middle;">Оператор</td>
        <td align="center" style="width:5%; vertical-align: middle;">Время ожидания (с)</td>
        <td align="center" style="width:5%; vertical-align: middle;">Длительность (с)</td>
        <td align="center" style="width:30%; vertical-align: middle;">Дата время</td>
        <td align="center" style="width:30px; vertical-align: middle;"><img src="img\Play.png"></td> 
        <td align="center" style="width:10%; vertical-align: middle;">Статус звонка</td>
    </tr>
    </thead>
     <tbody>
<?php 
    $res = $dbh->query("SELECT * FROM asteriskcdrdb.cdr where dcontext='from-internal'  ORDER BY calldate DESC LIMIT 500");
    if($res) {
        while ($line = $res->fetch(PDO::FETCH_ASSOC)){
            $Wait = $line[duration]-$line[billsec];
            echo '<tr Class="TBody">
            <td>'.$line[src].'</td>
            <td>'.$line[dst].'</td>
            <td>'.$Wait.'</td>
            <td>'.$line[billsec].'</td>
            <td>'.$line[calldate].'</td>
            <td  class="tdPlayer">'.Player($line[calldate],$line[uniqueid]).'</td>
            <td>'.$line[disposition].'</td>
            </tr>';
        }
    }
?>    
     </tbody>
  </table>  
</div>

<!-- ************************ (Входящие)**********************************-->

<div id="Received" class="tabcontent">
    <h2 style="color:green;">Входящие</h2>  
<table  id="TReceived" align="center" cellspacing="0" cellpadding="1" width="100%" border="1" style="text-align:center;vertical-align: middle; margin-top:20px;" >
    <thead>
    <tr Class="THead" style="background:green;">

        <td align="center" style="width:20%; vertical-align: middle;">Абонент</td>
        <td align="center" style="width:10%; vertical-align: middle;">Оператор</td>
        <td align="center" style="width:5%; vertical-align: middle;">Время ожидания (с)</td>
        <td align="center" style="width:5%; vertical-align: middle;">Длительность (с)</td>
        <td align="center" style="width:30%; vertical-align: middle;">Дата и время</td>
        <td align="center" style="width:30px; vertical-align: middle;"><img src="img\Play.png"></td> 
        <!--<td align="center" style="width:10%; vertical-align: middle;">Разорвал соединение</td> 
        <td align="center" style="width:5%; vertical-align: middle;">uniqueid</td>-->

    </tr>
    </thead>
    <tbody>
<?php
    
    //$res = $dbh->query("SELECT * FROM qstatslite.queue_stats where (qevent = 7 OR qevent = 8)ORDER BY `datetime` DESC LIMIT 50 ");
    $res = $dbh->query("SELECT * FROM asteriskcdrdb.cdr where (dcontext='ext-local' AND  billsec > 0) ORDER BY calldate DESC LIMIT 500");
    if($res) {
        while ($line = $res->fetch(PDO::FETCH_ASSOC)){
            
                $Wait = $line[duration]-$line[billsec];
            echo '<tr Class="TBody">
                <td>'.$line[src].'</td>
                <td>'.$line[dst].'</td>
                <td>'.$Wait.'</td>
                <td>'.$line[billsec].'</td>
                <td>'.$line[calldate].'</td>
                <td class="tdPlayer">'.Player($line[calldate],$line[uniqueid]).'</td>
                </tr>';

        }
    }


function GetForReceived($PD,$id){
    $Ares = $PD->query("SELECT * FROM qstatslite.queue_stats where uniqueid = ".$id);
    $Ansv = Array();
    if($Ares) {
        while ($line = $Ares->fetch(PDO::FETCH_ASSOC)){
            if($line[qevent] == 11){
                $Ansv[Number_In] = $line[info2];
                
            }
            if(($line[qevent] == 7) ||($line[qevent] == 8)){
                    $Ansv[Operator] = $line[qagent];
                    $Ansv[Wait] = $line[info1];
                    $Ansv[Call_Date] = $line[datetime];
                    $Ansv[Speak] = $line[info2];
                    if($line[qevent] == 7) $Ansv[end] = 'сотрудник';
                    if($line[qevent] == 8) $Ansv[end] = 'абонент';
            }
        }
    } else $Ansv = 'Error';
    return $Ansv;
}
  
?>    
    </tbody>
  </table> 
</div>

<!-- *************************** Потерянные звонки **********************-->


<div id="Lost" class="tabcontent">
    <h2 style="color:#F27A3D;">Пропущенные</h2> 
<table  id="TLost" align="center" cellspacing="0" cellpadding="1" width="100%" border="1" style="text-align:left;vertical-align: middle; margin-top:20px;" >
    <thead>
    <tr Class="THead" style="background:#F27A3D;">
        
        <td align="center" style="width:10%; vertical-align: middle;">Абонент</td>
        <td align="center" style="width:10%; vertical-align: middle;">Оператор (группа)</td>
        <td align="center" style="width:10%; vertical-align: middle;">Время ожидания (с)</td>
        <td align="center" style="width:30%; vertical-align: middle;">Дата и время</td>
        <td align="center" style="display:none;">uniqueid</td>
        

    </tr>
    </thead>
    <tbody>
<?php
    $uniqueid_prew = 0;
    //$res = $dbh->query("SELECT * FROM asteriskcdrdb.cdr where dcontext='ext-queues'  and billsec='0' ORDER BY calldate DESC LIMIT 500");
    $res = $dbh->query("SELECT * FROM asteriskcdrdb.cdr where dcontext='ext-queues' ORDER BY calldate DESC LIMIT 500");
    if($res) {
        while ($line = $res->fetch(PDO::FETCH_ASSOC)){
                /*
                    $Ansv = GetForLost($dbh,$line[uniqueid]);
                    
                    echo '<tr Class="TBody">
                    <td id="LostId" title="'.$line[uniqueid].'">'.$Ansv[Number_In].'</td>
                    <td>'.$Names[$Ansv[Operator]].'</td>
                    <td>'.$Ansv[Wait].'</td>
                    <td>'.$Ansv[Call_Date].'</td>
                    <td style="display:none;">'.$line[uniqueid].'</td>
                    </tr>';
                    */
        if($line[uniqueid] != $uniqueid_prew)
            if(GetForLost($dbh,$line[uniqueid])) {            
                    echo '<tr Class="TBody">
                    <td >'.$line[src].'</td>
                    <td>'.$line[dst].'</td>
                    <td>'.$line[duration].'</td>
                    <td>'.$line[calldate].'</td>
                    <td style="display:none;">'.$line[uniqueid].'</td>
                    </tr>';
                $uniqueid_prew = $line[uniqueid];
            }
        }
    }

function GetForLost($PD,$id){

    $Ares = $PD->query("SELECT * FROM asteriskcdrdb.cdr where uniqueid = ".$id." AND disposition = `ANSWERED`");
    if ($Ares->rowCount() > 0 ) then return false;
        else return true;

  /*  $Ares = $PD->query("SELECT * FROM qstatslite.queue_stats where uniqueid = ".$id);
    $Ansv = Array();
    if($Ares) {
        while ($line = $Ares->fetch(PDO::FETCH_ASSOC)){
            if($line[qevent] == 11){
                $Ansv[Number_In] = $line[info2];
                $Ansv[Call_Date] = $line[datetime];
            }
            if($line[qevent] == 1){
                    $Ansv[Operator] = $line[qname];
                    $Ansv[Wait] = $line[info3];
                    $Ansv[Speak] = $line[info2];
            }
        }
    } else $Ansv = 'Error';
    return $Ansv;*/

}    

function Player($dt,$uni){
	list($Ddate,$Dtime) = explode(' ', $dt);
	list($year,$month,$day) = explode('-', $Ddate);
	list($Hour,$Min,$Sec) = explode(':', $Dtime);
    // Путь к каталогу файлов
	$path = '../../../../var/spool/asterisk/monitor/'.$year.'/'.$month.'/'.$day.'/';
	
	$DirName = $path;
    // Поиск полного имени файла по его части ($uni)
    foreach(glob($DirName . "*".$uni.".wav") as $file) {
        $FileName[] = $file;
     }
    // Количество найденых файлов
    $lastIndex = count($FileName) - 1;
    if($lastIndex > -1) $FName = $FileName[0]; else $FName = "Not Exists";

	//$src = "pwav.php?wav=".urlencode($FName);
    $src = "";

	$out = '<div class="Player" title="'.$FName.'">
				<button></button>
				<audio preload="metadata">
  					<source src="'.$src.'" type="audio/wav">
				</audio>
			</div>';
	return $out;			
}
?>    
    </tbody>
  </table>   

</div>

</div>