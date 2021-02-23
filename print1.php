<?php 
ob_start();
error_reporting(0);
session_start();
if (empty($_SESSION['namausernahmpos']))
{
  include "koneksi.php";
session_destroy();
header('Location: login.php');
exit(); 
}
else
{
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$usrpay=$_SESSION['iduser'];
$datepay=date("Y-m-d", $tanggal);
$timepay=date("H:i:s", $jam);
$otletpay = "SELECT * FROM setupparameter ";
$resultotletpay = mysqli_query($koneksi,$otletpay) or die (mysqli_error());
 $hresultotletpay = mysqli_fetch_array($resultotletpay);
$outletpay=$hresultotletpay['KdOutlet'];
?>
<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>NAHM POS</title>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="css/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
<link href="css/style.css" rel="stylesheet">
<link href="sticky-footer.css" rel="stylesheet">
<style>
.rcp
{
    width: 100%;
}
.logo
{
    width: 100%;
    padding-left: 15%;
    padding-right: 15%;
    padding-top: 0;
    padding-bottom: 5%;
}
.separator
{
	width: 100%;
	margin-top: 2%;
	margin-bottom: 2%;
    border-bottom-style: dashed;
    border-bottom-color: #000;
    border-bottom-width: 0.5vh;
}
</style>
</head>
<!--
border-width: 1vh;border-style: solid;border-color: #000;
-->
<body onkeypress='return false' onload="doPrint()" style="font-size: 5vh;">
<?php
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$nowdate=date("d/m/Y h:n");
$transtempprm=$_GET['transtempprm'];
$billid=$_GET['billid'];
$paramx=mysqli_query($koneksi,"SELECT * FROM pos_parameter");
$rparamx = mysqli_num_rows($paramx);
$hparamx = mysqli_fetch_array($paramx);
$param=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$transtempprm'");
$rparam = mysqli_num_rows($param);
$hparam = mysqli_fetch_array($param);
$keyprm3= $hparam['close_user'];
$subtotal=$hparam['gross_sales']-$hparam['disc'];
$tax=$subtotal*10/100;
$grandtotal=$subtotal+$tax;
$param3=mysqli_query($koneksi,"SELECT * FROM user where id_user = '$keyprm3'");
$rparam3 = mysqli_num_rows($param3);
$hparam3 = mysqli_fetch_array($param3);
$opnid1=substr($hparam['notrans'],6);
$opnid=intval($opnid1);
$opndate= $hparam['date'];
$opntime= $hparam['time'];
$lastdate= $hparam['close_date'];
$lasttime= $hparam['close_time'];
?>
<div><br><br><br></div>
<div class="rcp" style="text-align: center;">
<div class="logo">
<a><img src="logo.png" class="img-fluid" alt="Responsive image"></a>
</div>
<a style="font-size: 7vh;"><b>NAHM THAI SUKI & BBQ</b></a><br>
<a style="font-size: 5vh;"><b>Mall Pondok Indah 1</b></a><br>
<a style="font-size: 5vh;"><b>Lt.2 Unit 2. 12</b></a><br>
<a style="font-size: 5vh;"><b>021-75901646</b></a><br>
<a style="font-size: 7vh;"><b>Check : <?php echo $opnid;?></b></a><br>
<table style="width: 100%;font-size: 1vh;">
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b>PAX:<?php echo $hparam['custqty'];?></b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b>OP:<?php echo $hparam3['nama_user'];?></b></td>
</tr>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b>POS Title:<?php echo $hparam3['previlage'];?></b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b>POS:<?php echo $hparamx['id_parameter'];?></b></td>
</tr>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b>Rcpt#:<?php echo $billid;?></b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b><?php echo $opndate;?> <?php echo $opntime;?></b></td>
</tr>
</table>
<div class="separator"></div>
<!--
<a style="font-size: 5vh;">NAHM THAI SUKI 5vh</a><br>
<a style="font-size: 5vh;"><b>NAHM THAI SUKI 5vh BOLD</b></a><br>
<a style="font-size: 7vh;">NAHM THAI SUKI 7vh</a><br>
<a style="font-size: 7vh;"><b>NAHM THAI SUKI 7vh BOLD</b></a><br>
<a style="font-size: 10vh;">NAHM THAI SUKI 10vh</a><br>
<a style="font-size: 10vh;"><b>NAHM THAI SUKI 10vh BOLD</b></a><br>
-->
<table style="width: 100%;font-size: 1vh;">
<?php
$param1=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtempprm' group by kditem");
while($hparam1 = mysqli_fetch_array($param1)) 
{
$keyprm4=$hparam1['kditem'];
$sumitemtemp=mysqli_query($koneksi,"SELECT sum(qty) as grandqty, sum(price) as grandprice FROM pos_itemtemp where transtemp = '$transtempprm' AND kditem = '$keyprm4'");
$rsumitemtemp= mysqli_num_rows($sumitemtemp);
$hsumitemtemp = mysqli_fetch_array($sumitemtemp);
$param4=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$keyprm4'");
$rparam4 = mysqli_num_rows($param4);
$hparam4 = mysqli_fetch_array($param4);
?>
<tr valign="top">
<td style="font-size: 4vh;width: 5%;text-align: left;"><b><?php echo $hsumitemtemp['grandqty'];?></b></td>
<td style="font-size: 4vh;width: 55%;text-align: left;"><b><?php echo $hparam4['nmitem'];?></b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b><?php echo number_format("$hsumitemtemp[grandprice]");?></b></td>
</tr>
<?php
}
?>
</table>
<div class="separator"></div>
<table style="width: 100%;font-size: 1vh;">
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b>TOTAL BILL</b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b><?php echo number_format("$hparam[gross_sales]");?></b></td>
</tr>
<?php
$paramdisc=mysqli_query($koneksi,"SELECT * FROM pos_promotion_h where notrans = '$transtempprm'");
$rparamdisc = mysqli_num_rows($paramdisc);
while($hparamdisc = mysqli_fetch_array($paramdisc)) 
{
$viewdisc=mysqli_query($koneksi,"SELECT * FROM promotion_h where id_promotion = '$hparamdisc[id_promotion]'");
$rviewdisc = mysqli_num_rows($viewdisc);
$hviewdisc = mysqli_fetch_array($viewdisc);
?>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b><?php echo $hviewdisc['promotion_name'];?></b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b><?php echo number_format("$hparamdisc[disc]");?></b></td>
</tr>
<?php
}
?>
</table>
<div class="separator"></div>
<table style="width: 100%;font-size: 1vh;">
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b>SUBTOTAL</b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b><?php echo number_format("$subtotal");?></b></td>
</tr>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b>TAX 10%</b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b><?php echo number_format("$tax");?></b></td>
</tr>
</table>
<div class="separator"></div>
<table style="width: 100%;font-size: 1vh;">
<tr valign="top">
<td style="font-size: 7vh;width: 60%;text-align: left;"><b>TOTAL</b></td>
<td style="font-size: 7vh;width: 40%;text-align: right;"><b><?php echo number_format("$grandtotal");?></b></td>
</tr>
<tr valign="top">
<?php
$param5=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtempprm' GROUP BY kditem");
$rparam5 = mysqli_num_rows($param5);
$hparam5 = mysqli_fetch_array($param5);
$param6=mysqli_query($koneksi,"SELECT SUM(qty) AS total_qty FROM pos_itemtemp WHERE transtemp = '$transtempprm' ");
$rparam6 = mysqli_num_rows($param6);
$hparam6 = mysqli_fetch_array($param6);
?>
<td style="font-size: 4vh;width: 60%;text-align: left;"><b>Total Item :<?php echo $rparam5;?></b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b>Total Qty :<?php echo $hparam6['total_qty'];?></b></td>
</tr>
<?php
$param2=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where NoTrans = '$transtempprm'");
$rparam2 = mysqli_num_rows($param2);
while($hparam2 = mysqli_fetch_array($param2)) 
{
?>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b><?php echo $hparam2['JnsTrans'];?></b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b><?php echo number_format("$hparam2[Jumlah]");?></b></td>
</tr>
<?php
}
?>
<?php
$sumpayment=mysqli_query($koneksi,"SELECT sum(Jumlah) as grandpayment FROM pos_paymenttemp where NoTrans = '$transtempprm'");
$hsumpayment = mysqli_fetch_array($sumpayment);
$kembalian=$hsumpayment['grandpayment']-$grandtotal;
$cekpembayaran=mysqli_query($koneksi,"SELECT sum(jumlah) as totaljumpay FROM pos_paymenttemp where NoTrans = '$transtempprm' and JnsTrans != 'CASH' and JnsTrans != 'CARD' ");
$rcekpembayaran = mysqli_num_rows($cekpembayaran);
$hcekpembayaran = mysqli_fetch_array($cekpembayaran);
$ceknonchange=$hcekpembayaran['totaljumpay']-$grandtotal;
if($ceknonchange>=0)
{
    $tampilkembalian="0";
}
else
{
    $tampilkembalian=$kembalian;
}
?>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b>Change</b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b><?php echo number_format("$tampilkembalian");?></b></td>
</tr>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b>Member</b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;">
<?php 
if($hparam['member']=="")
{
	echo "-";
}
else
{
?>
<b>
<?php
	echo substr($hparam['member'],14);
?>
</b>
<?php
}
?>
</td>
</tr>
</table>
<div class="separator"></div>
<div class="separator"></div>
<a style="font-size: 5vh;"><b>Closed Bill</b></a><br>
<a style="font-size: 5vh;"><b><?php echo $lastdate;?> <?php echo $lasttime;?></b></a><br>
<a style="font-size: 5vh;"><b>Thank's For Coming</b></a><br>
<div class="separator"></div>
<div class="separator"></div>
<a style="font-size: 5vh;"><b>Gratis 1 Voucher @ Rp 50.000 Setiap</b></a><br>
<a style="font-size: 5vh;"><b>Transaksi Minimum Rp. 100.000</b></a><br>
<a style="font-size: 5vh;"><b>Berlaku Kelipatan 3x</b></a><br>
<div class="separator"></div>
<div class="separator" style="margin-bottom: 5%;"></div>
<!--
<img width='50%' src='https://chart.googleapis.com/chart?chs=350x350&amp;cht=qr&amp;chl=<?php echo $nomat;?>' /><br>
-->
</div>
<div><br><br></div>
<script>
function doPrint() {
    window.print();
    window.location.href = "index.php";
}
</script>
</body>
</html>
<?php }ob_flush();?>