<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script language="JavaScript" src="http://j.maxmind.com/app/geoip.js"></script>
<script type="text/javascript">
    //Landing Pops [page1]
    var landingPopAlert = "ALERT:\\n\\n One Of Your Friends From " + geoip_city()  + " Thinks You're Hot! \\n\\n";
    var landingPop ="\\n________________________\\n\\n Click 'CANCEL' Below To Find Out Who! \\n\\n________________________\\n";
    var landingPopLink ="";


    //Exit Pops  [page2 - pageX]
    var exitPopAlert = "ALERT:\\n\\n One Of Your Friends From " + geoip_city()  + " Thinks You're Hot! \\n\\n";
    var exitPop ="\\n________________________\\n\\n Click 'CANCEL' Below To Find Out Who! \\n\\n________________________\\n";
    var exitPopLink ='';
    /*

    //Exit Pops [Cell Page]
    var cellPopAlert ="IQ ALERT:\\n\\n YOUR CRUSH SCORED 103 ON THE IQ QUIZ. \\n\\n";
    var cellPop ="\\n________________________\\n\\n CLICK 'CANCEL' BELOW TO CALCULATE YOUR IQ! \\n\\n________________________\\n";
    var cellPopLink ="";


    //Exit Pops [Pin Page]
    var pinPopAlert ="IQ ALERT:\\n\\n YOUR CRUSH SCORED 103 ON THE IQ QUIZ. \\n\\n";
    var pinPop ="\\n________________________\\n\\n CLICK 'CANCEL' BELOW TO CALCULATE YOUR IQ! \\n\\n________________________\\n";
    var pinPopLink ="";


    //Exit Pops [Thank You Page]
    */
    
    var confPopAlert ="ALERT:\\n\\n YOUR FREE TRIAL OFFER IS READY. \\n\\n";
    var confPop ="\\n________________________\\n\\n CLICK 'CANCEL' BELOW TO GET YOUR FREE TRIAL! \\n\\n________________________\\n";
    var confPopLink =""
            // fget gets called whenever a user tries to leave the page.
        window.onbeforeunload = fget

        /* The two statements below and the function below is needed to allow the exitpops to work
         * when the user tries to close the window.
         */
        var mouseX,mouseY;
        document.onmousemove=mtrack;
        function mtrack(e) {
            if (!e) {e=event}

            if (e.clientX!=null){
                mouseX=e.clientX;
                mouseY=e.clientY;
            }
        }
	    /*
     * The iframe variable, the checkPop function, and the resetPop function determine when the exit pops get fired.
     * For example, they should not fire when the user clicks the continue button.  This will not happen when iframe is
     * greater than one.
     */
    var iframe = 1;
    var crn_loc = window.location.href;
    function checkPop() {
        iframe = 100;
    }

    function resetPop() {
        iframe = 1;
    }
    
    function fget(){
        if (iframe < 2)
        {
            if (typeof(event)=="object")
            {
                mouseX=event.clientX;
                mouseY=event.clientY;
            }
            if (mouseY<10 && mouseX>400){
                alert(landingPopAlert);
                if (landingPopLink != ""){
                   window.location = landingPopLink;
                }
				return landingPop;
            }
        }
    }

    function onClickQuestion(){
        checkPop();
    }

    function exitpopRedir() {
        if(window.location.href == crn_loc) {
            window.onbeforeunload='';
            window.location.href=landingPopLink;
        }
    }
</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Exit Popup  -</title>
<style type="text/css" media="screen">
<!--
@import url( css/style2.css );
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	Refresh the screen will get a exit popup.
</body>
</html>