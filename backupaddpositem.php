<?php
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$id=$_POST["id"];
$kd=$_POST["kd"];
$sc=mysql_query("SELECT * FROM pos_item where kditem = $kd ");
$hsc = mysql_fetch_array($sc);
$price=$hsc['price'];
$qty=$_POST["txt1"];
$gp=$price*$qty;
$cekpostemp=mysql_query("SELECT * FROM pos_itemtemp where kditem = '$kd' ");
$hcekpostemp = mysql_fetch_array($cekpostemp);
$rcekpostemp = mysql_num_rows($cekpostemp);
if ($rcekpostemp > 0)
{
	$oldqty=$hcekpostemp['qty'];
	$newqty=$qty+$oldqty;
	$oldgp=$hcekpostemp['grandprice'];
	$newgp=$newqty*$price;
    $sql="UPDATE pos_itemtemp SET qty = '$newqty',grandprice = '$newgp' WHERE kditem = '$kd'";
    //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
    mysql_query($sql) or die(mysql_error()); 
    header('location:index.php');
}
else
{
	$sql="INSERT INTO pos_itemtemp values('$id','$kd','$price','$qty','$gp')";
	mysql_query($sql) or die(mysql_error());
    header('location:index.php');
}
ob_flush();
?>