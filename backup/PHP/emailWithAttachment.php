<?php
  if (isset($_REQUEST['email'])) {
 	if ($_FILES)
	{
		$firstname = $_REQUEST['firstname'] ;
		$lastname = $_REQUEST['lastname'] ;
		$email = $_REQUEST['email'] ;
		$address = $_REQUEST['address'];
		$City = $_REQUEST['City'];
		$PostalCode = $_REQUEST['PostalCode'];
		$phone = $_REQUEST['phone'];
		$phone2 = $_REQUEST['phone2'];
		$phone3 = $_REQUEST['phone3'];
		$phone4 = $_REQUEST['phone4'];
		$phone5 = $_REQUEST['phone5'];
		$phone6 = $_REQUEST['phone6'];
		$HomePhone = "($phone)$phone2-$phone3";
		$CellPhone = "($phone4)$phone5-$phone6";
		$JobCategory = $_REQUEST['JobCategory'];
		$subject = "Resume" ;
		$name = $_FILES['filename']['name'];
		$ext = substr($name,strpos($name,".") + 1);
		$n = "$firstname"."$lastname"."."."$ext";
		setcookie( "notify", "Thank you for your application", time() + 60 * 60 * 24 * 365, "", "", false, true );
		$headers = "From: raymond@mundomedia.com\r\n";
		$headers .= "Reply-To: raymond@mundomedia.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		//			$headers = "CC: $cc\nX-Sender-IP: $ip\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$message = '<html><body>';
		$message .= "From: $firstname $lastname";
		$message .= "address: $address<br/>";
		$message .= "City: $City<br/>";
		$message .= "Postal Code: $PostalCode<br/>";
		$message .= "Home Phone: $HomePhone<br/>";
		$message .= "Cell Phone: $CellPhone<br/>";
		$message .= "Email Address: $email<br/>";
		$message .= "Job Category: $JobCategory<br/>";
		$message .= $_REQUEST['message'] ;
		$websit = $_SERVER['HTTP_HOST'];
		$message .= "<br/><br/><a href='$websit/$n' >Resume</a><br/>";
		$message .= '</body></html>';
		mail("raymond@mundomedia.com", $subject, $message, $headers) ;
		if(!move_uploaded_file($_FILES['filename']['tmp_name'], $n)) {
			echo  "Fail to Upload your resume!<br />";
			die;
		}
echo <<<_END
<script type="text/javascript">
window.open( 'emailWithAttachment.php', '_top');
</script>
_END;
	}
	else echo "No file has been uploaded";   
}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Send e-mail with attachment</title>
<link href="Scripts/styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="Scripts/anylinkmenu.css" />
<style type="text/css">
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    font-size:16px;    
    font-family: Arial, Helvetica, sans-serif;
}    

p {
    margin:0px 0px 13px;
}

.main {
    width:750px;
    margin:auto;
}

.survey-container {
    text-align:center;
    overflow:hidden;
}

fieldset {
    padding:5px 0px;
    margin:5px 0px;
    border:0px;                        
}

 fieldset legend {
    background-color:#E6E6E6;
    padding:1px 2px;
    font-weight:bold;
}


.survey-right{
    float:right;        
    width:360px;
	padding-left:20px;
    text-align:left;
}

#signup_form label {
    float:left;
    width:100px;
}

#signup_form input[type=text]:focus {
    border-color:#0000b3!important;
}

.LV_valid {
    padding-left: 18px;
    color:#00CC00;
    font-size: 12px;
}
    
.LV_invalid {
    padding-left: 18px;
    color:#CC0000;
    font-size: 12px;
}

.mobile-container {
    padding-bottom:15px;
}

.mobile-container .LV_valid {
    padding-left: 5px;
    color:#00CC00;
    font-size: 12px;
    position:absolute;
    margin-left:-60px;
    margin-top:25px;
}

.mobile-container .LV_invalid {
    padding-left: 5px;
    color:#CC0000;
    font-size: 12px;
    position:absolute;
    margin-left:-60px;
    margin-top:25px;
    
}

.style1 {
    font-family: Arial, Helvetica, sans-serif;
    color: #FFFFFF;
    font-size: 16px;
    font-weight: bold;
}



    .header{    
        border-bottom-color:#949494;  
        background-color:#CC0000;
    }
    .congratsmessage {
        border-bottom-color:#949494;
    }
.style2 {
	font-size: 18px;
	font-weight: bold;
}
.mobile-container .LV_valid {
    padding-left: 5px;
    color:#00CC00;
    font-size: 12px;
    position:absolute;
    margin-left:-60px;
    margin-top:37px;
}

.mobile-container .LV_invalid {
    padding-left: 5px;
    color:#CC0000;
    font-size: 12px;
    position:absolute;
    margin-left:-60px;
    margin-top:37px;
    
}
</style>
<script type="text/javascript" src="Scripts/menucontents.js"></script>
<script type="text/javascript" src="Scripts/anylinkmenu.js"></script>
<script type="text/javascript" src="Scripts/livevalidation_standalone.js"></script> 
<script type="text/javascript">
//anylinkmenu.init("menu_anchors_class") //Pass in the CSS class of anchor links (that contain a sub menu)
anylinkmenu.init("menuanchorclass");
function ForceNumericInput(field,DotIncl) {
	if (DotIncl == true) {var regExpr = /^[0-9]*([\.]?)[0-9]*$/;} else var regExpr = /^[0-9]*$/;
	if (!regExpr.test(field.value)) {field.value = field.value.substr(0,field.value.length-1);}
}
 function autoTab(a,b)
 {
	if(a.value.length == a.maxLength){
		document.getElementById(b).focus();
	}
 }
</script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>

<body>
<div id="content_wrap">
<form method='post' enctype='multipart/form-data'>
          <table width="538" border="0"  cellpadding="2" cellspacing="2">
            <tbody>
              <tr>
                <td width="213" class="formtext">First Name:</td>
                <td width="311" class="inputtext"><input name="firstname" maxlength="50" size="29" id="firstname" class="FieldPubreq" type="text" /></td>
              </tr>
              <tr>
                <td class="formtext">Last Name:</td>
                <td class="inputtext"><input name="lastname" maxlength="50" size="29" id="lastname" class="FieldPubreq" type="text" /></td>
              </tr>
              <tr>
                <td class="formtext"> Address:</td>
                <td class="inputtext"><input name="address" maxlength="70" size="29" id="address" type="text" class="address" /></td>
              </tr>
                            <tr>
                <td class="formtext">City:</td>
                <td class="inputtext"><input name="City" maxlength="70" size="29" id="City" type="text" class="address" /></td>
              </tr>
                            <tr>
                <td class="formtext">Postal Code:</td>
                <td class="inputtext"><input name="PostalCode" maxlength="70" size="29" id="PostalCode" type="text" class="address" /></td>
              </tr>
                            <tr>
                <td class="formtext">Home Phone:</td>
                <td class="inputtext"><input name="phone" maxlength="3" id="phone" class="phone" onkeyup="ForceNumericInput(this,false);autoTab(this,'phone2');" style="color: rgb(0, 0, 0); height: 18px; padding-top: 1px; width: 35px;" type="text" />
-
  <input name="phone2" maxlength="3" id="phone2" class="phone" onkeyup="ForceNumericInput(this,false);autoTab(this,'phone3');" style="color: rgb(0, 0, 0); height: 18px; padding-left: 1px; padding-top: 1px; width: 35px;" type="text" />
-
<input name="phone3" maxlength="4" id="phone3" class="phone" onkeyup="ForceNumericInput(this,false);autoTab(this,'phone4');" style="color: rgb(0, 0, 0); height: 18px; padding-left: 1px; padding-top: 1px; width: 45px;" type="text" /></td>
              </tr>
              <tr>
                <td class="formtext">Cell Phone:</td>
                <td class="inputtext"><input name="phone4" maxlength="3" id="phone4" class="phone" onkeyup="ForceNumericInput(this,false);autoTab(this,'phone5');" style="color: rgb(0, 0, 0); height: 18px; padding-top: 1px; width: 35px;" type="text" />
-
  <input name="phone5" maxlength="3" id="phone5" class="phone" onkeyup="ForceNumericInput(this,false);autoTab(this,'phone6');" style="color: rgb(0, 0, 0); height: 18px; padding-left: 1px; padding-top: 1px; width: 35px;" type="text" />
-
<input name="phone6" maxlength="4" id="phone6" class="phone" onkeyup="ForceNumericInput(this,false);autoTab(this,'email');" style="color: rgb(0, 0, 0); height: 18px; padding-left: 1px; padding-top: 1px; width: 45px;" type="text" /></td>
              </tr>
              <tr>
                <td class="formtext">Email Address:</td>
                <td class="inputtext"><input name="email" maxlength="70" size="29" id="email" type="text" class="email" /></td>
              </tr>
              <tr>
                <td class="formtext">Job Category:</td>
                <td class="inputtext">
				<select name="JobCategory" id="JobCategory" class="formfielddropdown" style="width: 250px;">
					<option value="customer_service_specialist">Customer Service Specialist</option>
					<option value="senior_rep">Senior Representative</option> 
					<option value="team_lead">Team Leads</option> 
					<option value="supervisor">Supervisors (min 5 years' experience)</option>
					<option value="customer_service_operations_coordinator">Customer Service and Operations Coordinator</option>
					<option value="corporate_customer_care_specialist">Corporate Customer Care Specialist</option>
					<option value="sales_support_associate">Sales Support Associate</option>
					<option value="bilingual_customer_service">Bilingual Customer Service/Sales</option>
					<option value="b2b_customer_care">Business to Business Customer Care</option>
					<option value="tech_support_rep">Technical Support Representative</option>
					<option value="human_resources">Human Resources</option>
					<option value="admin_asst">Administrative Assistant </option>
					<option value="exec_management">Executive Management (Min 10 years experience)</option>
					<option value="qa">Quality Assurance Experts (Min 5 years experience)</option>
					<option value="finance">Finance and Accounting</option>
					<option value="training">Training and Development</option>
					<option value="credit_ops">Credit Operations</option>
					<option value="marketing_specialist">Marketing Specialist</option> 
                </select>
				</td>
              </tr>
              <tr>
                <td class="formtext">Attach Your Resume:</td>
                <td class="inputtext">
				<input type='file' name='filename' size='29'  class="address"/>
				</td>
              </tr>		
                  <tr>
                    <td  class="formtext" colspan="2"><p align="center">Notes:</p></td>
                  </tr>
                  <tr>
                    <td class="inputtext" colspan="2"><p align="center">
                      <textarea name="message" id="message" cols="60" rows="5" class ="message"></textarea>
                    </p>
					
					</td>
                  </tr>			  
              <tr>
                <td height="59" colspan="2"  bgcolor="#e8e8e8" align="center">
                  <input type="submit" name="Submit" id="Submit" value="Apply Now"/>
                </td>
              </tr>
            </tbody>
          </table>

                <script type="text/javascript"> 
                      var my_testing = new LiveValidation('firstname', { validMessage: "OK", wait: 1100 });
                      my_testing.add(Validate.Presence, {failureMessage: "Required"});
                      var my_testing = new LiveValidation('lastname', { validMessage: "OK", wait: 1100 });
                      my_testing.add(Validate.Presence, {failureMessage: "Required"});

                      var phone = new LiveValidation('phone', { validMessage: "OK", wait: 1100 });
                      phone.add(Validate.Numericality , {notANumberMessage: "Not Numeric"});
                      //phone.add(Validate.Presence, {failureMessage: "Required"});
                      phone.add( Validate.Length, { is: 3, wrongLengthMessage: "Not 3-digits"} );
                      var phone2 = new LiveValidation('phone2', { validMessage: "OK", wait: 1100 });
                      phone2.add(Validate.Numericality , {notANumberMessage: "Not Numeric"});
                      //phone2.add(Validate.Presence, {failureMessage: "Required"});
                      phone2.add( Validate.Length, { is: 3, wrongLengthMessage: "Not 3-digits"} );
                      var phone3 = new LiveValidation('phone3', { validMessage: "OK", wait: 1100 });
                      phone3.add(Validate.Numericality , {notANumberMessage: "Not Numeric"});
                      phone3.add(Validate.Presence, {failureMessage: "Required"});
                      phone3.add( Validate.Length, { is: 4, wrongLengthMessage: "Not 4-digits"} ); 
                      var email = new LiveValidation('email', { validMessage: "OK", wait: 1100 });
                      email.add(Validate.Email, {failureMessage: "Invalid"});
                      email.add(Validate.Presence, {failureMessage: "Required"});
					  
                    </script>
		  
</form>
 </body>
</html>
 