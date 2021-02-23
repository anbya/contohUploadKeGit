<?php
include "koneksi.php";
$hapus = mysql_query("delete from realisasi where nik = '".$_GET['ID']."' and tgl = '".$_GET['TGL']."'");
header('location:realisasi.php');
?>