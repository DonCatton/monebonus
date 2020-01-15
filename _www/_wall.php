<?PHP
// аккаунт
if($sessiya == 1 AND $banned == 0 AND isset($_SESSION["payeer"])){
if(isset($_GET["accstr"])){
$smenu = $func->procVar($_GET["accstr"],0,0,0,'no');
$smenu = strval($smenu);
switch($smenu){

case "refs": @require_once("_www/w/_refs.php"); break;
case "pays": @require_once("_www/w/_pays.php"); break;
case "bonus": @require_once("_www/w/_bonus.php"); break;
case "banners": @require_once("_www/w/_banners.php"); break;
case "profile": @require_once("_www/w/_profile.php"); break;
case "exit": unset($_SESSION["payeer"]); Header("Location: /"); return; break;

default: @require_once("_www/_404.php"); break;
}
}
} else {
unset($_SESSION["payeer"]);
Header("Location: /");
die();
}
?>