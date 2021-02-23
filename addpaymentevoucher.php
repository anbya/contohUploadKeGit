<?php
ob_start();
error_reporting(0);
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$notrans=$_POST["notrans"];
$idterminal=$_POST["idterminal"];
$jnstrans=$_POST["jnspay"];
$jnscard=$_POST["jnscard"];
$num=$_POST["num"];
$lastuser=$_POST["lastuser"];
$lastmodify=$_POST["lastmodify"];
$keyparameter=$num;
$query2 = "SELECT * FROM pos_paymenttemp WHERE NoTrans = '$notrans' AND JnsTrans = 'CASH'";
$prosesquery2 = mysqli_query($koneksi,$query2) or die (mysqli_error());
$rquery2 = mysqli_num_rows($prosesquery2);
	if($rquery2>0)
	{
		echo "<script>alert('PEMBAYARAN E-VOUCHER HANYA BISA DILAKUKAN PADA AWAL PEMBAYARAN');location='index.php?transtempprm=$notrans'</script>";
	}
	else
	{
		$file = file_get_contents("http://nahmthaisukibbq.com/jsondata/voucherproses.php?keyparameter=$keyparameter");
		$json = json_decode($file, true);

		$idvoucher = $json[0]['vouchernumber'];
		$namavoucher = $json[0]['namavoucher'];
		$status = $json[0]['status'];
		$expdatestr=$json[0]['expdate'];
		$useddate=$json[0]['useddate'];
		$jumlah=$json[0]['amount'];

		if (empty($idvoucher))
		{
		echo "<script>alert('tidak dapat membuka data e-voucher, periksa internet anda.');location='index.php?transtempprm=$notrans'</script>";
		}
		else
		{
			$nowdate=$lastmodify;
			if (!empty($idvoucher))
			{	
				if($status=="USED")
				{
				echo "<script>alert('E-VOUCHER SUDAH TERPAKAI');location='index.php?transtempprm=$notrans'</script>";
				}
				else
				{
					if($expdatestr < $nowdate)
					{
						echo "<script>alert('E-VOUCHER SUDAH EXPIRED PADA TANGGAL $expdatestr');location='index.php?transtempprm=$notrans'</script>";
					}
					else
					{
        			$keyoutlet = mysqli_query($koneksi,"SELECT * FROM pos_parameter");
        			$hkeyoutlet = mysqli_fetch_array($keyoutlet);
					$sql="INSERT INTO pos_paymenttemp values('$notrans','$jnstrans','$namavoucher','$jumlah','$jumlah','$lastuser','$lastmodify','','1','$num','OPEN','$idterminal','$hkeyoutlet[id_outlet]')";
					//data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
					mysqli_query($koneksi,$sql) or die(mysqli_error());
					$query3 = "SELECT * FROM pos_salestemp WHERE notrans = '$notrans' ";
					$result3 = mysqli_query($koneksi,$query3) or die (mysqli_error());
					$salesh = mysqli_fetch_array($result3);
					$salesh1=$salesh['jumlah_bayar'];
					$salesh2=$salesh1+$jumlah;
					$sql4="UPDATE pos_salestemp SET jumlah_bayar = '$salesh2' WHERE notrans = '$notrans' ";
					mysqli_query($koneksi,$sql4) or die(mysqli_error());
					echo "<script>location='http://nahmthaisukibbq.com/eksternalapi/test/prosesevoucher.php?keyparameter=$num&notrans=$notrans&useddate=$nowdate'</script>";
					}
				}
			}
			else
			{
			echo "<script>alert('NOMOR VOUCHER TIDAK TERDAFTAR');location='index.php?transtempprm=$notrans'</script>";
			}
		}
	}
ob_flush();
?>