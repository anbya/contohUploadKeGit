<?php
include "koneksi.php";
$hapus = mysql_query("delete from jabatan where id_jabatan = '".$_GET['ID']."'");
header('location:jabatan.php');
?>