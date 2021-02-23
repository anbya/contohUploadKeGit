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
$resultotletpay = mysql_query($otletpay) or die (mysql_error());
 $hresultotletpay = mysql_fetch_array($resultotletpay);
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
    padding: 15%;
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
$nomat='NHV'.$nowdate.'000001';
?>
<div class="rcp" style="text-align: center;">
<div class="logo">
<a><img src="logo.png" class="img-fluid" alt="Responsive image"></a>
</div>
<a style="font-size: 7vh;"><b>NAHM THAI SUKI & BBQ</b></a><br>
<a style="font-size: 5vh;"><b>Mall Pondok Indah 1</b></a><br>
<a style="font-size: 5vh;"><b>Lt.2 Unit 2. 12</b></a><br>
<a style="font-size: 5vh;"><b>021-75901646</b></a><br>
<a style="font-size: 7vh;"><b>Check : 5082</b></a><br>
<img width='50%' src='https://chart.googleapis.com/chart?chs=350x350&amp;cht=qr&amp;chl=<?php echo $nomat;?>' /><br>
<!--
<a style="font-size: 5vh;">NAHM THAI SUKI 5vh</a><br>
<a style="font-size: 5vh;"><b>NAHM THAI SUKI 5vh BOLD</b></a><br>
<a style="font-size: 7vh;">NAHM THAI SUKI 7vh</a><br>
<a style="font-size: 7vh;"><b>NAHM THAI SUKI 7vh BOLD</b></a><br>
<a style="font-size: 10vh;">NAHM THAI SUKI 10vh</a><br>
<a style="font-size: 10vh;"><b>NAHM THAI SUKI 10vh BOLD</b></a><br>
-->
<table style="width: 100%;font-size: 1vh;">
<tr>
<td style="font-size: 5vh;">1</td>
<td style="font-size: 5vh;">2</td>
<td style="font-size: 5vh;">3</td>
</tr>
</table>
<table style="width: 100%;font-size: 1vh;">
<tr>
<td style="font-size: 5vh;width: 70%;">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</td>
<td style="font-size: 5vh;width: 30%;">Contrary to popular belief.</td>
</tr>
</table>
</div>
<script>
function doPrint() {
    window.print();            
    document.location.href = "rcprpt.php"; 
}
</script>
</body>
</html>
<?php }ob_flush();?>