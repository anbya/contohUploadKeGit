<?php
require 'autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
//use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/* Fill in your own connector here */
$connector = new NetworkPrintConnector("192.168.1.123", 9100);
//$connector = new WindowsPrintConnector("EPSON TM-T82 Receipt");
//$connector = new WindowsPrintConnector("EPSON TM-T88IV Receipt");

/* Information for the receipt */
$items = array(
    new item("Example item #1", "4.00"),
    new item("Another thing", "3.50"),
    new item("Something else", "1.00"),
    new item("A final item", "4.45"),
);
$subtotal = new item('Subtotal', '12.95');
$tax = new item('A local tax', '1.30');
$total = new item('Total', '14.25', true);
/* Date is kept the same for testing */
// $date = date('l jS \of F Y h:i:s A');
$date = "Monday 6th of April 2015 02:56:25 PM";

/* Start the printer */
$logo = EscposImage::load("soldout.jpg", false);
$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
$printer -> graphics($logo);
$printer -> feed();
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
        $leftCols = 32;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? 'Rp ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}