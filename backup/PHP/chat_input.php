<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link type="text/css" rel="stylesheet" href="styles.css" />
<form action="../main.php" class="submit_form" method="post" >
 <div>
 <img src="../images/chat.jpg" alt="chat" height="22"/>
 <input type="text" size="45" name="s_message" />
 <input type="submit" value="Say" name="s_say"  style="height:0px; width:0px; border:0px;"/>
 </div>
</form>
<script type="text/javascript">
function addInputSubmitEvent(form, input) {
    input.onkeydown = function(e) {
        e = e || window.event;
        if (e.keyCode == 13) {
            form.submit();
            return false;
        }
    };
}

window.onload = function() {
    var forms = document.getElementsByTagName('form');

    for (var i=0;i < forms.length;i++) {
        var inputs = forms[i].getElementsByTagName('input');

        for (var j=0;j < inputs.length;j++)
            addInputSubmitEvent(forms[i], inputs[j]);
    }
};
</script>
<?php
if(isset($_POST['s_message'])) {
	ECHO $_POST['s_message'];
}
?>