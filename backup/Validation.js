window.onload = initForms;
var thisMsg = true;
var vertical=new Array("","","","",""); 
function initForms() {
	for (var i=0; i< document.forms.length; i++) {
		document.forms[i].onsubmit = function() {return validForm();}
	}
}
function validForm() {
	MessageTag = document.getElementById("ErrorMessage");
	MessageTag.color = "red";
	var allGood = true;
	var allTags = document.getElementsByTagName("*");

	for (var i=0; i<allTags.length; i++) {
		if (!validTag(allTags[i])) {
			allGood = false;
		}
	}

	return allGood;

	function validTag(thisTag) {
			var outClass = "";
			var allClasses = thisTag.className.split(" ");
			for (var j=0; j<allClasses.length; j++) {
				outClass += validBasedOnClass(allClasses[j]) + " ";
			}

			thisTag.className = outClass;

			if (outClass.indexOf(invalid) > -1) {
				if (colorLabel && thisMsg == true){invalidLabel(thisTag.parentNode.parentNode);}
				thisTag.focus();
				if (thisTag.nodeName == "INPUT") {
					thisTag.select();
				}
				return false;
			}
			thisMsg = true;
			return true;

			function validBasedOnClass(thisClass) {
				var classBack = "";

				switch(thisClass) {
					case "":
					case invalid:
						break;
					case emailfield:
						if (allGood && !validEmail(thisTag.value)) {
							classBack = invalid + " ";
						}
						classBack += thisClass;
						break;
					case altemailfield:
						if (allGood && thisTag.value != "" && !validEmail(thisTag.value)) {
							classBack = invalid + " ";
						}
						classBack += thisClass;
						break;
					case AffiliateId:
						if (allGood && thisTag.value != "" && !validAffiliateId(thisTag.value)) {
							classBack = invalid + " ";
						}
						classBack += thisClass;
						break;
					case website:
						if (allGood && !validWebsite(thisTag.value)) {
							classBack = invalid + " ";
						}
						classBack += thisClass;
						break;
					case phonefield:
						if (allGood && !validPhone(thisTag.value)) {
							classBack = invalid + " ";
						}
						classBack += thisClass;
						break;
					case passwordConfirm:
						if (allGood && !validPassword(thisTag.value)) {
							classBack = invalid + " ";
						}
						classBack += thisClass;
						break;
					case categoryfield:
						if (thisTag.value != "" && !validCategory(thisTag.value,thisTag.id)) {
							classBack = invalid + " ";
						}
						classBack += thisClass;
						break;						
					case reqdfield:
						if (allGood && thisTag.value == "") {
							classBack = invalid + " ";
						}
						classBack += thisClass;
						break;
					default:
						classBack += thisClass;
				}
				return classBack;
			}
			function validEmail(email) {
				var re = /^\\w+([\\.-]?\\w+)*@\\w+([\\.-]?\\w+)*(\\.\\w{2,3})+$/;
				if (!re.test(email)){
					MessageTag.innerHTML = "** Invalid e-mail address! **";
				}
				else MessageTag.innerHTML = "";
				thisMsg = false;
				return re.test(email);
			}
			function validAffiliateId(ID) {
				var re = /^\\s*(\\+|-)?\\d+\\s*$/;
				var re = /^(CD([\\d+]))/i;
				if (!re.test(ID)){
					MessageTag.innerHTML = "** Invalid Affiliated ID! **";
				}
				else MessageTag.innerHTML = "";
				thisMsg = false;
				return re.test(ID);
			}
			function validWebsite(website) {
				var re = /^(http:\\/\\/([\\-\\w]+\\.)+\\w{2,3}(\\/[%\\-\\w]+(\\.\\w{2,})?)*(([\\w\\-\\.\\?\\\\/+@&#;`~=%!]*)(\\.\\w{2,})?)*\\/?)/i;

				if (!re.test(website)){
					MessageTag.innerHTML = "** Invalid website! **";
				}
				else MessageTag.innerHTML = "";
				thisMsg = false;
				return re.test(website);
			}
			function validPhone(phone) {
				MessageTag.innerHTML = "** Invalid phone number! **";
				thisMsg = false;
				return phone.match(/[0-9]{10}/);
			}
			function validCategory(category,id) {
				var notfound = true;
			    for (var i=0; i< vertical.length; i++){
					if(vertical[i] !="" && vertical[i] == category && id.substr(id.length-1,1) != i){
						MessageTag.innerHTML = "** Duplicate vertical category not allowed! **";
						notfound = false;
						thisMsg = false;
						break;
					}
				}
				if(notfound){
					vertical[id.substr(id.length-1,1)] = category;
				}				
				return notfound;
			}
			function validPassword(password) {
				if (document.getElementById("password").value != password){
				MessageTag.innerHTML = "** Confirm password must match to password entered! **";
				thisMsg = false;
				return false;
				}
				return true;
			}			
			function invalidLabel(parentTag) {
			var cnt=0;
			while(thisTag != parentTag.children.item(cnt).children.item(0)){
			cnt++;
			}
				var ColorLabel = parentTag.children.item(cnt - 1).children.item(0);
				MessageTag.innerHTML = "** " + ColorLabel.innerHTML.substring(0,ColorLabel.innerHTML.length -1) + " must be filled! **";
				ColorLabel.className += " invalid";
			}
		}
}
function ForceNumericInput(field,DotIncl) {
	if (DotIncl == true) {var regExpr = /^[0-9]*([\\.]?)[0-9]*$/;} else var regExpr = /^[0-9]*$/;
	if (!regExpr.test(field.value)) {field.value = field.value.substr(0,field.value.length-1);}
}

