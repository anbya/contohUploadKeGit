<?php
ob_start();
session_start();
include "koneksi.php";
$terminal=$_GET['terminal'];
$sqldetail="INSERT INTO data_import values('$terminal','TEST')";
mysqli_query($koneksi,$sqldetail) or die(mysqli_error());
echo "<script>location='importsales.php'</script>";
ob_flush();
?>