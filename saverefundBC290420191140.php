<?php
ob_start();
session_start();
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i");
$dateopn=date("d/m/Y", $tanggal);
$timeopn=$jam;
$nowyears=date("y");
/*terminal*/
$terminalcek = "SELECT * FROM terminal_parameter WHERE openterminal = '' OR closeterminal ='' ";
$resultterminalcek = mysqli_query($koneksi,$terminalcek) or die (mysqli_error());
$rresultterminalcek= mysqli_num_rows($resultterminalcek);
$hresultterminalcek= mysqli_fetch_array($resultterminalcek);
$prmterminal=$hresultterminalcek['terminal_id'];
if(empty($rresultterminalcek))
{
	echo "<script>alert('order tidak dapat diproses karena terminal belum dibuka');location='index.php'</script>";
	ob_flush();
}
else
{
/*terminal*/
/*header*/
$headerparam=mysqli_query($koneksi,"SELECT * FROM pos_parameter ");
$hparamheader = mysqli_fetch_array($headerparam);
$nomatx2header=$hparamheader['counter_trans_temp'];
$prefixheader=$hparamheader['prefix'];
$idoutlet=$hparamheader['id_outlet'];
$nomatx3header=$nomatx2header+1;
if ($nomatx2header > 0)
{
	if ($nomatx3header>=0 && $nomatx3header<=9)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'000000'.$nomatx3header;
	}
	elseif ($nomatx3header>9 && $nomatx3header<=99)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'00000'.$nomatx3header;
	}
	elseif ($nomatx3header>99 && $nomatx3header<=999)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'0000'.$nomatx3header;
	}
	elseif ($nomatx3header>999 && $nomatx3header<=9999)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'000'.$nomatx3header;
	}
	elseif ($nomatx3header>9999 && $nomatx3header<=99999)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'00'.$nomatx3header;
	}
	elseif ($nomatx3header>99999 && $nomatx3header<=999999)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'0'.$nomatx3header;
	}
	elseif ($nomatx3header>999999 && $nomatx3header<=9999999)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.$nomatx3header;
	}
}
else
{
	$nomatheader=$prefixheader.'T'.$nowyears.'0000001';
}

/*header awal*/
$keytrans=$_GET["transtempprm"];
$keyuser=$_GET["user"];
$getsalestemp = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$keytrans'  ");
$hgetsalestemp = mysqli_fetch_array($getsalestemp);
/*header awal*/
$sqlheader="INSERT INTO pos_salestemp values('$nomatheader','$hgetsalestemp[member]','$hgetsalestemp[custqty]','$hgetsalestemp[gross_sales]','$hgetsalestemp[disc]','$hgetsalestemp[tax]','$hgetsalestemp[service_charge]','$hgetsalestemp[nett_sales]','$hgetsalestemp[jumlah_bayar]','$hgetsalestemp[member]','$hgetsalestemp[member]','$hgetsalestemp[member]','$hgetsalestemp[member]','$hgetsalestemp[member]','$hgetsalestemp[member]','REFUND','$hgetsalestemp[member]','$hgetsalestemp[member]','$hgetsalestemp[member]','$prmterminal','$idoutlet')";
mysqli_query($koneksi,$sqlheader) or die(mysqli_error());
$sql4header="UPDATE pos_parameter SET counter_trans_temp = '$nomatx3header' ";
mysqli_query($koneksi,$sql4header) or die(mysqli_error());

/*header*/
echo "<script>location='index.php?transtempprm=$nomatheader'</script>";
ob_flush();
}
?>