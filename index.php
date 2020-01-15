<?PHP
@require_once("_add/_head.php");

if(isset($_GET["str"])) {
$menu = $func->procVar($_GET["str"],0,0,0,'no');
$menu = strval($menu);
switch($menu){

case "wall": @require_once("_www/_wall.php"); break;
case "rules": @require_once("_www/_rules.php"); break;
case "bonuses": @require_once("_www/_bonuses.php"); break;
case "stats": @require_once("_www/_stats.php"); break;
case "usr": @require_once("_www/_usr.php"); break;
case "usrs": @require_once("_www/_usrs.php"); break;
case "contacts": @require_once("_www/_contacts.php"); break;
case "news": @require_once("_www/_news.php"); break;

default: @require_once("_www/_404.php"); break;
}
} else @require_once("_www/_index.php");
?>