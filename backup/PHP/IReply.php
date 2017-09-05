<?php
include("../config.php");
include_once("sethash.php");
if(isset($_REQUEST['inviter']))
{
	if($_REQUEST['accept']==1){
		$inviter = newdecode($_REQUEST['inviter']);
		$invitee = newdecode($_REQUEST['invitee']);
		mysql_query("UPDATE view_permission SET is_active=1 WHERE owner_email='$inviter' and viewer_email='$invitee';");
		$query = mysql_query("SELECT * FROM user WHERE email_address='$inviter' limit 1");
		while($row=mysql_fetch_array($query)){
			$first_name=ucfirst(strtolower($row['first_name']));
			$last_name=ucfirst(strtolower($row['last_name']));
		}
echo <<<_END
<script type="text/javascript">
alert("Thank you. $first_name $last_name is your friend now!");
window.open( 'index.php', '_top');
</script>
_END;

	}
	else {
echo <<<_END
<script type="text/javascript">
alert("Thank you. You had rejected $first_name $last_name as your friend!");
window.open( 'index.php', '_top');
</script>
_END;
	
}	
}
?>
