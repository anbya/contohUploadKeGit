<?php
ob_start();
include "koneksi.php";
$hapus = mysql_query("delete from member where id_member = '".$_GET['ID']."'");
header('location:member.php');
ob_flush();
?>