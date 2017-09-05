<script language="JavaScript">
function formCheck( )	  
{
	if(document.getElementById("login").value=="Cancle") {
		document.getElementById("login").value="Log In";
		document.getElementById("ErrorMessage").innerHTML = "";
		document.getElementById("autologin").style.display="inline-block";
		document.getElementById("UserSetup").innerHTML="New User<br />Reset/Forget password";
		return false;
	}
	if (document.ValidateUser.username.value == "") 
	{  
	   document.getElementById("ErrorMessage").innerHTML = "Please provide your valid email address!";
	   return false;
	}
	var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (!re.test(document.getElementById("username").value)){
		document.getElementById("ErrorMessage").innerHTML = "Please provide your valid email address!";
		return false;
	}
	if (document.ValidateUser.password.value == "") 
	{  
	   document.getElementById("ErrorMessage").innerHTML = "Password required!!";
	   document.getElementById("autologin").style.display="inline-block";
	   document.getElementById("password").focus();
	   return false;
	}
}

function validEMail(email) {
	document.getElementById("login").value="Cancle";
	document.getElementById("UserSetup").innerHTML="Send<br /> Require";
	if(email=="") {
		document.getElementById("ErrorMessage").innerHTML = "Please provide your valid email address!";
		document.getElementById("autologin").style.display="none";
		return false;
	}
	var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (!re.test(email)){
		document.getElementById("ErrorMessage").innerHTML = "Please provide your valid email address!";
	}
	alert("Your require had been sent.\nPlease check you e-mail and follow the instruction.");
	return re.test(email);			
}	
</script>

<input type="image" src="../images/home.png" name="Home" id="Home" value="Home" width="40" onClick="window.open('index.php',target='_top');" style="display:inline-block;">
<form name="ValidateUser" method="Post" style="display:inline-block;">
	<div style="display:inline-block;">
		<div id="mydiv"><b><font color="red" id="ErrorMessage" size="4"><?php if(isset($ErrorMessage)) echo $ErrorMessage; ?></font></b><br/>
			Email: <input type="text" name="username" id="username" size="20" maxlength="30" value=""  onChange="document.ValidateUser.password.value = ''"/>
			<div style="display:inline-block;" id="autologin">
			Password:<input type="password" name="password" id="password"  size="10" maxlength="15" value="" AUTOCOMPLETE=OFF onfocus="this.value = ''"/>
			<input type="checkbox" name="autologin" value="1">Keep me loged in
			</div>
		</div>
	</div>
	<div class="pointer" style="display:inline-block;">
		<input type="submit" class="pointer" id="login" name="submit" value="Log In" onClick="return formCheck()" style="background-color:#174250;color:white;font-weight:bold;height:38px;vertical-align:top;border-radius: 10px;">
<!--		<input type="image" src="../images/login.jpg" name="submit" value="submit" alt="Login" width="100" onClick="return formCheck()">-->
		<button type="submit" name="UserSetup" id="UserSetup" class="pointer"  onClick="return validEMail(document.getElementById('username').value);document.ValidateUser.submit();" style="background-color:#174250;color:white;font-weight:bold;border-radius: 10px;">
			New User<br />
			Reset/Forget password
		</button>
	</div>
</form>
<hr/>