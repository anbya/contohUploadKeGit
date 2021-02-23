<?php
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$notrans=$_POST["notrans"];
$bill=$_POST["bill"];
$idterminal=$_POST["idterminal"];
$jnstrans=$_POST["jnspay"];
$jnscard=$_POST["jnscard"];
$num=$_POST["num"];
$bank='';
$jumlah=$_POST["txt1"];
$lastuser=$_POST["lastuser"];
$lastmodify=$_POST["lastmodify"];
$keyoutlet = mysqli_query($koneksi,"SELECT * FROM pos_parameter");
$hkeyoutlet = mysqli_fetch_array($keyoutlet);
if ($jnstrans=="CASH")
	{
		$query3 = "SELECT * FROM pos_salestemp WHERE notrans = '$notrans' ";
		$result3 = mysqli_query($koneksi,$query3) or die (mysqli_error());
		$salesh = mysqli_fetch_array($result3);
		$salesh1=$salesh['jumlah_bayar'];
		$salesh2=$salesh1+$jumlah;
		$taxprm=mysqli_query($koneksi,"SELECT * FROM pos_parameter");
		$htaxprm = mysqli_fetch_array($taxprm);
		if($htaxprm['service_charge']>0)
		{
		$gta=$salesh['gross_sales']-$salesh['disc'];
		$servicecharge=ceil($gta*$htaxprm['service_charge']/100);
		$gt=$gta+$servicecharge;
		$gttax=ceil($htaxprm['tax']*$gt/100);
		$finalgt=$gt+$gttax;
			if($salesh2>$finalgt)
			{
			$sisabayar=ceil($finalgt-$salesh['jumlah_bayar']);
			$sql="INSERT INTO pos_paymenttemp values('$notrans','$jnstrans','$jnscard','$sisabayar','$jumlah','$lastuser','$lastmodify','$bank','$bill','','OPEN','$idterminal','$hkeyoutlet[id_outlet]')";
			mysqli_query($koneksi,$sql) or die(mysqli_error());
			$sql4="UPDATE pos_salestemp SET jumlah_bayar = '$salesh2' WHERE notrans = '$notrans' ";
			mysqli_query($koneksi,$sql4) or die(mysqli_error());
			}
			else
			{
			$sql4="UPDATE pos_salestemp SET jumlah_bayar = '$salesh2' WHERE notrans = '$notrans' ";
			mysqli_query($koneksi,$sql4) or die(mysqli_error());
			$sql="INSERT INTO pos_paymenttemp values('$notrans','$jnstrans','$jnscard','$jumlah','$jumlah','$lastuser','$lastmodify','$bank','$bill','','OPEN','$idterminal','$hkeyoutlet[id_outlet]')";
			mysqli_query($koneksi,$sql) or die(mysqli_error());
			}
		}
		else
		{
		$gta=$salesh['gross_sales']-$salesh['disc'];
		$servicecharge=0;
		$gt=$gta+$servicecharge;
		$gttax=($htaxprm['tax']*$gt/100);
		$finalgt=$gt+$gttax;
			if($salesh2>$finalgt)
			{
			$sisabayar=ceil($finalgt-$salesh['jumlah_bayar']);
			$sql="INSERT INTO pos_paymenttemp values('$notrans','$jnstrans','$jnscard','$sisabayar','$jumlah','$lastuser','$lastmodify','$bank','$bill','','OPEN','$idterminal','$hkeyoutlet[id_outlet]')";
			mysqli_query($koneksi,$sql) or die(mysqli_error());
			$sql4="UPDATE pos_salestemp SET jumlah_bayar = '$salesh2' WHERE notrans = '$notrans' ";
			mysqli_query($koneksi,$sql4) or die(mysqli_error());
			}
			else
			{
			$sql4="UPDATE pos_salestemp SET jumlah_bayar = '$salesh2' WHERE notrans = '$notrans' ";
			mysqli_query($koneksi,$sql4) or die(mysqli_error());
			$sql="INSERT INTO pos_paymenttemp values('$notrans','$jnstrans','$jnscard','$jumlah','$jumlah','$lastuser','$lastmodify','$bank','$bill','','OPEN','$idterminal','$hkeyoutlet[id_outlet]')";
			mysqli_query($koneksi,$sql) or die(mysqli_error());
			}
		}
		echo "<script>location='index.php?transtempprm=$notrans&bill=$bill'</script>";
	}
else
	{
		$cekcard = mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where NoTrans = '$notrans' AND JnsTrans = 'CARD' ");
		$hcekcard = mysqli_fetch_array($cekcard);
		$rcekcard = mysqli_num_rows($cekcard);
		if($rcekcard>0)
		{
			echo "<script>alert('PAYMENT CARD HANYA BISA DI LAKUKAN SATU KALI');location='index.php?transtempprm=$notrans'</script>";
		}
		else
		{
		$sql="INSERT INTO pos_paymenttemp values('$notrans','$jnstrans','$jnscard','$jumlah','$jumlah','$lastuser','$lastmodify','$bank','$bill','','OPEN','$idterminal','$hkeyoutlet[id_outlet]')";
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
	}
ob_flush();
?>