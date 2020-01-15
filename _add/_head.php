<?PHP                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
// время
$time = time();
// адрес страницы
$req_uri = trim($_SERVER['REQUEST_URI']);

@session_start();
@ob_start("ob_gzhandler");
mb_internal_encoding("UTF-8");
define(CNSTFORINC, 'tHveW!m(Pq@z)h.tAqejy', true);
function __autoload($name){ @require_once("./_class/_class.".$name.".php"); }
$host = new host;
$func = new func;
$bd = new bd($host->HostDB, $host->UserDB, $host->PassDB, $host->BaseDB);
@require_once("_config.php");
@require_once("_sponsor.php");
?>