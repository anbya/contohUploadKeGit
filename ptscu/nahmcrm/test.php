<?php
$sms = [
    'nohp' => '08119298089',
    'pesan' => 'Assalamualaikum'
];
 
// Prepare dan Konfigurasi
$baseUrl = 'https://reguler.zenziva.net/apps/smsapi.php';
$config = [
    'userkey' => '5nwmlt',
    'passkey' => 'qaz741852963'
];
$params = array_merge($config, $sms);
$uri = $baseUrl . '?' . http_build_query($params);
 
// Kirim HTTP GET
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, $uri);
$result = curl_exec($curl);
?>