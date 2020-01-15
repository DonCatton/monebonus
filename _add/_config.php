<?PHP
if(CNSTFORINC != 'tHveW!m(Pq@z)h.tAqejy'){die();}

// статистика,  тех. работы
$bd->Query("SELECT `bns_kol`,`from_refs`,`cash_out` FROM `stat_vexahkertg` WHERE `id` = '1' LIMIT 1");
if($bd->NumRows() == 1){
$a = $bd->FetchArray();
$st_bns_kol = $a["bns_kol"];
$st_from_refs = $a["from_refs"];
$st_cash_out = $a["cash_out"];
unset($a);
}

// временные интервалы
$back20min = $time-60*20;
$backhour = $time-60*60;
$backday = $time-60*60*24;
$backmounth = $time-60*60*24*30;

// сессия
$sessiya = 2;
if(isset($_SESSION["payeer"])){
$payeer = $func->procVar($_SESSION["payeer"],0,0,0,'payeer');
if($payeer !== false){
$bd->Query("SELECT * FROM `users_nykfageubf` WHERE `payeer` = '$payeer' LIMIT 1");
if($bd->NumRows() == 1){
$sessiya = 1;
$a = $bd->FetchArray();

$id = $a["id"];
$payeer = $a["payeer"];
$balance = $a["balance"];
$bns_kol = $a["bns_kol"];
$cash_out = $a["cash_out"];
$sponsor = $a["sponsor"];
$all_refs = $a["all_refs"];
$to_sponsor = $a["to_sponsor"];
$from_refs = $a["from_refs"];
$date_reg = $a["date_reg"];
$banned = $a["banned"];

unset($a);
// если забанен или баланс < 0
if($banned > 0 OR $balance < 0){
unset($_SESSION["payeer"]);
Header("Location: /");
die();
}

}}}

$uri = $_SERVER['SERVER_NAME'];
// название сайта
$site_name = 'Payeer Bonus';
// мин выплата
$minpay = 1;
// мин бонус
$minbns = 0.03;
// макс бонус
$maxbns = 0.06;
// рефские
$refsk = 0.2;

if(isset($_SESSION["inv"])){
$ref = '/?inv='.$func->procVar($_SESSION["inv"],0,0,0,'no');
} elseif(isset($_COOKIE["inv"])){
$ref = '/?inv='.$func->procVar($_COOKIE["inv"],0,0,0,'no');
} else {$ref = '';}
?>