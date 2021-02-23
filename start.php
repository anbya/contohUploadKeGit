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
$param=mysqli_query($koneksi,"SELECT * FROM pos_parameter ");
$hparam = mysqli_fetch_array($param);
$nomatx2=$hparam['counter_trans_temp'];
$prefix=$hparam['prefix'];
$nomatx3=$nomatx2+1;
if ($nomatx2 > 0)
{
	if ($nomatx3>=0 && $nomatx3<=9)
	{
		$nomat=$prefix.'T'.$nowyears.'000000'.$nomatx3;
	}
	elseif ($nomatx3>9 && $nomatx3<=99)
	{
		$nomat=$prefix.'T'.$nowyears.'00000'.$nomatx3;
	}
	elseif ($nomatx3>99 && $nomatx3<=999)
	{
		$nomat=$prefix.'T'.$nowyears.'0000'.$nomatx3;
	}
	elseif ($nomatx3>999 && $nomatx3<=9999)
	{
		$nomat=$prefix.'T'.$nowyears.'000'.$nomatx3;
	}
	elseif ($nomatx3>9999 && $nomatx3<=99999)
	{
		$nomat=$prefix.'T'.$nowyears.'00'.$nomatx3;
	}
	elseif ($nomatx3>99999 && $nomatx3<=999999)
	{
		$nomat=$prefix.'T'.$nowyears.'0'.$nomatx3;
	}
	elseif ($nomatx3>999999 && $nomatx3<=9999999)
	{
		$nomat=$prefix.'T'.$nowyears.$nomatx3;
	}
}
else
{
	$nomat=$prefix.'T'.$nowyears.'0000001';
}
$jumcust=$_POST["txt1"];
$lastuser=$_POST["lastuser"];
$sql="INSERT INTO pos_salestemp values('$nomat','','$jumcust','0','0','','0','0','$dateopn','$timeopn','$lastuser','OPEN')";
mysqli_query($koneksi,$sql) or die(mysqli_error());
$sql4="UPDATE pos_parameter SET counter_trans_temp = '$nomatx3' ";
mysqli_query($koneksi,$sql4) or die(mysqli_error()); 
echo "<script>location='index.php?transtempprm=$nomat'</script>";
ob_flush();
?>
