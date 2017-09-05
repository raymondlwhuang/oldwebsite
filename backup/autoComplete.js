window.onload = initAll;
var xhr = false;
var statesArray = new Array();
function initAll() {

	document.getElementById("searchField").onkeyup = searchSuggest;

    var forceActiveX = (window.ActiveXObject && location.protocol === "file:");
    if (window.XMLHttpRequest && !forceActiveX) {
        xhr = new XMLHttpRequest();
    }
    else {
        try {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        } catch(e) {}
    }	
	if (xhr) {
		xhr.onreadystatechange = setStatesArray;
		xhr.open("GET", "us-states.xml", true);
		xhr.send(null);
	}
	else {
		alert("Sorry, but I couldn't create an XMLHttpRequest");
	}
}

function setStatesArray() {
	if (xhr.readyState == 4) {
       if (xhr.status == 0 || (xhr.status >= 200 && xhr.status < 300) 
        || xhr.status == 304 
        || xhr.status == 1223) {    // defined in ajax.js
       var allStates=xhr.responseText;
	   var tempText = document.createElement("div");
        tempText.innerHTML = allStates;

        var objNodeList = tempText.getElementsByTagName("label");
				for (var i=0; i<objNodeList.length; i++) {
				
					statesArray[i] = objNodeList[i].innerHTML;
				}
		}
		else {
			alert("There was a problem with the request " + xhr.status);
		}
	}
}

function searchSuggest() {
	var str = document.getElementById("searchField").value;
	document.getElementById("searchField").className = "";
	if (str != "") {
		document.getElementById("popups").innerHTML = "";
		for (var i=0; i<statesArray.length; i++) {
			var thisState = statesArray[i];

			if (thisState.toLowerCase().indexOf(str.toLowerCase()) == 0) {
				var tempDiv = document.createElement("div");
				tempDiv.innerHTML = thisState;
				tempDiv.onclick = makeChoice;
				tempDiv.className = "suggestions";
				document.getElementById("popups").appendChild(tempDiv);
			}
		}
		var foundCt = document.getElementById("popups").childNodes.length;
		if (foundCt == 0) {
			document.getElementById("searchField").className = "error";
		}
		if (foundCt == 1) {
			document.getElementById("searchField").value = document.getElementById("popups").firstChild.innerHTML;
			document.getElementById("popups").innerHTML = "";
		}
	}
}

function makeChoice(evt) {
	if (evt) {	
		var thisDiv = evt.target;
	}
	else {
		var thisDiv = window.event.srcElement;
	}
	document.getElementById("searchField").value = thisDiv.innerHTML;
	document.getElementById("popups").innerHTML = "";
}