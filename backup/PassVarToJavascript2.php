<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">

function validForm() {
 var MessageTag = document.getElementById("ErrorMessage");
 var signature = document.getElementById("signatureCheck").value.toLowerCase();
 var FirstLast = signature.split(" ");
 var FinalName = new Array(" "," "), j = 0;
var CheckName = "";
	 if(signature == "")
	 {
       MessageTag.innerHTML = "** Name that you entered is not the same as you entered in last page **";
       document.getElementById("signatureCheck").className = "invalid";
	   document.getElementById("signatureCheck").focus();
	   return false;
	 }	
	 for (var i=0; i< FirstLast.length; i++) {
		if(FirstLast[i] != "") {
			FinalName[j] = FirstLast[i];
			CheckName = CheckName + FirstLast[i];
			j++;
		}
	}
 	 <?php $first_name = $_REQUEST['first_name']; ?>
	var first_name = "<?php echo strtolower($first_name); ?>";
	var FirstNameOrg = first_name.split(" ");
	var FirstNameSplit = new Array(" "," "), j = 0;
	var FirstNameFinal = "";
	for (var i=0; i< FirstNameOrg.length; i++) {
		if(FirstNameOrg[i] != "") {
			FirstNameSplit[j] = FirstNameOrg[i];
			FirstNameFinal = FirstNameFinal + FirstNameSplit[j];
			j++;
		}
	}
	var FirstNameLen = j;
	 <?php $last_name = $_REQUEST['last_name']; ?>
	var last_name = "<?php echo strtolower($last_name); ?>";
	var LastNameOrg = last_name.split(" ");
	var LastNameSplit = new Array(" "," "), j = 0;
	var LastNameFinal = "";
	for (var i=0; i< LastNameOrg.length; i++) {
		if(LastNameOrg[i] != "") {
			LastNameSplit[j] = LastNameOrg[i];
			LastNameFinal = LastNameFinal + LastNameSplit[j];
			j++;
		}
	}
	var LastNameLen = j;
	var CheckFirstName1 = "";
	var CheckLastName1 = "";
	for (var i=0; i< FirstNameLen; i++) {
		CheckFirstName1 = CheckFirstName1 + FinalName[i];
	}	
	for (var i=0; i< LastNameLen; i++) {
		CheckLastName1 = CheckLastName1 + FinalName[FirstNameLen + i];
	}	
	var CheckFirstName2 = "";
	var CheckLastName2 = "";
	for (var i=0; i< LastNameLen; i++) {
		CheckLastName2 = CheckLastName2 + FinalName[i];
	}	
	for (var i=0; i< FirstNameLen; i++) {
		CheckFirstName2 = CheckFirstName2 + FinalName[LastNameLen + i];
	}	
	var CheckName2 = FirstNameFinal + LastNameFinal;
	if(CheckName2.length != CheckName.length) {
		MessageTag.innerHTML = "** Name that you entered is not the same as you entered in last page **";
		document.getElementById("signatureCheck").className = "invalid";
		document.getElementById("signatureCheck").focus();
		return false;	
	}
	
	if (!((CheckFirstName1 == FirstNameFinal && CheckLastName1 == LastNameFinal) || (CheckFirstName2 == FirstNameFinal && CheckLastName2 == LastNameFinal))){
		MessageTag.innerHTML = "** Name that you entered is not the same as you entered in last page **";
		document.getElementById("signatureCheck").className = "invalid";
		document.getElementById("signatureCheck").focus();
		return false;
	}
	MessageTag.innerHTML = "** The name you entered are accepted! **";
	return false;

}
</script>

</head>

<body>
<form name="agreement_form" id="agreement_form"  method="post" onsubmit="return validForm();">
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td>Enter your name: <input type="text" size="50" name="signatureCheck" id="signatureCheck" value=""  autocomplete="off"/></td>
</tr>
	<tr>
		<td><input type="submit" value="Submit" name="finalsubmit" /><br/><b><font color="red" id="ErrorMessage"></font></b></td>
	</tr>
</table>
</form>

</body>
</html>