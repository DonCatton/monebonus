<?PHP
$str_title = 'Новости';
if($req_uri != '/news'){Header("Location: /news");die();}
@require_once("_add/_header.php");
if(isset($_SESSION["payeer"])){@require_once("_add/_menu.php");}
?>
                                          	<center><h1>Новости</h1></center>
						<!-- Код блока новости -->   
								<div class="links2">
								 <div class="link"> <font color="#127998"><i class="fa fa-info" aria-hidden="true"></i>
								 <b> Реферальные 20 % </font></b></div>
								<p> Уважаемые пользователи, с этого дня реферальные установлены 20%.</p>
								<p>   
								<i class="fa fa-calendar-o" aria-hidden="true"></i> <font color="#888888">Создана:  31.08.2018 10:18 </font> 
								</p>
								</div>
						<!-- Код блока новости -->  		
								<br>
						<!-- Код блока новости -->   		
								<div class="links2">
								<div class="link"> <font color="#127998"><i class="fa fa-info" aria-hidden="true"></i>
								<b> Старт проекта. </font></b></div>
								<p> Наш проект начал свою работу. Вы можете получать бонусы на Payeer.</p>
								<p>   
								<i class="fa fa-calendar-o" aria-hidden="true"></i> <font color="#888888">Создана:  10.07.2018 15:47 </font> 
								</p>
								</div>
						<!-- Код блока новости -->  
						
<?PHP
@require_once("_add/_footer.php");
?>