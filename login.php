<?php
session_start();

//print_r($_SESSION);
//print_r($_POST);

$username = $_POST["username"];
$password = $_POST["password"];

$target = $_SESSION["target"];
$targetPort = $_SESSION["targetPort"];
$clientMac = $_SESSION["clientMac"];
$clientIp = $_SESSION["clientIp"];
$radiusServerIp = $_SESSION["radiusServerIp"];
$apMac = $_SESSION["apMac"];
$gatewayMac = $_SESSION["gatewayMac"];
$scheme = $_SESSION["scheme"];
$ssidName = $_SESSION["ssidName"];
$vid = $_SESSION["vid"];
$radioId = $_SESSION["radioId"];
$originUrl = $_SESSION["originUrl"];
$authType = 2;

$postData = [
  "clientMac" => $clientMac,
  "clientIp" => $clientIp,
  "apMac" => $apMac,
  "gatewayMac" => $gatewayMac,
  "ssidName" => $ssidName,
  "vid" => $vid,
  "radioId" => $radioId,
  "originUrl" => $originUrl,
  "authType" => $authType,
  "username" => $username,
  "password" => $password,
];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $scheme.'://'.$target.':'.$targetPort.'/portal/radius/auth',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postData),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

if ($response !== false) {
  $json = json_decode($response, true);
  //print_r($json);
}
else {
  die("Error: check with your network administrator");
}

?>