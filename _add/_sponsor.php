<?PHP
if(CNSTFORINC != 'tHveW!m(Pq@z)h.tAqejy'){die();}
// определяем спонсора
if(isset($_GET["inv"])){
$sp = $func->procVar($_GET["inv"],0,0,0,'no');
$_SESSION["inv"] = $sp;
setcookie("inv",$sp,time()+60*60*24*30);
}
?>