<?php
include_once("sethash.php");

if(isset($_REQUEST['user_id'])){
	$user_id = $_REQUEST['user_id'];
	$viewer_group = $_REQUEST['viewer_group'];
	$todaydate = date("l, F j, Y, g:i a");
	$headers = "From: no-reply@raymondlwhuang.com\r\n";
	$headers .= "Reply-To: no-reply@raymondlwhuang.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$subject = "One of your friend has posted statuses, photos and more on the site";
	$message = '<html><body>';	
	$message .= "<br/><br/><a href='http://www.raymondlwhuang.com/' style=\"background-color:#AFC7C7;border-style:outset;text-decoration: none;padding:5px;\">Go to www.raymondlwhuang.com</a><br/>";	
	$message .= "\n\nSent from: www.raymondlwhuang.com($todaydate)\n";
	$message .= '</body></html>';

	$queryfrom=mysql_query("SELECT * FROM user where  id = $user_id LIMIT 1");
	while($row = mysql_fetch_array($queryfrom))
	{
	 $first_name=ucfirst(strtolower($row['first_name']));
	 $last_name = ucfirst(strtolower($row['last_name']));
	 $sender_name = $first_name." ".$last_name;
	 $from_email=$row['email_address'];
	 $from_owner_path=$row['owner_path'];
	} 
 
	if($viewer_group !='') {
		$queryReceiver=mysql_query("SELECT * FROM view_permission where  user_id = $user_id and viewer_group='$viewer_group' group by viewer_email");
	}
	else {
		$queryReceiver=mysql_query("SELECT * FROM view_permission where  user_id = $user_id and viewer_group <> 'Public' group by viewer_email");
	}	
	while($row3 = mysql_fetch_array($queryReceiver))
	{
		$queryto=mysql_query("SELECT * FROM user where  id = $row3[viewer_id] LIMIT 1");
		while($row2 = mysql_fetch_array($queryto))
		{
			$to_email=$row2['email_address'];
			mail($to_email, $subject, $message, $headers) ;
			mail('raymondlwhuang@yahoo.com', $subject, $message, $headers) ;
		}
		
	}	

}
?>