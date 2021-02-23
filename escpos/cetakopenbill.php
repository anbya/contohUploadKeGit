<?php
ob_start();
error_reporting(0);
include "../koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$nowdate=date("d/m/Y H:i");
$transtempprm=$_GET['keytrans'];
$paramx=mysqli_query($koneksi,"SELECT * FROM pos_parameter");
$rparamx = mysqli_num_rows($paramx);
$hparamx = mysqli_fetch_array($paramx);
$param=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$transtempprm'");
$rparam = mysqli_num_rows($param);
$hparam = mysqli_fetch_array($param);
$keyprm3= $usrpay;
$subtotal=$hparam['gross_sales']-$hparam['disc'];
$servicecharge=ceil($hparamx['service_charge']*$subtotal/100);
$subtotala=$subtotal+$servicecharge;
$tax=ceil($hparamx['tax']*$subtotala/100);
$grandtotal=$subtotal+$servicecharge+$tax;
$param3=mysqli_query($koneksi,"SELECT * FROM user where id_user = '$keyprm3'");
$rparam3 = mysqli_num_rows($param3);
$hparam3 = mysqli_fetch_array($param3);
$opnid1=substr($hparam['notrans'],6);
$opnid=intval($opnid1);
require 'autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/* Open the printer; this will change depending on how it is connected */
//$connector = new WindowsPrintConnector("EPSON TM-T88IV Receipt");
$connector = new WindowsPrintConnector("EPSON TM-T82 Receipt");
$printer = new Printer($connector);

/* Information for the receipt */

/* Date is kept the same for testing */
// $date = date('l jS \of F Y h:i:s A');

/* Start the printer */
$logo = EscposImage::load("logostruksm.png", false);
$printer = new Printer($connector);

/* Print top logo */
// $printer -> setJustification(Printer::JUSTIFY_CENTER);
// $printer -> graphics($logo);
// $printer -> feed();
/* Name of shop */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("WAHID HASYIM\n");
$printer -> text("CLOSING SALES REPORT\n");
if($hparam['meja']=="takeaway")
{
$printer -> setEmphasis(true);
$printer -> text("Check : $opnid1\n");
$printer -> setEmphasis(false);
}
else
{
//*pos tabel*//
$keymeja=substr($hparam['meja'],0,7);
$getpostable = mysqli_query($koneksi,"SELECT * FROM pos_table where id_table = '$keymeja' ");
$hgetpostable = mysqli_fetch_array($getpostable);
$namameja=$hgetpostable['nama_table'];
//*pos tabel*//
$printer -> setEmphasis(true);
$printer -> text($namameja."\n");
$printer -> setEmphasis(false);
}
$printer -> selectPrintMode();
$printer -> feed();

/* Title of receipt */
$printer -> setEmphasis(true);
$printer -> setFont(Printer::FONT_B);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> setTextSize(1, 1);
$printer -> selectPrintMode();
$printer -> setEmphasis(false);
$str1="PAX:".$hparam['custqty'];
$str2="OP:".$hparam3['nama_user'];
$headertext1= str_pad($str1,21," ");
$headertext2= str_pad($str2,21," ",STR_PAD_LEFT);
$printer -> text($headertext1.$headertext2."\n");
$str3="POS Title:".$hparam3['previlage'];
$str4="POS:".$hparamx['id_parameter'];
$headertext3= str_pad($str3,21," ");
$headertext4= str_pad($str4,21," ",STR_PAD_LEFT);
$printer -> text($headertext3.$headertext4."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//itemloop
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
$stritem1=$hsumitemtemp['grandqty']." ".$hparam4['nmitem'];
$stritem2=number_format($hsumitemtemp['grandprice']);
$headeritem1= str_pad($stritem1,31," ");
$headeritem2= str_pad($stritem2,11," ",STR_PAD_LEFT);
$printer -> text($headeritem1.$headeritem2."\n");
}
//itemloop
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$strtotbilla="TOTAL BILL";
$strtotbillb=number_format("$hparam[gross_sales]");
$headertotbilla= str_pad($strtotbilla,21," ");
$headertotbillb= str_pad($strtotbillb,21," ",STR_PAD_LEFT);
$printer -> text($headertotbilla.$headertotbillb."\n");
//discloop
$paramdisc=mysqli_query($koneksi,"SELECT * FROM pos_promotion_h where notrans = '$transtempprm'");
$rparamdisc = mysqli_num_rows($paramdisc);
while($hparamdisc = mysqli_fetch_array($paramdisc))
{
$viewdisc=mysqli_query($koneksi,"SELECT * FROM promotion_h where id_promotion = '$hparamdisc[id_promotion]'");
$rviewdisc = mysqli_num_rows($viewdisc);
$hviewdisc = mysqli_fetch_array($viewdisc);
$strdisc1=$hviewdisc['promotion_name'];
$strdisc2=number_format($hparamdisc['disc']);
$headerstrdisc1= str_pad($strdisc1,31," ");
$headerstrdisc2= str_pad($strdisc2,11," ",STR_PAD_LEFT);
$printer -> text($headerstrdisc1.$headerstrdisc2."\n");
}
//discloop
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$strsubtot1="SUBTOTAL";
$strsubtot2=number_format($subtotal);
$headersubtot1= str_pad($strsubtot1,21," ");
$headersubtot2= str_pad($strsubtot2,21," ",STR_PAD_LEFT);
$printer -> text($headersubtot1.$headersubtot2."\n");
if($servicecharge>0)
{
$strsvch1="SERVICE CHARGE ".$hparamx['service_charge']."%";
$strsvch2=number_format($servicecharge);
$headersvch1= str_pad($strsvch1,21," ");
$headersvch2= str_pad($strsvch2,21," ",STR_PAD_LEFT);
$printer -> text($headersvch1.$headersvch2."\n");
$strtax1="TAX 10%";
$strtax2=number_format($tax);
$headertax1= str_pad($strtax1,21," ");
$headertax2= str_pad($strtax2,21," ",STR_PAD_LEFT);
$printer -> text($headertax1.$headertax2."\n");
}
else
{
$strtax1="TAX 10%";
$strtax2=number_format($tax);
$headertax1= str_pad($strtax1,21," ");
$headertax2= str_pad($strtax2,21," ",STR_PAD_LEFT);
$printer -> text($headertax1.$headertax2."\n");
}
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$printer -> setTextSize(2, 2);
$strgt1="TOTAL";
$strgt2=number_format($grandtotal);
$headergt1= str_pad($strgt1,10," ");
$headergt2= str_pad($strgt2,11," ",STR_PAD_LEFT);
$printer -> text($headergt1.$headergt2."\n");
$printer -> setTextSize(1, 1);
$printer -> setEmphasis(true);

/* Footer */
$separator= str_pad("=",42,"=");
$printer -> text($separator."\n");
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("OPEN Bill\n");
$printer -> text($lastdate." ".$lasttime."\n");
$printer -> text("BILL INI BUKAN BUKTI TRANSAKSI YANG SAH\n");
$separator= str_pad("=",42,"=");
$printer -> text($separator."\n");
/* Footer */

/* Cut the receipt and open the cash drawer */
$printer -> cut();

$printer -> close();

echo "<script>location='../index.php?transtempprm=$transtempprm'</script>";
ob_flush();
?>
