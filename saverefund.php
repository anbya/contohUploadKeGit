<?php
ob_start();
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$datepay=date("d/m/Y", $tanggal);
$jam=date("H:i:s");
$nowyears=date("y");
$notranstemp=$_POST["notranstemp"];
$usr=$_POST["usr"];
$param=mysqli_query($koneksi,"SELECT * FROM pos_parameter");
$hparam = mysqli_fetch_array($param);
$cekprevilege=mysqli_query($koneksi,"SELECT * FROM user where pass_user = '$usr'");
$hcekprevilege= mysqli_fetch_array($cekprevilege);
if($hcekprevilege['previlage']=="SUPERVISOR")
{
$nomatx2=$hparam['counter_pos'];
$prefix=$hparam['prefix'];
$nomatx3=$nomatx2+1;
if ($nomatx2 > 0)
{
	if ($nomatx3>=0 && $nomatx3<=9)
	{
	$nomat=$prefix.'R'.$nowyears.'000000'.$nomatx3;
	}
	elseif ($nomatx3>9 && $nomatx3<=99)
	{
	$nomat=$prefix.'R'.$nowyears.'00000'.$nomatx3;
	}
	elseif ($nomatx3>99 && $nomatx3<=999)
	{
	$nomat=$prefix.'R'.$nowyears.'0000'.$nomatx3;
	}
	elseif ($nomatx3>999 && $nomatx3<=9999)
	{
	$nomat=$prefix.'R'.$nowyears.'000'.$nomatx3;
	}
	elseif ($nomatx3>9999 && $nomatx3<=99999)
	{
	$nomat=$prefix.'R'.$nowyears.'00'.$nomatx3;
	}
	elseif ($nomatx3>99999 && $nomatx3<=999999)
	{
	$nomat=$prefix.'R'.$nowyears.'0'.$nomatx3;
	}
	elseif ($nomatx3>999999 && $nomatx3<=9999999)
	{
	$nomat=$prefix.'R'.$nowyears.$nomatx3;
	}
}
else
{
$nomat=$prefix.'R'.$nowyears.'0000001';
}
$sql4="UPDATE pos_parameter SET counter_pos = '$nomatx3' ";
mysqli_query($koneksi,$sql4) or die(mysqli_error());
$sql5="UPDATE pos_salestemp SET status = 'REFUND', refund_date = '$datepay', refund_time = '$jam', refund_user = '$usr', refund_bill_num = '$nomat' where notrans = '$notranstemp' ";
mysqli_query($koneksi,$sql5) or die(mysqli_error());
$sql6="UPDATE pos_itemtemp SET paidstatus = 'REFUND' where transtemp = '$notranstemp' ";
mysqli_query($koneksi,$sql6) or die(mysqli_error());
$updatepromotionh="UPDATE pos_promotion_h SET paid_status = 'REFUND' where notrans = '$notranstemp' ";
mysqli_query($koneksi,$updatepromotionh) or die(mysqli_error());
$updatepromotiond="UPDATE pos_promotion_d SET paid_status = 'REFUND' where transtemp = '$notranstemp' ";
mysqli_query($koneksi,$updatepromotiond) or die(mysqli_error());
$updatepaytemp="UPDATE pos_paymenttemp SET payment_status = 'REFUND' where NoTrans = '$notranstemp' ";
mysqli_query($koneksi,$updatepaytemp) or die(mysqli_error());
echo "<script>location='escpos/cetakrefundbill.php?transtempprm=$notranstemp&billid=$nomat'</script>";
ob_flush();
}
else
{
	echo "<script>alert('HANYA SUPERVISOR YANG DAPAT MELAKUKAN REFUND');location='tampilrekap.php?transtempprm=$notranstemp'</script>";
    ob_flush();
}
?>