<?php
error_reporting(0);
ob_start();
include "koneksi.php";
$notrans=$_POST["prmremarks"];
$remarks=$_POST["remarks"];
$sql="UPDATE pos_salestemp SET remarks = '$remarks' WHERE notrans = '$notrans'";
mysqli_query($koneksi,$sql) or die(mysqli_error());
echo "<script>location='index.php?transtempprm=$notrans'</script>";
ob_flush();
?>