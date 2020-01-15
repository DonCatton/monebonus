<?PHP
$str_title = 'Статистика';
if($req_uri != '/stats'){Header("Location: /stats");die();}
@require_once("_add/_header.php");
if(isset($_SESSION["payeer"])){@require_once("_add/_menu.php");}
?>


<?
$bd->Query("SELECT `users`,`bns_kol` FROM `stat_vexahkertg`");
while($a = $bd->FetchArray()){
$users = $a["users"];
$bns = $a["bns_kol"];
}
?>
<center>	
<div class="panel-stats2">
<div>Проект работает <span>
<script language=JavaScript>
<!--
d0 = new Date('June 29, 2018');
d1 = new Date();
dt = (d1.getTime() - d0.getTime()) / (1000*60*60*24);
document.write('' + Math.round(dt) + '');
-->
</script>-й день
</span></div>
<div>
Выдано бонусов <span> <?=$bns;?> &#8381; </span></div>
<div>Пользователей<span> <?=$users;?> <i class="fa fa-group" aria-hidden="true"></i></span></div>
										
										
									</div>
   	
 </center> 
          <h1>Последние выплаты</h1>
                        <p class="link"></p>
									<table class="table table4">
										<thead>
											<tr>
												<th>Кошелек</th>
												<th>Сумма</th>
												<th>Дата получения</th>
												<th>Статус</th>
											</tr>
										</thead>
										<tbody>
<?PHP
$bd->Query("SELECT `payeer`,`summa`,`dates_add`,`status` FROM `pays_tnmleafeuj` ORDER BY `id` DESC LIMIT 45");
if($bd->NumRows() > 0){
while($a = $bd->FetchArray()){
$payeer = substr($a["payeer"],0,strlen($a["payeer"])-3).'<font color="#127998">***</font>';
$summ = $a["summa"];
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
											  <td><i class="fa fa-credit-card" aria-hidden="true"></i> <?=$payeer;?></td>
											  <td><?=$func->NumFormat($summ);?> &#8381;</td>
											  <td><i class="fa fa-calendar-o" aria-hidden="true"></i> <?=$func->TimeTime($dates_add);?></td>
											  <td><?=$status;?></td>
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