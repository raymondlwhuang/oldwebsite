/* This must install into the server to have it works */
<?php /* this programe is calling http://raymondlwhuang.host56.com/MyHelpFile.htm but display as ../redirect.php */
$sub_req_url = "http://raymondlwhuang.host56.com/MyHelpFile.php";
$ch = curl_init($sub_req_url);
$encoded = '';
// include GET as well as POST variables; your needs may vary.
foreach($_GET as $name => $value) {
  $encoded .= urlencode($name).'='.urlencode($value).'&';
}
foreach($_POST as $name => $value) {
  $encoded .= urlencode($name).'='.urlencode($value).'&';
}
// chop off last ampersand
$encoded = substr($encoded, 0, strlen($encoded)-1);
curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_exec($ch);
curl_close($ch);
?>