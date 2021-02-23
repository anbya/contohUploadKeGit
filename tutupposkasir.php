<?php
ob_start();
session_start();
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$prmjam=date("H:i:s");
$jam=date("Hi");
$dateopn=date("dmy", $tanggal);
$timeopn=$jam;
$nowyears=date("y");
$user=$_GET["user"];
$terminal=$_GET["idterminal"];
$closedate=date("Y-m-d", $tanggal)." ".$prmjam;
$sql4="UPDATE terminal_parameter SET closeterminal = '$closedate', closeuser = '$user' where terminal_id = '$terminal' ";
mysqli_query($koneksi,$sql4) or die(mysqli_error());
// echo "<script>location='escpos/cetakclosedayreport.php?user=$user&idterminal=$terminal'</script>";
echo "<script>location='escpos/dump.php?terminal=$terminal'</script>";
ob_flush();
?>
