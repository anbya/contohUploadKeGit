<?php
ob_start();
session_start();
include "koneksi.php";
$notrans=$_GET['id'];
	mysqli_query($koneksi,"delete from pos_itemtemp where transtemp = '$notrans'");
	mysqli_query($koneksi,"delete from pos_paymenttemp where NoTrans = '$notrans'");
	mysqli_query($koneksi,"delete from pos_salestemp where notrans = '$notrans'");
    header('Location: index.php');
ob_flush();
?>
