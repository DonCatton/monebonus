<?PHP
// Бонусы
$str_title = 'Бонусы';
if($req_uri != '/bonus' AND !preg_match("|^[/bonus?p=]+[0-9]{1,5}$|u",$req_uri)){Header("Location: /bonus");die();}
@require_once("_add/_header.php");
@require_once("_add/_menu.php");
?>
									<h1>Бонусы</h1>
<?PHP
$chbns = 2;
// проверяем, что прошло 20 мин от последнего бонуса
$bd->Query("SELECT `dates_add` FROM `bonus_vrleqdaxjk` WHERE `payeer` = '$payeer' AND `dates_add` > '$back20min' ORDER BY `dates_add` DESC LIMIT 1");
if($bd->NumRows() == 1){
$last_bns = $bd->FetchRow();
$chbns = 1;

$data_due = $last_bns+60*20;
$dd_1 = date("Y-m-d",$data_due);
$dd_2 = date("H:i:s",$data_due);
$data_due = $dd_1.'T'.$dd_2;

$data_now = $time;
$dn_1 = date("Y-m-d",$data_now);
$dn_2 = date("H:i:s",$data_now);
$data_now = $dn_1.'T'.$dn_2;



$bd->Query("SELECT `summ` FROM `bonus_vrleqdaxjk` WHERE `payeer` = '$payeer' ORDER BY `id` DESC LIMIT 1");
while($a = $bd->FetchArray()){
$summ = $a["summ"];
?>

							 <div class="bonus">
							<p><i class="fa fa-gift" aria-hidden="true"></i> Вы успешно получили бонус в размере<b> <?=$func->NumFormat($summ);?> руб</b>.</p>
Следующий бонус будет доступен через:<br>
								<div class="timer">
									<div class="soon"
										 data-separator=":"
										 data-format="m,s"
										 data-scale-max="l"
										 data-separate-chars="false">
									</div>
								</div>
								<script type="text/javascript">
									(function(){
										var i=0,soons = document.querySelectorAll('.timer .soon'),l=soons.length;
										for (;i<l;i++) {
											soons[i].setAttribute('data-due','<?=$data_due;?>');
											soons[i].setAttribute('data-now','<?=$data_now;?>');
										}
									}());
								</script>
                              </div>

<?PHP
}
} else {
// записываем номер для бонуса
$num = mt_rand(1,15);
$bd->Query("SELECT COUNT(*) FROM `num_bonus_wbawhty` WHERE `payeer` = '$payeer'");
if($bd->FetchRow() > 0){
$bd->Query("UPDATE `num_bonus_wbawhty` SET `num` = '$num' WHERE `payeer` = '$payeer'");
} else {
$bd->Query("INSERT INTO `num_bonus_wbawhty` (`payeer`,`num`) VALUES ('$payeer','$num')");
}

// 0 - catcut отключен, 1 - catcut включен
$catcut = 1;

if($num == 1){
if($catcut == 1){
$bnslink = 'http://catcut.net/98cx';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=1';}
} elseif($num == 2){
if($catcut == 1){
$bnslink = 'http://catcut.net/c8cx';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=2';}
} elseif($num == 3){
if($catcut == 1){
$bnslink = 'http://catcut.net/g8cx';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=3';}
} elseif($num == 4){
if($catcut == 1){
$bnslink = 'http://catcut.net/h8cx';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=4';}
} elseif($num == 5){
if($catcut == 1){
$bnslink = 'http://catcut.net/i8cx';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=5';}
}  elseif ($num == 6){
if($catcut == 1){
$bnslink = 'http://catcut.net/j8cx';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=6';}
}  elseif ($num == 7){
if($catcut == 1){
$bnslink = 'http://catcut.net/m8cx';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=7';}
}  elseif ($num == 8){
if($catcut == 1){
$bnslink = 'http://profit-link.ru/short/1746/';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=8';}
} elseif ($num == 9){
if($catcut == 1){
$bnslink = 'http://q32.pw/btYu';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=9';}
}  elseif ($num == 10){
if($catcut == 1){
$bnslink = 'https://1ink.info/T5KDe';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=10';}
} elseif ($num == 11){
if($catcut == 1){
$bnslink = 'http://catcut.net/vkcx';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=11';}
} elseif ($num == 12){
if($catcut == 1){
$bnslink = 'http://catcut.net/xkcx';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=12';}
} elseif ($num == 13){
if($catcut == 1){
$bnslink = 'http://mellowads.com/6iYg2';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=13';}
} elseif ($num == 14){
if($catcut == 1){
$bnslink = 'http://mellowads.com/46EtP';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=14';}
} elseif ($num == 15){
if($catcut == 1){
$bnslink = 'http://mellowads.com/20E0x';
} else {$bnslink = 'http://'.$_SERVER['SERVER_NAME'].'/get.php?c=15';}
}
?>                                      
                           <br>
						 	    <div class="bonus">
						 		<div class="hid" id="hidden1" onclick="document.all.hidden1.style.display='block';" style="display:none">
							 		<center><a href="<?=$bnslink;?>" class="button" style ="background-color:#4fa44d">Получить бонус</a></center>
						        </div>
		<div id="div2">
<div class="hid" id="hidden2" onclick="document.all.hidden1.style.display='none';">
	
	  <center><font color="#223222"><i class="fa fa-info" aria-hidden="true"></i> Для того что бы получить бонус кликните по любому верхнему или нижнему баннеру<br></font></center>
     
</div>
         </div>
         </div>
         <br><br>

<?PHP
}
?>
									<table class="table table3">
										<thead>
											<tr>
												<th>Сумма</th>
												<th>Дата получения</th>
											</tr>
										</thead>
										<tbody>
<?PHP
$pages = 0;
$bd->Query("SELECT COUNT(*) FROM `bonus_vrleqdaxjk` WHERE `payeer` = '$payeer'");
$kol = $bd->FetchRow();
if($kol > 0){

$elems = 10;
$pages = ceil($kol/$elems);
if($pages < 1) {$pages = 1;}
if(!isset($_GET['p'])){$p = 1;} else {$p = $func->procVar($_GET['p'],0,1,0,'no');}
if($p < 1){$p = 1;}
if($p > $pages){$p = $pages;}
$start = ($p - 1)*$elems;

$bd->Query("SELECT `summ`,`dates_add` FROM `bonus_vrleqdaxjk` WHERE `payeer` = '$payeer' ORDER BY `id` DESC LIMIT ".$start.",".$elems);
while($a = $bd->FetchArray()){
$summ = $a["summ"];
$dates_add = $a["dates_add"];
?>
											<tr>
											  <td><?=$func->NumFormat($summ);?> &#8381; </td>
											  <td><i class="fa fa-calendar-o" aria-hidden="true"></i> <?=$func->TimeTime($dates_add);?></td>
											</tr>
<?PHP
}
unset($a);
} else {
?>
											<tr>
											  <td colspan="2"><center>Вы не собрали ни одного бонуса</center></td>
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