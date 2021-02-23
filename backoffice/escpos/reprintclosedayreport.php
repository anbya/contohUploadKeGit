<?php
ob_start();
error_reporting(0);
include "../koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$user=$_GET["user"];
$idterminal=$_GET["idterminal"];
$tglterminal=mysqli_query($koneksi,"SELECT * FROM terminal_parameter where terminal_id = '$idterminal'");
$htglterminal = mysqli_fetch_array($tglterminal);
$nowdate=$htglterminal['closeterminal'];
/*sumitemsales*/
$ceknamauser=mysqli_query($koneksi,"SELECT * FROM user where id_user = '$user'");
$hceknamauser = mysqli_fetch_array($ceknamauser);
/*sumitemsales*/
require 'autoload.php';
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

/* Start the printer */
$logo = EscposImage::load("logostruksm.png", false);
$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($logo);
$printer -> feed();

$printer -> selectPrintMode();

/* Title of receipt */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> setFont(Printer::FONT_B);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> setTextSize(1, 1);
$printer -> selectPrintMode();
$printer -> setEmphasis(false);
$printer -> text("ISOIDE\n");
$printer -> text("PLAZA ATRIUM,SENEN\n");
$printer -> text("CLOSING SALES REPORT\n");
$str1="OP:".$hceknamauser['nama_user'];
$str2=$nowdate;
$headertext1= str_pad($str1,21," ");
$headertext2= str_pad($str2,21," ",STR_PAD_LEFT);
$printer -> text($headertext1.$headertext2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$str3="TYPE";
$str4=" ";
$str5="QTY";
$str6="AMOUNT";
$headertext3= str_pad($str3,20," ");
$headertext4= str_pad($str4,4," ",STR_PAD_RIGHT);
$headertext5= str_pad($str5,4," ",STR_PAD_RIGHT);
$headertext6= str_pad($str6,14," ",STR_PAD_LEFT);
$printer -> text($headertext3.$headertext4.$headertext5.$headertext6."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumitemsales*/
$sumitemsales=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyitem, sum(price) as sumpriceitem FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID'");
$hsumitemsales = mysqli_fetch_array($sumitemsales);
/*sumitemsales*/
$str7="ItemSales";
$str8="(+)";
$str9=$hsumitemsales['sumqtyitem'];
$str10=number_format($hsumitemsales['sumpriceitem']);
$headertext7= str_pad($str7,20," ");
$headertext8= str_pad($str8,4," ",STR_PAD_RIGHT);
$headertext9= str_pad($str9,4," ",STR_PAD_RIGHT);
$headertext10= str_pad($str10,14," ",STR_PAD_LEFT);
$printer -> text($headertext7.$headertext8.$headertext9.$headertext10."\n");
/*sumdiscitem*/
$sumitemdisc=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyitemdisc, sum(disc) as sumdiscitem FROM pos_promotion_d where terminal_id = '$idterminal' and promotion_type = 'DISC ITEM' and paid_status = 'PAID'");
$hsumitemdisc = mysqli_fetch_array($sumitemdisc);
/*sumdiscitem*/
$str11="ItemDiscount";
$str12="(-)";
$str13=number_format($hsumitemdisc['sumqtyitemdisc']);
$str14=number_format($hsumitemdisc['sumdiscitem']);
$headertext11= str_pad($str11,20," ");
$headertext12= str_pad($str12,4," ",STR_PAD_RIGHT);
$headertext13= str_pad($str13,4," ",STR_PAD_RIGHT);
$headertext14= str_pad($str14,14," ",STR_PAD_LEFT);
$printer -> text($headertext11.$headertext12.$headertext13.$headertext14."\n");
$str15="FOC Items";
$str16="(-)";
$str17="0";
$str18="0";
$headertext15= str_pad($str15,20," ");
$headertext16= str_pad($str16,4," ",STR_PAD_RIGHT);
$headertext17= str_pad($str17,4," ",STR_PAD_RIGHT);
$headertext18= str_pad($str18,14," ",STR_PAD_LEFT);
$printer -> text($headertext15.$headertext16.$headertext17.$headertext18."\n");
$str19="FOC Bill";
$str20="(-)";
$str21="0";
$str22="0";
$headertext19= str_pad($str19,20," ");
$headertext20= str_pad($str20,4," ",STR_PAD_RIGHT);
$headertext21= str_pad($str21,4," ",STR_PAD_RIGHT);
$headertext22= str_pad($str22,14," ",STR_PAD_LEFT);
$printer -> text($headertext19.$headertext20.$headertext21.$headertext22."\n");
/*sumclosesales*/
$sumclosesales=mysqli_query($koneksi,"SELECT sum(gross_sales) as sumgrosssales, sum(disc) as sumsalesdisc FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumclosesales = mysqli_fetch_array($sumclosesales);
$grandtotalsumclosesales=$hsumclosesales['sumgrosssales']-$hsumclosesales['sumsalesdisc'];
/*sumclosesales*/
$str23="Total Sales";
$str24="(=)";
$str25="";
$str26=number_format($grandtotalsumclosesales);
$headertext23= str_pad($str23,20," ");
$headertext24= str_pad($str24,4," ",STR_PAD_RIGHT);
$headertext25= str_pad($str25,4," ",STR_PAD_RIGHT);
$headertext26= str_pad($str26,14," ",STR_PAD_LEFT);
$printer -> text($headertext23.$headertext24.$headertext25.$headertext26."\n");
/*sumestimatedsales*/
$sumestimatedsales=mysqli_query($koneksi,"SELECT sum(gross_sales) as sumgrosssales, sum(disc) as sumsalesdisc FROM pos_salestemp where terminal_id = '$idterminal' AND status != 'CANCELED' AND status != 'REFUND'");
$hsumestimatedsales = mysqli_fetch_array($sumestimatedsales);
$grandtotalsumestimatedsales=$hsumestimatedsales['sumgrosssales']-$hsumestimatedsales['sumsalesdisc'];
/*sumestimatedsales*/
$str27="Estimated Sales";
$str28="";
$str29="";
$str30=number_format($grandtotalsumestimatedsales);
$headertext27= str_pad($str27,20," ");
$headertext28= str_pad($str28,4," ",STR_PAD_RIGHT);
$headertext29= str_pad($str29,4," ",STR_PAD_RIGHT);
$headertext30= str_pad($str30,14," ",STR_PAD_LEFT);
$printer -> text($headertext27.$headertext28.$headertext29.$headertext30."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$mediatext= str_pad("MEDIA",42," ",STR_PAD_BOTH);
$printer -> text($mediatext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumclosepay*/
$sumclosepaycash=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CASH' group by JnsCard");
/*sumclosepay*/
while($hsumclosepaycash = mysqli_fetch_array($sumclosepaycash))
{
$keyJnsCardcash=$hsumclosepaycash['JnsCard'];
$sumdetpaycash=mysqli_query($koneksi,"SELECT sum(bill) as qtybill, sum(jumlah_bayar) as sumpay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsCard = '$keyJnsCardcash'");
$hsumdetpaycash = mysqli_fetch_array($sumdetpaycash);
//mediacashloop
$strmcash1=$hsumclosepaycash['JnsCard'];
$strmcash2=number_format($hsumdetpaycash['qtybill']);
$strmcash3=number_format($hsumdetpaycash['sumpay']);
$headerstrmcash1= str_pad($strmcash1,24," ");
$headerstrmcash2= str_pad($strmcash2,4," ",STR_PAD_RIGHT);
$headerstrmcash3= str_pad($strmcash3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrmcash1.$headerstrmcash2.$headerstrmcash3."\n");
//mediacashloop
}
/*sumclosepay*/
$sumclosepaycard=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CARD' group by JnsCard");
/*sumclosepay*/
while($hsumclosepaycard = mysqli_fetch_array($sumclosepaycard))
{
$keyJnsCardcard =$hsumclosepaycard['JnsCard'];
$sumdetpaycard=mysqli_query($koneksi,"SELECT sum(bill) as qtybill, sum(jumlah) as sumpay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsCard = '$keyJnsCardcard'");
$hsumdetpaycard = mysqli_fetch_array($sumdetpaycard);
//mediacardloop
$strmcard1=$hsumclosepaycard['JnsCard'];
$strmcard2=number_format($hsumdetpaycard['qtybill']);
$strmcard3=number_format($hsumdetpaycard['sumpay']);
$headerstrmcard1= str_pad($strmcard1,24," ");
$headerstrmcard2= str_pad($strmcard2,4," ",STR_PAD_RIGHT);
$headerstrmcard3= str_pad($strmcard3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrmcard1.$headerstrmcard2.$headerstrmcard3."\n");
//mediacardloop
}
/*sumclosepay*/
$sumclosepayvcr=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'VOUCHER' group by JnsCard");
/*sumclosepay*/
while($hsumclosepayvcr = mysqli_fetch_array($sumclosepayvcr))
{
$keyJnsCardvcr=$hsumclosepayvcr['JnsCard'];
$sumdetpayvcr=mysqli_query($koneksi,"SELECT sum(bill) as qtybill, sum(jumlah) as sumpay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsCard = '$keyJnsCardvcr'");
$hsumdetpayvcr = mysqli_fetch_array($sumdetpayvcr);
//mediavoucherloop
$strmvcr1=$hsumclosepayvcr['JnsCard'];
$strmvcr2=number_format($hsumdetpayvcr['qtybill']);
$strmvcr3=number_format($hsumdetpayvcr['sumpay']);
$headerstrmvcr1= str_pad($strmvcr1,24," ");
$headerstrmvcr2= str_pad($strmvcr2,4," ",STR_PAD_RIGHT);
$headerstrmvcr3= str_pad($strmvcr3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrmvcr1.$headerstrmvcr2.$headerstrmvcr3."\n");
//mediavoucherloop
}
/*sumcashsales*/
$sumcashsales=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CASH'");
$hsumcashsales = mysqli_fetch_array($sumcashsales);
/*sumcardsales*/
//TOTALCASH
$strtotcash1="TOTAL CASH";
$strtotcash2=number_format($hsumcashsales['sumcardbill']);
$strtotcash3=number_format($hsumcashsales['sumjumlah_bayar']);
$headerstrtotcash1= str_pad($strtotcash1,24," ");
$headerstrtotcash2= str_pad($strtotcash2,4," ",STR_PAD_RIGHT);
$headerstrtotcash3= str_pad($strtotcash3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrtotcash1.$headerstrtotcash2.$headerstrtotcash3."\n");
//TOTALCASH
/*sumcardsales*/
$sumcardsales=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CARD'");
$hsumcardsales = mysqli_fetch_array($sumcardsales);
/*sumcardsales*/
//TOTALCARD
$strtotcard1="TOTAL CARD";
$strtotcard2=number_format($hsumcardsales['sumcardbill']);
$strtotcard3=number_format($hsumcardsales['sumjumlah_bayar']);
$headerstrtotcard1= str_pad($strtotcard1,24," ");
$headerstrtotcard2= str_pad($strtotcard2,4," ",STR_PAD_RIGHT);
$headerstrtotcard3= str_pad($strtotcard3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrtotcard1.$headerstrtotcard2.$headerstrtotcard3."\n");
//TOTALCARD
/*sumvchsales*/
$sumvchsales=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'VOUCHER'");
$hsumvchsales = mysqli_fetch_array($sumvchsales);
/*sumcardsales*/
//TOTALVOUCHER
$strtotvrc1="TOTAL VOUCHER";
$strtotvrc2=number_format($hsumvchsales['sumcardbill']);
$strtotvrc3=number_format($hsumvchsales['sumjumlah_bayar']);
$headerstrtotvrc1= str_pad($strtotvrc1,24," ");
$headerstrtotvrc2= str_pad($strtotvrc2,4," ",STR_PAD_RIGHT);
$headerstrtotvrc3= str_pad($strtotvrc3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrtotvrc1.$headerstrtotvrc2.$headerstrtotvrc3."\n");
//TOTALVOUCHER
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$voidreturntext= str_pad("VOID/REFUND SUMAMRY",42," ",STR_PAD_BOTH);
$printer -> text($voidreturntext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumrefund*/
$sumrefund=mysqli_query($koneksi,"SELECT sum(jumbill) as sumqtybill,sum(nett_sales) as sumpriceprevoid FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'REFUND'");
$hsumrefund = mysqli_fetch_array($sumrefund);
/*sumrefund*/
//TOTALREFUND
$strREFUND1="REFUND";
$strREFUND2=number_format($hsumrefund['sumqtybill']);
$strREFUND3=number_format($hsumrefund['sumpriceprevoid']);
$headerREFUND1= str_pad($strREFUND1,24," ");
$headerREFUND2= str_pad($strREFUND2,4," ",STR_PAD_RIGHT);
$headerREFUND3= str_pad($strREFUND3,14," ",STR_PAD_LEFT);
$printer -> text($headerREFUND1.$headerREFUND2.$headerREFUND3."\n");
//TOTALREFUND
/*sumpresendvoid*/
$sumpresendvoid=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyprevoid,sum(price) as sumpriceprevoid FROM item_void where terminal_id = '$idterminal' AND status_void = 'Before Send'");
$hsumpresendvoid = mysqli_fetch_array($sumpresendvoid);
/*sumpresendvoid*/
//TOTALPREVOID
$strPREVOID1="Pre-Send Void";
$strPREVOID2=number_format($hsumpresendvoid['sumqtyprevoid']);
$strPREVOID3=number_format($hsumpresendvoid['sumpriceprevoid']);
$headerPREVOID1= str_pad($strPREVOID1,24," ");
$headerPREVOID2= str_pad($strPREVOID2,4," ",STR_PAD_RIGHT);
$headerPREVOID3= str_pad($strPREVOID3,14," ",STR_PAD_LEFT);
$printer -> text($headerPREVOID1.$headerPREVOID2.$headerPREVOID3."\n");
//TOTALPREVOID
/*sumpostsendvoid*/
$sumpostsendvoid=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyprevoid,sum(price) as sumpriceprevoid FROM item_void where terminal_id = '$idterminal' AND status_void = 'After Send'");
$hsumpostsendvoid = mysqli_fetch_array($sumpostsendvoid);
/*sumpostsendvoid*/
//TOTALPOSTVOID
$strPOSTVOID1="Post-Send Void";
$strPOSTVOID2=number_format($hsumpostsendvoid['sumqtyprevoid']);
$strPOSTVOID3=number_format($hsumpostsendvoid['sumpriceprevoid']);
$headerPOSTVOID1= str_pad($strPOSTVOID1,24," ");
$headerPOSTVOID2= str_pad($strPOSTVOID2,4," ",STR_PAD_RIGHT);
$headerPOSTVOID3= str_pad($strPOSTVOID3,14," ",STR_PAD_LEFT);
$printer -> text($headerPOSTVOID1.$headerPOSTVOID2.$headerPOSTVOID3."\n");
//TOTALPOSTVOID
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumTotCollection*/
$sumTotCollection=mysqli_query($koneksi,"SELECT sum(bill) as sumbill, sum(jumlah_bayar) as sumjumbay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED'");
$hsumTotCollection = mysqli_fetch_array($sumTotCollection);
/*sumTotCollection*/
//TOTALCOLLECT
$strCOLLECT1="TotCollection";
$strCOLLECT2=number_format($hsumTotCollection['sumbill']);
$strCOLLECT3=number_format($hsumTotCollection['sumjumbay']);
$headerCOLLECT1= str_pad($strCOLLECT1,24," ");
$headerCOLLECT2= str_pad($strCOLLECT2,4," ",STR_PAD_RIGHT);
$headerCOLLECT3= str_pad($strCOLLECT3,14," ",STR_PAD_LEFT);
$printer -> text($headerCOLLECT1.$headerCOLLECT2.$headerCOLLECT3."\n");
//TOTALCOLLECT
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$svctext= str_pad("SERVICE CHARGE",42," ",STR_PAD_BOTH);
$printer -> text($svctext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumtax*/
$sumtax=mysqli_query($koneksi,"SELECT sum(tax) as sumtax, sum(gross_sales) as sumbeforetax, sum(disc) as sumdiscsales, sum(service_charge) as totalsurcharge FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumtax = mysqli_fetch_array($sumtax);
$servicech=$hsumtax['totalsurcharge'];
$tax=$hsumtax['sumtax'];
$aftertax=$hsumtax['sumbeforetax']-$hsumtax['sumdiscsales'];
/*sumtax*/
//SERVICECHARGE
$strsvch1="Service Charge 5%";
$strsvch2=number_format($servicech);
$headersvch1= str_pad($strsvch1,28," ");
$headersvch2= str_pad($strsvch2,14," ",STR_PAD_LEFT);
$printer -> text($headersvch1.$headersvch2."\n");
//SERVICECHARGE
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$taxtext= str_pad("TAX",42," ",STR_PAD_BOTH);
$printer -> text($taxtext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//tax10
$strtax101="Tax 10%";
$strtax102=number_format($tax);
$headertax101= str_pad($strtax101,28," ");
$headertax102= str_pad($strtax102,14," ",STR_PAD_LEFT);
$printer -> text($headertax101.$headertax102."\n");
//tax10
//nettsls
$strnettsls1="Nett Sales";
$strnettsls2=number_format($aftertax);
$headernettsls1= str_pad($strnettsls1,28," ");
$headernettsls2= str_pad($strnettsls2,14," ",STR_PAD_LEFT);
$printer -> text($headernettsls1.$headernettsls2."\n");
//nettsls
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumbillspending*/
$sumbillspending=mysqli_query($koneksi,"SELECT sum(jumbill) as sumopenbill, sum(gross_sales) as sumgrossopenbill, sum(disc) as sumdiscopenbill FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'OPEN'");
$hsumbillspending = mysqli_fetch_array($sumbillspending);
$totalopenbill=$hsumbillspending['sumgrossopenbill']+$hsumbillspending['sumdiscopenbill'];
/*sumbillspending*/
//billpen
$strbillpen1="Bills Pending";
$strbillpen2=number_format($hsumbillspending['sumopenbill']);
$strbillpen3=number_format($totalopenbill);
$headerbillpen1= str_pad($strbillpen1,24," ");
$headerbillpen2= str_pad($strbillpen2,4," ",STR_PAD_RIGHT);
$headerbillpen3= str_pad($strbillpen3,14," ",STR_PAD_LEFT);
$printer -> text($headerbillpen1.$headerbillpen2.$headerbillpen3."\n");
//billpen
/*sumclosebill*/
$sumclosebill=mysqli_query($koneksi,"SELECT sum(jumbill) as sumclosebill FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumclosebill = mysqli_fetch_array($sumclosebill);
/*sumclosebill*/
//countbill
$strcountbill1="Total # of Bills";
$strcountbill2=number_format($hsumclosebill['sumclosebill']);
$headercountbill1= str_pad($strcountbill1,28," ");
$headercountbill2= str_pad($strcountbill2,14," ",STR_PAD_LEFT);
$printer -> text($headercountbill1.$headercountbill2."\n");
//countbill
/*sumavgbill*/
$sumavgbill=mysqli_query($koneksi,"SELECT sum(jumbill) as sumclosebill, sum(nett_sales) as sumnett_sales FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumavgbill = mysqli_fetch_array($sumavgbill);
$xavgperbill=$hsumavgbill['sumnett_sales']/$hsumavgbill['sumclosebill'];
$avgperbill=ceil($xavgperbill);
/*sumavgbill*/
//avgbill
$stravgbill1="Avg Bills";
$stravgbill2=number_format($avgperbill);
$headeravgbill1= str_pad($stravgbill1,28," ");
$headeravgbill2= str_pad($stravgbill2,14," ",STR_PAD_LEFT);
$printer -> text($headeravgbill1.$headeravgbill2."\n");
//avgbill
/*sumcoverbill*/
$sumcoverbill=mysqli_query($koneksi,"SELECT sum(custqty) as sumcustqty, sum(nett_sales) as sumnett_sales FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumcoverbill = mysqli_fetch_array($sumcoverbill);
$xavgcustperbill=$hsumcoverbill['sumnett_sales']/$hsumcoverbill['sumcustqty'];
$avgcustperbill=ceil($xavgcustperbill);
/*sumcoverbill*/
//countcust
$strcountcust1="Total # of Covers";
$strcountcust2=number_format($hsumcoverbill['sumcustqty']);
$headercountcust1= str_pad($strcountcust1,28," ");
$headercountcust2= str_pad($strcountcust2,14," ",STR_PAD_LEFT);
$printer -> text($headercountcust1.$headercountcust2."\n");
//countcust
//avgcust
$stravgcust1="Avg Covers";
$stravgcust2=number_format($avgcustperbill);
$headeravgcust1= str_pad($stravgcust1,28," ");
$headeravgcust2= str_pad($stravgcust2,14," ",STR_PAD_LEFT);
$printer -> text($headeravgcust1.$headeravgcust2."\n");
//avgcust
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$bgnbill=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where terminal_id = '$idterminal' AND status != 'CANCELED' AND status != 'OPEN' order by bill_number ASC LIMIT 1");
$hbgnbill = mysqli_fetch_array($bgnbill);
$strbgnrcpt1="Begin Receipt#";
$strbgnrcpt2=$hbgnbill['bill_number'];
$headerbgnrcpt1= str_pad($strbgnrcpt1,21," ");
$headerbgnrcpt2= str_pad($strbgnrcpt2,21," ",STR_PAD_LEFT);
$printer -> text($headerbgnrcpt1.$headerbgnrcpt2."\n");
$endbill=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where terminal_id = '$idterminal' AND status != 'CANCELED' AND status != 'OPEN' order by bill_number DESC LIMIT 1");
$hendbill = mysqli_fetch_array($endbill);
$strendrcpt1="End Receipt#";
$strendrcpt2=$hendbill['bill_number'];
$headerendrcpt1= str_pad($strendrcpt1,21," ");
$headerendrcpt2= str_pad($strendrcpt2,21," ",STR_PAD_LEFT);
$printer -> text($headerendrcpt1.$headerendrcpt2."\n");

$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$groupslstext= str_pad("GROUP SALES",42," ",STR_PAD_BOTH);
$printer -> text($groupslstext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumbevsales*/
$sumbevsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp where kdcategory = '191002' AND terminal_id = '$idterminal' AND paidstatus = 'PAID'");
$hsumbevsales = mysqli_fetch_array($sumbevsales);
/*sumbevsales*/
//bevsls
$strbevsls1="BEVERAGES";
$strbevsls2=number_format($hsumbevsales['sumbevqty']);
$strbevsls3=number_format($hsumbevsales['sumbevprice']);
$headerbevsls1= str_pad($strbevsls1,24," ");
$headerbevsls2= str_pad($strbevsls2,4," ",STR_PAD_RIGHT);
$headerbevsls3= str_pad($strbevsls3,14," ",STR_PAD_LEFT);
$printer -> text($headerbevsls1.$headerbevsls2.$headerbevsls3."\n");
//bevsls
/*sumfoodsales*/
$sumfoodsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp where kdcategory = '191001' AND terminal_id = '$idterminal' AND paidstatus = 'PAID'");
$hsumfoodsales = mysqli_fetch_array($sumfoodsales);
/*sumfoodsales*/
//fodsls
$strfodsls1="FOOD";
$strfodsls2=number_format($hsumfoodsales['sumbevqty']);
$strfodsls3=number_format($hsumfoodsales['sumbevprice']);
$headerfodsls1= str_pad($strfodsls1,24," ");
$headerfodsls2= str_pad($strfodsls2,4," ",STR_PAD_RIGHT);
$headerfodsls3= str_pad($strfodsls3,14," ",STR_PAD_LEFT);
$printer -> text($headerfodsls1.$headerfodsls2.$headerfodsls3."\n");
//fodsls
/*sumfnbsales*/
$sumfnbsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp WHERE terminal_id = '$idterminal' AND paidstatus = 'PAID'");
$hsumfnbsales = mysqli_fetch_array($sumfnbsales);
/*sumfnbsales*/
//fnbsls
$strfnbsls1="TOTAL GROUP";
$strfnbsls2=number_format($hsumfnbsales['sumbevqty']);
$strfnbsls3=number_format($hsumfnbsales['sumbevprice']);
$headerfnbsls1= str_pad($strfnbsls1,24," ");
$headerfnbsls2= str_pad($strfnbsls2,4," ",STR_PAD_RIGHT);
$headerfnbsls3= str_pad($strfnbsls3,14," ",STR_PAD_LEFT);
$printer -> text($headerfnbsls1.$headerfnbsls2.$headerfnbsls3."\n");
//fnbsls
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$focgrouptext= str_pad("GROUP FOC",42," ",STR_PAD_BOTH);
$printer -> text($focgrouptext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");

//bevfoc
$strbevfoc1="BEVERAGES";
$strbevfoc2="0";
$strbevfoc3="0";
$headerbevfoc1= str_pad($strbevfoc1,24," ");
$headerbevfoc2= str_pad($strbevfoc2,4," ",STR_PAD_RIGHT);
$headerbevfoc3= str_pad($strbevfoc3,14," ",STR_PAD_LEFT);
$printer -> text($headerbevfoc1.$headerbevfoc2.$headerbevfoc3."\n");
//bevfoc

//fodfoc
$strfodfoc1="FOOD";
$strfodfoc2="QTY";
$strfodfoc3="AMOUNT";
$headerfodfoc1= str_pad($strfodfoc1,24," ");
$headerfodfoc2= str_pad($strfodfoc2,4," ",STR_PAD_RIGHT);
$headerfodfoc3= str_pad($strfodfoc3,14," ",STR_PAD_LEFT);
$printer -> text($headerfodfoc1.$headerfodfoc2.$headerfodfoc3."\n");
//fodfoc
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$salescattext= str_pad("SALES CATEGORY",42," ",STR_PAD_BOTH);
$printer -> text($salescattext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumdinein*/
$sumdinein=mysqli_query($koneksi,"SELECT sum(jumbill) as sumdineinqty, sum(gross_sales) as sumdineingross FROM pos_salestemp WHERE terminal_id = '$idterminal' AND status = 'CLOSED' AND meja != 'takeaway' ");
$hsumdinein = mysqli_fetch_array($sumdinein);
/*sumdinein*/
//dinein
$strdinein1="DINE IN";
$strdinein2=number_format($hsumdinein['sumdineinqty']);
$strdinein3=number_format($hsumdinein['sumdineingross']);
$headerdinein1= str_pad($strdinein1,24," ");
$headerdinein2= str_pad($strdinein2,4," ",STR_PAD_RIGHT);
$headerdinein3= str_pad($strdinein3,14," ",STR_PAD_LEFT);
$printer -> text($headerdinein1.$headerdinein2.$headerdinein3."\n");
//dinein
/*sumtakeaway*/
$sumtakeaway=mysqli_query($koneksi,"SELECT sum(jumbill) as sumtakeawayqty, sum(gross_sales) as sumtakeawaygross FROM pos_salestemp WHERE terminal_id = '$idterminal' AND status = 'CLOSED' AND meja = 'takeaway' ");
$hsumtakeaway = mysqli_fetch_array($sumtakeaway);
/*sumtakeaway*/
//takeaway
$strtakeaway1="TAKE AWAY";
$strtakeaway2=number_format($hsumtakeaway['sumtakeawayqty']);
$strtakeaway3=number_format($hsumtakeaway['sumtakeawaygross']);
$headertakeaway1= str_pad($strtakeaway1,24," ");
$headertakeaway2= str_pad($strtakeaway2,4," ",STR_PAD_RIGHT);
$headertakeaway3= str_pad($strtakeaway3,14," ",STR_PAD_LEFT);
$printer -> text($headertakeaway1.$headertakeaway2.$headertakeaway3."\n");
//takeaway
/*sumtotctgry*/
$sumtotctgry=mysqli_query($koneksi,"SELECT sum(jumbill) as sumtotctgryqty, sum(gross_sales) as sumtotctgrygross FROM pos_salestemp WHERE terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumtotctgry = mysqli_fetch_array($sumtotctgry);
/*sumtotctgry*/
//totslscat
$strtotslscat1="TOTAL SALES CATEGORY";
$strtotslscat2=number_format($hsumtotctgry['sumtotctgryqty']);
$strtotslscat3=number_format($hsumtotctgry['sumtotctgrygross']);
$headertotslscat1= str_pad($strtotslscat1,24," ");
$headertotslscat2= str_pad($strtotslscat2,4," ",STR_PAD_RIGHT);
$headertotslscat3= str_pad($strtotslscat3,14," ",STR_PAD_LEFT);
$printer -> text($headertotslscat1.$headertotslscat2.$headertotslscat3."\n");
//totslscat
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$discprmtext= str_pad("DISCOUNT/PROMOTION",42," ",STR_PAD_BOTH);
$printer -> text($discprmtext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*discitemdet*/
$discitemdet=mysqli_query($koneksi,"SELECT id_promotion,sum(qty) as sumqtyitemdisc, sum(disc) as sumdiscitem FROM pos_promotion_d where terminal_id = '$idterminal' and promotion_type = 'DISC ITEM' and paid_status = 'PAID' group by id_promotion");
while($hdiscitemdet = mysqli_fetch_array($discitemdet))
{
$discitemket=mysqli_query($koneksi,"SELECT * FROM promotion_h WHERE id_promotion = '$hdiscitemdet[id_promotion]'");
$hdiscitemket = mysqli_fetch_array($discitemket);
/*sumdiscitem*/
//itmdscloop
$stritmdscloop1=$hdiscitemket['promotion_name'];
$stritmdscloop2=number_format($hdiscitemdet['sumqtyitemdisc']);
$stritmdscloop3=number_format($hdiscitemdet['sumdiscitem']);
$headeritmdscloop1= str_pad($stritmdscloop1,24," ");
$headeritmdscloop2= str_pad($stritmdscloop2,4," ",STR_PAD_RIGHT);
$headeritmdscloop3= str_pad($stritmdscloop3,14," ",STR_PAD_LEFT);
$printer -> text($headeritmdscloop1.$headeritmdscloop2.$headeritmdscloop3."\n");
//itmdscloop
}
/*sumdiscitem*/
$sumitemdisc=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyitemdisc, sum(disc) as sumdiscitem, id_promotion FROM pos_promotion_d where terminal_id = '$idterminal' and promotion_type = 'DISC ITEM' and paid_status = 'PAID'");
$hsumitemdisc = mysqli_fetch_array($sumitemdisc);
/*sumdiscitem*/
//totitmdsc
$strtotitmdsc1="TOTAL ItemDiscount";
$strtotitmdsc2=number_format($hsumitemdisc['sumqtyitemdisc']);
$strtotitmdsc3=number_format($hsumitemdisc['sumdiscitem']);
$headertotitmdsc1= str_pad($strtotitmdsc1,24," ");
$headertotitmdsc2= str_pad($strtotitmdsc2,4," ",STR_PAD_RIGHT);
$headertotitmdsc3= str_pad($strtotitmdsc3,14," ",STR_PAD_LEFT);
$printer -> text($headertotitmdsc1.$headertotitmdsc2.$headertotitmdsc3."\n");
//totitmdsc
/*discbilldet*/
$discbilldet=mysqli_query($koneksi,"SELECT sum(bill) as sumbilldisc, sum(disc) as sumdiscbill, disc_desk FROM pos_promotion_h where terminal_id = '$idterminal' and promotion_type = 'DISC ALL' and paid_status = 'PAID' group by id_promotion");
while($hdiscbilldet = mysqli_fetch_array($discbilldet))
{
/*discbilldet*/
//bildscloop
$strbildscloop1=$hdiscbilldet['disc_desk'];
$strbildscloop2=number_format($hdiscbilldet['sumbilldisc']);
$strbildscloop3=number_format($hdiscbilldet['sumdiscbill']);
$headerbildscloop1= str_pad($strbildscloop1,24," ");
$headerbildscloop2= str_pad($strbildscloop2,4," ",STR_PAD_RIGHT);
$headerbildscloop3= str_pad($strbildscloop3,14," ",STR_PAD_LEFT);
$printer -> text($headerbildscloop1.$headerbildscloop2.$headerbildscloop3."\n");
//bildscloop
}
/*sumbilldisc*/
$sumbilldisc=mysqli_query($koneksi,"SELECT sum(bill) as sumqtybill, sum(disc) as sumdiscbill FROM pos_promotion_h where terminal_id = '$idterminal' and promotion_type = 'DISC ALL' and paid_status = 'PAID'");
$hsumbilldisc = mysqli_fetch_array($sumbilldisc);
/*sumbilldisc*/
//totbildsc
$strtotbildsc1="TOTAL BillDiscount";
$strtotbildsc2=number_format($hsumbilldisc['sumqtybill']);
$strtotbildsc3=number_format($hsumbilldisc['sumdiscbill']);
$headertotbildsc1= str_pad($strtotbildsc1,24," ");
$headertotbildsc2= str_pad($strtotbildsc2,4," ",STR_PAD_RIGHT);
$headertotbildsc3= str_pad($strtotbildsc3,14," ",STR_PAD_LEFT);
$printer -> text($headertotbildsc1.$headertotbildsc2.$headertotbildsc3."\n");
//totbildsc
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$fipotext= str_pad("FIPO",42," ",STR_PAD_BOTH);
$printer -> text($fipotext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumsalescash*/
$sumsalescash=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CASH' AND JnsCard = 'CASH'");
$hsumsalescash = mysqli_fetch_array($sumsalescash);
/*sumsalescash*/
//estcash
$strestcash1="SALES CASH";
$strestcash2="(+)";
$strestcash3=number_format($hsumsalescash['sumcardbill']);
$strestcash4=number_format($hsumsalescash['sumjumlah_bayar']);
$headerestcash1= str_pad($strestcash1,20," ");
$headerestcash2= str_pad($strestcash2,4," ",STR_PAD_RIGHT);
$headerestcash3= str_pad($strestcash3,4," ",STR_PAD_RIGHT);
$headerestcash4= str_pad($strestcash4,14," ",STR_PAD_LEFT);
$printer -> text($headerestcash1.$headerestcash2.$headerestcash3.$headerestcash4."\n");
//estcash
/*modalcash*/
$modalcash=mysqli_query($koneksi,"SELECT * FROM terminal_parameter where terminal_id = '$idterminal'");
$hmodalcash = mysqli_fetch_array($modalcash);
$totalcashindrawer=$hsumsalescash['sumjumlah_bayar']+$hmodalcash['modal'];
/*modalcash*/
//cashindrw
$strcashindrw1="CASH IN DRAWER";
$strcashindrw2="(=)";
$strcashindrw3=number_format($totalcashindrawer);
$headercashindrw1= str_pad($strcashindrw1,20," ");
$headercashindrw2= str_pad($strcashindrw2,4," ",STR_PAD_RIGHT);
$headercashindrw3= str_pad($strcashindrw3,18," ",STR_PAD_LEFT);
$printer -> text($headercashindrw1.$headercashindrw2.$headercashindrw3."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$terminaldatefromto=$hmodalcash['openterminal']." TO ".$hmodalcash['closeterminal'];
$hterminaldatefromto= str_pad($terminaldatefromto,20," ");
$printer -> text($hterminaldatefromto."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//cashindrw
$printer -> feed();
/* Footer */

/* Cut the receipt and open the cash drawer */
$printer -> cut();

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($logo);
$printer -> feed();

$printer -> selectPrintMode();

/* Title of receipt */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> setFont(Printer::FONT_B);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> setTextSize(1, 1);
$printer -> selectPrintMode();
$printer -> setEmphasis(false);
$printer -> text("ISOIDE\n");
$printer -> text("PLAZA ATRIUM,SENEN\n");
$printer -> text("PLU SALES REPORT\n");
$strplu1="OP:".$hceknamauser['nama_user'];
$strplu2=$nowdate;
$headerplu1= str_pad($strplu1,21," ");
$headerplu2= str_pad($strplu2,21," ",STR_PAD_LEFT);
$printer -> text($headerplu1.$headerplu2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$strplu3="PLUName";
$strplu4="Qty";
$headerplu3= str_pad($strplu3,32," ");
$headerplu4= str_pad($strplu4,10," ",STR_PAD_LEFT);
$printer -> text($headerplu3.$headerplu4."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");

$strplu5="Group:BEVERAGES";
$headerplu5= str_pad($strplu5,42," ");
$printer -> text($headerplu5."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgs=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191002' group by kdsubcategory");
while($hloopbvrgs = mysqli_fetch_array($loopbvrgs))
{
$detbvgdept=mysqli_query($koneksi,"SELECT * FROM pos_subcategory where kdsubcategory = '$hloopbvrgs[kdsubcategory]'");
$hdetbvgdept = mysqli_fetch_array($detbvgdept);
$sumdetbvgdept=mysqli_query($koneksi,"SELECT sum(qty) as qtydept FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kdsubcategory = '$hdetbvgdept[kdsubcategory]'");
$hsumdetbvgdept = mysqli_fetch_array($sumdetbvgdept);
//deptloop
$strbvrdeplop="Dept:".$hdetbvgdept['nmsubcategory'];;
$headerbvrdeplop= str_pad($strbvrdeplop,42," ");
$printer -> text($headerbvrdeplop."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgsdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdsubcategory = '$hdetbvgdept[kdsubcategory]' group by kditem");
while($hloopbvrgsdeptitem = mysqli_fetch_array($loopbvrgsdeptitem))
{
$detbvgdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$hloopbvrgsdeptitem[kditem]'");
$hdetbvgdeptitem = mysqli_fetch_array($detbvgdeptitem);
$sumdetbvgdeptitem=mysqli_query($koneksi,"SELECT sum(qty) as qtydeptitem FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kditem = '$hdetbvgdeptitem[kditem]'");
$hsumdetbvgdeptitem = mysqli_fetch_array($sumdetbvgdeptitem);
//deptitemloop
$strdeptitem1=$hdetbvgdeptitem['nmitem'];
$strdeptitem2=$hsumdetbvgdeptitem['qtydeptitem'];
$headerdeptitem1= str_pad($strdeptitem1,32," ");
$headerdeptitem2= str_pad($strdeptitem2,10," ",STR_PAD_LEFT);
$printer -> text($headerdeptitem1.$headerdeptitem2."\n");
//deptitemloop
}
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$strtotdept1=$hdetbvgdept['nmsubcategory'];
$strtotdept2=$hsumdetbvgdept['qtydept'];
$headertotdept1= str_pad($strtotdept1,32," ");
$headertotdept2= str_pad($strtotdept2,10," ",STR_PAD_LEFT);
$printer -> text($headertotdept1.$headertotdept2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//deptloop
}
$sumbeverages=mysqli_query($koneksi,"SELECT sum(qty) as qtybeverages FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191002'");
$hsumbeverages= mysqli_fetch_array($sumbeverages);
$strtotgroup1="Group:BEVERAGES";
$strtotgroup2=$hsumbeverages['qtybeverages'];
$headertotgroup1= str_pad($strtotgroup1,32," ");
$headertotgroup2= str_pad($strtotgroup2,10," ",STR_PAD_LEFT);
$printer -> text($headertotgroup1.$headertotgroup2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");

$strplu5="Group:FOOD";
$headerplu5= str_pad($strplu5,42," ");
$printer -> text($headerplu5."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgs=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191001' group by kdsubcategory");
while($hloopbvrgs = mysqli_fetch_array($loopbvrgs))
{
$detbvgdept=mysqli_query($koneksi,"SELECT * FROM pos_subcategory where kdsubcategory = '$hloopbvrgs[kdsubcategory]'");
$hdetbvgdept = mysqli_fetch_array($detbvgdept);
$sumdetbvgdept=mysqli_query($koneksi,"SELECT sum(qty) as qtydept FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kdsubcategory = '$hdetbvgdept[kdsubcategory]'");
$hsumdetbvgdept = mysqli_fetch_array($sumdetbvgdept);
//deptloop
$strbvrdeplop="Dept:".$hdetbvgdept['nmsubcategory'];;
$headerbvrdeplop= str_pad($strbvrdeplop,42," ");
$printer -> text($headerbvrdeplop."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgsdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdsubcategory = '$hdetbvgdept[kdsubcategory]' group by kditem");
while($hloopbvrgsdeptitem = mysqli_fetch_array($loopbvrgsdeptitem))
{
$detbvgdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$hloopbvrgsdeptitem[kditem]'");
$hdetbvgdeptitem = mysqli_fetch_array($detbvgdeptitem);
$sumdetbvgdeptitem=mysqli_query($koneksi,"SELECT sum(qty) as qtydeptitem FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kditem = '$hdetbvgdeptitem[kditem]'");
$hsumdetbvgdeptitem = mysqli_fetch_array($sumdetbvgdeptitem);
//deptitemloop
$strdeptitem1=$hdetbvgdeptitem['nmitem'];
$strdeptitem2=$hsumdetbvgdeptitem['qtydeptitem'];
$headerdeptitem1= str_pad($strdeptitem1,32," ");
$headerdeptitem2= str_pad($strdeptitem2,10," ",STR_PAD_LEFT);
$printer -> text($headerdeptitem1.$headerdeptitem2."\n");
//deptitemloop
}
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$strtotdept1=$hdetbvgdept['nmsubcategory'];
$strtotdept2=$hsumdetbvgdept['qtydept'];
$headertotdept1= str_pad($strtotdept1,32," ");
$headertotdept2= str_pad($strtotdept2,10," ",STR_PAD_LEFT);
$printer -> text($headertotdept1.$headertotdept2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//deptloop
}
$sumbeverages=mysqli_query($koneksi,"SELECT sum(qty) as qtybeverages FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191001'");
$hsumbeverages= mysqli_fetch_array($sumbeverages);
$strtotgroup1="Group:FOOD";
$strtotgroup2=$hsumbeverages['qtybeverages'];
$headertotgroup1= str_pad($strtotgroup1,32," ");
$headertotgroup2= str_pad($strtotgroup2,10," ",STR_PAD_LEFT);
$printer -> text($headertotgroup1.$headertotgroup2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");

$strplu5="Group:FREE ITEM";
$headerplu5= str_pad($strplu5,42," ");
$printer -> text($headerplu5."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgs=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191003' group by kdsubcategory");
while($hloopbvrgs = mysqli_fetch_array($loopbvrgs))
{
$detbvgdept=mysqli_query($koneksi,"SELECT * FROM pos_subcategory where kdsubcategory = '$hloopbvrgs[kdsubcategory]'");
$hdetbvgdept = mysqli_fetch_array($detbvgdept);
$sumdetbvgdept=mysqli_query($koneksi,"SELECT sum(qty) as qtydept FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kdsubcategory = '$hdetbvgdept[kdsubcategory]'");
$hsumdetbvgdept = mysqli_fetch_array($sumdetbvgdept);
//deptloop
$strbvrdeplop="Dept:".$hdetbvgdept['nmsubcategory'];;
$headerbvrdeplop= str_pad($strbvrdeplop,42," ");
$printer -> text($headerbvrdeplop."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgsdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdsubcategory = '$hdetbvgdept[kdsubcategory]' group by kditem");
while($hloopbvrgsdeptitem = mysqli_fetch_array($loopbvrgsdeptitem))
{
$detbvgdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$hloopbvrgsdeptitem[kditem]'");
$hdetbvgdeptitem = mysqli_fetch_array($detbvgdeptitem);
$sumdetbvgdeptitem=mysqli_query($koneksi,"SELECT sum(qty) as qtydeptitem FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kditem = '$hdetbvgdeptitem[kditem]'");
$hsumdetbvgdeptitem = mysqli_fetch_array($sumdetbvgdeptitem);
//deptitemloop
$strdeptitem1=$hdetbvgdeptitem['nmitem'];
$strdeptitem2=$hsumdetbvgdeptitem['qtydeptitem'];
$headerdeptitem1= str_pad($strdeptitem1,32," ");
$headerdeptitem2= str_pad($strdeptitem2,10," ",STR_PAD_LEFT);
$printer -> text($headerdeptitem1.$headerdeptitem2."\n");
//deptitemloop
}
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$strtotdept1=$hdetbvgdept['nmsubcategory'];
$strtotdept2=$hsumdetbvgdept['qtydept'];
$headertotdept1= str_pad($strtotdept1,32," ");
$headertotdept2= str_pad($strtotdept2,10," ",STR_PAD_LEFT);
$printer -> text($headertotdept1.$headertotdept2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//deptloop
}
$sumbeverages=mysqli_query($koneksi,"SELECT sum(qty) as qtybeverages FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191003'");
$hsumbeverages= mysqli_fetch_array($sumbeverages);
$strtotgroup1="Group:FREE ITEM";
$strtotgroup2=$hsumbeverages['qtybeverages'];
$headertotgroup1= str_pad($strtotgroup1,32," ");
$headertotgroup2= str_pad($strtotgroup2,10," ",STR_PAD_LEFT);
$printer -> text($headertotgroup1.$headertotgroup2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");

$sumallplu=mysqli_query($koneksi,"SELECT sum(qty) as qtyallplu FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' ");
$hsumallplu= mysqli_fetch_array($sumallplu);
$strtotall1="Total";
$strtotall2=$hsumallplu['qtyallplu'];
$headertotall1= str_pad($strtotall1,32," ");
$headertotall2= str_pad($strtotall2,10," ",STR_PAD_LEFT);
$printer -> text($headertotall1.$headertotall2."\n");
/*modalcash*/
$modalcash=mysqli_query($koneksi,"SELECT * FROM terminal_parameter where terminal_id = '$idterminal'");
$hmodalcash = mysqli_fetch_array($modalcash);
$totalcashindrawer=$hsumsalescash['sumjumlah_bayar']+$hmodalcash['modal'];
/*modalcash*/
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$terminaldatefromto=$hmodalcash['openterminal']." TO ".$hmodalcash['closeterminal'];
$hterminaldatefromto= str_pad($terminaldatefromto,20," ");
$printer -> text($hterminaldatefromto."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$printer -> feed();
/* Footer */

/* Cut the receipt and open the cash drawer */
$printer -> cut();

/* Start the printer */
$logo = EscposImage::load("logostruksm.png", false);
$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($logo);
$printer -> feed();

$printer -> selectPrintMode();

/* Title of receipt */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> setFont(Printer::FONT_B);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> setTextSize(1, 1);
$printer -> selectPrintMode();
$printer -> setEmphasis(false);
$printer -> text("ISOIDE\n");
$printer -> text("PLAZA ATRIUM,SENEN\n");
$printer -> text("CLOSING SALES REPORT\n");
$str1="OP:".$hceknamauser['nama_user'];
$str2=$nowdate;
$headertext1= str_pad($str1,21," ");
$headertext2= str_pad($str2,21," ",STR_PAD_LEFT);
$printer -> text($headertext1.$headertext2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$str3="TYPE";
$str4=" ";
$str5="QTY";
$str6="AMOUNT";
$headertext3= str_pad($str3,20," ");
$headertext4= str_pad($str4,4," ",STR_PAD_RIGHT);
$headertext5= str_pad($str5,4," ",STR_PAD_RIGHT);
$headertext6= str_pad($str6,14," ",STR_PAD_LEFT);
$printer -> text($headertext3.$headertext4.$headertext5.$headertext6."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumitemsales*/
$sumitemsales=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyitem, sum(price) as sumpriceitem FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID'");
$hsumitemsales = mysqli_fetch_array($sumitemsales);
/*sumitemsales*/
$str7="ItemSales";
$str8="(+)";
$str9=$hsumitemsales['sumqtyitem'];
$str10=number_format($hsumitemsales['sumpriceitem']);
$headertext7= str_pad($str7,20," ");
$headertext8= str_pad($str8,4," ",STR_PAD_RIGHT);
$headertext9= str_pad($str9,4," ",STR_PAD_RIGHT);
$headertext10= str_pad($str10,14," ",STR_PAD_LEFT);
$printer -> text($headertext7.$headertext8.$headertext9.$headertext10."\n");
/*sumdiscitem*/
$sumitemdisc=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyitemdisc, sum(disc) as sumdiscitem FROM pos_promotion_d where terminal_id = '$idterminal' and promotion_type = 'DISC ITEM' and paid_status = 'PAID'");
$hsumitemdisc = mysqli_fetch_array($sumitemdisc);
/*sumdiscitem*/
$str11="ItemDiscount";
$str12="(-)";
$str13=number_format($hsumitemdisc['sumqtyitemdisc']);
$str14=number_format($hsumitemdisc['sumdiscitem']);
$headertext11= str_pad($str11,20," ");
$headertext12= str_pad($str12,4," ",STR_PAD_RIGHT);
$headertext13= str_pad($str13,4," ",STR_PAD_RIGHT);
$headertext14= str_pad($str14,14," ",STR_PAD_LEFT);
$printer -> text($headertext11.$headertext12.$headertext13.$headertext14."\n");
$str15="FOC Items";
$str16="(-)";
$str17="0";
$str18="0";
$headertext15= str_pad($str15,20," ");
$headertext16= str_pad($str16,4," ",STR_PAD_RIGHT);
$headertext17= str_pad($str17,4," ",STR_PAD_RIGHT);
$headertext18= str_pad($str18,14," ",STR_PAD_LEFT);
$printer -> text($headertext15.$headertext16.$headertext17.$headertext18."\n");
$str19="FOC Bill";
$str20="(-)";
$str21="0";
$str22="0";
$headertext19= str_pad($str19,20," ");
$headertext20= str_pad($str20,4," ",STR_PAD_RIGHT);
$headertext21= str_pad($str21,4," ",STR_PAD_RIGHT);
$headertext22= str_pad($str22,14," ",STR_PAD_LEFT);
$printer -> text($headertext19.$headertext20.$headertext21.$headertext22."\n");
/*sumclosesales*/
$sumclosesales=mysqli_query($koneksi,"SELECT sum(gross_sales) as sumgrosssales, sum(disc) as sumsalesdisc FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumclosesales = mysqli_fetch_array($sumclosesales);
$grandtotalsumclosesales=$hsumclosesales['sumgrosssales']-$hsumclosesales['sumsalesdisc'];
/*sumclosesales*/
$str23="Total Sales";
$str24="(=)";
$str25="";
$str26=number_format($grandtotalsumclosesales);
$headertext23= str_pad($str23,20," ");
$headertext24= str_pad($str24,4," ",STR_PAD_RIGHT);
$headertext25= str_pad($str25,4," ",STR_PAD_RIGHT);
$headertext26= str_pad($str26,14," ",STR_PAD_LEFT);
$printer -> text($headertext23.$headertext24.$headertext25.$headertext26."\n");
/*sumestimatedsales*/
$sumestimatedsales=mysqli_query($koneksi,"SELECT sum(gross_sales) as sumgrosssales, sum(disc) as sumsalesdisc FROM pos_salestemp where terminal_id = '$idterminal' AND status != 'CANCELED' AND status != 'REFUND'");
$hsumestimatedsales = mysqli_fetch_array($sumestimatedsales);
$grandtotalsumestimatedsales=$hsumestimatedsales['sumgrosssales']-$hsumestimatedsales['sumsalesdisc'];
/*sumestimatedsales*/
$str27="Estimated Sales";
$str28="";
$str29="";
$str30=number_format($grandtotalsumestimatedsales);
$headertext27= str_pad($str27,20," ");
$headertext28= str_pad($str28,4," ",STR_PAD_RIGHT);
$headertext29= str_pad($str29,4," ",STR_PAD_RIGHT);
$headertext30= str_pad($str30,14," ",STR_PAD_LEFT);
$printer -> text($headertext27.$headertext28.$headertext29.$headertext30."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$mediatext= str_pad("MEDIA",42," ",STR_PAD_BOTH);
$printer -> text($mediatext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumclosepay*/
$sumclosepaycash=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CASH' group by JnsCard");
/*sumclosepay*/
while($hsumclosepaycash = mysqli_fetch_array($sumclosepaycash))
{
$keyJnsCardcash=$hsumclosepaycash['JnsCard'];
$sumdetpaycash=mysqli_query($koneksi,"SELECT sum(bill) as qtybill, sum(jumlah_bayar) as sumpay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsCard = '$keyJnsCardcash'");
$hsumdetpaycash = mysqli_fetch_array($sumdetpaycash);
//mediacashloop
$strmcash1=$hsumclosepaycash['JnsCard'];
$strmcash2=number_format($hsumdetpaycash['qtybill']);
$strmcash3=number_format($hsumdetpaycash['sumpay']);
$headerstrmcash1= str_pad($strmcash1,24," ");
$headerstrmcash2= str_pad($strmcash2,4," ",STR_PAD_RIGHT);
$headerstrmcash3= str_pad($strmcash3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrmcash1.$headerstrmcash2.$headerstrmcash3."\n");
//mediacashloop
}
/*sumclosepay*/
$sumclosepaycard=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CARD' group by JnsCard");
/*sumclosepay*/
while($hsumclosepaycard = mysqli_fetch_array($sumclosepaycard))
{
$keyJnsCardcard =$hsumclosepaycard['JnsCard'];
$sumdetpaycard=mysqli_query($koneksi,"SELECT sum(bill) as qtybill, sum(jumlah) as sumpay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsCard = '$keyJnsCardcard'");
$hsumdetpaycard = mysqli_fetch_array($sumdetpaycard);
//mediacardloop
$strmcard1=$hsumclosepaycard['JnsCard'];
$strmcard2=number_format($hsumdetpaycard['qtybill']);
$strmcard3=number_format($hsumdetpaycard['sumpay']);
$headerstrmcard1= str_pad($strmcard1,24," ");
$headerstrmcard2= str_pad($strmcard2,4," ",STR_PAD_RIGHT);
$headerstrmcard3= str_pad($strmcard3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrmcard1.$headerstrmcard2.$headerstrmcard3."\n");
//mediacardloop
}
/*sumclosepay*/
$sumclosepayvcr=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'VOUCHER' group by JnsCard");
/*sumclosepay*/
while($hsumclosepayvcr = mysqli_fetch_array($sumclosepayvcr))
{
$keyJnsCardvcr=$hsumclosepayvcr['JnsCard'];
$sumdetpayvcr=mysqli_query($koneksi,"SELECT sum(bill) as qtybill, sum(jumlah) as sumpay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsCard = '$keyJnsCardvcr'");
$hsumdetpayvcr = mysqli_fetch_array($sumdetpayvcr);
//mediavoucherloop
$strmvcr1=$hsumclosepayvcr['JnsCard'];
$strmvcr2=number_format($hsumdetpayvcr['qtybill']);
$strmvcr3=number_format($hsumdetpayvcr['sumpay']);
$headerstrmvcr1= str_pad($strmvcr1,24," ");
$headerstrmvcr2= str_pad($strmvcr2,4," ",STR_PAD_RIGHT);
$headerstrmvcr3= str_pad($strmvcr3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrmvcr1.$headerstrmvcr2.$headerstrmvcr3."\n");
//mediavoucherloop
}
/*sumcashsales*/
$sumcashsales=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CASH'");
$hsumcashsales = mysqli_fetch_array($sumcashsales);
/*sumcardsales*/
//TOTALCASH
$strtotcash1="TOTAL CASH";
$strtotcash2=number_format($hsumcashsales['sumcardbill']);
$strtotcash3=number_format($hsumcashsales['sumjumlah_bayar']);
$headerstrtotcash1= str_pad($strtotcash1,24," ");
$headerstrtotcash2= str_pad($strtotcash2,4," ",STR_PAD_RIGHT);
$headerstrtotcash3= str_pad($strtotcash3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrtotcash1.$headerstrtotcash2.$headerstrtotcash3."\n");
//TOTALCASH
/*sumcardsales*/
$sumcardsales=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CARD'");
$hsumcardsales = mysqli_fetch_array($sumcardsales);
/*sumcardsales*/
//TOTALCARD
$strtotcard1="TOTAL CARD";
$strtotcard2=number_format($hsumcardsales['sumcardbill']);
$strtotcard3=number_format($hsumcardsales['sumjumlah_bayar']);
$headerstrtotcard1= str_pad($strtotcard1,24," ");
$headerstrtotcard2= str_pad($strtotcard2,4," ",STR_PAD_RIGHT);
$headerstrtotcard3= str_pad($strtotcard3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrtotcard1.$headerstrtotcard2.$headerstrtotcard3."\n");
//TOTALCARD
/*sumvchsales*/
$sumvchsales=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'VOUCHER'");
$hsumvchsales = mysqli_fetch_array($sumvchsales);
/*sumcardsales*/
//TOTALVOUCHER
$strtotvrc1="TOTAL VOUCHER";
$strtotvrc2=number_format($hsumvchsales['sumcardbill']);
$strtotvrc3=number_format($hsumvchsales['sumjumlah_bayar']);
$headerstrtotvrc1= str_pad($strtotvrc1,24," ");
$headerstrtotvrc2= str_pad($strtotvrc2,4," ",STR_PAD_RIGHT);
$headerstrtotvrc3= str_pad($strtotvrc3,14," ",STR_PAD_LEFT);
$printer -> text($headerstrtotvrc1.$headerstrtotvrc2.$headerstrtotvrc3."\n");
//TOTALVOUCHER
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$voidreturntext= str_pad("VOID/REFUND SUMAMRY",42," ",STR_PAD_BOTH);
$printer -> text($voidreturntext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumrefund*/
$sumrefund=mysqli_query($koneksi,"SELECT sum(jumbill) as sumqtybill,sum(nett_sales) as sumpriceprevoid FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'REFUND'");
$hsumrefund = mysqli_fetch_array($sumrefund);
/*sumrefund*/
//TOTALREFUND
$strREFUND1="REFUND";
$strREFUND2=number_format($hsumrefund['sumqtybill']);
$strREFUND3=number_format($hsumrefund['sumpriceprevoid']);
$headerREFUND1= str_pad($strREFUND1,24," ");
$headerREFUND2= str_pad($strREFUND2,4," ",STR_PAD_RIGHT);
$headerREFUND3= str_pad($strREFUND3,14," ",STR_PAD_LEFT);
$printer -> text($headerREFUND1.$headerREFUND2.$headerREFUND3."\n");
//TOTALREFUND
/*sumpresendvoid*/
$sumpresendvoid=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyprevoid,sum(price) as sumpriceprevoid FROM item_void where terminal_id = '$idterminal' AND status_void = 'Before Send'");
$hsumpresendvoid = mysqli_fetch_array($sumpresendvoid);
/*sumpresendvoid*/
//TOTALPREVOID
$strPREVOID1="Pre-Send Void";
$strPREVOID2=number_format($hsumpresendvoid['sumqtyprevoid']);
$strPREVOID3=number_format($hsumpresendvoid['sumpriceprevoid']);
$headerPREVOID1= str_pad($strPREVOID1,24," ");
$headerPREVOID2= str_pad($strPREVOID2,4," ",STR_PAD_RIGHT);
$headerPREVOID3= str_pad($strPREVOID3,14," ",STR_PAD_LEFT);
$printer -> text($headerPREVOID1.$headerPREVOID2.$headerPREVOID3."\n");
//TOTALPREVOID
/*sumpostsendvoid*/
$sumpostsendvoid=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyprevoid,sum(price) as sumpriceprevoid FROM item_void where terminal_id = '$idterminal' AND status_void = 'After Send'");
$hsumpostsendvoid = mysqli_fetch_array($sumpostsendvoid);
/*sumpostsendvoid*/
//TOTALPOSTVOID
$strPOSTVOID1="Post-Send Void";
$strPOSTVOID2=number_format($hsumpostsendvoid['sumqtyprevoid']);
$strPOSTVOID3=number_format($hsumpostsendvoid['sumpriceprevoid']);
$headerPOSTVOID1= str_pad($strPOSTVOID1,24," ");
$headerPOSTVOID2= str_pad($strPOSTVOID2,4," ",STR_PAD_RIGHT);
$headerPOSTVOID3= str_pad($strPOSTVOID3,14," ",STR_PAD_LEFT);
$printer -> text($headerPOSTVOID1.$headerPOSTVOID2.$headerPOSTVOID3."\n");
//TOTALPOSTVOID
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumTotCollection*/
$sumTotCollection=mysqli_query($koneksi,"SELECT sum(bill) as sumbill, sum(jumlah_bayar) as sumjumbay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED'");
$hsumTotCollection = mysqli_fetch_array($sumTotCollection);
/*sumTotCollection*/
//TOTALCOLLECT
$strCOLLECT1="TotCollection";
$strCOLLECT2=number_format($hsumTotCollection['sumbill']);
$strCOLLECT3=number_format($hsumTotCollection['sumjumbay']);
$headerCOLLECT1= str_pad($strCOLLECT1,24," ");
$headerCOLLECT2= str_pad($strCOLLECT2,4," ",STR_PAD_RIGHT);
$headerCOLLECT3= str_pad($strCOLLECT3,14," ",STR_PAD_LEFT);
$printer -> text($headerCOLLECT1.$headerCOLLECT2.$headerCOLLECT3."\n");
//TOTALCOLLECT
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$svctext= str_pad("SERVICE CHARGE",42," ",STR_PAD_BOTH);
$printer -> text($svctext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumtax*/
$sumtax=mysqli_query($koneksi,"SELECT sum(tax) as sumtax, sum(gross_sales) as sumbeforetax, sum(disc) as sumdiscsales, sum(service_charge) as totalsurcharge FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumtax = mysqli_fetch_array($sumtax);
$servicech=$hsumtax['totalsurcharge'];
$tax=$hsumtax['sumtax'];
$aftertax=$hsumtax['sumbeforetax']-$hsumtax['sumdiscsales'];
/*sumtax*/
//SERVICECHARGE
$strsvch1="Service Charge 5%";
$strsvch2=number_format($servicech);
$headersvch1= str_pad($strsvch1,28," ");
$headersvch2= str_pad($strsvch2,14," ",STR_PAD_LEFT);
$printer -> text($headersvch1.$headersvch2."\n");
//SERVICECHARGE
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$taxtext= str_pad("TAX",42," ",STR_PAD_BOTH);
$printer -> text($taxtext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//tax10
$strtax101="Tax 10%";
$strtax102=number_format($tax);
$headertax101= str_pad($strtax101,28," ");
$headertax102= str_pad($strtax102,14," ",STR_PAD_LEFT);
$printer -> text($headertax101.$headertax102."\n");
//tax10
//nettsls
$strnettsls1="Nett Sales";
$strnettsls2=number_format($aftertax);
$headernettsls1= str_pad($strnettsls1,28," ");
$headernettsls2= str_pad($strnettsls2,14," ",STR_PAD_LEFT);
$printer -> text($headernettsls1.$headernettsls2."\n");
//nettsls
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumbillspending*/
$sumbillspending=mysqli_query($koneksi,"SELECT sum(jumbill) as sumopenbill, sum(gross_sales) as sumgrossopenbill, sum(disc) as sumdiscopenbill FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'OPEN'");
$hsumbillspending = mysqli_fetch_array($sumbillspending);
$totalopenbill=$hsumbillspending['sumgrossopenbill']+$hsumbillspending['sumdiscopenbill'];
/*sumbillspending*/
//billpen
$strbillpen1="Bills Pending";
$strbillpen2=number_format($hsumbillspending['sumopenbill']);
$strbillpen3=number_format($totalopenbill);
$headerbillpen1= str_pad($strbillpen1,24," ");
$headerbillpen2= str_pad($strbillpen2,4," ",STR_PAD_RIGHT);
$headerbillpen3= str_pad($strbillpen3,14," ",STR_PAD_LEFT);
$printer -> text($headerbillpen1.$headerbillpen2.$headerbillpen3."\n");
//billpen
/*sumclosebill*/
$sumclosebill=mysqli_query($koneksi,"SELECT sum(jumbill) as sumclosebill FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumclosebill = mysqli_fetch_array($sumclosebill);
/*sumclosebill*/
//countbill
$strcountbill1="Total # of Bills";
$strcountbill2=number_format($hsumclosebill['sumclosebill']);
$headercountbill1= str_pad($strcountbill1,28," ");
$headercountbill2= str_pad($strcountbill2,14," ",STR_PAD_LEFT);
$printer -> text($headercountbill1.$headercountbill2."\n");
//countbill
/*sumavgbill*/
$sumavgbill=mysqli_query($koneksi,"SELECT sum(jumbill) as sumclosebill, sum(nett_sales) as sumnett_sales FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumavgbill = mysqli_fetch_array($sumavgbill);
$xavgperbill=$hsumavgbill['sumnett_sales']/$hsumavgbill['sumclosebill'];
$avgperbill=ceil($xavgperbill);
/*sumavgbill*/
//avgbill
$stravgbill1="Avg Bills";
$stravgbill2=number_format($avgperbill);
$headeravgbill1= str_pad($stravgbill1,28," ");
$headeravgbill2= str_pad($stravgbill2,14," ",STR_PAD_LEFT);
$printer -> text($headeravgbill1.$headeravgbill2."\n");
//avgbill
/*sumcoverbill*/
$sumcoverbill=mysqli_query($koneksi,"SELECT sum(custqty) as sumcustqty, sum(nett_sales) as sumnett_sales FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumcoverbill = mysqli_fetch_array($sumcoverbill);
$xavgcustperbill=$hsumcoverbill['sumnett_sales']/$hsumcoverbill['sumcustqty'];
$avgcustperbill=ceil($xavgcustperbill);
/*sumcoverbill*/
//countcust
$strcountcust1="Total # of Covers";
$strcountcust2=number_format($hsumcoverbill['sumcustqty']);
$headercountcust1= str_pad($strcountcust1,28," ");
$headercountcust2= str_pad($strcountcust2,14," ",STR_PAD_LEFT);
$printer -> text($headercountcust1.$headercountcust2."\n");
//countcust
//avgcust
$stravgcust1="Avg Covers";
$stravgcust2=number_format($avgcustperbill);
$headeravgcust1= str_pad($stravgcust1,28," ");
$headeravgcust2= str_pad($stravgcust2,14," ",STR_PAD_LEFT);
$printer -> text($headeravgcust1.$headeravgcust2."\n");
//avgcust
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$bgnbill=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where terminal_id = '$idterminal' AND status != 'CANCELED' AND status != 'OPEN' order by bill_number ASC LIMIT 1");
$hbgnbill = mysqli_fetch_array($bgnbill);
$strbgnrcpt1="Begin Receipt#";
$strbgnrcpt2=$hbgnbill['bill_number'];
$headerbgnrcpt1= str_pad($strbgnrcpt1,21," ");
$headerbgnrcpt2= str_pad($strbgnrcpt2,21," ",STR_PAD_LEFT);
$printer -> text($headerbgnrcpt1.$headerbgnrcpt2."\n");
$endbill=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where terminal_id = '$idterminal' AND status != 'CANCELED' AND status != 'OPEN' order by bill_number DESC LIMIT 1");
$hendbill = mysqli_fetch_array($endbill);
$strendrcpt1="End Receipt#";
$strendrcpt2=$hendbill['bill_number'];
$headerendrcpt1= str_pad($strendrcpt1,21," ");
$headerendrcpt2= str_pad($strendrcpt2,21," ",STR_PAD_LEFT);
$printer -> text($headerendrcpt1.$headerendrcpt2."\n");

$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$groupslstext= str_pad("GROUP SALES",42," ",STR_PAD_BOTH);
$printer -> text($groupslstext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumbevsales*/
$sumbevsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp where kdcategory = '191002' AND terminal_id = '$idterminal' AND paidstatus = 'PAID'");
$hsumbevsales = mysqli_fetch_array($sumbevsales);
/*sumbevsales*/
//bevsls
$strbevsls1="BEVERAGES";
$strbevsls2=number_format($hsumbevsales['sumbevqty']);
$strbevsls3=number_format($hsumbevsales['sumbevprice']);
$headerbevsls1= str_pad($strbevsls1,24," ");
$headerbevsls2= str_pad($strbevsls2,4," ",STR_PAD_RIGHT);
$headerbevsls3= str_pad($strbevsls3,14," ",STR_PAD_LEFT);
$printer -> text($headerbevsls1.$headerbevsls2.$headerbevsls3."\n");
//bevsls
/*sumfoodsales*/
$sumfoodsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp where kdcategory = '191001' AND terminal_id = '$idterminal' AND paidstatus = 'PAID'");
$hsumfoodsales = mysqli_fetch_array($sumfoodsales);
/*sumfoodsales*/
//fodsls
$strfodsls1="FOOD";
$strfodsls2=number_format($hsumfoodsales['sumbevqty']);
$strfodsls3=number_format($hsumfoodsales['sumbevprice']);
$headerfodsls1= str_pad($strfodsls1,24," ");
$headerfodsls2= str_pad($strfodsls2,4," ",STR_PAD_RIGHT);
$headerfodsls3= str_pad($strfodsls3,14," ",STR_PAD_LEFT);
$printer -> text($headerfodsls1.$headerfodsls2.$headerfodsls3."\n");
//fodsls
/*sumfnbsales*/
$sumfnbsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp WHERE terminal_id = '$idterminal' AND paidstatus = 'PAID'");
$hsumfnbsales = mysqli_fetch_array($sumfnbsales);
/*sumfnbsales*/
//fnbsls
$strfnbsls1="TOTAL GROUP";
$strfnbsls2=number_format($hsumfnbsales['sumbevqty']);
$strfnbsls3=number_format($hsumfnbsales['sumbevprice']);
$headerfnbsls1= str_pad($strfnbsls1,24," ");
$headerfnbsls2= str_pad($strfnbsls2,4," ",STR_PAD_RIGHT);
$headerfnbsls3= str_pad($strfnbsls3,14," ",STR_PAD_LEFT);
$printer -> text($headerfnbsls1.$headerfnbsls2.$headerfnbsls3."\n");
//fnbsls
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$focgrouptext= str_pad("GROUP FOC",42," ",STR_PAD_BOTH);
$printer -> text($focgrouptext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");

//bevfoc
$strbevfoc1="BEVERAGES";
$strbevfoc2="0";
$strbevfoc3="0";
$headerbevfoc1= str_pad($strbevfoc1,24," ");
$headerbevfoc2= str_pad($strbevfoc2,4," ",STR_PAD_RIGHT);
$headerbevfoc3= str_pad($strbevfoc3,14," ",STR_PAD_LEFT);
$printer -> text($headerbevfoc1.$headerbevfoc2.$headerbevfoc3."\n");
//bevfoc

//fodfoc
$strfodfoc1="FOOD";
$strfodfoc2="QTY";
$strfodfoc3="AMOUNT";
$headerfodfoc1= str_pad($strfodfoc1,24," ");
$headerfodfoc2= str_pad($strfodfoc2,4," ",STR_PAD_RIGHT);
$headerfodfoc3= str_pad($strfodfoc3,14," ",STR_PAD_LEFT);
$printer -> text($headerfodfoc1.$headerfodfoc2.$headerfodfoc3."\n");
//fodfoc
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$salescattext= str_pad("SALES CATEGORY",42," ",STR_PAD_BOTH);
$printer -> text($salescattext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumdinein*/
$sumdinein=mysqli_query($koneksi,"SELECT sum(jumbill) as sumdineinqty, sum(gross_sales) as sumdineingross FROM pos_salestemp WHERE terminal_id = '$idterminal' AND status = 'CLOSED' AND meja != 'takeaway' ");
$hsumdinein = mysqli_fetch_array($sumdinein);
/*sumdinein*/
//dinein
$strdinein1="DINE IN";
$strdinein2=number_format($hsumdinein['sumdineinqty']);
$strdinein3=number_format($hsumdinein['sumdineingross']);
$headerdinein1= str_pad($strdinein1,24," ");
$headerdinein2= str_pad($strdinein2,4," ",STR_PAD_RIGHT);
$headerdinein3= str_pad($strdinein3,14," ",STR_PAD_LEFT);
$printer -> text($headerdinein1.$headerdinein2.$headerdinein3."\n");
//dinein
/*sumtakeaway*/
$sumtakeaway=mysqli_query($koneksi,"SELECT sum(jumbill) as sumtakeawayqty, sum(gross_sales) as sumtakeawaygross FROM pos_salestemp WHERE terminal_id = '$idterminal' AND status = 'CLOSED' AND meja = 'takeaway' ");
$hsumtakeaway = mysqli_fetch_array($sumtakeaway);
/*sumtakeaway*/
//takeaway
$strtakeaway1="TAKE AWAY";
$strtakeaway2=number_format($hsumtakeaway['sumtakeawayqty']);
$strtakeaway3=number_format($hsumtakeaway['sumtakeawaygross']);
$headertakeaway1= str_pad($strtakeaway1,24," ");
$headertakeaway2= str_pad($strtakeaway2,4," ",STR_PAD_RIGHT);
$headertakeaway3= str_pad($strtakeaway3,14," ",STR_PAD_LEFT);
$printer -> text($headertakeaway1.$headertakeaway2.$headertakeaway3."\n");
//takeaway
/*sumtotctgry*/
$sumtotctgry=mysqli_query($koneksi,"SELECT sum(jumbill) as sumtotctgryqty, sum(gross_sales) as sumtotctgrygross FROM pos_salestemp WHERE terminal_id = '$idterminal' AND status = 'CLOSED'");
$hsumtotctgry = mysqli_fetch_array($sumtotctgry);
/*sumtotctgry*/
//totslscat
$strtotslscat1="TOTAL SALES CATEGORY";
$strtotslscat2=number_format($hsumtotctgry['sumtotctgryqty']);
$strtotslscat3=number_format($hsumtotctgry['sumtotctgrygross']);
$headertotslscat1= str_pad($strtotslscat1,24," ");
$headertotslscat2= str_pad($strtotslscat2,4," ",STR_PAD_RIGHT);
$headertotslscat3= str_pad($strtotslscat3,14," ",STR_PAD_LEFT);
$printer -> text($headertotslscat1.$headertotslscat2.$headertotslscat3."\n");
//totslscat
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$discprmtext= str_pad("DISCOUNT/PROMOTION",42," ",STR_PAD_BOTH);
$printer -> text($discprmtext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*discitemdet*/
$discitemdet=mysqli_query($koneksi,"SELECT id_promotion,sum(qty) as sumqtyitemdisc, sum(disc) as sumdiscitem FROM pos_promotion_d where terminal_id = '$idterminal' and promotion_type = 'DISC ITEM' and paid_status = 'PAID' group by id_promotion");
while($hdiscitemdet = mysqli_fetch_array($discitemdet))
{
$discitemket=mysqli_query($koneksi,"SELECT * FROM promotion_h WHERE id_promotion = '$hdiscitemdet[id_promotion]'");
$hdiscitemket = mysqli_fetch_array($discitemket);
/*sumdiscitem*/
//itmdscloop
$stritmdscloop1=$hdiscitemket['promotion_name'];
$stritmdscloop2=number_format($hdiscitemdet['sumqtyitemdisc']);
$stritmdscloop3=number_format($hdiscitemdet['sumdiscitem']);
$headeritmdscloop1= str_pad($stritmdscloop1,24," ");
$headeritmdscloop2= str_pad($stritmdscloop2,4," ",STR_PAD_RIGHT);
$headeritmdscloop3= str_pad($stritmdscloop3,14," ",STR_PAD_LEFT);
$printer -> text($headeritmdscloop1.$headeritmdscloop2.$headeritmdscloop3."\n");
//itmdscloop
}
/*sumdiscitem*/
$sumitemdisc=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyitemdisc, sum(disc) as sumdiscitem, id_promotion FROM pos_promotion_d where terminal_id = '$idterminal' and promotion_type = 'DISC ITEM' and paid_status = 'PAID'");
$hsumitemdisc = mysqli_fetch_array($sumitemdisc);
/*sumdiscitem*/
//totitmdsc
$strtotitmdsc1="TOTAL ItemDiscount";
$strtotitmdsc2=number_format($hsumitemdisc['sumqtyitemdisc']);
$strtotitmdsc3=number_format($hsumitemdisc['sumdiscitem']);
$headertotitmdsc1= str_pad($strtotitmdsc1,24," ");
$headertotitmdsc2= str_pad($strtotitmdsc2,4," ",STR_PAD_RIGHT);
$headertotitmdsc3= str_pad($strtotitmdsc3,14," ",STR_PAD_LEFT);
$printer -> text($headertotitmdsc1.$headertotitmdsc2.$headertotitmdsc3."\n");
//totitmdsc
/*discbilldet*/
$discbilldet=mysqli_query($koneksi,"SELECT sum(bill) as sumbilldisc, sum(disc) as sumdiscbill, disc_desk FROM pos_promotion_h where terminal_id = '$idterminal' and promotion_type = 'DISC ALL' and paid_status = 'PAID' group by id_promotion");
while($hdiscbilldet = mysqli_fetch_array($discbilldet))
{
/*discbilldet*/
//bildscloop
$strbildscloop1=$hdiscbilldet['disc_desk'];
$strbildscloop2=number_format($hdiscbilldet['sumbilldisc']);
$strbildscloop3=number_format($hdiscbilldet['sumdiscbill']);
$headerbildscloop1= str_pad($strbildscloop1,24," ");
$headerbildscloop2= str_pad($strbildscloop2,4," ",STR_PAD_RIGHT);
$headerbildscloop3= str_pad($strbildscloop3,14," ",STR_PAD_LEFT);
$printer -> text($headerbildscloop1.$headerbildscloop2.$headerbildscloop3."\n");
//bildscloop
}
/*sumbilldisc*/
$sumbilldisc=mysqli_query($koneksi,"SELECT sum(bill) as sumqtybill, sum(disc) as sumdiscbill FROM pos_promotion_h where terminal_id = '$idterminal' and promotion_type = 'DISC ALL' and paid_status = 'PAID'");
$hsumbilldisc = mysqli_fetch_array($sumbilldisc);
/*sumbilldisc*/
//totbildsc
$strtotbildsc1="TOTAL BillDiscount";
$strtotbildsc2=number_format($hsumbilldisc['sumqtybill']);
$strtotbildsc3=number_format($hsumbilldisc['sumdiscbill']);
$headertotbildsc1= str_pad($strtotbildsc1,24," ");
$headertotbildsc2= str_pad($strtotbildsc2,4," ",STR_PAD_RIGHT);
$headertotbildsc3= str_pad($strtotbildsc3,14," ",STR_PAD_LEFT);
$printer -> text($headertotbildsc1.$headertotbildsc2.$headertotbildsc3."\n");
//totbildsc
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$fipotext= str_pad("FIPO",42," ",STR_PAD_BOTH);
$printer -> text($fipotext."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
/*sumsalescash*/
$sumsalescash=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CASH' AND JnsCard = 'CASH'");
$hsumsalescash = mysqli_fetch_array($sumsalescash);
/*sumsalescash*/
//estcash
$strestcash1="SALES CASH";
$strestcash2="(+)";
$strestcash3=number_format($hsumsalescash['sumcardbill']);
$strestcash4=number_format($hsumsalescash['sumjumlah_bayar']);
$headerestcash1= str_pad($strestcash1,20," ");
$headerestcash2= str_pad($strestcash2,4," ",STR_PAD_RIGHT);
$headerestcash3= str_pad($strestcash3,4," ",STR_PAD_RIGHT);
$headerestcash4= str_pad($strestcash4,14," ",STR_PAD_LEFT);
$printer -> text($headerestcash1.$headerestcash2.$headerestcash3.$headerestcash4."\n");
//estcash
/*modalcash*/
$modalcash=mysqli_query($koneksi,"SELECT * FROM terminal_parameter where terminal_id = '$idterminal'");
$hmodalcash = mysqli_fetch_array($modalcash);
$totalcashindrawer=$hsumsalescash['sumjumlah_bayar']+$hmodalcash['modal'];
/*modalcash*/
//cashindrw
$strcashindrw1="CASH IN DRAWER";
$strcashindrw2="(=)";
$strcashindrw3=number_format($totalcashindrawer);
$headercashindrw1= str_pad($strcashindrw1,20," ");
$headercashindrw2= str_pad($strcashindrw2,4," ",STR_PAD_RIGHT);
$headercashindrw3= str_pad($strcashindrw3,18," ",STR_PAD_LEFT);
$printer -> text($headercashindrw1.$headercashindrw2.$headercashindrw3."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$terminaldatefromto=$hmodalcash['openterminal']." TO ".$hmodalcash['closeterminal'];
$hterminaldatefromto= str_pad($terminaldatefromto,20," ");
$printer -> text($hterminaldatefromto."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//cashindrw
$printer -> feed();
/* Footer */

/* Cut the receipt and open the cash drawer */
$printer -> cut();

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($logo);
$printer -> feed();

$printer -> selectPrintMode();

/* Title of receipt */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> setFont(Printer::FONT_B);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> setTextSize(1, 1);
$printer -> selectPrintMode();
$printer -> setEmphasis(false);
$printer -> text("ISOIDE\n");
$printer -> text("PLAZA ATRIUM,SENEN\n");
$printer -> text("PLU SALES REPORT\n");
$strplu1="OP:".$hceknamauser['nama_user'];
$strplu2=$nowdate;
$headerplu1= str_pad($strplu1,21," ");
$headerplu2= str_pad($strplu2,21," ",STR_PAD_LEFT);
$printer -> text($headerplu1.$headerplu2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$strplu3="PLUName";
$strplu4="Qty";
$headerplu3= str_pad($strplu3,32," ");
$headerplu4= str_pad($strplu4,10," ",STR_PAD_LEFT);
$printer -> text($headerplu3.$headerplu4."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");

$strplu5="Group:BEVERAGES";
$headerplu5= str_pad($strplu5,42," ");
$printer -> text($headerplu5."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgs=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191002' group by kdsubcategory");
while($hloopbvrgs = mysqli_fetch_array($loopbvrgs))
{
$detbvgdept=mysqli_query($koneksi,"SELECT * FROM pos_subcategory where kdsubcategory = '$hloopbvrgs[kdsubcategory]'");
$hdetbvgdept = mysqli_fetch_array($detbvgdept);
$sumdetbvgdept=mysqli_query($koneksi,"SELECT sum(qty) as qtydept FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kdsubcategory = '$hdetbvgdept[kdsubcategory]'");
$hsumdetbvgdept = mysqli_fetch_array($sumdetbvgdept);
//deptloop
$strbvrdeplop="Dept:".$hdetbvgdept['nmsubcategory'];;
$headerbvrdeplop= str_pad($strbvrdeplop,42," ");
$printer -> text($headerbvrdeplop."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgsdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdsubcategory = '$hdetbvgdept[kdsubcategory]' group by kditem");
while($hloopbvrgsdeptitem = mysqli_fetch_array($loopbvrgsdeptitem))
{
$detbvgdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$hloopbvrgsdeptitem[kditem]'");
$hdetbvgdeptitem = mysqli_fetch_array($detbvgdeptitem);
$sumdetbvgdeptitem=mysqli_query($koneksi,"SELECT sum(qty) as qtydeptitem FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kditem = '$hdetbvgdeptitem[kditem]'");
$hsumdetbvgdeptitem = mysqli_fetch_array($sumdetbvgdeptitem);
//deptitemloop
$strdeptitem1=$hdetbvgdeptitem['nmitem'];
$strdeptitem2=$hsumdetbvgdeptitem['qtydeptitem'];
$headerdeptitem1= str_pad($strdeptitem1,32," ");
$headerdeptitem2= str_pad($strdeptitem2,10," ",STR_PAD_LEFT);
$printer -> text($headerdeptitem1.$headerdeptitem2."\n");
//deptitemloop
}
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$strtotdept1=$hdetbvgdept['nmsubcategory'];
$strtotdept2=$hsumdetbvgdept['qtydept'];
$headertotdept1= str_pad($strtotdept1,32," ");
$headertotdept2= str_pad($strtotdept2,10," ",STR_PAD_LEFT);
$printer -> text($headertotdept1.$headertotdept2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//deptloop
}
$sumbeverages=mysqli_query($koneksi,"SELECT sum(qty) as qtybeverages FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191002'");
$hsumbeverages= mysqli_fetch_array($sumbeverages);
$strtotgroup1="Group:BEVERAGES";
$strtotgroup2=$hsumbeverages['qtybeverages'];
$headertotgroup1= str_pad($strtotgroup1,32," ");
$headertotgroup2= str_pad($strtotgroup2,10," ",STR_PAD_LEFT);
$printer -> text($headertotgroup1.$headertotgroup2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");

$strplu5="Group:FOOD";
$headerplu5= str_pad($strplu5,42," ");
$printer -> text($headerplu5."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgs=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191001' group by kdsubcategory");
while($hloopbvrgs = mysqli_fetch_array($loopbvrgs))
{
$detbvgdept=mysqli_query($koneksi,"SELECT * FROM pos_subcategory where kdsubcategory = '$hloopbvrgs[kdsubcategory]'");
$hdetbvgdept = mysqli_fetch_array($detbvgdept);
$sumdetbvgdept=mysqli_query($koneksi,"SELECT sum(qty) as qtydept FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kdsubcategory = '$hdetbvgdept[kdsubcategory]'");
$hsumdetbvgdept = mysqli_fetch_array($sumdetbvgdept);
//deptloop
$strbvrdeplop="Dept:".$hdetbvgdept['nmsubcategory'];;
$headerbvrdeplop= str_pad($strbvrdeplop,42," ");
$printer -> text($headerbvrdeplop."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgsdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdsubcategory = '$hdetbvgdept[kdsubcategory]' group by kditem");
while($hloopbvrgsdeptitem = mysqli_fetch_array($loopbvrgsdeptitem))
{
$detbvgdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$hloopbvrgsdeptitem[kditem]'");
$hdetbvgdeptitem = mysqli_fetch_array($detbvgdeptitem);
$sumdetbvgdeptitem=mysqli_query($koneksi,"SELECT sum(qty) as qtydeptitem FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kditem = '$hdetbvgdeptitem[kditem]'");
$hsumdetbvgdeptitem = mysqli_fetch_array($sumdetbvgdeptitem);
//deptitemloop
$strdeptitem1=$hdetbvgdeptitem['nmitem'];
$strdeptitem2=$hsumdetbvgdeptitem['qtydeptitem'];
$headerdeptitem1= str_pad($strdeptitem1,32," ");
$headerdeptitem2= str_pad($strdeptitem2,10," ",STR_PAD_LEFT);
$printer -> text($headerdeptitem1.$headerdeptitem2."\n");
//deptitemloop
}
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$strtotdept1=$hdetbvgdept['nmsubcategory'];
$strtotdept2=$hsumdetbvgdept['qtydept'];
$headertotdept1= str_pad($strtotdept1,32," ");
$headertotdept2= str_pad($strtotdept2,10," ",STR_PAD_LEFT);
$printer -> text($headertotdept1.$headertotdept2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//deptloop
}
$sumbeverages=mysqli_query($koneksi,"SELECT sum(qty) as qtybeverages FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191001'");
$hsumbeverages= mysqli_fetch_array($sumbeverages);
$strtotgroup1="Group:FOOD";
$strtotgroup2=$hsumbeverages['qtybeverages'];
$headertotgroup1= str_pad($strtotgroup1,32," ");
$headertotgroup2= str_pad($strtotgroup2,10," ",STR_PAD_LEFT);
$printer -> text($headertotgroup1.$headertotgroup2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");

$strplu5="Group:FREE ITEM";
$headerplu5= str_pad($strplu5,42," ");
$printer -> text($headerplu5."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgs=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191003' group by kdsubcategory");
while($hloopbvrgs = mysqli_fetch_array($loopbvrgs))
{
$detbvgdept=mysqli_query($koneksi,"SELECT * FROM pos_subcategory where kdsubcategory = '$hloopbvrgs[kdsubcategory]'");
$hdetbvgdept = mysqli_fetch_array($detbvgdept);
$sumdetbvgdept=mysqli_query($koneksi,"SELECT sum(qty) as qtydept FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kdsubcategory = '$hdetbvgdept[kdsubcategory]'");
$hsumdetbvgdept = mysqli_fetch_array($sumdetbvgdept);
//deptloop
$strbvrdeplop="Dept:".$hdetbvgdept['nmsubcategory'];;
$headerbvrdeplop= str_pad($strbvrdeplop,42," ");
$printer -> text($headerbvrdeplop."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$loopbvrgsdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdsubcategory = '$hdetbvgdept[kdsubcategory]' group by kditem");
while($hloopbvrgsdeptitem = mysqli_fetch_array($loopbvrgsdeptitem))
{
$detbvgdeptitem=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$hloopbvrgsdeptitem[kditem]'");
$hdetbvgdeptitem = mysqli_fetch_array($detbvgdeptitem);
$sumdetbvgdeptitem=mysqli_query($koneksi,"SELECT sum(qty) as qtydeptitem FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' AND kditem = '$hdetbvgdeptitem[kditem]'");
$hsumdetbvgdeptitem = mysqli_fetch_array($sumdetbvgdeptitem);
//deptitemloop
$strdeptitem1=$hdetbvgdeptitem['nmitem'];
$strdeptitem2=$hsumdetbvgdeptitem['qtydeptitem'];
$headerdeptitem1= str_pad($strdeptitem1,32," ");
$headerdeptitem2= str_pad($strdeptitem2,10," ",STR_PAD_LEFT);
$printer -> text($headerdeptitem1.$headerdeptitem2."\n");
//deptitemloop
}
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$strtotdept1=$hdetbvgdept['nmsubcategory'];
$strtotdept2=$hsumdetbvgdept['qtydept'];
$headertotdept1= str_pad($strtotdept1,32," ");
$headertotdept2= str_pad($strtotdept2,10," ",STR_PAD_LEFT);
$printer -> text($headertotdept1.$headertotdept2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
//deptloop
}
$sumbeverages=mysqli_query($koneksi,"SELECT sum(qty) as qtybeverages FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' and kdcategory = '191003'");
$hsumbeverages= mysqli_fetch_array($sumbeverages);
$strtotgroup1="Group:FREE ITEM";
$strtotgroup2=$hsumbeverages['qtybeverages'];
$headertotgroup1= str_pad($strtotgroup1,32," ");
$headertotgroup2= str_pad($strtotgroup2,10," ",STR_PAD_LEFT);
$printer -> text($headertotgroup1.$headertotgroup2."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");

$sumallplu=mysqli_query($koneksi,"SELECT sum(qty) as qtyallplu FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID' ");
$hsumallplu= mysqli_fetch_array($sumallplu);
$strtotall1="Total";
$strtotall2=$hsumallplu['qtyallplu'];
$headertotall1= str_pad($strtotall1,32," ");
$headertotall2= str_pad($strtotall2,10," ",STR_PAD_LEFT);
$printer -> text($headertotall1.$headertotall2."\n");
/*modalcash*/
$modalcash=mysqli_query($koneksi,"SELECT * FROM terminal_parameter where terminal_id = '$idterminal'");
$hmodalcash = mysqli_fetch_array($modalcash);
$totalcashindrawer=$hsumsalescash['sumjumlah_bayar']+$hmodalcash['modal'];
/*modalcash*/
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$terminaldatefromto=$hmodalcash['openterminal']." TO ".$hmodalcash['closeterminal'];
$hterminaldatefromto= str_pad($terminaldatefromto,20," ");
$printer -> text($hterminaldatefromto."\n");
$separator= str_pad("-",42,"-");
$printer -> text($separator."\n");
$printer -> feed();
/* Footer */

/* Cut the receipt and open the cash drawer */
$printer -> cut();

$printer -> close();

//echo "<script>location='dump.php?terminal=$idterminal'</script>";
ob_flush();
?>
