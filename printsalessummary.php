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
.mediacetak { 
    display: none;
    }
@media print {
    .mediacetak { 
        display: block;
        }
}
</style>
</head>
<!--
border-width: 1vh;border-style: solid;border-color: #000;
-->
<body onkeypress='return false' onload="doPrint()" style="font-size: 5vh;">
<?php
$terminalcek = "SELECT * FROM terminal_parameter WHERE openterminal = '' OR closeterminal ='' ";
$resultterminalcek = mysqli_query($koneksi,$terminalcek) or die (mysqli_error());
$rresultterminalcek= mysqli_num_rows($resultterminalcek);
$hresultterminalcek= mysqli_fetch_array($resultterminalcek);
if(empty($rresultterminalcek)){?>
<div class="row mh2 justify-content-md-center tepian" style="background-color: rgba(0, 0, 0, 0.2);">
    <div class="col-md-12" style="padding: 20vh;text-align: center;">
    <a><img src="logo.png" alt="Responsive image" width="20%"></a><br>
    <a href="bukaposkasir.php?iduser=<?php echo $usrpay;?>" class="btn btn-nahm">BUKA POS KASIR</a>
    </div>
</div>
<?php }
else{ $idterminal=$hresultterminalcek['terminal_id'];?>
<div class="mediacetak">
<div class="container-fluid" style="background-color: #ffffff;color: #000;font-size: 0.7em;font-weight: bold;">
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 5px;margin-bottom: 5px;">
            NAHM THAI SUKI & BBQ</br>
            NAHM TEST
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 5px;margin-bottom: 5px;">
            SALES SUMMARY
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <p style="margin-top: 5px;margin-bottom: 1px;text-align: left;">
            OP : <?php echo $nmusrpos;?>
            </p>
        </div>
        <div class="col-6">
            <p style="margin-top: 5px;margin-bottom: 1px;text-align: right;">
            Group : All POS
            </p>
        </div>
        <div class="col-6">
            <p style="margin-top: 1px;margin-bottom: 5px;text-align: left;">
            ReportNo : 
            </p>
        </div>
        <div class="col-6">
            <p style="margin-top: 1px;margin-bottom: 5px;text-align: right;">
            <?php $tglslssum=date("d M Y", $tanggal); echo $tglslssum." ".$jam; ?> 
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <p style="margin-top: 2px;margin-bottom: 2px;text-align: left;">
            TYPE
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 2px;margin-bottom: 2px;text-align: right;">
            QTY 
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 2px;margin-bottom: 2px;text-align: right;">
            AMOUNT
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
    <?php
    /*sumitemsales*/
    $sumitemsales=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyitem, sum(price) as sumpriceitem FROM pos_itemtemp where terminal_id = '$idterminal' and paidstatus = 'PAID'");
    $hsumitemsales = mysqli_fetch_array($sumitemsales);
    /*sumitemsales*/
    ?>
        <div class="col-5">
            <p style="margin-top: 4px;margin-bottom: 1px;text-align: left;">
            ItemSales
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 4px;margin-bottom: 1px;text-align: center;">
            (+)
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 4px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumitemsales['sumqtyitem']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 4px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumitemsales['sumpriceitem']);?>
            </p>
        </div>
    </div>
    <div class="row">
    <?php
    /*sumdiscitem*/
    $sumitemdisc=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyitemdisc, sum(disc) as sumdiscitem FROM pos_promotion_d where terminal_id = '$idterminal' and promotion_type = 'DISC ITEM' and paid_status = 'PAID'");
    $hsumitemdisc = mysqli_fetch_array($sumitemdisc);
    /*sumdiscitem*/
    ?>
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            ItemDiscount
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            (-)
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumitemdisc['sumqtyitemdisc']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumitemdisc['sumdiscitem']);?>
            </p>
        </div>
    </div>
    <div class="row">
    <?php
    /*sumbilldisc*/
    $sumbilldisc=mysqli_query($koneksi,"SELECT sum(bill) as sumqtybill, sum(disc) as sumdiscbill FROM pos_promotion_h where terminal_id = '$idterminal' and promotion_type = 'DISC ALL' and paid_status = 'PAID'");
    $hsumbilldisc = mysqli_fetch_array($sumbilldisc);
    /*sumbilldisc*/
    ?>
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            BillDiscount
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            (-)
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumbilldisc['sumqtybill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumbilldisc['sumdiscbill']);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            FOC Items
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            (-)
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            0
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            0
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 4px;text-align: left;">
            FOC Bill
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 4px;text-align: center;">
            (-)
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 4px;text-align: right;">
            0
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 4px;text-align: right;">
            0
            </p>
        </div>
    </div>
    <?php
    /*sumclosesales*/
    $sumclosesales=mysqli_query($koneksi,"SELECT sum(gross_sales) as sumgrosssales, sum(disc) as sumsalesdisc FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
    $hsumclosesales = mysqli_fetch_array($sumclosesales);
    $grandtotalsumclosesales=$hsumclosesales['sumgrosssales']-$hsumclosesales['sumsalesdisc'];
    /*sumclosesales*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Total Sales
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            (=)
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($grandtotalsumclosesales);?>
            </p>
        </div>
    </div>
    <div class="row">
    <?php
    /*sumestimatedsales*/
    $sumestimatedsales=mysqli_query($koneksi,"SELECT sum(gross_sales) as sumgrosssales, sum(disc) as sumsalesdisc FROM pos_salestemp where terminal_id = '$idterminal' AND status != 'CANCELED' AND status != 'REFUND'");
    $hsumestimatedsales = mysqli_fetch_array($sumestimatedsales);
    $grandtotalsumestimatedsales=$hsumestimatedsales['sumgrosssales']-$hsumestimatedsales['sumsalesdisc'];
    /*sumestimatedsales*/
    ?>
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Estimated Sales
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($grandtotalsumestimatedsales);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            MEDIA
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <?php
    /*sumclosepay*/
    $sumclosepaycash=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CASH' group by JnsCard");
    /*sumclosepay*/
    while($hsumclosepaycash = mysqli_fetch_array($sumclosepaycash))
    {
        $keyJnsCardcash=$hsumclosepaycash['JnsCard'];
        $sumdetpaycash=mysqli_query($koneksi,"SELECT sum(bill) as qtybill, sum(jumlah_bayar) as sumpay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsCard = '$keyJnsCardcash'");
        $hsumdetpaycash = mysqli_fetch_array($sumdetpaycash);
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            <?php echo $hsumclosepaycash['JnsCard'];?>
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumdetpaycash['qtybill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumdetpaycash['sumpay']);?>
            </p>
        </div>
    </div>
    <?php
    }
    ?>
    <?php
    /*sumclosepay*/
    $sumclosepaycard=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CARD' group by JnsCard");
    /*sumclosepay*/
    while($hsumclosepaycard = mysqli_fetch_array($sumclosepaycard))
    {
        $keyJnsCardcard =$hsumclosepaycard['JnsCard'];
        $sumdetpaycard=mysqli_query($koneksi,"SELECT sum(bill) as qtybill, sum(jumlah) as sumpay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsCard = '$keyJnsCardcard'");
        $hsumdetpaycard = mysqli_fetch_array($sumdetpaycard);
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            <?php echo $hsumclosepaycard['JnsCard'];?>
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumdetpaycard['qtybill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumdetpaycard['sumpay']);?>
            </p>
        </div>
    </div>
    <?php
    }
    ?>
    <?php
    /*sumclosepay*/
    $sumclosepayvcr=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'VOUCHER' group by JnsCard");
    /*sumclosepay*/
    while($hsumclosepayvcr = mysqli_fetch_array($sumclosepayvcr))
    {
        $keyJnsCardvcr=$hsumclosepayvcr['JnsCard'];
        $sumdetpayvcr=mysqli_query($koneksi,"SELECT sum(bill) as qtybill, sum(jumlah) as sumpay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsCard = '$keyJnsCardvcr'");
        $hsumdetpayvcr = mysqli_fetch_array($sumdetpayvcr);
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            <?php echo $hsumclosepayvcr['JnsCard'];?>
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumdetpayvcr['qtybill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumdetpayvcr['sumpay']);?>
            </p>
        </div>
    </div>
    <?php
    }
    ?>
    <?php
    /*sumcashsales*/
    $sumcashsales=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CASH'");
    $hsumcashsales = mysqli_fetch_array($sumcashsales);
    /*sumcardsales*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            TOTAL CASH
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumcashsales['sumcardbill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumcashsales['sumjumlah_bayar']);?>
            </p>
        </div>
    </div>
    <?php
    /*sumcardsales*/
    $sumcardsales=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CARD'");
    $hsumcardsales = mysqli_fetch_array($sumcardsales);
    /*sumcardsales*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            TOTAL CARD
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumcardsales['sumcardbill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumcardsales['sumjumlah_bayar']);?>
            </p>
        </div>
    </div>
    <?php
    /*sumvchsales*/
    $sumvchsales=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'VOUCHER'");
    $hsumvchsales = mysqli_fetch_array($sumvchsales);
    /*sumcardsales*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            TOTAL VOUCHER
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumvchsales['sumcardbill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumvchsales['sumjumlah_bayar']);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            VOID / REFUND SUMMARY
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <?php
    /*sumrefund*/
    $sumrefund=mysqli_query($koneksi,"SELECT sum(jumbill) as sumqtybill,sum(nett_sales) as sumpriceprevoid FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'REFUND'");
    $hsumrefund = mysqli_fetch_array($sumrefund);
    /*sumrefund*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            REFUND
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
                                                                    
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumrefund['sumqtybill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumrefund['sumpriceprevoid']);?>
            </p>
        </div>
    </div>
    <?php
    /*sumpresendvoid*/
    $sumpresendvoid=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyprevoid,sum(price) as sumpriceprevoid FROM item_void where terminal_id = '$idterminal' AND status_void = 'Before Send'");
    $hsumpresendvoid = mysqli_fetch_array($sumpresendvoid);
    /*sumpresendvoid*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Pre-Send Void
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumpresendvoid['sumqtyprevoid']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumpresendvoid['sumpriceprevoid']);?>
            </p>
        </div>
    </div>
    <?php
    /*sumpostsendvoid*/
    $sumpostsendvoid=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyprevoid,sum(price) as sumpriceprevoid FROM item_void where terminal_id = '$idterminal' AND status_void = 'After Send'");
    $hsumpostsendvoid = mysqli_fetch_array($sumpostsendvoid);
    /*sumpostsendvoid*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Post-Send Void
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumpostsendvoid['sumqtyprevoid']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumpostsendvoid['sumpriceprevoid']);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <?php
    /*sumTotCollection*/
    $sumTotCollection=mysqli_query($koneksi,"SELECT sum(bill) as sumbill, sum(jumlah_bayar) as sumjumbay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED'");
    $hsumTotCollection = mysqli_fetch_array($sumTotCollection);
    /*sumTotCollection*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            TotCollection
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumTotCollection['sumbill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumTotCollection['sumjumbay']);?>
            </p>
        </div>
    </div> 
    <?php
    /*sumtax*/
    $sumtax=mysqli_query($koneksi,"SELECT sum(tax) as sumtax, sum(gross_sales) as sumbeforetax, sum(disc) as sumdiscsales, sum(service_charge) as totalsurcharge FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
    $hsumtax = mysqli_fetch_array($sumtax);
    $servicech=$hsumtax['totalsurcharge'];
    $tax=$hsumtax['sumtax'];
    $aftertax=$hsumtax['sumbeforetax']-$hsumtax['sumdiscsales'];
    /*sumtax*/
    ?>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            SERVICE CHARGE
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Service Charge 5%
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($servicech);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            TAX
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Tax 10%
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($tax);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Nett Sales
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($aftertax);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <?php
    /*sumbillspending*/
    $sumbillspending=mysqli_query($koneksi,"SELECT sum(jumbill) as sumopenbill, sum(gross_sales) as sumgrossopenbill, sum(disc) as sumdiscopenbill FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'OPEN'");
    $hsumbillspending = mysqli_fetch_array($sumbillspending);
    $totalopenbill=$hsumbillspending['sumgrossopenbill']+$hsumbillspending['sumdiscopenbill'];
    /*sumbillspending*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Bills Pending
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumbillspending['sumopenbill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($totalopenbill);?>
            </p>
        </div>
    </div>
    <?php
    /*sumclosebill*/
    $sumclosebill=mysqli_query($koneksi,"SELECT sum(jumbill) as sumclosebill FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
    $hsumclosebill = mysqli_fetch_array($sumclosebill);
    /*sumclosebill*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Total # of Bills
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumclosebill['sumclosebill']);?>
            </p>
        </div>
    </div>
    <?php
    /*sumavgbill*/
    $sumavgbill=mysqli_query($koneksi,"SELECT sum(jumbill) as sumclosebill, sum(nett_sales) as sumnett_sales FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
    $hsumavgbill = mysqli_fetch_array($sumavgbill);
    $xavgperbill=$hsumavgbill['sumnett_sales']/$hsumavgbill['sumclosebill'];
    $avgperbill=ceil($xavgperbill);
    /*sumavgbill*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Avg Bills
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($avgperbill);?>
            </p>
        </div>
    </div>
    <?php
    /*sumcoverbill*/
    $sumcoverbill=mysqli_query($koneksi,"SELECT sum(custqty) as sumcustqty, sum(nett_sales) as sumnett_sales FROM pos_salestemp where terminal_id = '$idterminal' AND status = 'CLOSED'");
    $hsumcoverbill = mysqli_fetch_array($sumcoverbill);
    $xavgcustperbill=$hsumcoverbill['sumnett_sales']/$hsumcoverbill['sumcustqty'];
    $avgcustperbill=ceil($xavgcustperbill);
    /*sumcoverbill*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Total # of Covers
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumcoverbill['sumcustqty']);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            Avg Covers
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($avgcustperbill);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            GROUP SALES
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <?php
    /*sumbevsales*/
    $sumbevsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp where kdcategory = '100002' AND terminal_id = '$idterminal' AND paidstatus = 'PAID'");
    $hsumbevsales = mysqli_fetch_array($sumbevsales);
    /*sumbevsales*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            BEVERAGES
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumbevsales['sumbevqty']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumbevsales['sumbevprice']);?>
            </p>
        </div>
    </div>
    <?php
    /*sumfoodsales*/
    $sumfoodsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp where kdcategory = '100001' AND terminal_id = '$idterminal' AND paidstatus = 'PAID'");
    $hsumfoodsales = mysqli_fetch_array($sumfoodsales);
    /*sumfoodsales*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            FOOD
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumfoodsales['sumbevqty']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumfoodsales['sumbevprice']);?>
            </p>
        </div>
    </div>
    <?php
    /*sumfnbsales*/
    $sumfnbsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp WHERE terminal_id = '$idterminal' AND paidstatus = 'PAID'");
    $hsumfnbsales = mysqli_fetch_array($sumfnbsales);
    /*sumfnbsales*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            FOOD
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumfnbsales['sumbevqty']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumfnbsales['sumbevprice']);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            GROUP FOC
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <?php
    /*sumfnbsales*/
    $sumfnbsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp WHERE terminal_id = '$idterminal' AND paidstatus = 'PAID'");
    $hsumfnbsales = mysqli_fetch_array($sumfnbsales);
    /*sumfnbsales*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            BEVERAGES
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            0
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            0
            </p>
        </div>
    </div>
    <?php
    /*sumfnbsales*/
    $sumfnbsales=mysqli_query($koneksi,"SELECT sum(qty) as sumbevqty, sum(price) as sumbevprice FROM pos_itemtemp WHERE terminal_id = '$idterminal' AND paidstatus = 'PAID'");
    $hsumfnbsales = mysqli_fetch_array($sumfnbsales);
    /*sumfnbsales*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            FOOD
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            0
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            0
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            SALES CATEGORY
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <?php
    /*sumdinein*/
    $sumdinein=mysqli_query($koneksi,"SELECT sum(jumbill) as sumdineinqty, sum(gross_sales) as sumdineingross FROM pos_salestemp WHERE terminal_id = '$idterminal' AND status = 'CLOSED' AND meja != 'takeaway' ");
    $hsumdinein = mysqli_fetch_array($sumdinein);
    /*sumdinein*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            DINE IN
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumdinein['sumdineinqty']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumdinein['sumdineingross']);?>
            </p>
        </div>
    </div>
    <?php
    /*sumtakeaway*/
    $sumtakeaway=mysqli_query($koneksi,"SELECT sum(jumbill) as sumtakeawayqty, sum(gross_sales) as sumtakeawaygross FROM pos_salestemp WHERE terminal_id = '$idterminal' AND status = 'CLOSED' AND meja = 'takeaway' ");
    $hsumtakeaway = mysqli_fetch_array($sumtakeaway);
    /*sumtakeaway*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            TAKE AWAY
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumtakeaway['sumtakeawayqty']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumtakeaway['sumtakeawaygross']);?>
            </p>
        </div>
    </div>
    <?php
    /*sumtotctgry*/
    $sumtotctgry=mysqli_query($koneksi,"SELECT sum(jumbill) as sumtotctgryqty, sum(gross_sales) as sumtotctgrygross FROM pos_salestemp WHERE terminal_id = '$idterminal' AND status = 'CLOSED'");
    $hsumtotctgry = mysqli_fetch_array($sumtotctgry);
    /*sumtotctgry*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            TOTAL SALES CATEGORY
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumtotctgry['sumtotctgryqty']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumtotctgry['sumtotctgrygross']);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            DISCOUNT / PROMOTION
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <?php
    /*discitemdet*/
    $discitemdet=mysqli_query($koneksi,"SELECT id_promotion,sum(qty) as sumqtyitemdisc, sum(disc) as sumdiscitem FROM pos_promotion_d where terminal_id = '$idterminal' and promotion_type = 'DISC ITEM' and paid_status = 'PAID' group by id_promotion");
    while($hdiscitemdet = mysqli_fetch_array($discitemdet))
    {
    $discitemket=mysqli_query($koneksi,"SELECT * FROM promotion_h WHERE id_promotion = '$hdiscitemdet[id_promotion]'");
    $hdiscitemket = mysqli_fetch_array($discitemket);
    /*sumdiscitem*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            <?php echo $hdiscitemket['promotion_name'];?>
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hdiscitemdet['sumqtyitemdisc']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hdiscitemdet['sumdiscitem']);?>
            </p>
        </div>
    </div>
    <?php
    }
    ?>
    <?php
    /*sumdiscitem*/
    $sumitemdisc=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyitemdisc, sum(disc) as sumdiscitem, id_promotion FROM pos_promotion_d where terminal_id = '$idterminal' and promotion_type = 'DISC ITEM' and paid_status = 'PAID'");
    $hsumitemdisc = mysqli_fetch_array($sumitemdisc);
    /*sumdiscitem*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            TOTAL ItemDiscount
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumitemdisc['sumqtyitemdisc']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumitemdisc['sumdiscitem']);?>
            </p>
        </div>
    </div>
    <?php
    /*discbilldet*/
    $discbilldet=mysqli_query($koneksi,"SELECT sum(bill) as sumbilldisc, sum(disc) as sumdiscbill, disc_desk FROM pos_promotion_h where terminal_id = '$idterminal' and promotion_type = 'DISC ALL' and paid_status = 'PAID' group by id_promotion");
    while($hdiscbilldet = mysqli_fetch_array($discbilldet))
    {
    /*discbilldet*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            <?php echo $hdiscbilldet['disc_desk'];?>
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hdiscbilldet['sumbilldisc']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hdiscbilldet['sumdiscbill']);?>
            </p>
        </div>
    </div>
    <?php
    }
    ?>
    <?php
    /*sumbilldisc*/
    $sumbilldisc=mysqli_query($koneksi,"SELECT sum(bill) as sumqtybill, sum(disc) as sumdiscbill FROM pos_promotion_h where terminal_id = '$idterminal' and promotion_type = 'DISC ALL' and paid_status = 'PAID'");
    $hsumbilldisc = mysqli_fetch_array($sumbilldisc);
    /*sumbilldisc*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            TOTAL BillDiscount
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumbilldisc['sumqtybill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumbilldisc['sumdiscbill']);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            FIPO
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border-bottom-width: 5px;border-bottom-color: #000;border-bottom-style: dashed;">
        </div>
    </div>
    <?php
    /*sumsalescash*/
    $sumsalescash=mysqli_query($koneksi,"SELECT sum(bill) as sumcardbill, sum(jumlah_bayar) as sumjumlah_bayar FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsTrans = 'CASH' AND JnsCard = 'CASH'");
    $hsumsalescash = mysqli_fetch_array($sumsalescash);
    /*sumsalescash*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            SALES CASH
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            (+)
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumsalescash['sumcardbill']);?>
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($hsumsalescash['sumjumlah_bayar']);?>
            </p>
        </div>
    </div>
    <?php
    /*modalcash*/
    $modalcash=mysqli_query($koneksi,"SELECT * FROM terminal_parameter where terminal_id = '$idterminal'");
    $hmodalcash = mysqli_fetch_array($modalcash);
    $totalcashindrawer=$hsumsalescash['sumjumlah_bayar']+$hmodalcash['modal'];
    /*modalcash*/
    ?>
    <div class="row">
        <div class="col-5">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: left;">
            CASH IN DRAWER
            </p>
        </div>
        <div class="col-1">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: center;">
            (=)
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            
            </p>
        </div>
        <div class="col-3">
            <p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
            <?php echo number_format($totalcashindrawer);?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12"></div>
    </div>
</div>
</div>
<?php }
?>
<script>
function doPrint() {
    window.print();            
    document.location.href = "index.php";
}
</script>
</body>
</html>
<?php }ob_flush();?>