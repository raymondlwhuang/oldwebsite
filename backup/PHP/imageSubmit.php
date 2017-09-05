<?php
if ( isset( $_POST['submit_x'] ) )
{
    echo "You submited with the image button!";
}
ELSEIF(isset($_POST['Save']))
{
echo "You submited with the Save button!";
}
?>

<form action="" method="post">
<input	type="image" name="submit"	src="../images/save.jpg" />
<input type="submit" name="Save" value="Save">
</form>