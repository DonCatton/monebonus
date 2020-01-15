<?PHP
// статистика
$str_title = 'Профиль';
if($req_uri != '/profile'){Header("Location: /profile");die();}
@require_once("_add/_header.php");
@require_once("_add/_menu.php");

$bd->Query("SELECT `payeer`,`balance`,`date_reg` FROM `users_nykfageubf` WHERE `payeer` = '$payeer'");
while($a = $bd->FetchArray())
$dates_add = $a["date_reg"];


$bd->Query("SELECT SUM(`summa`) FROM `pays_tnmleafeuj` WHERE `payeer` = '$payeer' AND `status` = '0'");
$cash_wait = $bd->FetchRow();
?>
<div class="block_text_c_g_inf" style="height: 175px;">
		<img src="/img/3542.png" alt="">
		<p>
	&nbsp;Собирайте бонусы от <?=$minbns;?> до <?=$maxbns;?> каждые 20 мин. и получайте оплату за свой труд сразу же не прилагая особых усилий и затрат времени. Все полученные средства за сбор бонусов попадают на баланс для вывода. Выплаты доступны на платежную систему Pay<font color="#0195d5">eer</font>. 
	 <br>
	&nbsp;Зарабатывать можно не только получая бонусы, но и привлекая рефералов получая 20% от каждых сборов бонусов.<br>
	</p>
	</div>


										<p><center><a href="/bonus" class="button" style ="background-color:#4fa44d">Получить бонус</a></center></p>
							            <br>
							            
	<div class="link"><h1>&nbsp;&nbsp;&nbsp;Профиль: <font color="#7c7c7c"> <?=$payeer;?></font></h1></div><br>
    <p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Дата регистрации:</b>  <?=$func->TimeTime($dates_add); ?></p>						            
							            
										<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ваша статистика:</b>
										<div class="panel-stats">
										<div>Ваш баланс <span> <?=$func->NumFormat($balance);?> &#8381; </span></div>   
										<div>Заработано на бонусах <span><?=$func->NumFormat($bns_kol);?> &#8381; </span></div>
										<div>Заработано на рефералах <span><?=$func->NumFormat($from_refs);?> &#8381; </span></div>
										<div>Суммарный заработок <span><?=$func->NumFormat($bns_kol+$from_refs);?> &#8381; </span></div>
										<div>Заказано на выплату <span><?=$func->NumFormat($cash_wait);?> &#8381; </span></div>
									    <div>Всего рефералов <span><?=$func->NumFormat($all_refs,0);?> <i class="fa fa-group" aria-hidden="true"></i></span></div>
									</div>
<?PHP
@require_once("_add/_footer.php");
?>