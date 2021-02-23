<?php
include "koneksi.php";
$hapus = mysql_query("delete from golongan where id_gol = '".$_GET['ID']."'");
header('location:golongan.php');
?>