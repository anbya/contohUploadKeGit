<?php
ob_start();
session_start();
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i");
$dateopn=date("d/m/Y", $tanggal);
$timeopn=$jam;
$nowyears=date("y");
/*start*/
$notrans=$_POST["notrans"];
$kosongmejaawal = mysqli_query($koneksi,"SELECT * FROM pos_table where notrans = '$notrans' ");
while($hkosongmejaawal= mysqli_fetch_array($kosongmejaawal))
{
	$mejaawal=$hkosongmejaawal['id_table'];
	$updatemejaawal="UPDATE pos_table SET notrans = '' where id_table = '$mejaawal' ";
	mysqli_query($koneksi,$updatemejaawal) or die(mysqli_error());
}
$pmejatujuan = implode(", ", $_POST['table']);
if(!empty($_POST['table'])) {
    foreach($_POST['table'] as $table) {
    $tableupdate="UPDATE pos_table SET notrans = '$notrans' where id_table = '$table' ";
	mysqli_query($koneksi,$tableupdate) or die(mysqli_error());
    }
}
$updatesalestemp="UPDATE pos_salestemp SET meja = '$pmejatujuan' where notrans = '$notrans' ";
mysqli_query($koneksi,$updatesalestemp) or die(mysqli_error());
/*end*/
echo "<script>location='index.php?transtempprm=$notrans'</script>";
ob_flush();
?>