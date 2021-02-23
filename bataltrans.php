<?php
ob_start();
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$datepay=date("d/m/Y", $tanggal);
$jam=date("H:i:s");
$notrans=$_POST["transtemp"];
$usr=$_POST["usr"];
$cancelremarks=$_POST["cancelremarks"];
$sql="UPDATE pos_salestemp SET close_date = '$datepay', close_time = '$jam', close_user = '$usr', `status` = 'CANCELED', remarks = '$cancelremarks' WHERE notrans = '$notrans'";
//data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
mysqli_query($koneksi,$sql) or die(mysqli_error());
$cekbataltrans=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$notrans'");
$hcekbataltrans = mysqli_fetch_array($cekbataltrans);
$updatemeja= explode(", ", $hcekbataltrans['meja']);
$hitungupdatemeja=count($updatemeja);
for ($x = 0; $x<$hitungupdatemeja; $x++) 
{
$sql1="UPDATE pos_table SET notrans = '' WHERE id_table = '$updatemeja[$x]'";
//data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
mysqli_query($koneksi,$sql1) or die(mysqli_error());
}
mysqli_query($koneksi,"delete from pos_itemtemp where transtemp = '$notrans'");
mysqli_query($koneksi,"delete from pos_paymenttemp where NoTrans = '$notrans'");
mysqli_query($koneksi,"delete from pos_promotion_h where notrans = '$notrans'");
mysqli_query($koneksi,"delete from pos_promotion_d where transtemp = '$notrans'");
echo "<script>location='index.php'</script>";
ob_flush();
?>