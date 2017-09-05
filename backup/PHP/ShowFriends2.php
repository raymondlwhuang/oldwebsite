<?php
session_start();
include("../config.php");
include("../inc/GlobalVar.inc.php");
$FriendCount = 0;
$query="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_email";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row2 = mysql_fetch_array($result))
{
	$curr_path = $row2['owner_path'];
	$FriendEmail[] = $row2['viewer_email'];
	if($row2['is_active']==3) $TalkStatus[] = 'checked'; else $TalkStatus[] = '';
	$TalkValue[] = $row2['is_active'];
	$queryFriends="SELECT * FROM user where  email_address = '$row2[viewer_email]' and is_active <> 0 LIMIT 1";
	$friend=mysql_query($queryFriends);          // query executed 
	echo mysql_error();
	while($row3 = mysql_fetch_array($friend))
	{
	 $first_name=ucfirst(strtolower($row3['first_name']));
	 $last_name = ucfirst(strtolower($row3['last_name']));
	 $profile_picture[] = $row3['profile_picture'];
	 $name[] = $first_name." ".$last_name;
	 $FriendStat[] = $row3['is_active'];
	} 
	$FriendCount = $FriendCount + 1;
}

?>
<style> 
a{text-decoration:none} 
</style> 

<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>"  name="FriendForm" id="FriendForm" method="post">
<input type="hidden" name="email" id="email" value ="">
<input type="hidden" name="activate" id="activate" value ="">
<table width="200" border="0">
<?php
foreach ($profile_picture as $key => $value) {
echo "<tr><td valign='top'>";
if($FriendStat[$key] == 3)
{
	echo <<<END
	<input type='image' name='TalkTo' value=$FriendEmail[$key] src='$value' width='35' onClick="document.getElementById('email').value='$FriendEmail[$key]';document.getElementById('activate').value='$TalkValue[$key]';" />
	</td><td  valign='center'><font size='2'><a href="" onClick="document.getElementById('email').value='$FriendEmail[$key]';document.getElementById('activate').value='$TalkValue[$key]';document.FriendForm.submit();return false;">$name[$key]</a></font>
END;
}
else
	echo "<img src='$value' width='35'/>
	</td><td  valign='center'><font size='2'>$name[$key]</font>";
echo "</td><td valign='center'>";	
if($FriendStat[$key] == 2) echo "<img src='../images/yellow.png' width='20'/>";
elseif($FriendStat[$key] == 4) echo "<img src='../images/red.png' width='20'/>";
elseif($FriendStat[$key] == 3)
{
echo <<<END
<input type='image' name='TalkTo' value=$FriendEmail[$key] src='../images/green.png' width='20' onClick="document.getElementById('email').value='$FriendEmail[$key]';document.getElementById('activate').value='$TalkValue[$key]';" />
END;
}
else echo "<img src='../images/white.png' width='20'/>";
echo "</td><td valign='center'>";
if($FriendStat[$key] == 3) {
	echo <<<END
	<input type='checkbox' name='TalkTo' value='$TalkValue[$key]' $TalkStatus[$key] onClick="document.getElementById('email').value='$FriendEmail[$key]';document.getElementById('activate').value='$TalkValue[$key]';document.FriendForm.submit();" />
END;
	}
	echo "</td></tr>";
}
?>	
</table>
</form>

