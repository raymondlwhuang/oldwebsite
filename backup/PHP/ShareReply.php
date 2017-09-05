<?php
include("../config.php");
include_once("sethash.php");
if(isset($_REQUEST['infor']))
{
	$infor=newdecode($_REQUEST['infor']);
	$pieces = explode(",", $infor);
	$pv_id = (int)$pieces[0];
	$user_id = $pieces[1];
	$shareto_id = $pieces[2];
	$pv_name = $pieces[3];
	if($_REQUEST['accept']==1){
		mysql_query("UPDATE `pv_share` SET `accept`=0 WHERE pv_id=$pv_id and shareto_id=$shareto_id)"); /* accept=0 is accepted accept=1 is waiting*/
	}
}
?>
