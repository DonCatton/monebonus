<?PHP                                                                                                                                                                                                                                                                                                                                                                                                                                                           
// главная страница
$str_title = 'бонусы на Payeer';
if($req_uri != '/'){Header("Location: /");die();}
@require_once("_add/_header.php");
if(isset($_SESSION["payeer"])){@require_once("_add/_menu.php");}
?>

<!--
<div class="alert alert-info"><center><b><i class="fa fa-info" aria-hidden="true"></i>&nbsp;Важная новость.</b><br>
	<span>&nbsp;&nbsp;&nbsp;
	Текст новости
	</span>
	</center>
</div> 
-->				

								

<?PHP
if(!isset($_SESSION["payeer"])){

if(isset($_POST["payeer"])){
// задержка от 0.00001 до 0.01 секунды для разделения одновременных запросов
$rand = mt_rand(10, 10000);
usleep($rand);
// защита от двойных post запросов
if(!isset($_SESSION["ghkesad"]) OR $_SESSION["ghkesad"] <= $time-60){
$_SESSION["ghkesad"] = $time;
// проверяем сессию
if(isset($_SESSION["ghkesad"])){

$payeer = $func->procVar($_POST["payeer"],0,0,0,'payeer');
// если кошелек корректный
if($payeer !== false){

// если нет такого кошелька в системе
$bd->Query("SELECT COUNT(*) FROM `users_nykfageubf` WHERE `payeer` = '$payeer'");
if($bd->FetchRow() == 0){
$sql = "";
// определяем спонсора
if(isset($_SESSION["inv"])){
$ref = $func->procVar($_SESSION["inv"],0,0,0,'no');
} elseif(isset($_COOKIE["inv"])){
$ref = $func->procVar($_COOKIE["inv"],0,0,0,'no');
} else {$ref = 'cuomaeomcx';}
$ref = $func->rpurse($ref);
$bd->Query("SELECT COUNT(*) FROM `users_nykfageubf` WHERE `payeer` = '$ref'");
if($bd->FetchRow() == 1){
$sponsor = $ref;
} else {$sponsor = 'P8546321457';}
// добавляем юзера
$sql.= "INSERT INTO `users_nykfageubf` (`payeer`,`sponsor`,`date_reg`) VALUES ('$payeer','$sponsor','$time'); ";
// добавляем спонсору рефа
$sql.= "UPDATE `users_nykfageubf` SET `all_refs` = `all_refs` + '1' WHERE `payeer` = '$sponsor'; ";
// апдейтим статистику
$sql.= "UPDATE `stat_vexahkertg` SET `users` = `users` + '1' WHERE `id` = '1'; ";
$bd->MultiQuery($sql);
}

$_SESSION["payeer"] = $payeer;
unset($_SESSION["ghkesad"]);
Header("Location: /profile");
die();

} else{echo '<div class="alert-msg"><p><font color="#cc0000"><i class="fa fa-info" aria-hidden="true"></i> Кошелек указан неверно.</font></p></div>';}
unset($_SESSION["ghkesad"]);
}
}
}
?>
	<h1>Раздача бонусов на Payeer</h1>
									<div class="block_text_c_g_inf" style="min-height: 295px;">
		<img src="/img/3542.png" alt="">
		<p>
	&nbsp;Собирайте бонусы от <?=$minbns;?> до <?=$maxbns;?> каждые 20 мин. и получайте оплату за свой труд сразу же не прилагая особых затрат времени. Все полученные средства за сбор бонусов попадают на баланс для вывода.
	Выплаты доступны на платежную систему Pay<font color="#0195d5">eer</font>. 
	 <br>
	&nbsp;Зарабатывать можно не только получая бонусы, но и привлекая рефералов получая 20% от каждых сборов бонусов.<br>
	</p>
	<p>
	&nbsp; Вам даже не нужно регистрироваться. 
    Просто введите номер своего <a href="https://payeer.com/?partner=2471119">Payeer</a> кошелька в форму ниже.
	</p>                         
	                                <p><center>
									<form method="post" style="background-color:#fefefe">
									    <div class="auth">
											<label for="payeer">Введите Payeer кошелек:</label>
											<input type="text" class="input" name="payeer" maxlength="12" />
										<input type="submit" class="button" style="background-color:#4fa44d" value="Войти в аккаунт" />
                                         
								        </div>	
								    </form>
							      </center>  
							      </P>

	</div>
<?PHP
}else{
?>
<h1>Раздача бонусов на Payeer</h1>
									<div class="block_text_c_g_inf" style="height: 204px;">
		<img src="/img/3542.png" alt="">
		<p>
	&nbsp;Собирайте бонусы от <?=$minbns;?> до <?=$maxbns;?> каждые 20 мин. и получайте оплату за свой труд сразу же не прилагая особых усилий и затрат времени. Все полученные средства за сбор бонусов попадают на баланс для вывода.
	Выплаты доступны на платежную систему Pay<font color="#0195d5">eer</font>. 
	 <br>
	&nbsp;Зарабатывать можно не только получая бонусы, но и привлекая рефералов получая 20% от каждых сборов бонусов.<br>
	</p>

	</div>
<?PHP
}
?>
    
    
	<center><h1>ПОСЛЕДНИЕ БОНУСЫ</h1></center>
										<table class="table table4">
										<thead>
											<tr>
												<th>Кошелек</th>
												<th>Бонус</th>
												<th>Дата получения</th>
											</tr>
										</thead>
										<tbody>
<?PHP
$bd->Query("SELECT `payeer`,`summ`,`dates_add` FROM `bonus_vrleqdaxjk` ORDER BY `id` DESC LIMIT 12");
if($bd->NumRows() > 0){
while($a = $bd->FetchArray()){
$payeer = substr($a["payeer"],0,strlen($a["payeer"])-3).'<font color="#127998">***</font>';
$summ = $a["summ"];
$dates_add = $a["dates_add"];
?>
											<tr>
											  <td><i class="fa fa-credit-card" aria-hidden="true"></i> <?=$payeer;?></td>
											  <td><?=$func->NumFormat($summ);?> &#8381;</td>
											  <td><i class="fa fa-calendar-o" aria-hidden="true"></i> <?=$func->TimeTime($dates_add);?></td>
											</tr>
<?PHP
}
} else {
?>
											<tr>
											  <td colspan="3">-</td>
											</tr>
<?PHP
}
?>
										</tbody>
									</table>


<?PHP
@require_once("_add/_footer.php");
?>