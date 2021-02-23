<?php
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$ref=$_GET["REF"];
$prm=$_GET["PRM"];
$dsk=$_GET["DSK"];
$idaktivasi=$_GET["ID"];
$cariref=mysql_query("select * from member where id_member='$ref'");
$tampilref=mysql_fetch_array($cariref);
		$idvoucher=mysql_query("SELECT * FROM voucher ORDER BY id_voucher desc");
        $hidvoucher = mysql_fetch_array($idvoucher);
        $rowvoucher = mysql_num_rows($idvoucher);
        if ($rowvoucher > 0)
        {
	        $nomatx1=substr($hidvoucher['id_voucher'],3);
	        $nomatx2=intval($nomatx1);
	        $nomatx3=$nomatx2+1;
	        if ($nomatx3>=0 && $nomatx3<=9)
	        {
	        $nomat='NHV00000'.$nomatx3;
	        }
	        elseif ($nomatx3>9 && $nomatx3<=99)
	        {
	        $nomat='NHV0000'.$nomatx3;
	        }
	        elseif ($nomatx3>99 && $nomatx3<=999)
	        {
	        $nomat='NHV000'.$nomatx3;
	        }
	        elseif ($nomatx3>999 && $nomatx3<=9999)
	        {
	        $nomat='NHV00'.$nomatx3;
	        }
	        elseif ($nomatx3>9999 && $nomatx3<=99999)
	        {
	        $nomat='NHV0'.$nomatx3;
	        }
	        elseif ($nomatx3>99999 && $nomatx3<=999999)
	        {
	        $nomat='NHV'.$nomatx3;
	        }
	    }
	    else
	    {
	    	$nomat='NHV000001';
	    }
$date = new DateTime('now');
$create=$date->format('Y-m-d');
$date->modify('+1 week');
$exp= $date->format('Y-m-d');
$sql="INSERT INTO voucher values('$nomat','$prm','$dsk','$ref','$create','$exp','NEW')";
mysql_query($sql) or die(mysql_error());
header("Location:mail/vouchermembergetmemberaktivasi.php?REF=$ref&VCR=$nomat&ID=$idaktivasi");
ob_flush();
?>