<?php
include "koneksi.php";
$hapus = mysql_query("delete from unit where id_unit = '".$_GET['ID']."'");
header('location:unit.php');
?>