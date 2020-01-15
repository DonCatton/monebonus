<?
// Выплаты
$str_title = 'Выплаты';
if($req_uri != '/pays' AND !preg_match("|^[/pays?p=]+[0-9]{1,5}$|u",$req_uri)){Header("Location: /pays");die();}
@require_once("_add/_header.php");
@require_once("_add/_menu.php");
?>
                                      <h1>Выплаты</h1>
									<p>Минимальная сумма вывода <?=$minpay;?> руб.</p>
<?

$bd->Query("SELECT COUNT(*) FROM `users_nykfageubf` WHERE `sponsor` = '$payeer' AND `bns_kol` >= '0' AND `all_refs` >= '0' AND `banned` = '0'");
$refact = $bd->FetchRow();

if(isset($_POST["pay"])){
	if($balance >= $minpay){
		if($all_refs >= 0){

				// задержка от 0.00001 до 0.01 секунды для разделения одновременных запросов
				$rand = mt_rand(10, 10000);
				usleep($rand);
				// защита от двойных post запросов
				if(!isset($_SESSION["ghkesad"]) OR $_SESSION["ghkesad"] <= $time-60){
				$_SESSION["ghkesad"] = $time;
				// проверяем сессию
				if(isset($_SESSION["ghkesad"])){

					$_SESSION['balanceee'] = $balance;
					$_SESSION['payeerser'] = $payeer;

					require_once('cpayeer.php');
					$accountNumber = 'P12312312'; // Payeer кошелек
					$apiId = '123456789'; // Api ID
					$apiKey = 'fjgJfgJhfvbGdgFSjfd'; // Секретный ключы
					$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
					if ($payeer->isAuth())
					{
						$initOutput = $payeer->initOutput(array(
							'ps' => '1136053',
							//'sumIn' => 1,
							'curIn' => 'RUB',
							'sumOut' => $balance,
							'curOut' => 'RUB',
							'comment' => 'Bonus',
							'param_ACCOUNT_NUMBER' => $_SESSION['payeerser']
						));

						if ($initOutput)
						{
							$historyId = $payeer->output();
							if ($historyId > 0)
							{
							  
                          $db = mysqli_connect('localhost', 'имя_пользователя', 'пароль_базы', 'имя_базы'); // Хоост, пользователь, пароль, база данных
								mysqli_query($db, "UPDATE `users_nykfageubf` SET balance = balance-'$_SESSION[balanceee]' WHERE payeer = '$_SESSION[payeerser]'");
								mysqli_query($db, "INSERT INTO `pays_tnmleafeuj` (`payeer`,`summa`,`dates_add`, `status`) VALUES ('$_SESSION[payeerser]',$_SESSION[balanceee],'$time', '1')");
    
								$_SESSION['balanceee'] = array();
								$_SESSION['payeerser'] = array();
								
							 unset($_SESSION["ghkesad"]);
                             echo "<div class='alert alert-info'>Выплата прошла успешно.</div>";
                             echo "<meta http-equiv='refresh' content='3; url=/pays'>";

							}
							else
							{
								echo '<div class="alert-msg"><p><font color="#cc0000"><i class="fa fa-info" aria-hidden="true"></i> Ошибка выплаты! Попробуйте позже.</font></p></div>';

							}
						}
						else
						{
							echo '<div class="alert-msg"><p><font color="#cc0000"><i class="fa fa-info" aria-hidden="true"></i> Ошибка выплаты! Попробуйте позже.</font></p></div>';
						}
					}
					else
					{
						echo '<div class="alert-msg"><p><font color="#cc0000"><i class="fa fa-info" aria-hidden="true"></i> Ошибка выплаты! Попробуйте позже.</font></p></div>';
					}

				}
			}
		} else{echo '<div class="alert-msg"><a href="#" class="close-alert"><i class="fa fa-times"></i></a><p>Пригласите 5 рефералов.</p></div>';}
	} else{echo '<div class="alert-msg"><p><font color="#cc0000"><i class="fa fa-info" aria-hidden="true"></i> Минимальная сумма для выплаты составляет '.$minpay.' руб.</font></p></div>';}
}
?>
									<form action="" method="post" style="background-color:#fefefe">
										<p>Баланс: <?=$func->NumFormat($balance);?> &#8381;</p>
										<input name="pay" type="hidden" />
										<input type="submit" class="button" style ="background-color:#4fa44d" value="Выслать на <?=$payeer;?>" />
								    </form>
									<table class="table table2">
										<thead>
											<tr>
												<th>Сумма</th>
												<th>Дата заказа</th>
												<th>Статус обработки</th>
											</tr>
										</thead>
										<tbody>
<?PHP
$pages = 0;
$bd->Query("SELECT COUNT(*) FROM `pays_tnmleafeuj` WHERE `payeer` = '$payeer'");
$kol = $bd->FetchRow();
if($kol > 0){

$elems = 10;
$pages = ceil($kol/$elems);
if($pages < 1) {$pages = 1;}
if(!isset($_GET['p'])){$p = 1;} else {$p = $func->procVar($_GET['p'],0,1,0,'no');}
if($p < 1){$p = 1;}
if($p > $pages){$p = $pages;}
$start = ($p - 1)*$elems;

$bd->Query("SELECT `summa`,`dates_add`,`status` FROM `pays_tnmleafeuj` WHERE `payeer` = '$payeer' ORDER BY `id` DESC LIMIT ".$start.",".$elems);
while($a = $bd->FetchArray()){
$summa = $a["summa"];
$dates_add = $a["dates_add"];
$status = $a["status"];
if($status == 0){
$status = '<font color="#127998"><i class="fa fa-clock-o" aria-hidden="true"></i> В обработке</font>';
} elseif($status == 1){
$status = '<font color="green"><i class="fa fa-check" aria-hidden="true"></i> Выплачено</font>';
} elseif($status == 2){
$status = '<font color="#cc0000"><i class="fa fa-times" aria-hidden="true"></i> Отказано</font>';
}
?>
										    <tr>
											  <td><i class="fa fa-credit-card" aria-hidden="true"></i> <?=$func->NumFormat($summa);?> &#8381;</td>
											  <td><i class="fa fa-calendar-o" aria-hidden="true"></i> <?=$func->TimeTime($dates_add);?></td>
											  <td><?=$status;?></td>
											</tr>
<?PHP
}
unset($a);
} else {
?>
											<tr>
											  <td colspan="3"><center>Вывод не производился</center></td>
											</tr>
<?PHP
}
?>
										</tbody>
									</table>
<?PHP
if($pages > 1){echo $func->Navigation($p,$pages);}
@require_once("_add/_footer.php");
?>