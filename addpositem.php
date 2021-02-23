<?php
/*CODE TANPA PENGGABUNGAN*/
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$id=$_POST["id"];
$kd=$_POST["kd"];
$sc=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = $kd ");
$hsc = mysqli_fetch_array($sc);
$price=$hsc['price'];
$qty=$_POST["txt1"];
$gp=$price*$qty;
$param=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$id' ORDER BY squence desc");
$rparam = mysqli_num_rows($param);
$hparam = mysqli_fetch_array($param);
if ($rparam > 0)
{
	$nomatx2=$hparam['squence'];
	$nomatx3=$nomatx2+1;
	if ($nomatx3>=0 && $nomatx3<=9)
	{
		$nomat=$nomatx3;
	}
	elseif ($nomatx3>9 && $nomatx3<=99)
	{
		$nomat=$nomatx3;
	}
	elseif ($nomatx3>99 && $nomatx3<=999)
	{
		$nomat=$nomatx3;
	}
	elseif ($nomatx3>999 && $nomatx3<=9999)
	{
		$nomat=$nomatx3;
	}
	elseif ($nomatx3>9999 && $nomatx3<=99999)
	{
		$nomat=$nomatx3;
	}
	elseif ($nomatx3>99999 && $nomatx3<=999999)
	{
		$nomat=$nomatx3;
	}
}
else
{
	$nomat='1';
}
$salestemp = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$id' ");
$hsalestemp = mysqli_fetch_array($salestemp);
$grosssales=$hsalestemp['gross_sales']+$gp;
$nettsales=$hsalestemp['nett_sales']+$gp;
$sql="INSERT INTO pos_itemtemp values('$id','$kd','$price','$qty','$gp','0','$gp','$nomat')";
mysqli_query($koneksi,$sql) or die(mysqli_error());
$sql1="UPDATE pos_salestemp SET gross_sales = '$grosssales',nett_sales = '$nettsales' WHERE notrans = '$id'";
mysqli_query($koneksi,$sql1) or die(mysqli_error());
echo "<script>location='index.php?transtempprm=$id'</script>";
ob_flush();
/*CODE DENGAN PENGGABUNGAN*/
/*
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$id=$_POST["id"];
$kd=$_POST["kd"];
$sc=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = $kd ");
$hsc = mysqli_fetch_array($sc);
$price=$hsc['price'];
$qty=$_POST["txt1"];
$gp=$price*$qty;
$cekpostemp=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where kditem = '$kd' ");
$hcekpostemp = mysqli_fetch_array($cekpostemp);
$rcekpostemp = mysqli_num_rows($cekpostemp);
if ($rcekpostemp > 0)
{
	$oldqty=$hcekpostemp['qty'];
	$newqty=$qty+$oldqty;
	$oldgp=$hcekpostemp['grandprice'];
	$newgp=$newqty*$price;
    $sql="UPDATE pos_itemtemp SET qty = '$newqty',grandprice = '$newgp' WHERE kditem = '$kd'";
    //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
    mysqli_query($koneksi,$sql) or die(mysqli_error()); 
    echo "<script>location='index.php?transtempprm=$id'</script>";
}
else
{
	$sql="INSERT INTO pos_itemtemp values('$id','$kd','$price','$qty','$gp')";
	mysqli_query($koneksi,$sql) or die(mysqli_error());
    echo "<script>location='index.php?transtempprm=$id'</script>";
}
ob_flush();
*/
?>