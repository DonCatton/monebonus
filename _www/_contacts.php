<?PHP
$str_title = 'Контакты';
if($req_uri != '/contacts'){Header("Location: /contacts");die();}
@require_once("_add/_header.php");
if(isset($_SESSION["payeer"])){@require_once("_add/_menu.php");}
?>
									<p>
									Всем посетителям и пользователям проекта 
									оказывается техническая поддержка 24 часа в сутки и  7 дней в неделю в режиме онлайн. <br>
									Вы можете задать интересующий вас вопрос касательно проекта администратору на прямую используя e-mail адрес.
									</p>
									<br>
									                              <!-- Ваш e-mail -->   
									<center><h2><font color="#127998">admin@bonus.ru</font></h2></center><br> 
			
 Или можете воспользоваться формой обратной связи ниже, указав ваш Payeer и e-mail для связи с вами.<br>
 <p class="link"></p>
			<br>
			<h1>Форма обратной связи.</h1><br>						
									
<?php
if (isset($_POST['name'])) {$name = $_POST['name']; if ($name == '') {unset($name);}}
if (isset($_POST['email'])) {$email = $_POST['email']; if ($email == '') {unset($email);}}
if (isset($_POST['sub'])) {$sub = $_POST['sub']; if ($sub == '') {unset($sub);}}
if (isset($_POST['body'])) {$body = $_POST['body']; if ($body == '') {unset($body);}}
if (isset($_POST['captcha_validation'])){$captcha_validation = $_POST['captcha_validation']; if ($captcha_validation == '') {unset($captcha_validation);}}
if (isset($_POST['captcha'])){$captcha = $_POST['captcha'];}

 
if (isset($name) && isset($email) && isset($sub) && isset($body) && isset($captcha_validation)){
 
  if ($captcha == $captcha_validation)
{


$address = "admin@bonus.ru"; // Укажите Ваш е-mail
$mes = "Имя: $name \nE-mail: $email \nТема: $sub \nТекст: $body";
$send = mail ($address,$sub,$mes,"Content-type:text/plain; charset = UTF-8\r\nFrom:$email");
if ($send == 'true')
{echo "<div class='alert alert-info'>Сообщение успешно отправлено.</div>";
echo "<meta http-equiv='refresh' content='3; url=/profile'>"; 
}
else {echo "<font color='#cc0000'><i class='fa fa-info' aria-hidden='true'></i> Ошибка, сообщение не отправлено!</font><br>";
}
}
else
{
echo "<font color='#cc0000'><i class='fa fa-info' aria-hidden='true'></i> Вы неправильно ввели цифры с картинки</font><br>";
}
 
}
else
{
echo "<font color='#667666'><i class='fa fa-info' aria-hidden='true'></i> Заполните все поля</font><br>";
}
?>
 

 
<form name="MyForm" action="" method="post" style="background-color:#fefefe" >
   <div class="auth">  
<p>Ваш Payeer: <input class="input" name="name" type="text" value="<?=$payeer;?>" style="width:62%"/></p>
<p>Ваш e-mail: <input class="input" name="email" type="text" style="width:64%" /></p>
<p>Тема сообщения: <input class="input" name="sub" type="text" style="width:51%" /></p>
<p>Текст сообщения:<br> <textarea name="body" cols="1" rows="5" style="width:89%" /></textarea></p>

<?php require ("captcha.php"); ?>
 
<p><input name="captcha_validation" type="text" maxlength="5" style="width:54%"></p>

  <p><small><font color="#999999">Ответ придет на указанную вами почту</font></small></p>
<input id="submit" style="background-color:#4fa44d" value="Отправить" type="submit" />
    </div>	
</form>	
								
									
									
<?PHP
@require_once("_add/_footer.php");
?>