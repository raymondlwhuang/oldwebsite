<?php
$sub_req_url = "http://raymondlwhuang.host56.com/MyHelpFile.php";
$ch = curl_init($sub_req_url);
curl_setopt($ch, CURLOPT_POSTFIELDS,  $sub_req_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_exec($ch);
curl_close($ch);