<?php
include "../koneksi.php";
$kditem=$_GET["KDITEM"];
$subcat=$_GET["SUBCAT"];
$sp=mysql_query("SELECT * FROM setupparameter");
$hsp = mysql_fetch_array($sp);
$nomatx1=$hsp['CounterPOS'];
$nomatx2=intval($nomatx1);
$nomatx3=$nomatx2+1;
if ($nomatx3>=0 && $nomatx3<=9)
{
$nomat=$hsp['Prefix'].'00000'.$nomatx3;
}
elseif ($nomatx3>9 && $nomatx3<=99)
{
$nomat=$hsp['Prefix'].'0000'.$nomatx3;
}
elseif ($nomatx3>99 && $nomatx3<=999)
{
$nomat=$hsp['Prefix'].'000'.$nomatx3;
}
elseif ($nomatx3>999 && $nomatx3<=9999)
{
$nomat=$hsp['Prefix'].'00'.$nomatx3;
}
elseif ($nomatx3>9999 && $nomatx3<=99999)
{
$nomat=$hsp['Prefix'].'0'.$nomatx3;
}
elseif ($nomatx3>99999 && $nomatx3<=999999)
{
$nomat=$hsp['Prefix'].''.$nomatx3;
}
$cari=mysql_query("select * from pos_item where kditem ='$kditem'");
$hasil=mysql_fetch_array($cari);
$price=$hasil['price'];
$qty='1';
mysql_query("INSERT INTO pos_keranjangbelanja values('$nomat','$kditem','$price','','','1')");
header("Location:../index.php?SUBCAT=$subcat");
?>