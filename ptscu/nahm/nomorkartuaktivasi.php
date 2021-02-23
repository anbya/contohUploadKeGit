<?php
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$idmember=$_POST["inputx"];
$nomorkartu=$_POST["input1"];
    $sql="UPDATE member SET no_kartu = '$nomorkartu' WHERE id_member = '$idmember'";
    mysql_query($sql) or die(mysql_error()); 
    header("Location:detailaktivasifinal.php?ID=$idmember&kartu=$nomorkartu");
ob_flush();
?>