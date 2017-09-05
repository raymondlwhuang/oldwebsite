<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Get Province/State base on country you selected</title>
<script type="text/javascript" src="../scripts/jquery-1.4.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#country').change(function () {
		var country = $(this).val();
		$.ajax({
		    type: 'POST',
		    url: 'signup.php',
		    data: 'change_state=' + country,
		    success: function(data) {
				$('#state_data').html(data);
			}
		});
	});
});
</script>
</head>
<body>
YOU NEED TO UPLOAD THIS INTO THE SERVER TO HAVE IT WORKED
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="FormPubText">
<tr>
<td>
              <select name="country" class="FieldPub" id="country">
                  <option value="1" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="1") echo "selected"; ?> >Asia/Pacific Region</option>
                  <option value="3" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="3") echo "selected"; ?> >Andorra</option>
                  <option value="4" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="4") echo "selected"; ?> >United Arab Emirates</option>
                  <option value="5" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="5") echo "selected"; ?> >Afghanistan</option>
                  <option value="6" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="6") echo "selected"; ?> >Antigua and Barbuda</option>
                  <option value="7" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="7") echo "selected"; ?> >Anguilla</option>
                  <option value="8" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="8") echo "selected"; ?> >Albania</option>
                  <option value="9" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="9") echo "selected"; ?> >Armenia</option>
                  <option value="10" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="10") echo "selected"; ?> >Netherlands Antilles</option>
                  <option value="11" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="11") echo "selected"; ?> >Angola</option>
                  <option value="12" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="12") echo "selected"; ?> >Antarctica</option>
                  <option value="13" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="13") echo "selected"; ?> >Argentina</option>
                  <option value="14" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="14") echo "selected"; ?> >American Samoa</option>
                  <option value="15" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="15") echo "selected"; ?> >Austria</option>
                  <option value="16" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="16") echo "selected"; ?> >Australia</option>
                  <option value="17" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="17") echo "selected"; ?> >Aruba</option>
                  <option value="18" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="18") echo "selected"; ?> >Azerbaijan</option>
                  <option value="19" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="19") echo "selected"; ?> >Bosnia and Herzegovina</option>
                  <option value="20" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="20") echo "selected"; ?> >Barbados</option>
                  <option value="21" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="21") echo "selected"; ?> >Bangladesh</option>
                  <option value="22" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="22") echo "selected"; ?> >Belgium</option>
                  <option value="23" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="23") echo "selected"; ?> >Burkina Faso</option>
                  <option value="24" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="24") echo "selected"; ?> >Bulgaria</option>
                  <option value="25" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="25") echo "selected"; ?> >Bahrain</option>
                  <option value="26" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="26") echo "selected"; ?> >Burundi</option>
                  <option value="27" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="27") echo "selected"; ?> >Benin</option>
                  <option value="28" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="28") echo "selected"; ?> >Bermuda</option>
                  <option value="29" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="29") echo "selected"; ?> >Brunei Darussalam</option>
                  <option value="30" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="30") echo "selected"; ?> >Bolivia</option>
                  <option value="31" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="31") echo "selected"; ?> >Brazil</option>
                  <option value="32" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="32") echo "selected"; ?> >Bahamas</option>
                  <option value="33" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="33") echo "selected"; ?> >Bhutan</option>
                  <option value="34" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="37") echo "selected"; ?> >Bouvet Island</option>
                  <option value="35" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="35") echo "selected"; ?> >Botswana</option>
                  <option value="36" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="36") echo "selected"; ?> >Belarus</option>
                  <option value="37" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="37") echo "selected"; ?> >Belize</option>
                  <option value="38" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="38") echo "selected"; ?> >Canada</option>
                  <option value="39" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="39") echo "selected"; ?> >Cocos (Keeling) Islands</option>
                  <option value="40" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="40") echo "selected"; ?> >Congo, The Democratic Republic of the</option>
                  <option value="41" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="41") echo "selected"; ?> >Central African Republic</option>
                  <option value="42" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="42") echo "selected"; ?> >Congo</option>
                  <option value="43" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="43") echo "selected"; ?> >Switzerland</option>
                  <option value="44" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="44") echo "selected"; ?> >Cote D'Ivoire</option>
                  <option value="45" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="45") echo "selected"; ?> >Cook Islands</option>
                  <option value="46" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="46") echo "selected"; ?> >Chile</option>
                  <option value="47" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="47") echo "selected"; ?> >Cameroon</option>
                  <option value="48" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="48") echo "selected"; ?> >China</option>
                  <option value="49" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="49") echo "selected"; ?> >Colombia</option>
                  <option value="50" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="50") echo "selected"; ?> >Costa Rica</option>
                  <option value="51" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="51") echo "selected"; ?> >Cuba</option>
                  <option value="52" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="52") echo "selected"; ?> >Cape Verde</option>
                  <option value="53" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="53") echo "selected"; ?> >Christmas Island</option>
                  <option value="54" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="54") echo "selected"; ?> >Cyprus</option>
                  <option value="55" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="55") echo "selected"; ?> >Czech Republic</option>
                  <option value="56" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="56") echo "selected"; ?> >Germany</option>
                  <option value="57" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="57") echo "selected"; ?> >Djibouti</option>
                  <option value="58" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="58") echo "selected"; ?> >Denmark</option>
                  <option value="59" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="59") echo "selected"; ?> >Dominica</option>
                  <option value="60" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="60") echo "selected"; ?> >Dominican Republic</option>
                  <option value="61" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="61") echo "selected"; ?> >Algeria</option>
                  <option value="62" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="62") echo "selected"; ?> >Ecuador</option>
                  <option value="63" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="63") echo "selected"; ?> >Estonia</option>
                  <option value="64" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="64") echo "selected"; ?> >Egypt</option>
                  <option value="65" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="65") echo "selected"; ?> >Western Sahara</option>
                  <option value="66" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="66") echo "selected"; ?> >Eritrea</option>
                  <option value="67" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="67") echo "selected"; ?> >Spain</option>
                  <option value="68" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="68") echo "selected"; ?> >Ethiopia</option>
                  <option value="69" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="69") echo "selected"; ?> >Finland</option>
                  <option value="70" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="70") echo "selected"; ?> >Fiji</option>
                  <option value="71" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="71") echo "selected"; ?> >Falkland Islands (Malvinas)</option>
                  <option value="72" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="72") echo "selected"; ?> >Micronesia, Federated States of</option>
                  <option value="73" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="73") echo "selected"; ?> >Faroe Islands</option>
                  <option value="74" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="74") echo "selected"; ?> >France</option>
                  <option value="75" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="75") echo "selected"; ?> >France, Metropolitan</option>
                  <option value="76" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="76") echo "selected"; ?> >Gabon</option>
                  <option value="77" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="77") echo "selected"; ?> >United Kingdom</option>
                  <option value="78" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="78") echo "selected"; ?> >Grenada</option>
                  <option value="79" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="79") echo "selected"; ?> >Georgia</option>
                  <option value="80" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="80") echo "selected"; ?> >French Guiana</option>
                  <option value="81" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="81") echo "selected"; ?> >Ghana</option>
                  <option value="82" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="82") echo "selected"; ?> >Gibraltar</option>
                  <option value="83" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="83") echo "selected"; ?> >Greenland</option>
                  <option value="84" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="84") echo "selected"; ?> >Gambia</option>
                  <option value="85" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="85") echo "selected"; ?> >Guinea</option>
                  <option value="86" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="86") echo "selected"; ?> >Guadeloupe</option>
                  <option value="87" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="87") echo "selected"; ?> >Equatorial Guinea</option>
                  <option value="88" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="88") echo "selected"; ?> >Greece</option>
                  <option value="89" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="89") echo "selected"; ?> >South Georgia and the South Sandwich Islands</option>
                  <option value="90" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="90") echo "selected"; ?> >Guatemala</option>
                  <option value="91" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="91") echo "selected"; ?> >Guam</option>
                  <option value="92" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="92") echo "selected"; ?> >Guinea-Bissau</option>
                  <option value="93" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="93") echo "selected"; ?> >Guyana</option>
                  <option value="94" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="94") echo "selected"; ?> >Hong Kong</option>
                  <option value="95" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="95") echo "selected"; ?> >Heard Island and McDonald Islands</option>
                  <option value="96" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="96") echo "selected"; ?> >Honduras</option>
                  <option value="97" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="97") echo "selected"; ?> >Croatia</option>
                  <option value="98" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="98") echo "selected"; ?> >Haiti</option>
                  <option value="99" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="99") echo "selected"; ?> >Hungary</option>
                  <option value="100" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="100") echo "selected"; ?> >Indonesia</option>
                  <option value="101" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="101") echo "selected"; ?> >Ireland</option>
                  <option value="102" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="102") echo "selected"; ?> >Israel</option>
                  <option value="103" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="103") echo "selected"; ?> >India</option>
                  <option value="104" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="104") echo "selected"; ?> >British Indian Ocean Territory</option>
                  <option value="105" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="105") echo "selected"; ?> >Iraq</option>
                  <option value="106" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="106") echo "selected"; ?> >Iran, Islamic Republic of</option>
                  <option value="107" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="107") echo "selected"; ?> >Iceland</option>
                  <option value="108" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="108") echo "selected"; ?> >Italy</option>
                  <option value="109" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="109") echo "selected"; ?> >Jamaica</option>
                  <option value="110" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="110") echo "selected"; ?> >Jordan</option>
                  <option value="111" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="111") echo "selected"; ?> >Japan</option>
                  <option value="112" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="112") echo "selected"; ?> >Kenya</option>
                  <option value="113" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="113") echo "selected"; ?> >Kyrgyzstan</option>
                  <option value="114" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="114") echo "selected"; ?> >Cambodia</option>
                  <option value="115" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="115") echo "selected"; ?> >Kiribati</option>
                  <option value="116" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="116") echo "selected"; ?> >Comoros</option>
                  <option value="117" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="117") echo "selected"; ?> >Saint Kitts and Nevis</option>
                  <option value="118" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="118") echo "selected"; ?> >Korea, Democratic People's Republic of</option>
                  <option value="119" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="119") echo "selected"; ?> >Korea, Republic of</option>
                  <option value="120" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="120") echo "selected"; ?> >Kuwait</option>
                  <option value="121" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="121") echo "selected"; ?> >Cayman Islands</option>
                  <option value="122" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="122") echo "selected"; ?> >Kazakhstan</option>
                  <option value="123" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="123") echo "selected"; ?> >Lao People's Democratic Republic</option>
                  <option value="124" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="124") echo "selected"; ?> >Lebanon</option>
                  <option value="125" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="125") echo "selected"; ?> >Saint Lucia</option>
                  <option value="126" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="126") echo "selected"; ?> >Liechtenstein</option>
                  <option value="127" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="127") echo "selected"; ?> >Sri Lanka</option>
                  <option value="128" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="128") echo "selected"; ?> >Liberia</option>
                  <option value="129" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="129") echo "selected"; ?> >Lesotho</option>
                  <option value="130" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="130") echo "selected"; ?> >Lithuania</option>
                  <option value="131" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="131") echo "selected"; ?> >Luxembourg</option>
                  <option value="132" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="132") echo "selected"; ?> >Latvia</option>
                  <option value="133" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="133") echo "selected"; ?> >Libyan Arab Jamahiriya</option>
                  <option value="134" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="134") echo "selected"; ?> >Morocco</option>
                  <option value="135" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="135") echo "selected"; ?> >Monaco</option>
                  <option value="136" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="136") echo "selected"; ?> >Moldova, Republic of</option>
                  <option value="137" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="137") echo "selected"; ?> >Madagascar</option>
                  <option value="138" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="138") echo "selected"; ?> >Marshall Islands</option>
                  <option value="139" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="139") echo "selected"; ?> >Macedonia</option>
                  <option value="140" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="140") echo "selected"; ?> >Mali</option>
                  <option value="141" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="141") echo "selected"; ?> >Myanmar</option>
                  <option value="142" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="142") echo "selected"; ?> >Mongolia</option>
                  <option value="143" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="143") echo "selected"; ?> >Macau</option>
                  <option value="144" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="144") echo "selected"; ?> >Northern Mariana Islands</option>
                  <option value="145" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="145") echo "selected"; ?> >Martinique</option>
                  <option value="146" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="146") echo "selected"; ?> >Mauritania</option>
                  <option value="147" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="147") echo "selected"; ?> >Montserrat</option>
                  <option value="148" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="148") echo "selected"; ?> >Malta</option>
                  <option value="149" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="149") echo "selected"; ?> >Mauritius</option>
                  <option value="150" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="150") echo "selected"; ?> >Maldives</option>
                  <option value="151" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="151") echo "selected"; ?> >Malawi</option>
                  <option value="152" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="152") echo "selected"; ?> >Mexico</option>
                  <option value="153" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="153") echo "selected"; ?> >Malaysia</option>
                  <option value="154" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="154") echo "selected"; ?> >Mozambique</option>
                  <option value="155" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="155") echo "selected"; ?> >Namibia</option>
                  <option value="156" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="156") echo "selected"; ?> >New Caledonia</option>
                  <option value="157" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="157") echo "selected"; ?> >Niger</option>
                  <option value="158" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="158") echo "selected"; ?> >Norfolk Island</option>
                  <option value="159" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="159") echo "selected"; ?> >Nigeria</option>
                  <option value="160" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="160") echo "selected"; ?> >Nicaragua</option>
                  <option value="161" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="161") echo "selected"; ?> >Netherlands</option>
                  <option value="162" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="162") echo "selected"; ?> >Norway</option>
                  <option value="163" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="163") echo "selected"; ?> >Nepal</option>
                  <option value="164" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="164") echo "selected"; ?> >Nauru</option>
                  <option value="165" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="165") echo "selected"; ?> >Niue</option>
                  <option value="166" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="166") echo "selected"; ?> >New Zealand</option>
                  <option value="167" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="167") echo "selected"; ?> >Oman</option>
                  <option value="168" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="168") echo "selected"; ?> >Panama</option>
                  <option value="169" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="169") echo "selected"; ?> >Peru</option>
                  <option value="170" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="170") echo "selected"; ?> >French Polynesia</option>
                  <option value="171" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="171") echo "selected"; ?> >Papua New Guinea</option>
                  <option value="172" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="172") echo "selected"; ?> >Philippines</option>
                  <option value="173" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="173") echo "selected"; ?> >Pakistan</option>
                  <option value="174" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="174") echo "selected"; ?> >Poland</option>
                  <option value="175" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="175") echo "selected"; ?> >Saint Pierre and Miquelon</option>
                  <option value="176" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="176") echo "selected"; ?> >Pitcairn Islands</option>
                  <option value="177" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="177") echo "selected"; ?> >Puerto Rico</option>
                  <option value="178" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="178") echo "selected"; ?> >Palestinian Territory</option>
                  <option value="179" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="179") echo "selected"; ?> >Portugal</option>
                  <option value="180" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="180") echo "selected"; ?> >Palau</option>
                  <option value="181" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="181") echo "selected"; ?> >Paraguay</option>
                  <option value="182" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="182") echo "selected"; ?> >Qatar</option>
                  <option value="183" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="183") echo "selected"; ?> >Reunion</option>
                  <option value="184" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="184") echo "selected"; ?> >Romania</option>
                  <option value="185" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="185") echo "selected"; ?> >Russian Federation</option>
                  <option value="186" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="186") echo "selected"; ?> >Rwanda</option>
                  <option value="187" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="187") echo "selected"; ?> >Saudi Arabia</option>
                  <option value="188" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="188") echo "selected"; ?> >Solomon Islands</option>
                  <option value="189" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="189") echo "selected"; ?> >Seychelles</option>
                  <option value="190" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="190") echo "selected"; ?> >Sudan</option>
                  <option value="191" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="191") echo "selected"; ?> >Sweden</option>
                  <option value="192" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="192") echo "selected"; ?> >Singapore</option>
                  <option value="193" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="193") echo "selected"; ?> >Saint Helena</option>
                  <option value="194" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="194") echo "selected"; ?> >Slovenia</option>
                  <option value="195" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="195") echo "selected"; ?> >Svalbard and Jan Mayen</option>
                  <option value="196" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="196") echo "selected"; ?> >Slovakia</option>
                  <option value="197" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="197") echo "selected"; ?> >Sierra Leone</option>
                  <option value="198" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="198") echo "selected"; ?> >San Marino</option>
                  <option value="199" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="199") echo "selected"; ?> >Senegal</option>
                  <option value="200" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="200") echo "selected"; ?> >Somalia</option>
                  <option value="201" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="201") echo "selected"; ?> >Suriname</option>
                  <option value="202" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="202") echo "selected"; ?> >Sao Tome and Principe</option>
                  <option value="203" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="203") echo "selected"; ?> >El Salvador</option>
                  <option value="204" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="204") echo "selected"; ?> >Syrian Arab Republic</option>
                  <option value="205" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="205") echo "selected"; ?> >Swaziland</option>
                  <option value="206" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="206") echo "selected"; ?> >Turks and Caicos Islands</option>
                  <option value="207" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="207") echo "selected"; ?> >Chad</option>
                  <option value="208" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="208") echo "selected"; ?> >French Southern Territories</option>
                  <option value="209" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="209") echo "selected"; ?> >Togo</option>
                  <option value="210" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="210") echo "selected"; ?> >Thailand</option>
                  <option value="211" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="211") echo "selected"; ?> >Tajikistan</option>
                  <option value="212" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="212") echo "selected"; ?> >Tokelau</option>
                  <option value="213" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="213") echo "selected"; ?> >Turkmenistan</option>
                  <option value="214" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="214") echo "selected"; ?> >Tunisia</option>
                  <option value="215" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="215") echo "selected"; ?> >Tonga</option>
                  <option value="216" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="216") echo "selected"; ?> >Timor-Leste</option>
                  <option value="217" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="217") echo "selected"; ?> >Turkey</option>
                  <option value="218" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="218") echo "selected"; ?> >Trinidad and Tobago</option>
                  <option value="219" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="219") echo "selected"; ?> >Tuvalu</option>
                  <option value="220" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="220") echo "selected"; ?> >Taiwan</option>
                  <option value="221" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="221") echo "selected"; ?> >Tanzania, United Republic of</option>
                  <option value="222" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="222") echo "selected"; ?> >Ukraine</option>
                  <option value="223" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="223") echo "selected"; ?> >Uganda</option>
                  <option value="224" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="224") echo "selected"; ?> >United States Minor Outlying Islands</option>
                  <option value="225" <?php if((isset($_SESSION['country']) && $_SESSION['country']=="225") or !isset($_SESSION['country'])) echo "selected"; ?> >United States</option>
                  <option value="226" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="226") echo "selected"; ?> >Uruguay</option>
                  <option value="227" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="227") echo "selected"; ?> >Uzbekistan</option>
                  <option value="228" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="228") echo "selected"; ?> >Holy See (Vatican City State)</option>
                  <option value="229" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="229") echo "selected"; ?> >Saint Vincent and the Grenadines</option>
                  <option value="230" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="230") echo "selected"; ?> >Venezuela</option>
                  <option value="231" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="231") echo "selected"; ?> >Virgin Islands, British</option>
                  <option value="232" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="232") echo "selected"; ?> >Virgin Islands, U.S.</option>
                  <option value="233" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="233") echo "selected"; ?> >Vietnam</option>
                  <option value="234" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="234") echo "selected"; ?> >Vanuatu</option>
                  <option value="235" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="235") echo "selected"; ?> >Wallis and Futuna</option>
                  <option value="236" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="236") echo "selected"; ?> >Samoa</option>
                  <option value="237" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="237") echo "selected"; ?> >Yemen</option>
                  <option value="238" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="238") echo "selected"; ?> >Mayotte</option>
                  <option value="239" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="239") echo "selected"; ?> >Serbia</option>
                  <option value="240" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="240") echo "selected"; ?> >South Africa</option>
                  <option value="241" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="241") echo "selected"; ?> >Zambia</option>
                  <option value="242" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="242") echo "selected"; ?> >Montenegro</option>
                  <option value="243" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="243") echo "selected"; ?> >Zimbabwe</option>
                  <option value="244" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="244") echo "selected"; ?> >Anonymous Proxy</option>
                  <option value="245" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="245") echo "selected"; ?> >Satellite Provider</option>
                  <option value="246" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="246") echo "selected"; ?> >Other</option>
                  <option value="247" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="247") echo "selected"; ?> >Aland Islands</option>
                  <option value="248" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="248") echo "selected"; ?> >Guernsey</option>
                  <option value="249" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="249") echo "selected"; ?> >Isle of Man</option>
                  <option value="250" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="250") echo "selected"; ?> >Jersey</option>
                  <option value="251" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="251") echo "selected"; ?> >Saint Barthelemy</option>
                  <option value="252" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="252") echo "selected"; ?> >Saint Martin</option>
                  <option value="253" <?php if(isset($_SESSION['country']) && $_SESSION['country']=="253") echo "selected"; ?> >Kosovo</option>
                </select>
                </td>
                </tr>
            <td id="state_data">
            <select name="select_state" id="select_state"  class="FieldPub">
				<option value="AK">Alaska</option>
				<option value="AL">Alabama</option>
				<option value="AR">Arkansas</option>
				<option value="AS">American Samoa</option>
				<option value="AZ">Arizona</option>
				<option value="CA">California</option>
				<option value="CO">Colorado</option>
				<option value="CT">Connecticut</option>
				<option value="DC">D.C.</option>
				<option value="DE">Delaware</option>
				<option value="FL">Florida</option>
				<option value="FM">Micronesia</option>
				<option value="GA">Georgia</option>
				<option value="GU">Guam</option>
				<option value="HI">Hawaii</option>
				<option value="IA">Iowa</option>
				<option value="ID">Idaho</option>
				<option value="IL">Illinois</option>
				<option value="IN">Indiana</option>
				<option value="KS">Kansas</option>
				<option value="KY">Kentucky</option>
				<option value="LA">Louisiana</option>
				<option value="MA">Massachusetts</option>
				<option value="MD">Maryland</option>
				<option value="ME">Maine</option>
				<option value="MH">Marshall Islands</option>
				<option value="MI">Michigan</option>
				<option value="MN">Minnesota</option>
				<option value="MO">Missouri</option>
				<option value="MP">Marianas</option>
				<option value="MS">Mississip