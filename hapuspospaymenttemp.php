<?php
ob_start();
session_start();
include "koneksi.php";
$transtempprm=$_GET["transtempprm"];
$bill=$_GET["bill"];
$salesh2=0;
$sql4="UPDATE pos_salestemp SET jumlah_bayar = '$salesh2' WHERE notrans = '$transtempprm' ";
mysqli_query($koneksi,$sql4) or die(mysqli_error());
mysqli_query($koneksi,"delete from pos_paymenttemp where NoTrans = '$transtempprm' AND bill = '$bill'");
echo "<script>location='index.php?transtempprm=$transtempprm&bill=$bill'</script>";
ob_flush();
?>
