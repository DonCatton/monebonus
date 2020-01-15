<?PHP
@require_once("_add/_head.php");
if($sessiya == 1){

$get = end(explode("?", $req_uri));
parse_str($get, $_GET);

if(isset($_GET['c'])){
$num = trim($_GET['c']);

// проверяем номер бонуса
$bd->Query("SELECT `num` FROM `num_bonus_wbawhty` WHERE `payeer` = '$payeer' LIMIT 1");
if($bd->NumRows() == 1){
$num_bd = $bd->FetchRow();
} else {
$num_bd = 0;
}
if($num == $num_bd AND $num_bd > 0){

// ----------------------
$robot = 0;
// задержка от 0.00001 до 0.01 секунды для разделения одновременных запросов
$rand = mt_rand(10, 10000);
usleep($rand);
// защита от двойных post запросов
if(!isset($_SESSION["ghkesad"]) OR $_SESSION["ghkesad"] <= $time-60){
$_SESSION["ghkesad"] = $time;
// проверяем сессию
if(isset($_SESSION["ghkesad"])){
// проверяем, что прошел час от последнего бонуса
$bd->Query("SELECT `dates_add` FROM `bonus_vrleqdaxjk` WHERE `payeer` = '$payeer' ORDER BY `dates_add` DESC LIMIT 1");
if($bd->NumRows() == 1){
$last_bns = $bd->FetchRow();
} else {
$last_bns = 0;
}
if($last_bns < $back20min){

$bns_sum = mt_rand($minbns*100,$maxbns*100);
$bns_sum = $bns_sum/100;
$refsk_sum = $func->NumFormat($bns_sum*$refsk);

$sql = "";
// добавляем запись бонуса
$sql.= "INSERT INTO `bonus_vrleqdaxjk` (`payeer`,`summ`,`dates_add`) VALUES ('$payeer','$bns_sum','$time'); ";
// пополняем баланс
$sql.= "UPDATE `users_nykfageubf` SET `balance` = `balance` + '$bns_sum', `bns_kol` = `bns_kol` + '$bns_sum', `to_sponsor` = `to_sponsor` + '$refsk_sum' WHERE `payeer` = '$payeer'; ";
// начисляем спонсору
if($sponsor != 'admin'){
$sql.= "UPDATE `users_nykfageubf` SET `balance` = `balance` + '$refsk_sum', `from_refs` = `from_refs` + '$refsk_sum' WHERE `payeer` = '$sponsor'; ";
}
// апдейтим статистику
$sql.= "UPDATE `stat_vexahkertg` SET `bns_kol` = `bns_kol` + '$bns_sum', `from_refs` = `from_refs` + '$refsk_sum' WHERE `id` = '1'; ";
// апдейтим номер для бонуса
$sql.= "UPDATE `num_bonus_wbawhty` SET `num` = '0' WHERE `payeer` = '$payeer'; ";
$bd->MultiQuery($sql);
unset($_SESSION["ghkesad"]);
Header("Location: /bonus");
die();
}
unset($_SESSION["ghkesad"]);
}
}
// ----------------------

}
}
}

Header("Location: /bonus");
die();
?>