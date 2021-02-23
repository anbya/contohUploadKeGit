<?php
$server= "ptscu.net";
$username= "k3164444_admin";
$password= "qaz741852963";
$database= "k3164444_nahm";

mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
