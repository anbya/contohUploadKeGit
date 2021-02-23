<?php
/*CODE TANPA PENGGABUNGAN*/
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$prmbill=$_GET["transtempprm"];
$salestemp = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$prmbill' ");
$hsalestemp = mysqli_fetch_array($salestemp);
$bill=$hsalestemp['jumbill']+1;
$sql1="UPDATE pos_salestemp SET jumbill = '$bill' WHERE notrans = '$prmbill'";
mysqli_query($koneksi,$sql1) or die(mysqli_error());
echo "<script>location='index.php?transtempprm=$prmbill'</script>";
ob_flush();
?>