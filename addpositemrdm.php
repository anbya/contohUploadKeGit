<?php
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$id=$_POST["txt1"];
$notrans=$_POST["notrans"];
$rdm=mysql_query("SELECT * FROM redemption where id_redemption = '$id' ");
$hrdm = mysql_fetch_array($rdm);
$idvch=$hrdm['id_voucher'];
$vch=mysql_query("SELECT * FROM voucher where id_voucher = '$idvch' ");
$hvch = mysql_fetch_array($vch);
$idprm=$hvch['id_promo'];
$prm=mysql_query("SELECT * FROM promo where id_promo = '$idprm' ");
$hprm = mysql_fetch_array($prm);
$kd = $hprm['kditem'];
$disc = $hprm['disc'];
$sc=mysql_query("SELECT * FROM pos_item where kditem = '$kd' ");
$hsc = mysql_fetch_array($sc);
$pot = $hsc['price']*$disc/100;
$price=$hsc['price']-$pot;
$qty=1;
$gp=$price*$qty;
$lastuser=$_SESSION['iduser'];
$lastmodify=date("d-m-Y", $tanggal);
	$sql="INSERT INTO pos_itemtemp values('$notrans','$kd','$price','$qty','$gp')";
	mysql_query($sql) or die(mysql_error());
	$sql1="INSERT INTO pos_paymenttemp values('$notrans','VOUCHER','','','$lastuser','$lastmodify','','$idvch')";
	mysql_query($sql1) or die(mysql_error());
    header('location:index.php');
ob_flush();
?>