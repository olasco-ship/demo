
<?php

$userData = "grant_type=client_credentials&client_id=6358f49a-16c8-4aed-bc40-2df9dbf66e7f&client_secret=p-o9lBk~kAt7Mk5-noT4..c1D-B0539bhP&resource=https://td-dev40f46a5c4290ffb3devaos.cloudax.dynamics.com";


/*'{"grant_type: client_credentials", "client_id: 6358f49a-16c8-4aed-bc40-2df9dbf66e7f", "client_secret: p-o9lBk~kAt7Mk5-noT4..c1D-B0539bhP", --data-urlencode "resource: https://td-dev40f46a5c4290ffb3devaos.cloudax.dynamics.com", "tenant_id: 473a0bc4-3b24-41dd-8637-31d1d34ae468"}';*/
$urlApi = "https://login.microsoftonline.com/473a0bc4-3b24-41dd-8637-31d1d34ae468/oauth2/token";
$curl = curl_init($urlApi);
curl_setopt($curl, CURLOPT_URL, $urlApi);
curl_setopt($curl, CURLOPT_POST, true);
//curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$headers= array('Content-Type: application/x-www-form-urlencoded');
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, $userData);
$token = curl_exec($curl);
curl_close($curl);
//var_dump($token);

$try = json_decode($token);
$olasco = $try->access_token;
//var_dump($try->access_token);


$top;
$number = 3;
$url = "https://td-dev40f46a5c4290ffb3devaos.cloudax.dynamics.com/data/ReleasedProductsV2";
$curl = curl_init($url);
$endpoint = $url .'?' .'$top=' . $number;
//var_dump($endpoint);
curl_setopt($curl, CURLOPT_URL, $endpoint );

var_dump($olasco);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer $olasco"
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
var_dump($resp);

$tie =json_decode($resp);
//var_dump($tie);
//var_dump($tie->{'value'});
$ola = json_encode($tie->{'value'});
$te = json_decode($ola);
//var_dump($te);
//$te = json_decode(json_encode($tie->{'value'}));

//var_dump($te);
//echo $te;

foreach ($te as $t) {
   echo $t->SearchName;
}
 




