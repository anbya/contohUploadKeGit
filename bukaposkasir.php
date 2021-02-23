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
$param=mysqli_query($koneksi,"SELECT * FROM pos_parameter ");
$hparam = mysqli_fetch_array($param);
$prefix=$hparam['prefix'];
$user=$_POST["iduser"];
$modal=$_POST["txt1"];
$idterminal=$prefix.$dateopn.$jam;
$opendate=date("Y-m-d", $tanggal)." ".$prmjam;
$sql="INSERT INTO terminal_parameter values('$idterminal','$opendate','','$user','','$modal')";
mysqli_query($koneksi,$sql) or die(mysqli_error());
echo "<script>location='index.php'</script>";
ob_flush();
?>
