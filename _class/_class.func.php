<?PHP
if(CNSTFORINC != 'tHveW!m(Pq@z)h.tAqejy'){die();}
// функции
class func {

public $UserIP = "Undefined";
public $TableID = -1;
public $UserAgent = "Undefined";

public function __construct(){
$this->UserIP = $this->GetUserIp();
$this->UserAgent = $this->UserAgent();
}
	
public function __destruct(){}

// ip юзера
public function GetUserIp(){
if($this->UserIP == "Undefined"){
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
$client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : ((!empty($_ENV['REMOTE_ADDR'])) ? $_ENV['REMOTE_ADDR'] : "unknown");
$entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
reset($entries);
while (list(, $entry) = each($entries)){
$entry = trim($entry);
if(preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list)){
$private_ip = array(
'/^0\./',
'/^127\.0\.0\.1/',
'/^192\.168\..*/',
'/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
'/^10\..*/');
$found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
if ($client_ip != $found_ip)
{
$client_ip = $found_ip;
break;
}
}
}
$this->UserIP = $client_ip;
return $client_ip;
}else return ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : "unknown" );
}else return $this->UserIP;
}
	
// ip юзера переводим в цифры
public function IpToInt($ip){
$ip = ip2long($ip);
($ip < 0) ? $ip+=4294967296 : true;
return $ip;
}

// цифры переводим в ip юзера
public function IntToIP($int){
$int = long2ip($int); 
return $int;
}

// сейчас дата время
public function GetTime($tis = 0, $unix = true, $template = "d.m.Y H:i:s"){
if($tis == 0){
return ($unix) ? time() : date($template,time());
}else return date($template,$unix);
}

// браузер юзера
public function UserAgent(){
$x = trim($_SERVER['HTTP_USER_AGENT']);
if(empty($x)){return false;} else {
$x = strip_tags($x);
$x = str_replace("\\", "", $x);
while(mb_strpos($x,"  ",0,"UTF-8") !== false){
$x = str_replace("  ", " ", $x);
}
$x = addslashes($x);
return $x;
}}

// обработка переменных
public function procVar($x,$pr,$okr,$per,$typ){
$x = trim($x);
if(empty($x)){return false;} else {
$x = strip_tags($x);
$x = str_replace("\\", "", $x);

if($pr == 0){
$x = str_replace(" ", "", $x);
} elseif($pr == 1){
while(mb_strpos($x,"  ",0,"UTF-8") !== false){
$x = str_replace("  ", " ", $x);
}}

if($okr == 1){
$x = intval($x);
$x = abs($x);
}

if($per == 1){
while(mb_strpos($x,"\r\n\r\n\r\n",0,"UTF-8") !== false){
$x = str_replace("\r\n\r\n\r\n", "\r\n\r\n", $x);
}}

if($typ == 'no'){
$x = addslashes($x);
return $x;
} else {

if($typ == 'md5'){
$x = mb_strtolower($x,'UTF-8');
$mask = '/^[a-z0-9]{32}$/ui';
} elseif($typ == 'payeer'){
$x = mb_strtoupper($x,'UTF-8');
$mask = '/^P[0-9]{7,10}$/u';
} elseif($typ == 'ip'){
$mask = '/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/ui';
} elseif($typ == 'country'){
$x = mb_strtoupper($x,'UTF-8');
$mask = '/^[A-Z]{2}$/u';
}

if(preg_match($mask, $x)){
$x = addslashes($x);
return $x;
} else {
return false;
}
}}}

// формат числа, функция для вводимых юзером чисел
public function checkSum($x){
$x = trim($x);
if(empty($x)){return false;} else {
$x = strip_tags($x);
$x = str_replace("\\", "", $x);
$x = str_replace(" ", "", $x);
$x = str_replace(",", ".", $x);
$x = abs($x);
if(preg_match("/^[0-9]{1,10}(\.[0-9]{1,2})?$/u", $x)){
$x = addslashes($x);
return $x;
} else {
return false;
}}}

// формат числа, функция для вывода чисел из БД
public function NumFormat($x,$n=2){
if($x < 10000){
$z = '';
} else {
$z = ' ';
}
$x = number_format($x, $n, '.', $z);
return $x;
}

// дата из цифр
public function DateTime($prmn){
$prmn = date("d.m.Y",$prmn);
return $prmn;
}

// дата и время из цифр
public function TimeTime($prmn){
$prmn = date("d.m.Y H:i",$prmn);
return $prmn;
}

// зашифровка кошелька
public function zpurse($prmn){
$prmn = substr($prmn,1);
$aaa = array('1','2','3','4','5','6','7','8','9','0');
$bbb = array('a','b','c','d','e','f','g','h','j','k');
$prmn = str_replace($aaa, $bbb, $prmn);
return $prmn;
}
// расшифровка кошелька
public function rpurse($prmn){
$aaa = array('1','2','3','4','5','6','7','8','9','0');
$bbb = array('a','b','c','d','e','f','g','h','j','k');
$prmn = str_replace($bbb, $aaa, $prmn);
$prmn = 'P'.$prmn;
return $prmn;
}

// постраничная навигация
public function Navigation($p,$pages){
if($p > 1){
$prev_page = '<li><a href="?p='.($p-1).'"><i class="fa fa-angle-double-left"></i></a></li>';
} else {
$prev_page = '<li class="active"><a><i class="fa fa-angle-double-left"></i></a></li>';
}
if($p < $pages){
$next_page = '<li><a href="?p='.($p+1).'"><i class="fa fa-angle-double-right"></i></a></li>';
} else {
$next_page = '<li class="active"><a><i class="fa fa-angle-double-right"></i></a></li>';
}
if($p - 2 == 1){
$prev_2_page = '';
} elseif($p - 2 > 0){
$prev_2_page = '<li><a href="?p='.($p-2).'">'.($p-2).'</a></li>';
} else {$prev_2_page = '';}

if($p - 1 == 1){
$prev_1_page = '';
} elseif($p - 1 > 0){
$prev_1_page = '<li><a href="?p='.($p-1).'">'.($p-1).'</a></li>';
} else {$prev_1_page = '';}

if($p + 2 == $pages){
$next_2_page = '';
} elseif($p + 2 < $pages){
$next_2_page = '<li><a href="?p='.($p+2).'">'.($p+2).'</a></li>';
} else {$next_2_page = '';}

if($p + 1 == $pages){
$next_1_page = '';
} elseif($p + 1 < $pages){
$next_1_page = '<li><a href="?p='.($p+1).'">'.($p+1).'</a></li>';
} else {$next_1_page = '';}

if($p == 1){
$first_page = '';
} elseif($p > 4){
$first_page = '<li><a href="?p=1">1</a></li><li><a>...</a></li>';
} else {$first_page = '<li><a href="?p=1">1</a></li>';}

if($p == $pages){
$last_page = '';
} elseif($p < $pages - 3){
$last_page = '<li><a>...</a></li><li><a href="?p='.$pages.'">'.$pages.'</a></li>';
} else {$last_page = '<li><a href="?p='.$pages.'">'.$pages.'</a></li>';}

$navigate = '<ul class="pagination">'.$prev_page.$first_page.$prev_2_page.$prev_1_page.'<li class="active"><a>'.$p.'</a></li>'.$next_1_page.$next_2_page.$last_page.$next_page.'</ul>';
return $navigate;
}

}
?>