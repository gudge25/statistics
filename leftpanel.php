 <!-- ************************ LeftPanel *********************************** -->   
<div id="LeftPanel" style="width: auto; padding: 10px; ">    
<!-- Tab links -->
<div class="tab">
  <p style="float:left; color:white;margin-left: 20px; font-size: 14px;">История звонков</p> 
 <!-- <button id="BLost" class="tablinks" onclick="openCity(event, 'Lost')">Пропущенные</button>
  <button id="BPerfect" class="tablinks" onclick="openCity(event, 'Perfect')">Исходящие</button>
  <button id="BReceived" class="tablinks" onclick="openCity(event, 'Received')" >Входящие</button>-->
</div> 
<!-- Tab content -->

<!-- ************************ Совершенные звонки **********************************-->
<!--
<div id="Perfect" class="tabcontent" onclick="tableShow(event, 'Perfect')">

  <table  id="TPerfect" align="center" cellspacing="0" cellpadding="1" width="auto" border="1" style="text-align:left;vertical-align: middle; margin-top:20px; " >
    <thead>
    <tr Class="THead">
        <td align="center" style="width:20%; vertical-align: middle;">Абонент</td>
        <td align="center" style="width:20%x; vertical-align: middle;">Оператор</td>
        <td align="center" style="width:10%; vertical-align: middle;">Время ожидания (с)</td>
        <td align="center" style="width:10%; vertical-align: middle;">Длительность (с)</td>
        <td align="center" style="width:30%; vertical-align: middle;">Дата время</td>
        <td align="center" style="width:10%; vertical-align: middle;">Статус звонка</td>
    </tr>
    </thead>
     <tbody>
<?php /*
    $res = $dbh->query("SELECT * FROM asteriskcdrdb.cdr where dcontext='from-internal'  ORDER BY calldate DESC LIMIT 300");
    if($res) {
        while ($line = $res->fetch(PDO::FETCH_ASSOC)){
            echo '<tr Class="TBody">
            <td>'.$line[clid].'</td>
            <td>'.$line[dst].'</td>
            <td>'.$line[duration].'</td>
            <td>'.$line[billsec].'</td>
            <td>'.$line[calldate].'</td>
            <td>'.$line[disposition].'</td>
            </tr>';
        }
    }*/
?>    
     </tbody>
  </table>  
</div>-->

<!-- ************************ Принятые звонки **********************************-->
<!--
<div id="Received" class="tabcontent" onclick="tableShow(event, 'Received')">
  
<table  id="TReceived" align="center" cellspacing="0" cellpadding="1" width="auto" border="1" style="text-align:center;vertical-align: middle; margin-top:20px;" >
    <thead>
    <tr Class="THead">

        <td align="center" style="width:10%; vertical-align: middle;">Кто звонил (абонент)</td>
        <td align="center" style="width:10%; vertical-align: middle;">Кому звонили (сотрудник)</td>
        <td align="center" style="width:10%; vertical-align: middle;">Ожидание, сек (до соединения)</td>
        <td align="center" style="width:10%; vertical-align: middle;">Длительность разговора, сек</td>
        <td align="center" style="width:10%; vertical-align: middle;">Дата и время звонка</td> 
        <td align="center" style="width:10%; vertical-align: middle;">Разорвал соединение</td> 
        <td align="center" style="width:5%; vertical-align: middle;">uniqueid</td>

    </tr>
    </thead>
    <tbody>
<?php
    /*
    $res = $dbh->query("SELECT * FROM qstatslite.queue_stats where (qevent = 7 OR qevent = 8)ORDER BY queue_stats_id DESC LIMIT 300 ");
    if($res) {
        while ($line = $res->fetch(PDO::FETCH_ASSOC)){
            $Ansv = GetForReceived($dbh,$line[uniqueid]);
            echo '<tr Class="TBody">
                <td>'.$Ansv[Number_In].'</td>
                <td>'.$Agents[$Ansv[Operator]].'</td>
                <td>'.$Ansv[Wait].'</td>
                <td>'.$Ansv[Speak].'</td>
                <td>'.$Ansv[Call_Date].'</td>
                <td>'.$Ansv[end].'</td>
                <td>'.$line[uniqueid].'</td>
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
                $Ansv[Call_Date] = $line[datetime];
            }
            if(($line[qevent] == 7) ||($line[qevent] == 8)){
                    $Ansv[Operator] = $line[qagent];
                    $Ansv[Wait] = $line[info1];
                    $Ansv[Speak] = $line[info2];
                    if($line[qevent] == 7) $Ansv[end] = 'сотрудник';
                    if($line[qevent] == 8) $Ansv[end] = 'абонент';
            }
        }
    } else $Ansv = 'Error';
    return $Ansv;
}
*/  
?>    
    </tbody>
  </table> 
</div>-->

<!-- *************************** Потерянные звонки **********************-->

<!--
<div id="Lost" class="tabcontent"  onclick="tableShow(event, 'Lost')">

<table  id="TLost" align="center" cellspacing="0" cellpadding="1" width="auto" border="1" style="text-align:left;vertical-align: middle; margin-top:20px;" >
    <thead>
    <tr Class="THead">
 
        <td align="center" style="width:10%; vertical-align: middle;">Кто звонил (абонент)</td>
        <td align="center" style="width:10%; vertical-align: middle;">Кому звонили (сотрудник)</td>
        <td align="center" style="width:10%; vertical-align: middle;">Ожидание, сек</td>
        <td align="center" style="width:10%; vertical-align: middle;">Дата и время звонка</td>

        <td align="center" style="width:5%; vertical-align: middle;">uniqueid</td>

    </tr>
    </thead>
    <tbody>
<?php
    /*
    $res = $dbh->query("SELECT * FROM qstatslite.queue_stats where qevent = 1 ORDER BY queue_stats_id DESC LIMIT 300");
    if($res) {
        while ($line = $res->fetch(PDO::FETCH_ASSOC)){
 
                    $Ansv = GetForLost($dbh,$line[uniqueid]);read
                    
                    echo '<tr Class="TBody">
                    <td>'.$Ansv[Number_In].'</td>
                    <td>'.$Names[$Ansv[Operator]].'</td>
                    <td>'.$Ansv[Wait].'</td>
                    
                    <td>'.$Ansv[Call_Date].'</td>
                    <td>'.$line[uniqueid].'</td>
                    </tr>';
        }
    }

function GetForLost($PD,$id){
    $Ares = $PD->query("SELECT * FROM qstatslite.queue_stats where uniqueid = ".$id);
    $Ansv = Array();
    if($Ares) {
        while ($line = $Ares->fetch(PDO::FETCH_ASSOC)){
            if($line[qevent] == 11){
                $Ansv[Number_In] = $line[info2];
                $Ansv[Call_Date] = $line[datetime];
            }
            if($line[qevent] == 1){
                    $Ansv[Operator] = $line[qname];
                    $Ansv[Wait] = $line[info1];
                    $Ansv[Speak] = $line[info2];
            }
        }
    } else $Ansv = 'Error';
    return $Ansv;
}  */  
?>    
    </tbody>
  </table>   

</div>-->
</div> <!-- end LeftPanel>	