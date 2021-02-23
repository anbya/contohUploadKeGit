<?php
include "koneksi.php";
$hapus = mysql_query("delete from insentif_harian where id_ih = '".$_GET['ID']."'");
header('location:insentif.php');
?>