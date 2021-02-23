<?php
ob_start();
error_reporting(0);
include "koneksi.php";
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
$servicecharge=$hparam['service_charge'];
$tax=$hparam['tax'];
$grandtotal=$hparam['nett_sales'];
$cekmeja=$hparam['meja'];
$param3=mysqli_query($koneksi,"SELECT * FROM user where id_user = '$keyprm3'");
$rparam3 = mysqli_num_rows($param3);
$hparam3 = mysqli_fetch_array($param3);
$opnid1=substr($hparam['notrans'],6);
$opnid=intval($opnid1);
$opndate= $hparam['date'];
$opntime= $hparam['time'];
$lastdate= $hparam['close_date'];
$lasttime= $hparam['close_time'];
//*pos tabel*//
$getpostable = mysqli_query($koneksi,"SELECT * FROM pos_table where notrans = '$keytrans' ");
$hgetpostable = mysqli_fetch_array($getpostable);
//*pos tabel*//
require 'escpos/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/* Open the printer; this will change depending on how it is connected */
$connector = new WindowsPrintConnector("EPSON TM-T88IV Receipt");
//$connector = new WindowsPrintConnector("EPSON TM-T82 Receipt");
$printer = new Printer($connector);

/* Information for the receipt */

/* Date is kept the same for testing */
// $date = date('l jS \of F Y h:i:s A');
$date = "Monday 6th of April 2015 02:56:25 PM";

/* Start the printer */
$logo = EscposImage::load("logostruksm.png", false);
$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($logo);
$printer -> feed(2);

/* Name of shop */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("NAHM THAI SUKI & BBQ\n");
$printer -> selectPrintMode();
$printer -> text("Mall Pondok Indah 1\n");
$printer -> text("Lt.2 Unit 2. 12\n");
$printer -> text("021-75901646\n");
$printer -> feed();

/* Title of receipt */
$printer -> setEmphasis(true);
if($cekmeja=="takeaway")
{
$nomorcheck=substr($hparam['notrans'],6);
$printer -> text("Check : $nomorcheck \n");
}
else
{
//*pos tabel*//
$idmeja=substr($hparam['meja'],0,7);
$getpostable = mysqli_query($koneksi,"SELECT * FROM pos_table where id_table = '$idmeja' ");
$hgetpostable = mysqli_fetch_array($getpostable);
//*pos tabel*//
$printer -> text("$hgetpostable[nama_table]\n");
}
$printer -> setEmphasis(false);

$printer -> setEmphasis(false);

$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("-----|-----|-----|-----|-----|-----|-----|-----|--\n");
$str1 = "nama menu";
$str2 = "123";
$str3 = "15.000";
$finaltext1= str_pad($str1,20," ");
$finaltext2= str_pad($str2,8," ",STR_PAD_BOTH);
$finaltext3= str_pad($str3,20," ",STR_PAD_LEFT);
$printer -> text($finaltext1.$finaltext2.$finaltext3."\n");
$printer -> setEmphasis(true);
$printer -> text($finaltext1.$finaltext2.$finaltext3."\n");
$printer -> setEmphasis(false);
$printer -> text($finaltext1.$finaltext2.$finaltext3."\n");
$finaltext4= str_pad("FIPO",42,"-",STR_PAD_BOTH);
$printer -> text($finaltext4."\n");


/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();

//echo "<script>location='../index.php?transtempprm=$keytrans'</script>";
ob_flush();
?>