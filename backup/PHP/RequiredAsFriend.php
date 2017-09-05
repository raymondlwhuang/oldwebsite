<?php
include_once("sethash.php");

if(isset($_REQUEST['FriendID'])){
	$user_id = $_REQUEST['user_id'];
	$FriendID = $_REQUEST['FriendID'];
	$viewer_group = $_REQUEST['viewer_group'];
	$queryfrom=mysql_query("SELECT * FROM user where  id = $user_id LIMIT 1");
	while($row = mysql_fetch_array($queryfrom))
	{
	 $first_name=ucfirst(strtolower($row['first_name']));
	 $last_name = ucfirst(strtolower($row['last_name']));
	 $sender_name = $first_name." ".$last_name;
	 $from_email=$row['email_address'];
	 $from_owner_path=$row['owner_path'];
	} 
	$queryto=mysql_query("SELECT * FROM user where  id = $FriendID LIMIT 1");
	while($row2 = mysql_fetch_array($queryto))
	{
	 $to_email=$row2['email_address'];
	 $to_first_name=ucfirst(strtolower($row2['first_name']));
	 $to_last_name = ucfirst(strtolower($row2['last_name']));
	 $to_owner_path=$row['owner_path'];
	} 
	mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,is_active,viewer_id,viewer_email,first_name,last_name,viewer_group) VALUES($user_id,'$from_email', '$from_owner_path',9,$FriendID,'$to_email','$to_first_name','$to_last_name','$viewer_group')");

	$todaydate = date("l, F j, Y, g:i a");
	$userEmail=newencode("$from_email,$to_email,$sender_name,$user_id,$FriendID,$viewer_group,$to_owner_path,$first_name,$last_name");
	$headers = "From: no-reply@raymondlwhuang.com\r\n";
	$headers .= "Reply-To: no-reply@raymondlwhuang.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$subject = "Friend required";
	$message = '<html><body>';	
	$message .= "<h1>$sender_name want to be your friend,</h1>";
	$message .= "<br/><br/>Please Click here to <a href='http://raymondlwhuang.com/PHP/AcceptFriend.php?userEmail=$userEmail&accept=yes' > Accept</a><br/>";	
	$message .= "<br/><br/>Please Click here to <a href='http://raymondlwhuang.com/PHP/AcceptFriend.php?userEmail=$userEmail&accept=no' > Reject</a><br/>";	
	$message .= "\n\nSent from: www.raymondlwhuang.com($todaydate)\n";
	$message .= '</body></html>';
	if (preg_match("/bcc:/i", $to_email . " " . $message) == 0 &&          /* check for injected 'bcc' field */
		preg_match("/Content-Type:/i", $to_email . " " . $message) == 0 && /* check for injected 'content-type' field */
		preg_match("/cc:/i", $to_email . " " . $message) == 0 &&           /* check for injected 'cc' field */
		preg_match("/to:/i", $to_email . " " . $message) == 0) {           /* check for injected 'to' field */
		
		$sent = mail($to_email, $subject, $message, $headers) ;
		if($sent) {
			echo "sent";
		} else {
			echo "failed to sent";
		}
	} else  {
		echo "failed to sent";
	}

	
}
?>