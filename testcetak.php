<?php
ob_start();
error_reporting(0);
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$nowdate=date("d/m/Y h:m");
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

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($logo);
$printer -> feed(2);

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