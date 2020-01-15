<?PHP
$str_title = 'Пользователи';
if($req_uri != '/usrs' AND !preg_match("|^[/usr?p=]+[0-9]{1,5}$|u",$req_uri)){Header("Location: /usrs");die();}
@require_once("_add/_header.php");
if(isset($_SESSION["payeer"])){@require_once("_add/_menu.php");}
?>
<h1>Пользователи</h1>
<p>Сортировка по: &nbsp;<a href="/usr"><font color="#838383">ID</font></a> / <b>Балансу</b></p><br>
								
									<table class="table table4">
										<thead>
											<tr>
												<th>Кошелек</th>
												<th>Баланс</th>
												<th>Заработал</th>
												<th>Дата регистрации</th>
												
											</tr>
										</thead>
										<tbody>
<?PHP

$pages = 0;
$bd->Query("SELECT COUNT(*) FROM `users_nykfageubf`");
$kol = $bd->FetchRow();
if($kol > 0){

$elems = 35;
$pages = ceil($kol/$elems);
if($pages < 1) {$pages = 1;}
if(!isset($_GET['p'])){$p = 1;} else {$p = $func->procVar($_GET['p'],0,1,0,'no');}
if($p < 1){$p = 1;}
if($p > $pages){$p = $pages;}
$start = ($p - 1)*$elems;


$bd->Query("SELECT `payeer`,`balance`,`date_reg`,`bns_kol` FROM `users_nykfageubf` ORDER BY `balance` DESC LIMIT ".$start.",".$elems);

while($a = $bd->FetchArray()){
$payeer = substr($a["payeer"],0,strlen($a["payeer"])-3).'<font color="#127998">***</font>';
$summ = $a["balance"];
$dates_add = $a["date_reg"];
$raz = $a["bns_kol"];

?>
											<tr>
											  <td><i class="fa fa-credit-card" aria-hidden="true"></i> <?=$payeer;?></td>
											  <td><?=$func->NumFormat($summ);?> &#8381;</td>
											  <td><?=$func->NumFormat($raz);?> &#8381;</td>
											  <td><i class="fa fa-calendar-o" aria-hidden="true"></i> <?=$func->TimeTime($dates_add);?></td>
											  
											</tr>
<?PHP
}
unset($a);
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
if($pages > 1){echo $func->Navigation($p,$pages);}
@require_once("_add/_footer.php");
?>