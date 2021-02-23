<?php
ob_start();
session_start();
error_reporting(0);
$nmusrpos=$_SESSION['namausernahmposorder'];
/*data pos*/
include "../koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$nowdate=date("d/m/Y H:i");
$keytrans=$_GET['keytrans'];
$sqnc=$_GET['sqnc'];
$header=$_GET['header'];
//*pos sales temp*//
$getsalestemp = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$keytrans'  ");
$hgetsalestemp = mysqli_fetch_array($getsalestemp);
//*pos sales temp*//
//*pos tabel*//
if($hgetsalestemp['meja']!="takeaway")
{
$getpostable = mysqli_query($koneksi,"SELECT * FROM pos_table where notrans = '$keytrans' ");
$hgetpostable = mysqli_fetch_array($getpostable);
$namameja=$hgetpostable['nama_table'];
}
else
{
$namameja="take away";
}
//*pos tabel*//
/*data pos*/

require 'autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
// use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/* Fill in your own connector here */
// $connector = new NetworkPrintConnector("192.168.1.123", 9100);
$connector = new WindowsPrintConnector("EPSON TM-T82 Receipt");
//$connector = new WindowsPrintConnector("EPSON TM-T88IV Receipt");
/* Information for the receipt */
$items = array(
    new item("Example item #1", "4"),
    new item("Another thing", "3"),
    new item("Something else", "1"),
    new item("A final item", "4"),
);
$subtotal = new item('Subtotal', '12.95');
$tax = new item('A local tax', '1.30');
$total = new item('Total', '14.25', true);
/* Date is kept the same for testing */
// $date = date('l jS \of F Y h:i:s A');
$date = $nowdate;

/* Start the printer */
$logo = EscposImage::load("resources/escpos-php.png", false);
$printer = new Printer($connector);

/* Print top logo */
// $printer -> setJustification(Printer::JUSTIFY_CENTER);
// $printer -> graphics($logo);

/* Name of shop */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("$nmusrpos\n");
$printer -> selectPrintMode();
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("ORDER KE($sqnc) : $namameja\n");
$printer -> selectPrintMode();
/* Footer */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("------------------------------------------\n");


/* Items */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> setEmphasis(false);
$param1=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$keytrans' and squenceorder = '$sqnc' group by additional, kditem");
while($hparam1 = mysqli_fetch_array($param1))
{
$keyprm4=$hparam1['kditem'];
$param4=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$keyprm4'");
$rparam4 = mysqli_num_rows($param4);
$hparam4 = mysqli_fetch_array($param4);
$sumitemtemp=mysqli_query($koneksi,"SELECT sum(qty) as grandqty, sum(price) as grandprice FROM pos_itemtemp where kditem = '$keyprm4' AND transtemp = '$keytrans' AND additional = '$hparam1[additional]' and squenceorder = '$sqnc'");
$rsumitemtemp= mysqli_num_rows($sumitemtemp);
$hsumitemtemp = mysqli_fetch_array($sumitemtemp);
$namaitem=$hparam4['nmitem'];
$qtyitem=$hsumitemtemp['grandqty'];
$printer -> text("$namaitem ($qtyitem)\n");
$noteitem=$hparam1['note'];
$additional=$hparam1['additional'];
if($additional!=$keyprm4)
    {
        $printer -> text("$additional\n");
    }
if($noteitem!="")
    {
        $printer -> text("//$noteitem\n");
    }
}

$printer -> setEmphasis(true);
$printer -> setEmphasis(false);

/* Tax and total */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> selectPrintMode();

/* Footer */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("------------------------------------------\n");
$printer -> text($date . "\n");

/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> close();

/* A wrapper to do organise item names & prices into columns */
class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 38;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
echo "<script>location='../index.php?transtempprm=$keytrans'</script>";
// if($header=="pos")
// {
// echo "<script>location='cetakorderkasir.php?keytrans=$keytrans&sqnc=$sqnc&header=pos'</script>";
// }
// elseif($header=="server")
// {
// echo "<script>location='cetakorderkasir.php?keytrans=$keytrans&sqnc=$sqnc&header=server'</script>";
// }
ob_flush();
?>
