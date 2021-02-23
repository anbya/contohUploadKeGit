<?php
ob_start();
include "koneksi.php";
$notrans=$_GET["transtemp"];
$sql="UPDATE pos_salestemp SET member = '' WHERE notrans = '$notrans'";
//data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
mysqli_query($koneksi,$sql) or die(mysqli_error());
echo "<script>location='index.php?transtempprm=$notrans'</script>";
ob_flush();
?>