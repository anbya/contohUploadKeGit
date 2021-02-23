<?php
include "koneksi.php";
$hapus = mysql_query("delete from karyawan where nik = '".$_GET['ID']."'");
header('location:karyawan.php');
?>