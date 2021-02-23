<?php
ob_start();
include "koneksi.php";
include "library.php";
$idv=$_GET['IDV'];
$nhp=$_GET['NHP'];
$new_otp = randomString(6);
$sql="UPDATE otentikasi SET otp = '$new_otp' WHERE id_voucher = '$idv'";
mysql_query($sql) or die(mysql_error()); 

$sms = [

    'nohp' => $nhp,

    'pesan' => $new_otp

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

header("Location:cekotp.php?IDV=$idv");
ob_flush();
?>