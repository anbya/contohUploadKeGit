<?php
ob_start();
error_reporting(0);
include "../koneksi.php";
$user=$_GET["user"];
$idterminal=$_GET["idterminal"];
$cekopentrans=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'OPEN'");
$hcekopentrans = mysqli_fetch_array($cekopentrans);
$rcekopentrans = mysqli_num_rows($cekopentrans);
if($rcekopentrans>0)
{
echo "<script>alert('TERMINAL POS TIDAK BISA DITUTUP KARENA MASIH ADA TRANSAKSI YANG TERBUKA');location='../index.php'</script>";
}
else
{
echo "<script>location='../tutupposkasir.php?user=$user&idterminal=$idterminal'</script>";
}
ob_flush();
?>