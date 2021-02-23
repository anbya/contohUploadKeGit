<?php
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$notrans=$_GET["transtempprm"];
$bill=$_GET["bill"];
$idterminal=$_GET["idterminal"];
$jnstrans=$_GET["jnspay"];
$jumlah=$_GET["jml"];
$lastuser=$_GET["lastuser"];
$lastmodify=$_GET["lastmodify"];
$query2 = "SELECT * FROM pos_paymenttemp WHERE NoTrans = '$notrans' AND JnsTrans = 'CASH'";
$prosesquery2 = mysqli_query($koneksi,$query2) or die (mysqli_error());
$rquery2 = mysqli_num_rows($prosesquery2);
	if($rquery2>0)
	{
		echo "<script>alert('PEMBAYARAN VOUCHER HANYA BISA DILAKUKAN PADA AWAL PEMBAYARAN');location='index.php?transtempprm=$notrans'</script>";
	}
	else
	{
        $keyoutlet = mysqli_query($koneksi,"SELECT * FROM pos_parameter");
        $hkeyoutlet = mysqli_fetch_array($keyoutlet);
		$sql="INSERT INTO pos_paymenttemp values('$notrans','VOUCHER','$jnstrans','$jumlah','$jumlah','$lastuser','$lastmodify','','$bill','','OPEN','$idterminal','$hkeyoutlet[id_outlet]')";
		mysqli_query($koneksi,$sql) or die(mysqli_error());
		$query3 = "SELECT * FROM pos_salestemp WHERE notrans = '$notrans' ";
		$result3 = mysqli_query($koneksi,$query3) or die (mysqli_error());
		$salesh = mysqli_fetch_array($result3);
		$salesh1=$salesh['jumlah_bayar'];
		$salesh2=$salesh1+$jumlah;
		$sql4="UPDATE pos_salestemp SET jumlah_bayar = '$salesh2' WHERE notrans = '$notrans' ";
		mysqli_query($koneksi,$sql4) or die(mysqli_error());
		echo "<script>location='index.php?transtempprm=$notrans&bill=$bill'</script>";
	}
ob_flush();
?>