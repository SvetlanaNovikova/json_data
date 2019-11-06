<?php
include 'config.php';

$rezult = [];
$rezult['domainName'] = 'Test domain 2';
$rezult = json_encode($rezult);

$data = array("domainName" => "Test domain 2000");
$data_string = json_encode($data);

$ch = curl_init('http://vulture-tm.ru:3000/domains ');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
);
$result = curl_exec($ch);
var_dump($result);
var_dump('    ');
$data = json_decode($result, true);
var_dump($data);
if (!empty( $data["id"])){
    echo 'OK';
}
else echo '((';
return $data;