<?PHP
// Рефералы
$str_title = 'Рефералы';
if($req_uri != '/refs' AND !preg_match("|^[/refs?p=]+[0-9]{1,5}$|u",$req_uri)){Header("Location: /refs");die();}
@require_once("_add/_header.php");
@require_once("_add/_menu.php");

$refka = $func->zpurse($payeer);
?>
									<h1>Реферальная программа</h1>
									<p>Мы платим 20% от суммы каждого бонуса, полученного Вашими рефералами.</p>
									
									<div class="alert alert-info"><center>Ваша реферальная ссылка: <br>
									<input type="text" style="width: 250px; height: 35px;" value="http://<?=$_SERVER['SERVER_NAME'];?>/?inv=<?=$refka;?>"></center></div>
									<div><h1>Всего рефералов: <?=$func->NumFormat($all_refs,0);?> <i class="fa fa-group" aria-hidden="true"></i></h1></div>
									<br>
									<table class="table">
										<thead>
											<tr>
												<th>Кошелек</th>
												<th>Заработал на бонусах</th>
												<th>Ваш заработок</th>

												<th>Рефералов</th>

											</tr>
										</thead>
										<tbody>

						
<?PHP
$pages = 0;
$bd->Query("SELECT COUNT(*) FROM `users_nykfageubf` WHERE `sponsor` = '$payeer'");
$kol = $bd->FetchRow();
if($kol > 0){

$elems = 12;
$pages = ceil($kol/$elems);
if($pages < 1) {$pages = 1;}
if(!isset($_GET['p'])){$p = 1;} else {$p = $func->procVar($_GET['p'],0,1,0,'no');}
if($p < 1){$p = 1;}
if($p > $pages){$p = $pages;}
$start = ($p - 1)*$elems;

$bd->Query("SELECT `payeer`,`bns_kol`,`to_sponsor`,`all_refs` FROM `users_nykfageubf` WHERE `sponsor` = '$payeer' ORDER BY `to_sponsor` DESC LIMIT ".$start.",".$elems);
while($a = $bd->FetchArray()){
$payeer = substr($a["payeer"],0,strlen($a["payeer"])-3).'<font color="#127998">***</font>';
$bns_kol = $a["bns_kol"];
$to_sponsor = $a["to_sponsor"];
$all_refss = $a["all_refs"];
?>
											<tr>
											  <td><i class="fa fa-credit-card" aria-hidden="true"></i> <?=$payeer;?></td>
											  <td><?=$func->NumFormat($bns_kol);?> &#8381;</td>
											  <td><?=$func->NumFormat($to_sponsor);?> &#8381;</td>

											  <td><?=$all_refss;?></td>

											</tr>
<?PHP
}
unset($a);
} else {
?>
											<tr>
											  <td colspan="4"><center>У вас нет рефералов</center></td>
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