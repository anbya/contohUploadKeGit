<?php
ob_start();
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$datepay=date("Y-m-d", $tanggal);
$jam=date("H:i:s");
$nowyears=date("y");
$notranstemp=$_GET["notranstemp"];
$usr=$_GET["usr"];
$param=mysqli_query($koneksi,"SELECT * FROM pos_parameter");
$hparam = mysqli_fetch_array($param);
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
$pos_salestemp1=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$notranstemp'");
$rpos_salestemp1 = mysqli_num_rows($pos_salestemp1);
$hpos_salestemp1 = mysqli_fetch_array($pos_salestemp1);
$totala=$hpos_salestemp1['gross_sales'];
$disc=$hpos_salestemp1['disc'];
$subtotal=$totala-$disc;
$taxprm=mysqli_query($koneksi,"SELECT * FROM pos_parameter");
$htaxprm = mysqli_fetch_array($taxprm);
if($htaxprm['service_charge']>0)
{
$servicecharge=floor($subtotal*$htaxprm['service_charge']/100);
$subbillsvc=$subtotal+$servicecharge;
$tax=ceil($subbillsvc*$htaxprm['tax']/100);
}
else
{
$servicecharge=0;
$subbillsvc=$subtotal+$servicecharge;
$tax=ceil($subbillsvc*$htaxprm['tax']/100);
}
$grandtotal=$subtotal+$tax+$servicecharge;
$sql4="UPDATE pos_parameter SET counter_pos = '$nomatx3' ";
mysqli_query($koneksi,$sql4) or die(mysqli_error());
$sql5="UPDATE pos_salestemp SET tax = '$tax',service_charge = '$servicecharge', nett_sales = '$grandtotal', close_date = '$datepay', close_time = '$jam', close_user = '$usr', status = 'CLOSED', bill_number = '$nomat' where notrans = '$notranstemp' ";
mysqli_query($koneksi,$sql5) or die(mysqli_error());
$sql6="UPDATE pos_itemtemp SET paidstatus = 'PAID' where transtemp = '$notranstemp' ";
mysqli_query($koneksi,$sql6) or die(mysqli_error());
$updatepromotionh="UPDATE pos_promotion_h SET paid_status = 'PAID' where notrans = '$notranstemp' ";
mysqli_query($koneksi,$updatepromotionh) or die(mysqli_error());
$updatepromotiond="UPDATE pos_promotion_d SET paid_status = 'PAID' where transtemp = '$notranstemp' ";
mysqli_query($koneksi,$updatepromotiond) or die(mysqli_error());
$updatepaytemp="UPDATE pos_paymenttemp SET payment_status = 'CLOSED' where NoTrans = '$notranstemp' ";
mysqli_query($koneksi,$updatepaytemp) or die(mysqli_error());
if($hpos_salestemp1['meja']!="takeaway")
{
$updatepostable="UPDATE pos_table SET notrans = '' where notrans = '$notranstemp' ";
mysqli_query($koneksi,$updatepostable) or die(mysqli_error());
}
// echo "<script>location='escpos/cetakclosebill.php?transtempprm=$notranstemp&billid=$nomat'</script>";
echo "<script>location='index.php'</script>";
ob_flush();
?>