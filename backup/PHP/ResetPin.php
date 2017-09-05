<?php
	include_once 'sethash.php';
	include("../inc/GlobalVar.inc.php");
	$Oldpin = trim($_POST['Oldpin']);
	$pin = newencode(trim($_POST['pin']));
	$RememberPin = $_POST['RememberPin'];
	$_SESSION["pin"] =newdecode($pin);
	session_write_close();
	if($RememberPin == 1)
	{
		setcookie ($Pid, 'pin='.$pin, time() + $cookie_time);
	}
if(!isset($_SESSION["pin"]))
{
	header("Location: ChangePin.php");
	exit;
}
else $GV_pin = $_SESSION["pin"];
include("../config.php");
$Recloak = "raymond".$Oldpin;
include("Rendec.php");
$GV_pin = newdecode($pin);
include("endec.php");
$Old = new Rendec();
$New = new endec();
$query="SELECT * FROM spending where user_id=$GV_id";  // query string stored in a variable
$Result=mysql_query($query);          // query executed 

while($Row=mysql_fetch_array($Result)){
$amount1 = $Row['expenses'];
$amount = (float)$Old->new_decode("$amount1");
mysql_query("update spending set amount = $amount where id=$Row[id]");
}
$queryNew="SELECT * FROM spending where user_id=$GV_id";  // query string stored in a variable
$ResultNew=mysql_query($queryNew);          // query executed 

while($Row2=mysql_fetch_array($ResultNew)){
$amount2 = $Row2['amount'];
$expenses = $New->new_encode("$amount2");
mysql_query("update spending set expenses = '$expenses',amount=0 where id=$Row2[id]");
}
	mysql_close($link);
	header("Location: HERecorder.php");
	exit;

?>

