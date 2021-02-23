<?php
require 'autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/* Open the printer; this will change depending on how it is connected */
$connector = new WindowsPrintConnector("EPSON TM-T88IV Receipt");
//$connector = new WindowsPrintConnector("EPSON TM-T82 Receipt");
$printer = new Printer($connector);

/* Information for the receipt */
$printer -> setJustification(Printer::JUSTIFY_CENTER);

$printer -> selectPrintMode();
$printer -> setEmphasis(false);
$printer -> setTextSize(1, 1);
$printer -> setFont(Printer::FONT_A);
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$printer -> setTextSize(1, 1);
$printer -> setFont(Printer::FONT_A);
$separator= str_pad("=",42,"=");
$printer -> text($separator."\n");

/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();

//echo "<script>location='../index.php?transtempprm=$keytrans'</script>";
?>