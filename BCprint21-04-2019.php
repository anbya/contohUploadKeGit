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
$notranstemp=$_GET['transpaymenttemp'];
$transtempprm=$_GET['transtempprm'];
$paramx=mysqli_query($koneksi,"SELECT * FROM pos_parameter");
$rparamx = mysqli_num_rows($paramx);
$hparamx = mysqli_fetch_array($paramx);
$param=mysqli_query($koneksi,"SELECT * FROM pos_salesh where notrans = '$transtempprm'");
$rparam = mysqli_num_rows($param);
$hparam = mysqli_fetch_array($param);
$change=$hparam['jumlah_bayar']-$hparam['netsales'];
$keyprm3= $hparam['lastuser'];
$param3=mysqli_query($koneksi,"SELECT * FROM user where id_user = '$keyprm3'");
$rparam3 = mysqli_num_rows($param3);
$hparam3 = mysqli_fetch_array($param3);
$keyprmmem= $hparam['id_member'];
$parammem=mysqli_query($koneksi,"SELECT * FROM member where id_member = '$keyprmmem'");
$rparammem = mysqli_num_rows($parammem);
$hparammem = mysqli_fetch_array($parammem);
$opnid1=substr($hparam['opnid'],5);
$opnid=intval($opnid1);
$opndate= $hparam['opndate'];
$opntime= $hparam['opntime'];
$lastdate= $hparam['lastdate'];
$lasttime= $hparam['lasttime'];
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
<td style="font-size: 4vh;width: 60%;text-align: left;">PAX:<?php echo $hparam['custqty'];?></td>
<td style="font-size: 4vh;width: 40%;text-align: right;">OP:<?php echo $hparam3['nama_user'];?></td>
</tr>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;">POS Title:<?php echo $hparam3['previlage'];?></td>
<td style="font-size: 4vh;width: 40%;text-align: right;">POS:<?php echo $hparamx['id_parameter'];?></td>
</tr>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;">Rcpt#:<?php echo $hparam['notrans'];?></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><?php echo $opndate;?> <?php echo $opntime;?></td>
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
$param1=mysqli_query($koneksi,"SELECT * FROM pos_salesd where transtemp = '$transtempprm'");
while($hparam1 = mysqli_fetch_array($param1)) 
{
$keyprm4=$hparam1['kditem'];
$param4=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$keyprm4'");
$rparam4 = mysqli_num_rows($param4);
$hparam4 = mysqli_fetch_array($param4);
?>
<tr valign="top">
<td style="font-size: 4vh;width: 5%;text-align: left;"><?php echo $hparam1['qty'];?></td>
<td style="font-size: 4vh;width: 55%;text-align: left;"><?php echo $hparam4['nmitem'];?></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><?php echo number_format("$hparam1[grandprice]");?></td>
</tr>
<?php
}
?>
</table>
<div class="separator"></div>
<table style="width: 100%;font-size: 1vh;">
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;">SUBTOTAL</td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><?php echo number_format("$hparam[sales]");?></td>
</tr>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;">TAX 10%</td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><?php echo number_format("$hparam[tax]");?></td>
</tr>
</table>
<div class="separator"></div>
<table style="width: 100%;font-size: 1vh;">
<tr valign="top">
<td style="font-size: 7vh;width: 60%;text-align: left;"><b>TOTAL</b></td>
<td style="font-size: 7vh;width: 40%;text-align: right;"><b><?php echo number_format("$hparam[netsales]");?></b></td>
</tr>
<tr valign="top">
<?php
$param5=mysqli_query($koneksi,"SELECT * FROM pos_salesd where transtemp = '$transtempprm' GROUP BY kditem");
$rparam5 = mysqli_num_rows($param5);
$hparam5 = mysqli_fetch_array($param5);
$param6=mysqli_query($koneksi,"SELECT SUM(qty) AS total_qty FROM pos_salesd WHERE transtemp = '$transtempprm' ");
$rparam6 = mysqli_num_rows($param6);
$hparam6 = mysqli_fetch_array($param6);
?>
<td style="font-size: 4vh;width: 60%;text-align: left;">Total Item :<?php echo $rparam5;?></td>
<td style="font-size: 4vh;width: 40%;text-align: right;">Total Qty :<?php echo $hparam6['total_qty'];?></td>
</tr>
<?php
$param2=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where NoTrans = '$notranstemp'");
$rparam2 = mysqli_num_rows($param2);
while($hparam2 = mysqli_fetch_array($param2)) 
{
?>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><?php echo $hparam2['JnsTrans'];?></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><?php echo number_format("$hparam2[Jumlah]");?></td>
</tr>
<?php
}
?>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;">Change</td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><?php echo number_format("$change");?></td>
</tr>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;">Member</td>
<td style="font-size: 4vh;width: 40%;text-align: right;">
<?php 
if($hparammem['nama_member']=="")
{
	echo "-";
}
else
{
	echo $hparammem['nama_member'];
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
    document.location.href = "index.php";
}
</script>
</body>
</html>
<?php }ob_flush();?>