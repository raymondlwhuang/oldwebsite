<?php
include("../config.php");
$result=mysql_query("SELECT CURRENT_TIMESTAMP");
while($row = mysql_fetch_array($result))
{
 $now = strtotime($row[0]);
}
$now2=strtotime(date("Y-m-d H:i:s")) ;
$diff_in_second=$now2-$now;
?> 

<script language="Javascript">
var diff_in_second=<?php echo $diff_in_second; ?>;
window.alert("different in second: "+diff_in_second);
var dt = new Date();
window.alert("different in min: "+dt.getTimezoneOffset());

// OR

//window.alert(new Date().getTimezoneOffset());

</script>