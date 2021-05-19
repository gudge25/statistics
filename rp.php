<div id="RightPanel" style="width: auto; padding: 10px;">    
	<div class="tab">
  		<p style="float:left; color:white;margin-left: 20px; font-size: 14px;">Контакты</p> 
	</div>
	<table  id="TContakts" align="center" cellspacing="0" cellpadding="1" width="100%" border="0" style="align:center;vertical-align: top; margin-top:0px; " >
		<tr>
			<td width="220px" style="vertical-align: top;">
				<div style="<?php echo $UserButtons;?> ">
					<!-- Кнопка "Добавить пользователя" -->
				<button id="B_UsersAdd" class="But" style="background: #009966; display:block;">
				<img src="img\user.png" class="ImgButton"><img src="img\add_white.png" class="ImgButton">Добавить пользователя</button>
					<!-- Поле "Выбранный пользователь" -->
				<div id="SelectedUser" class="SelPhone">Пользователь не выбран</div>
					<!-- Кнопка "Удалить пользователя" -->
				<button id="B_UsersDel" class="But" style="background: #E64D00; display:none;"> 
				<img src="img\user.png" class="ImgButton"><img src="img\close_white.png" class="ImgButton">Удалить пользователя</button>
					</div>
					<!-- Кнопка "Добавить контакт" -->
				<button id="B_AddContakt" class="But" style="background: #009966;">Добавить контакт</button>

				<div class="GroupHeader">Группы контактов</div>
				<div class="GroupBody">Мои контакты<span class="GroupSpan">33</span></div>
				<div class="GroupBody">Офис<span class="GroupSpan">44</span></div>
				<div class="GroupBody">Менеджер<span class="GroupSpan">21</span></div>
				<div class="GroupFoot" style="height:10px;"></div>
				<!--<button id="B_AddGroup" class="GroupFoot"><img src="img\add_white.png" class="ImgButton">Добавить группу</button>-->
					<!-- Поле "Выбранный контакт" -->
				<div id="SelectedPhohe" class="SelPhone">Контакт не выбран</div>
					<!-- Кнопка "Удалить контакт" -->
				<button id="B_DeleteKontakt" class="But" style="background: #E64D00; margin-top: 0px; display:none"><img src="img\close_white.png" class="ImgButton">Удалить контакт</button>
					<!-- Кнопка "Позвонить" -->
				<button id="B_Call" class="But" style="background: #33CC9A; display:none"><img src="img\Call.png" class="ImgButton">Позвонить</button>

				<!--<div class="Player" title="pwav.php?wav=ext.wav" type="audio/wav">
					<button></button>
					<audio preload="metadata">
  						
					<source src="pwav.php?wav=external-901-+380442909933-20201021-115839-1603270719.1988.wav" type="audio/wav">

					</audio>
				</div>
				<div class="Player">
					<button></button>
					<audio preload="metadata">
  						<source src="pwav.php?wav=external-901-+380443547303-20201021-121957-1603271997.2089.wav" type="audio/mpeg">
					</audio>
				</div>
				<div class="Player">
					<button></button>
					<audio preload="metadata">
  						<source src="audio\1.mp3" type="audio/mpeg">
					</audio>
				</div>-->

			</td>
			<td style="vertical-align: top;">
				<div style="<?php echo $UserButtons;?>">
				<table  id="TUsers" align="center" cellspacing="0" cellpadding="1" width="100%" border="1" style="text-align:center;vertical-align: middle; margin-top:0px; " >
				<thead>
					<h2>Пользователи</h2>
    				<tr Class="THead">
    					<td align="center" style="width:10%; vertical-align: middle;">Id</td>
        				<td align="center" style="width:30%; vertical-align: middle;">Логин</td>
        				<td align="center" style="width:30%; vertical-align: middle;">Статус</td>
        			</thead>
       			</thead>
       			<tbody>
       		<?php
				$res = $dbh->query("SELECT * FROM asteriskcdrdb.user ORDER BY id ASC");
    			if($res) {
        			while ($line = $res->fetch(PDO::FETCH_ASSOC)){		
        				echo '<tr Class="TBody">
            			<td>'.$line[id].'</td>
            			<td>'.$line[login].'</td>
            			<td>'.GetSatus($line[status]).'</td>
            			</tr>';
        			}
        		}
        	?>			
       			</tbody>	
				</table> 
				</div>

				<table  id="TPhonebook" align="center" cellspacing="0" cellpadding="1" width="100%" border="1" style="text-align:left; margin-top:20px; " >
    			<thead>
    			<tr Class="THead">
    				<h2>Контакты</h2>
    				<td align="center" style="width:10%; vertical-align: middle;">Id</td>
        			<td align="center" style="width:30%; vertical-align: middle;">Телефон</td>
        			<td align="center" style="width:30%; vertical-align: middle;">Имя</td>
        			<td align="center" style="width:30%; vertical-align: middle;">Фамилия</td>
        		</thead>
        		<tbody>
   
			<?php
				$res = $dbh->query("SELECT * FROM asteriskcdrdb.phonebook ORDER BY id DESC");
    			if($res) {
        			while ($line = $res->fetch(PDO::FETCH_ASSOC)){
            		echo '<tr Class="TBody">
            		<td>'.$line[id].'</td>
            		<td>'.$line[phone].'</td>
            		<td>'.$line[name].'</td>
            		<td>'.$line[suname].'</td>
            		</tr>';
        			}
    			}
			?>
				</tbody>
				</table>
			</td>
		</tr>
		<td>
			 

		</td>

	</table>
	  		
<?php


?>

</div>