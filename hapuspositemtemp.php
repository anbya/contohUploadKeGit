<?php
ob_start();
session_start();
include "koneksi.php";
$transtempprm=$_GET["transtempprm"];
$squence=$_GET["squence"];
$notrans=$_GET["KDITEM"];
$cekpostemp=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtempprm' AND kditem = '$notrans' AND squence = '$squence' ");
$hcekpostemp = mysqli_fetch_array($cekpostemp);
$mingrosssales=$hcekpostemp['subtotal'];
$minnettsales=$hcekpostemp['grandprice'];
$salestemp = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$transtempprm' ");
$hsalestemp = mysqli_fetch_array($salestemp);
$grosssales=$hsalestemp['gross_sales']-$mingrosssales;
$nettsales=$hsalestemp['nett_sales']-$minnettsales;
$sql1="UPDATE pos_salestemp SET gross_sales = '$grosssales',nett_sales = '$nettsales' WHERE notrans = '$transtempprm'";
mysqli_query($koneksi,$sql1) or die(mysqli_error());

mysqli_query($koneksi,"DELETE FROM pos_itemtemp where transtemp = '$transtempprm' AND kditem = '$notrans' AND squence = '$squence'");
echo "<script>location='index.php?transtempprm=$transtempprm'</script>";
ob_flush();
?>
