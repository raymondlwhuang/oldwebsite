<?php
require_once '../config.php';
$id = (int)mysql_real_escape_string($_REQUEST['id']);
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
$action = mysql_real_escape_string($_REQUEST['action']);
if($action=='delete') mysql_query("DELETE from `view_permission` where id = $id limit 1");
$query="SELECT * FROM view_permission where user_id = $user_id";  // query string stored in a variable
$ViewerList=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 

?>

<table border="1">
	<tr>
		<th>
		</th>
		<th align='left'>
		Friend's Name
		</th>	
		<th align='left'>
		Group
		</th>	
		<th>
		Can Chat With?
		</th>
	</tr>
<?php	
while($nt=mysql_fetch_array($ViewerList)){
echo "
<tr>
    <td align='left'>
	<input type='image' src='../images/delete.png' name='Delete' value='$nt[id]' onclick=\"DeleteRecord(this.value);\">
	</td>
    <td align='left'>
	$nt[name]
	</td>
    <td align='left'>
	$nt[viewer_group]
	</td>
	<td align='center'>
	
	";
	if ($nt['is_active'] == '1') echo "Yes";
	ELSE echo "No";
echo "</td></tr>
";
}
?>
</table>
