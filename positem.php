<?php
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$id=$_POST["postid"];
$kd=$_POST["postkd"];
$sc=mysql_query("SELECT * FROM pos_item where kditem = $kd ");
$hsc = mysql_fetch_array($sc);
$price=$hsc['price'];
$qty=$_POST["postqty"];
$gp=$price*$qty;
$sql="INSERT INTO pos_itemtemp values('$id','$kd','$price','$qty','$gp')";
//data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
mysql_query($sql) or die(mysql_error()); 
ob_flush();
?>