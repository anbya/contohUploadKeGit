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
$nowdate=date("d/m/Y h:m");
$keytrans=$_GET['keytrans'];
$sqnc=$_GET['sqnc'];
//*pos sales temp*//
$getsalestemp = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$keytrans'  ");
$hgetsalestemp = mysqli_fetch_array($getsalestemp);
//*pos sales temp*//
//*pos tabel*//
$getpostable = mysqli_query($koneksi,"SELECT * FROM pos_table where notrans = '$keytrans' ");
$hgetpostable = mysqli_fetch_array($getpostable);
//*pos tabel*//
?>
<div><br><br><br></div>
<div class="rcp" style="text-align: center;">
<a style="font-size: 7vh;"><b>ORDER KE(<?php echo $sqnc;?>) : <?php echo $hgetpostable['nama_table'];?></b></a><br>
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
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b>NAMA MENU</b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b>JUMLAH ORDER</b></td>
</tr>
<?php
$param1=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$keytrans' and squenceorder = '$sqnc' group by kditem");
while($hparam1 = mysqli_fetch_array($param1)) 
{
$keyprm4=$hparam1['kditem'];
$param4=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$keyprm4'");
$rparam4 = mysqli_num_rows($param4);
$hparam4 = mysqli_fetch_array($param4);
$sumitemtemp=mysqli_query($koneksi,"SELECT sum(qty) as grandqty, sum(price) as grandprice FROM pos_itemtemp where kditem = '$keyprm4'");
$rsumitemtemp= mysqli_num_rows($sumitemtemp);
$hsumitemtemp = mysqli_fetch_array($sumitemtemp);
?>
<tr valign="top">
<td style="font-size: 4vh;width: 60%;text-align: left;"><b><?php echo $hparam4['nmitem'];?></b></td>
<td style="font-size: 4vh;width: 40%;text-align: right;"><b><?php echo $hsumitemtemp['grandqty'];?></b></td>
</tr>
<?php
}
?>
</table>
<div class="separator"></div>
<div class="separator"></div>
<!--
<img width='50%' src='https://chart.googleapis.com/chart?chs=350x350&amp;cht=qr&amp;chl=<?php echo $nomat;?>' /><br>
-->
</div>
<div><br><br></div>
<script>
function doPrint() {
    window.print();            
    document.location.href = "index.php?transtempprm=<?php echo $keytrans;?>";
}
</script>
</body>
</html>
<?php }ob_flush();?>