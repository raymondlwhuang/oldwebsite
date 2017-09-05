<?php
include("../config.php");
if (get_magic_quotes_gpc())
{
    function _stripslashes_rcurs($variable, $top = true)
    {
        $clean_data = array();
        foreach ($variable as $key => $value)
        {
            $key = ($top) ? $key : stripslashes($key);
            $clean_data[$key] = (is_array($value)) ?
                stripslashes_rcurs($value, false) : stripslashes($value);
        }
        return $clean_data;
    }
    $_REQUEST = _stripslashes_rcurs($_REQUEST);
}
$GV_pin = mysql_real_escape_string($_REQUEST['pin']);
include("endec.php");
$e = new endec();
$user_id = (int)$_REQUEST['user_id'];
$spender_id = (int)$_REQUEST['spender_id'];
$category_id = (int)$_REQUEST['category_id'];
$item_id = (int)$_REQUEST['item_id'];
$reminder = (int)$_REQUEST['reminder'];
$amount = (float)$_REQUEST['amount'];
$type_id = (int)$_REQUEST['type_id'];
$bank_id = (int)$_REQUEST['bank_id'];
$to_bank = (int)$_REQUEST['to_bank'];
$amount = $e->new_encode("$amount");
$start_date = date('Ymd');
if($reminder==2) {
	$newdate = strtotime ( "+1 day" , strtotime ( $start_date ) ) ;
}
elseif($reminder==3) {
	$newdate = strtotime ( "+1 week" , strtotime ( $start_date ) ) ;
}
elseif($reminder==4) {
	$newdate = strtotime ( "+2 week" , strtotime ( $start_date ) ) ;
}
elseif($reminder==5) {
	$newdate = strtotime ( "+1 month" , strtotime ( $start_date ) ) ;
}
elseif($reminder==6) {
	$newdate = strtotime ( "+3 month" , strtotime ( $start_date ) ) ;
}
elseif($reminder==7) {
	$newdate = strtotime ( "+6 month" , strtotime ( $start_date ) ) ;
}
else {
	$newdate = strtotime ( "+1 year" , strtotime ( $start_date ) ) ;
}

$activated = date ( 'Ymd' , $newdate );
if($reminder==5) {
	if(date('d') != date('d',$newdate)) $activated = date('Ymd', strtotime('last day of next month', strtotime ( $start_date )));
}
$beforeInsert = mysql_query("SELECT * FROM `sp_reminder` where user_id=$user_id and spender_id=$spender_id and category_id=$category_id and item_id=$item_id and frequency_id=$reminder and type_id=$type_id and bank_id=$bank_id and to_bank_id=$to_bank and activated='$activated' limit 1 ");
if(mysql_num_rows($beforeInsert)==0){
	mysql_query("INSERT INTO `sp_reminder`(`user_id`, `spender_id`, `category_id`, `item_id`, `frequency_id`, `amount`, `type_id`, `bank_id`, `to_bank_id`, `start_date`, `activated`) VALUES ($user_id, $spender_id, $category_id, $item_id, $reminder, '$amount', $type_id, $bank_id, $to_bank, '$start_date', '$activated')");
	echo mysql_error();
	echo "Reminder is set now!";
}
else echo "Duplicate reminder! operation canceled!";
mysql_close($link);

?>