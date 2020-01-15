<?PHP
// Баннеры
$str_title = 'Баннеры';
if($req_uri != '/banners'){Header("Location: /banners");die();}
@require_once("_add/_header.php");
@require_once("_add/_menu.php");

$refka = $func->zpurse($payeer);
?>
								<div class="alert alert-info">
				        <center><b>Баннеры - для привлечения пользователей.</b>
				        <br>
				        Для получения прямой ссылки на баннер нажмите ПКМ на баннере и выберите "Копировать адрес изображения".</center>
				        </div>
										<div class="panel-banner">
										<span>468&times;60</span>
										<a href="http://<?=$_SERVER['SERVER_NAME'];?>/?inv=<?=$refka;?>" target="_blank"><img src="/img/468x60.png" /></a>
										<textarea readonly="readonly"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/?inv=<?=$refka;?>" target="_blank"><img src="http://<?=$_SERVER['SERVER_NAME'];?>/img/468x60.png" /></a></textarea>
									</div>
					                 	<div class="panel-banner">
										<span>200&times;300</span>
										<a href="http://<?=$_SERVER['SERVER_NAME'];?>/?inv=<?=$refka;?>" target="_blank"><img src="img/200x300.gif" /></a>
										<textarea readonly="readonly"><a href="http://<?=$_SERVER['SERVER_NAME'];?>/?inv=<?=$refka;?>" target="_blank"><img src="http://<?=$_SERVER['SERVER_NAME'];?>/img/200x300.gif" /></a></textarea>
									</div>
<?PHP
@require_once("_add/_footer.php");
?>