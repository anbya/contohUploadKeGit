cal<?php 
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
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$usrpay=$_SESSION['iduser'];
$transtempprm=$_GET['transtempprm'];
$bill=$_GET['bill'];
if(empty($bill))
{
    $prmbill=1;
}
else
{
    $prmbill=$bill;
}
$datepay=date("d/m/Y", $tanggal);
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
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <style>
    .abcd {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: red;
        color: white;
        text-align: center;
    }
    .headerheight1
        {
          height: 5vh; /* 30% of viewport height*/
          max-height: 5vh;
        }
    .mh1
        {
          height: 45vh; /* 30% of viewport height*/
          max-height: 45vh;
        }
    .mh1-4
        {
          height: 48vh; /* 30% of viewport height*/
          max-height: 48vh;
        }
    .mh2
        {
          height: 95vh; /* 30% of viewport height*/
          max-height: 95vh;
        }
    .mh96
        {
          height: 80vh; /* 30% of viewport height*/
          max-height: 80vh;
        }
    .mh3
        {
          height: 70vh; /* 30% of viewport height*/
          max-height: 70vh;
        }
    .mh25
        {
          height: 25vh; /* 30% of viewport height*/
          max-height: 25vh;
        }
    .mh4
        {
          height: 30vh; /* 30% of viewport height*/
          max-height: 30vh;
        }
    .mh5
        {
          height: 40vh; /* 30% of viewport height*/
          max-height: 40vh;
        }
    .mh50
        {
          height: 50vh; /* 30% of viewport height*/
          max-height: 50vh;
        }
    .mh6
        {
          height: 60vh; /* 30% of viewport height*/
          max-height: 60vh;
        }
    .mh7
        {
          height: 20vh; /* 30% of viewport height*/
          max-height: 20vh;
        }
    .mh10
        {
          height: 10vh; /* 30% of viewport height*/
          max-height: 10vh;
        }
    .mh8
        {
          height: 80vh; /* 30% of viewport height*/
          max-height: 80vh;
        }
    .maxwidthheight
    {
        text-align: center;
        width: 100%;
        height: 100%;
    }
    .tepian
    {
        border-width: 1px;
        border-color: #000;
        border-style: solid;
    }
    .tepibawah
    {
        border-bottom-width: 1px;
        border-bottom-color: #000;
        border-bottom-style: solid;
    }
    .nopadding
    {
        padding: 0px;
    }
    .nomargin
    {
        margin: 0px;
    }
    .scrollpage
    {
    overflow-x: hidden;
    overflow-y: scroll;
    }
    #item0
    {
        display: block;
    }
    #item1
    {
        display: none;
    }
    #item2
    {
        display: none;
    }
    #item3
    {
        display: none;
    }
    #item4
    {
        display: none;
    }
    #item5
    {
        display: none;
    }
    #item6
    {
        display: none;
    }
    </style>
</head>

<body onkeypress='return false'>
<div class="container-fluid">
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
    <div class="row headerheight1" style="background-color: #e0e0e0;">
        <div class="col-md-12 nopadding">
            <h4 style="font-weight: bold;">POS SYSTEM</h4>
        </div>
    </div>
    <div class="row mh2">
        <div class="col-md-5"> <!--style="padding: 15px;"-->
            <div class="row mh2" style="background-color: #8c0000;padding: 2vh;">
                <div class="col-md-12 tepian" style="background-color: #ffffff;">
                    <div class="row tepian" style="background-color: #6c0000;color: #fff;height: 7vh;">
                        <div class="col-6">
                            <a>Item Name</a>
                        </div>
                        <div class="col-2">
                            <a>Qty</a>
                        </div>
                        <div class="col-4">
                            <a>Amount</a>
                        </div>
                    </div>
                    <div class="row mh50 scrollpage" style="background-color: #ffffff;">
                        <div class="col-12">
                        <?php
                        include "koneksi.php";
                        $itemtemp=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp ='$transtempprm' AND bill = '$prmbill' group by kditem");
                        while($hitemtemp = mysqli_fetch_array($itemtemp)) 
                            {
                            ?>
                            <?php
                            $kditem=$hitemtemp['kditem'];
                            $itemdet=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = $kditem");
                            $hitemdet = mysqli_fetch_array($itemdet);
                            $sumsubtotalitem=mysqli_query($koneksi,"SELECT SUM(price) AS sumsubtotal FROM pos_itemtemp where kditem = $kditem AND transtemp ='$transtempprm' AND bill = '$prmbill' ");
                            $hsumsubtotalitem = mysqli_fetch_array($sumsubtotalitem);
                            $sumqtyitem=mysqli_query($koneksi,"SELECT SUM(qty) AS sumsqty FROM pos_itemtemp where kditem = $kditem AND transtemp ='$transtempprm' AND bill = '$prmbill' ");
                            $hsumqtyitem = mysqli_fetch_array($sumqtyitem);
                            $price=$hsumsubtotalitem['sumsubtotal'];
                            ?>
                            <div class="row">
                            <div class="col-6">
                                <a><?php echo $hitemdet['nmitem'];?></a>
                            </div>
                            <div class="col-2">
                                <a><?php echo $hsumqtyitem['sumsqty'];?></a>
                            </div>
                            <div class="col-4">
                                <a><?php echo number_format("$price");?></a>
                            </div>
                            </div>
                            <?php
                            }
                        ?>
                        </div>
                    </div>
                    <div class="row mh25 scrollpage" style="background-color: #ffffff;border-top: solid;">
                        <div class="col-12">
                        <?php
                        $transtemp=$transtempprm;
                        $querytotalbill = "SELECT SUM(price) AS grand_total FROM pos_itemtemp WHERE transtemp = '$transtemp' AND bill = '$prmbill' ";
                        $resultquerytotalbill = mysqli_query($koneksi,$querytotalbill) or die (mysqli_error());
                        $hresultquerytotalbill = mysqli_fetch_array($resultquerytotalbill);
                        $totalperbill=$hresultquerytotalbill['grand_total'];
                        ?>
                            <div class="row">
                                <div class="col-7">
                                    <a style="font-size: 2.5vh;"><b>TOTAL BILL <?php echo $prmbill;?></b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-4" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>Rp. <?php echo number_format("$totalperbill");?></b></a>
                                </div>
                            </div>
                            <?php                           
                            $sqldisch=mysqli_query($koneksi,"SELECT * FROM pos_promotion_h where notrans = '$transtempprm' AND bill = '$prmbill'");
                            while($hsqldisch= mysqli_fetch_array($sqldisch))
                            {
                            $prmpromotion=$hsqldisch['id_promotion'];
                            $sqldischdetail=mysqli_query($koneksi,"SELECT * FROM promotion_h where id_promotion = '$prmpromotion'");
                            $hsqldischdetail = mysqli_fetch_array($sqldischdetail);
                            ?>
                            <div class="row">
                                <div class="col-7">
                                    <a style="font-size: 2vh;"><?php echo $hsqldischdetail['promotion_name'];?></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-4" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2vh;">-Rp. <?php echo number_format("$hsqldisch[disc]");?></a>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <?php    
                            $sqlgranddisc=mysqli_query($koneksi,"SELECT SUM(disc) as grand_disc FROM pos_promotion_h where notrans = '$transtempprm' AND bill = '$prmbill'");
                            $hsqlgranddisc = mysqli_fetch_array($sqlgranddisc);
                            $subtotalbill=$totalperbill-$hsqlgranddisc['grand_disc'];
                            ?>
                            <div class="row">
                                <div class="col-7">
                                    <a style="font-size: 2.5vh;"><b>SUBTOTAL BILL <?php echo $prmbill;?></b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-4" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>Rp. <?php echo number_format("$subtotalbill");?></b></a>
                                </div>
                            </div>
                            <?php    
                            $taxbill=$subtotalbill*10/100;
                            ?>
                            <div class="row">
                                <div class="col-7">
                                    <a style="font-size: 2vh;"><b>Tax BILL <?php echo $prmbill;?></b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-4" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2vh;"><b>Rp. <?php echo number_format("$taxbill");?></b></a>
                                </div>
                            </div>
                            <?php    
                            $grandtotalbill=$subtotalbill+$taxbill;
                            ?>
                            <div class="row">
                                <div class="col-7">
                                    <a style="font-size: 2.5vh;"><b>GRAND TOTAL BILL <?php echo $prmbill;?></b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-4" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>Rp. <?php echo number_format("$grandtotalbill");?></b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="background-color: #ffffff;border-top: solid;">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <?php
                                    $navbill = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$transtempprm' ");
                                    $hnavbill = mysqli_fetch_array($navbill);
                                    $billx1=$hnavbill['jumbill'];
                                    if(empty($transtempprm)){
                                        $prevbillstatus="disabled";
                                        $nextbillstatus="disabled";
                                    }
                                    else
                                    {
                                        if($prmbill>1){
                                            $prevbillstatus="";
                                            $prevbill=$prmbill-1;
                                        }
                                        else{
                                            $prevbillstatus="disabled";
                                            $prevbill=$prmbill-1;
                                        }
                                        if($prmbill==$billx1){
                                            $nextbillstatus="disabled";
                                            $nextbill=$prmbill+1;
                                        }
                                        else{
                                            $nextbillstatus="";
                                            $nextbill=$prmbill+1;
                                        }
                                    }
                                    ?>
                                    <!--
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pg-blue justify-content-center">
                                            <li class="page-item <?php echo $prevbillstatus;?>">
                                                <a href="index.php?transtempprm=<?php echo $transtempprm;?>&bill=<?php echo $prevbill;?>" class="page-link" tabindex="-1">Previous Bill</a>
                                            </li>
                                            <li class="page-item"><a class="page-link"><?php echo $prmbill;?></a></li>
                                            <li class="page-item <?php echo $nextbillstatus;?>">
                                                <a href="index.php?transtempprm=<?php echo $transtempprm;?>&bill=<?php echo $nextbill;?>" class="page-link">Next Bill</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="row">
                <div class="col-12 col-md-6 tepian" style="background-color: #8c0000;">
                    <div class="row" style="padding-top: 2vh;padding-left: 2vh;padding-right: 2vh;">
                        <div class="col-md-12 tepian" style="background-color: #ffffff;">
                                <div class="row">
                            <?php
                            if(!isset($transtempprm)){
                                $posnomortable="-";
                                $postrxnumber="-";
                            }
                            else{
                                $postrxnumber=$transtempprm;
                                $tablenumber = "SELECT * FROM pos_salestemp where notrans = '$transtempprm'";
                                $resulttablenumber = mysqli_query($koneksi,$tablenumber) or die (mysqli_error());
                                $hresulttablenumber= mysqli_fetch_array($resulttablenumber);
                                $posnomortable=$hresulttablenumber['meja'];
                            }
                            ?>
                                    <div class="col-6">
                                        <a style="font-size: 2vh;">trx no</a>
                                    </div>
                                    <div class="col-1">
                                        <a style="font-size: 2vh;">:</a>
                                    </div>
                                    <div class="col-5" style="text-align: right;">
                                        <a style="font-size: 2vh;"><?php echo $postrxnumber;?></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <a style="font-size: 2vh;">nomor meja</a>
                                    </div>
                                    <div class="col-1">
                                        <a style="font-size: 2vh;">:</a>
                                    </div>
                                    <div class="col-5" style="text-align: right;">
                                        <a style="font-size: 2vh;"><?php echo $posnomortable;?></a>
                                    </div>
                                </div>
                                <?php                           
                                $paytype=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where NoTrans = '$transtempprm' AND bill = '$prmbill'");
                                while($hpaytype= mysqli_fetch_array($paytype))
                                {
                                ?>
                                <div class="row" style="border-top:solid;">
                                    <?php
                                    if ($hpaytype['JnsTrans']!='CASH' AND $hpaytype['JnsTrans']!='CARD' AND $hpaytype['JnsTrans']!='VOUCHER' AND $hpaytype['JnsTrans']!='EVOUCHER')
                                    {
                                        $cekotherpayment=mysqli_query($koneksi,"SELECT * FROM pos_other_payment_prm where id_other_payment = '$hpaytype[JnsTrans]'");
                                        $hcekotherpayment= mysqli_fetch_array($cekotherpayment);
                                    ?>
                                    <div class="col-6">
                                        <a style="font-size: 2vh;"><?php echo $hcekotherpayment['nama_other_payment'];?></a>
                                    </div>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <div class="col-6">
                                        <a style="font-size: 2vh;"><?php echo $hpaytype['JnsTrans'];?></a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="col-1" style="border-bottom: solid;">
                                        <a style="font-size: 2vh;">:</a>
                                    </div>
                                    <div class="col-5" style="text-align: right;border-bottom: solid;">
                                        <a style="font-size: 2vh;">Rp. <?php echo number_format("$hpaytype[Jumlah];");?></a>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <?php    
                                $paytotal=mysqli_query($koneksi,"SELECT SUM(Jumlah) as jumlahpayment FROM pos_paymenttemp where NoTrans = '$transtempprm' AND bill = '$prmbill'");
                                $hpaytotal = mysqli_fetch_array($paytotal);
                                $rpaytotal = mysqli_num_rows($paytotal);
                                $payment=$hpaytotal['jumlahpayment'];
                                if(empty($payment)){
                                    $tampilpayment="0";
                                }
                                else{
                                    $tampilpayment=$payment;
                                }
                                ?>
                                <div class="row">
                                    <div class="col-6">
                                        <a style="font-size: 2.5vh;"><b>Jumlah Bayar</b></a>
                                    </div>
                                    <div class="col-1" style="border-bottom: solid;">
                                        <a style="font-size: 2.5vh;"><b>:</b></a>
                                    </div>
                                    <div class="col-5" style="text-align: right;border-bottom: solid;">
                                        <a style="font-size: 2.5vh;"><b>Rp. <?php echo number_format("$tampilpayment");?></b></a>
                                    </div>
                                </div>
                            <?php
                            $kembalian=$payment-$grandtotalbill;
                            $keysisabayar=$grandtotalbill-$payment;
                            if($keysisabayar<0){
                                $sisabayar="0";
                            }
                            else{
                                $sisabayar=$keysisabayar;
                            }
                            if($kembalian<0){
                                $tampilkembalian="0";
                            }
                            else{
                                $cekpembayaran=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where NoTrans = '$transtempprm' and JnsTrans != 'VOUCHER' ");
                                $rcekpembayaran = mysqli_num_rows($cekpembayaran);
                                if($rcekpembayaran<1)
                                {
                                    $tampilkembalian="0";
                                }
                                else
                                {
                                    $tampilkembalian=$kembalian;
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-6">
                                    <a style="font-size: 2.5vh;"><b>Kembalian</b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-5" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>Rp. <?php echo number_format("$tampilkembalian");?></b></a>
                                </div>
                            </div>
                            <?php
                            $datamember=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$transtempprm'");
                            $hdatamember = mysqli_fetch_array($datamember);
                            $keymember=substr($hdatamember['member'],14);
                            if($keymember==""){
                                $tampilmember="-";
                            }
                            else{
                                $tampilmember=$keymember;
                            }
                            ?>
                            <div class="row">
                                <div class="col-6">
                                    <a style="font-size: 2.5vh;"><b>Member</b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-5" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b><?php echo $tampilmember;?></b></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a style="font-size: 2.5vh;"><b>Jumlah Customer</b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-5" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b><?php echo $hdatamember['custqty'];?></b></a>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-md-12" style="background-color: #ffffff;padding-top: 1vh;">
                                <?php
                                $sqlpaidstatus = "SELECT * FROM pos_itemtemp WHERE transtemp = '$transtemp' AND bill = '$prmbill' ";
                                $resultsqlpaidstatus = mysqli_query($koneksi,$sqlpaidstatus) or die (mysqli_error());
                                $hsqlpaidstatus= mysqli_fetch_array($resultsqlpaidstatus);
                                if($hsqlpaidstatus['paidstatus']=="UNPAID"){?>
                                <h2 style="text-align: center;font-weight: bold;color: #ff0000;">UNPAID</h2>
                                <?php
                                }
                                elseif(empty($hsqlpaidstatus['paidstatus'])){
                                }
                                else{?>
                                <h2 style="text-align: center;font-weight: bold;color: #00d820;">PAID</h2>
                                <?php
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Nav tabs -->

                </div>
                <div class="col-12 col-md-6 tepian">
                    <div class="row">
                    <div class="col-md-12 nopadding">
                        <div class="card" style="background-color: #e0e0e0;color: #fff;">
                            <div class="card-header" style="background-color: #8c0000;color: #fff;">
                                <h5 class="text-center mb-0">MENU</h5>
                            </div>
                            <div class="card-body" style="padding: 0px;">
                                <?php
                                if(empty($transtempprm))
                                    {
                                    ?>
                                    <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-12" style="padding: 0px;margin: 0px;">
                                            <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalbuattrans" style="padding-left: 0px;padding-right: 0px;">BUAT TRANSAKSI</a>
                                                <!--Modal: mulai transaksi-->
                                                <div class="modal fade" id="modalbuattrans" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog cascading-modal" role="document">
                                                <!--Content-->
                                                <div class="modal-content">

                                                <!--Modal cascading tabs-->
                                                <div class="modal-c-tabs">

                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                                <li class="nav-item">
                                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelbukatrans" role="tab">BUAT ORDER</a>
                                                </li>
                                                </ul>

                                                <!-- Tab panels -->
                                                <div class="tab-content">
                                                <!--Panel 17-->
                                                <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

                                                <!--Body-->
                                                <div class="modal-body text-center mb-1">
                                                    <div class="card">
                                                        <form action="saveorder.php" method="post">
                                                            <div class="card-body">
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-12" style="padding: 3px;margin: 0px;">
                                                                        <?php
                                                                        $viewpostable1=mysqli_query($koneksi,"SELECT * FROM pos_table");
                                                                        while($hviewpostable1 = mysqli_fetch_array($viewpostable1)) 
                                                                        {
                                                                        if(empty($hviewpostable1['notrans'])){
                                                                            $discheck1="";
                                                                        }
                                                                        else{
                                                                            $discheck1="disabled";
                                                                        }
                                                                        ?>
                                                                        <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="checkbox" id="<?php echo $hviewpostable1['id_table'];?>" name = "table[]" value="<?php echo $hviewpostable1['id_table'];?>" <?php echo $discheck1;?>>
                                                                        <label class="form-check-label" for="<?php echo $hviewpostable1['id_table'];?>" style="font-size: 0.8em;"><?php echo $hviewpostable1['nama_table'];?></label>
                                                                        </div>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-8" style="padding: 3px;margin: 0px;"><strong>JUMLAH CUSTOMER</strong></div>
                                                                    <div class="col-4" style="padding: 3px;margin: 0px;"><input type="number" value="" style="width: 100%;" name="jumcust" required></div>
                                                                </div>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-12" style="padding: 3px;margin: 0px;"><button class="btn btn-nahm btn-block" type="submit" id="btnputorder">PROSES ORDER</button></div>
                                                                </div>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-12" style="padding: 3px;margin: 0px;"><a class="btn btn-nahm btn-block" role="button" href="index.php" id="btnvoidorder">BATAL</a></div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!--Body-->
                                                </div>
                                                <!--/.Panel 17-->
                                                </div>

                                                </div>
                                                </div>
                                                <!--/.Content-->
                                                </div>
                                                </div>
                                                <!--Modal: buka transaksi-->
                                        </div>
                                        <div class="col-12" style="padding: 0px;margin: 0px;">
                                            <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalbukatans" style="padding-left: 0px;padding-right: 0px;">BUKA TRANSAKSI</a>
                                                <!--Modal: mulai transaksi-->
                                                <div class="modal fade" id="modalbukatans" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog cascading-modal" role="document">
                                                <!--Content-->
                                                <div class="modal-content">

                                                <!--Modal cascading tabs-->
                                                <div class="modal-c-tabs">

                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                                <li class="nav-item">
                                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelbukatrans" role="tab">DAFTAR TRANSAKSI</a>
                                                </li>
                                                </ul>

                                                <!-- Tab panels -->
                                                <div class="tab-content">
                                                <!--Panel 17-->
                                                <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

                                                <!--Body-->
                                                <div class="modal-body text-center mb-1">
                                                <h5 class="mt-1 mb-2">PILIH transaksi yang akan di buka</h5>
                                                <div class="row scrollpage mh5">
                                                <div class="col-md-12 nopadding">
                                                <?php
                                                include "koneksi.php";
                                                $postemp=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where status = 'OPEN'");
                                                while($hpostemp = mysqli_fetch_array($postemp)) 
                                                {
                                                $opentrans=$hpostemp['notrans'];
                                                $tabletrans=$hpostemp['meja'];
                                                /*pos table*/
                                                $viewpostable1=mysqli_query($koneksi,"SELECT * FROM pos_table where notrans = '$opentrans' ");
                                                $hviewpostable1 = mysqli_fetch_array($viewpostable1);
                                                /*pos table*/
                                                ?>
                                                <a href="index.php?transtempprm=<?php echo $opentrans;?>" class="btn btn-nahm btn-block"><?php echo $hviewpostable1['nama_table'];?></a> 
                                                <?php
                                                }
                                                ?>
                                                </div>
                                                </div>
                                                </div>
                                                <!--Body-->
                                                </div>
                                                <!--/.Panel 17-->
                                                </div>

                                                </div>
                                                </div>
                                                <!--/.Content-->
                                                </div>
                                                </div>
                                                <!--Modal: buka transaksi-->
                                        </div>
                                    </div>
                                    <?php
                                    }
                                else
                                    {
                                    ?>
                                    <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-12" style="padding: 0px;margin: 0px;">
                                            
                                        <a href="index.php" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">HOLD TRANSAKSI</a>
                                        </div>
                                        <!--start: pindah meja-->
                                        <div class="col-12" style="padding: 0px;margin: 0px;">
                                               <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpindahtable" style="padding-left: 0px;padding-right: 0px;">PINDAH MEJA</a>
                                        </div>

                                        <div class="modal fade" id="modalpindahtable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                               <div class="modal-dialog cascading-modal modal-lg" role="document">
                                                      <!--Content-->
                                                      <div class="modal-content">

                                                             <!--Modal cascading tabs-->
                                                             <div class="modal-c-tabs">

                                                             <!-- Nav tabs -->
                                                             <ul class="nav nav-tabs tabs-2" role="tablist">
                                                             <li class="nav-item">
                                                             <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">PINDAH MEJA</a>
                                                             </li>
                                                             </ul>

                                                             <!-- Tab panels -->
                                                             <div class="tab-content">
                                                                    <!--Panel 17-->
                                                                    <div class="tab-pane fade in show active" id="panel171" role="tabpanel">
                                                                           <!--Body-->
                                                                           <div class="modal-body text-center mb-1">
                                                                           <h5 class="mt-1 mb-2">PILIH MEJA TUJUAN</h5>
                                                                           <form action="movetable.php" method="POST">
                                                                                <div class="row scrollpage mh5">
                                                                                <input type="hidden" name="notrans" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                                                                    <?php
                                                                                    $prmtable = "SELECT * FROM pos_table where notrans = '' order by id_table ASC";
                                                                                    $resultprmtable = mysqli_query($koneksi,$prmtable) or die (mysqli_error());
                                                                                    while($hresultprmtable= mysqli_fetch_array($resultprmtable))
                                                                                    {
                                                                                    ?>
                                                                                    <div class="col-3" style="padding: 3px;margin: 0px;">
                                                                                        <?php
                                                                                        $showtable=$hresultprmtable['id_table'];
                                                                                        $tabelcek1 = "SELECT * FROM pos_table WHERE id_table = '$showtable' ";
                                                                                        $resulttabelcek1 = mysqli_query($koneksi,$tabelcek1) or die (mysqli_error());
                                                                                        $hresulttabelcek1= mysqli_fetch_array($resulttabelcek1);
                                                                                        if(empty($hresulttabelcek1['notrans'])){
                                                                                            $discheck1="";
                                                                                        }
                                                                                        else{
                                                                                            $discheck1="disabled";      
                                                                                        }
                                                                                        ?>
                                                                                        <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" type="checkbox" id="<?php echo $hresulttabelcek1['id_table'];?>" name = "table[]" value="<?php echo $hresulttabelcek1['id_table'];?>" <?php echo $discheck1;?>>
                                                                                        <label class="form-check-label" for="<?php echo $hresulttabelcek1['id_table'];?>" style="font-size: 1em;"><?php echo $hresulttabelcek1['nama_table'];?></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                    <div class="col-12" style="padding: 3px;margin: 0px;">
                                                                                    <button class="btn btn-nahm btn-block" type= "submit">Proses</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                           </div>
                                                                           <!--Body-->
                                                                    </div>
                                                                    <!--/.Panel 17-->
                                                             </div>

                                                             </div>
                                                      </div>
                                                      <!--/.Content-->
                                               </div>
                                        </div>
                                        <!--end: pindah meja-->
                                        <?php
                                        $cekbataltrans=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where notrans = '$transtempprm'");
                                        $hcekbataltrans = mysqli_fetch_array($cekbataltrans);
                                        $rcekbataltrans = mysqli_num_rows($cekbataltrans);
                                        if($rcekbataltrans=="0")
                                        {
                                        ?>
                                            <!--start: cancel trans-->
                                            <div class="col-12" style="padding: 0px;margin: 0px;">
                                                   <a href="bataltrans.php?usr=<?php echo $usrpay;?>&transtemp=<?php echo $transtempprm;?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">BATALKAN TRANSAKSI</a>
                                            </div>
                                            <!--end: cancel trans-->
                                        <?php
                                        }
                                        else
                                        {
                                        echo "";
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    }
                                ?>
                            </div>
                            <!--
                            <div class="card-footer">
                                <h5 class="text-center mb-0">MENU</h5>
                            </div>
                            -->
                        </div>
                    </div>
                    </div>
                    <!-- Nav tabs -->

                </div>
            </div>
            <div class="row">
            <!-- /menu -->
                <div class="col-md-12 nopadding">
                    <?php
                    $transtemp=$transtempprm;
                    $itemtemp=mysqli_query($koneksi,"select * from pos_salestemp where notrans ='$transtemp'");
                    $ritemtemp=mysqli_num_rows($itemtemp);
                    if (!EMPTY($ritemtemp))
                    {   
                    ?>
                    <div class="card" style="background-color: #ffffff;color: #fff;">
                        <div class="card-header" style="background-color: #8c0000;color: #fff;padding:0px;">
                        <a class="btn btn-nahm" role="button" href="index.php?transtempprm=<?php echo $transtempprm;?>" id="btnvoidorder" style="width:45%;">BATAL</a>
                        <a class="btn btn-nahm" role="button" href="index.php?transtempprm=<?php echo $transtempprm;?>" id="btnvoidorder" style="width:45%;">BATAL</a>
                        </div>
                        <div class="card-body" style="padding: 0px;">
                            <div class="row" style="margin: 0px;padding: 0px;">
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalvoid" style="padding-left: 0px;padding-right: 0px;">ITEM VOID</a>
                                </div>
                                <!--Modal: void-->
                                    <div class="modal fade" id="modalvoid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog cascading-modal" role="document">
                                            <!--Content-->
                                            <div class="modal-content">

                                                <!--Modal cascading tabs-->
                                                <div class="modal-c-tabs">

                                                    <!-- Nav tabs -->
                                                    <ul class="nav nav-tabs tabs-2" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">ITEM VOID</a>
                                                        </li>
                                                    </ul>

                                                    <!-- Tab panels -->
                                                    <form action="order/voidorderproses.php" method="post">
                                                    <div class="tab-content">
                                                        <!--Panel 17-->
                                                        <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

                                                            <!--Body-->
                                                            <div class="modal-body mb-1">
                                                                <h5 class="mt-1 mb-2 text-center">PILIH ITEM YANG AKAN DI VOID</h5>
                                                                <input type="hidden" name ="prmvoid" value="<?php echo $transtempprm;?>" style="width: 100%;">
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-8" style="padding: 3px;margin: 0px;"><strong>NAMA MENU</strong></div>
                                                                    <div class="col-4" style="padding: 3px;margin: 0px;"><strong>JUMLAH</strong></div>
                                                                </div>
                                                                <?php
                                                                include "koneksi.php";
                                                                $sqlplu=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtemp' AND bill = '$prmbill'  group by kditem");
                                                                while($hsqlplu = mysqli_fetch_array($sqlplu)) 
                                                                {
                                                                $qtycek=$hsqlplu['kditem'];
                                                                $fetchitem = "SELECT * FROM pos_item WHERE kditem = '$qtycek'";
                                                                $resultfetchitem = mysqli_query($koneksi,$fetchitem) or die (mysqli_error());
                                                                $hresultfetchitem= mysqli_fetch_array($resultfetchitem);
                                                                $sumqtyitemvoid=mysqli_query($koneksi,"SELECT SUM(qty) AS sumsqty FROM pos_itemtemp where kditem = $qtycek AND transtemp ='$transtempprm' AND bill = '$prmbill' ");
                                                                $hsumqtyitemvoid = mysqli_fetch_array($sumqtyitemvoid);
                                                                $maxqtyvoid=$hsumqtyitemvoid['sumsqty'];
                                                                ?>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-8" style="padding: 3px;margin: 0px;"><strong><?php echo $hresultfetchitem['nmitem'];?> (<?php echo $maxqtyvoid;?>)</strong></div>
                                                                    <div class="col-4" style="padding: 3px;margin: 0px;"><input type="number" name ="<?php echo $qtycek;?>" value="" style="width: 100%;" min="0" max="<?php echo $maxqtyvoid;?>"></div>
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-12" style="padding: 3px;margin: 0px;">
                                                                        <select class="form-control" name="statusvoid" required>
                                                                        <option value="" disabled selected>Pilih Status Void</option>
                                                                        <option value="Before Send">Before Send</option>
                                                                        <option value="After Send">After Send</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-12" style="padding: 3px;margin: 0px;">
                                                                        <select class="form-control" name="alasanvoid" required>
                                                                        <option value="" disabled selected>Pilih Alasan Void</option>
                                                                        <option value="Komplen Customer">Komplen Customer</option>
                                                                        <option value="Salah Order">Salah Order</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-12" style="padding: 3px;margin: 0px;"><button class="btn btn-nahm btn-block" type="submit" id="btnputorder">PROSES VOID ORDER</button></div>
                                                                </div>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-12" style="padding: 3px;margin: 0px;"><a class="btn btn-nahm btn-block" role="button" href="index.php?transtempprm=<?php echo $transtempprm;?>" id="btnvoidorder">BATAL</a></div>
                                                                </div>
                                                            </div>
                                                            <!--Body-->
                                                        </div>
                                                        <!--/.Panel 17-->
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--/.Content-->
                                        </div>
                                    </div>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalmember" style="padding-left: 0px;padding-right: 0px;">MEMBER</a>
                                </div>
                                <?php
                                $datamember=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$transtempprm'");
                                $hdatamember = mysqli_fetch_array($datamember);
                                $keymember=substr($hdatamember['member'],14);
                                if($keymember=="")
                                {
                                    echo "";
                                }
                                else{?>
                                    <div class="col-md-3 nopadding">
                                    <a href="hapusposmember.php?transtemp=<?php echo $transtempprm;?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">HAPUS MEMBER</a>
                                    </div>
                                <?php
                                }
                                ?>
                                <!--Modal: member-->
                                <div class="modal fade" id="modalmember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog cascading-modal" role="document">
                                <!--Content-->
                                <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                <li class="nav-item">
                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelidmem" role="tab">ID <br>Member</a>
                                </li>
                                <li class="nav-item">
                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#paneltelmem" role="tab">Telepon <br>Member</a>
                                </li>
                                </ul>

                                <!-- Tab panels -->
                                <div class="tab-content">
                                <!--Panel 171-->
                                <div class="tab-pane fade in show active" id="panelidmem" role="tabpanel">

                                <!--Body-->
                                <div class="modal-body text-center mb-1">
                                <script type="text/javascript">
                                function displynummbr(n1)
                                {
                                calcformmbr.txt1.value=calcformmbr.txt1.value+n1;
                                }
                                function displyclearmbr()
                                {
                                calcformmbr.txt1.value="NHM";
                                }
                                </script>
                                <form name="calcformmbr" action="updateposmember.php" method="post">

                                <!--/.numpad-->
                                <table width="65%" align="center">
                                <tr>
                                <td colspan="3">
                                <input type="hidden" name="notrans" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                <input type="text" name="txt1" class="form-control ml-0" value="NHM">
                                </td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn7cash" value=7 onclick="displynummbr(btn7cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn8cash" value=8 onclick="displynummbr(btn8cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn9cash" value=9 onclick="displynummbr(btn9cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn4cash" value=4 onclick="displynummbr(btn4cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn5cash" value=5 onclick="displynummbr(btn5cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn6cash" value=6 onclick="displynummbr(btn6cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn1cash" value=1 onclick="displynummbr(btn1cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn2cash" value=2 onclick="displynummbr(btn2cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn3cash" value=3 onclick="displynummbr(btn3cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td><input type=button name="btn0cash" value=0 onclick="displynummbr(btn0cash.value)" class="btn btn-nahm btn-block"></td>
                                <td></td>
                                </tr>
                                <tr>
                                <td colspan="3"><input type=button name="clrbtn" value=clear onclick="displyclearmbr()" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td colspan="3">
                                <div class="text-center mt-4">
                                <button class="btn btn-nahm btn-block">Proses
                                </button>
                                </div>
                                </td>
                                </tr>
                                </table>
                                <!--/.numpad-->
                                </form>
                                </div>

                                </div>
                                <!--/.Panel 171-->
                                <!--/.Panel 172-->
                                <div class="tab-pane fade" id="paneltelmem" role="tabpanel">

                                <!--Body-->
                                <div class="modal-body text-center mb-1">
                                <script type="text/javascript">
                                function displynummbr1(n1)
                                {
                                calcformmbr1.txt1.value=calcformmbr1.txt1.value+n1;
                                }
                                function displyclearmbr1()
                                {
                                calcformmbr1.txt1.value="";
                                }
                                </script>
                                <form name="calcformmbr1" action="updateposmember.php" method="post">

                                <!--/.numpad-->
                                <table width="65%" align="center">
                                <tr>
                                <td colspan="3">
                                <input type="hidden" name="notrans" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                <input type="text" name="txt1" class="form-control ml-0"  placeholder="input no telepon member" value="">
                                </td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn7cash" value=7 onclick="displynummbr1(btn7cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn8cash" value=8 onclick="displynummbr1(btn8cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn9cash" value=9 onclick="displynummbr1(btn9cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn4cash" value=4 onclick="displynummbr1(btn4cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn5cash" value=5 onclick="displynummbr1(btn5cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn6cash" value=6 onclick="displynummbr1(btn6cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn1cash" value=1 onclick="displynummbr1(btn1cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn2cash" value=2 onclick="displynummbr1(btn2cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn3cash" value=3 onclick="displynummbr1(btn3cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td><input type=button name="btn0cash" value=0 onclick="displynummbr1(btn0cash.value)" class="btn btn-nahm btn-block"></td>
                                <td></td>
                                </tr>
                                <tr>
                                <td colspan="3"><input type=button name="clrbtn" value=clear onclick="displyclearmbr1()" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td colspan="3">
                                <div class="text-center mt-4">
                                <button class="btn btn-nahm btn-block">Proses
                                <i class="fa fa-sign-in ml-1"></i>
                                </button>
                                </div>
                                </td>
                                </tr>
                                </table>
                                <!--/.numpad-->
                                </form>
                                </div>
                                </div>
                                <!--/.Panel 172-->
                                </div>
                                </div>
                                </div>
                                <!--/.Content-->
                                </div>
                                </div>
                                <?php
                                if($grandtotalbill == 0)
                                {
                                ?>
                                <script>
                                function promotionalert() {
                                alert("ANDA BELUM MELAKUKAN TRANSAKSI");
                                }
                                </script>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="promotionalert()" style="padding-left: 0px;padding-right: 0px;">PROMOSI</a>
                                </div>
                                <?php
                                }
                                else
                                {
                                ?>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpromotion" style="padding-left: 0px;padding-right: 0px;">PROMOSI</a>
                                </div>
                                <!--Modal: payment-->
                                <div class="modal fade" id="modalpromotion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg cascading-modal" role="document">
                                <!--Content-->
                                <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                <li class="nav-item">
                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelpromotion" role="tab">PROMOSI</a>
                                </li>
                                </ul>

                                <!-- Tab panels -->
                                <div class="tab-content">
                                <!--Panel 17-->
                                <div class="tab-pane fade in show active" id="panelpromotion" role="tabpanel">

                                <!--Body-->
                                <div class="modal-body text-center mb-1">
                                <div class="row">
                                <div class="col-md-12">
                                <div class="row">  
                                <?php
                                include "koneksi.php";
                                $promotionprm=mysqli_query($koneksi,"SELECT * FROM promotion_h");
                                while($hpromotionprm = mysqli_fetch_array($promotionprm)) 
                                {
                                date_default_timezone_set('Asia/Jakarta');
                                $cekdatea=$hpromotionprm['datefrom'];
                                $cekdateb=$hpromotionprm['dateto'];
                                $cekdatec=date("Y-m-d");
                                $testdays=date("l");
                                if ($cekdatec>=$cekdatea AND $cekdatec<=$cekdateb)
                                {
                                $xtestdays=("Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday");
                                $prmtestdays=(explode(",",$xtestdays));
                                $countprmtestdays=array_search($testdays,$prmtestdays);
                                if($countprmtestdays!="")
                                {
                                $cektimea=$hpromotionprm['timefrom'];
                                $cektimeb=$hpromotionprm['timeto'];
                                $cektimec=date("H:i");
                                if ($cektimec>=$cektimea AND $cektimec<=$cektimeb)
                                {
                                ?>
                                <?php
                                if ($hpromotionprm['min_qty']=="none" AND $hpromotionprm['min_amount']=="none")
                                {
                                ?>
                                <div class="col-md-3">
                                <a href="addpromotion.php?transtempprm=<?php echo $transtempprm;?>&bill=<?php echo $prmbill;?>&promotionid=<?php echo $hpromotionprm['id_promotion'];?>" class="btn btn-nahm btn-block maxwidthheight"><?php echo $hpromotionprm['promotion_name'];?></a>
                                </div>
                                <?php
                                }
                                ?>
                                <?php
                                }
                                else
                                {
                                echo "";
                                }
                                }
                                else
                                {
                                echo "";
                                }
                                }
                                else
                                {
                                echo "";
                                }
                                }
                                ?>
                                </div>
                                </div>
                                </div>
                                </div>

                                </div>
                                <!--/.Panel 17-->
                                </div>

                                </div>
                                </div>
                                <!--/.Content-->
                                </div>
                                </div>
                                <?php
                                }
                                ?>
                                <!--Modal: PROMOTION-->
                                <!--START: OTHER PROMOTION-->
                                <!--END: OTHER PROMOTION-->
                                <!--start: void promotion-->
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpromotionvoid" style="padding-left: 0px;padding-right: 0px;">VOID PROMOSI</a>
                                </div>
                                <!--Modal: void payment-->
                                <div class="modal fade" id="modalpromotionvoid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog cascading-modal" role="document">
                                <!--Content-->
                                <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                <li class="nav-item">
                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">VOID PROMOSI</a>
                                </li>
                                </ul>

                                <!-- Tab panels -->
                                <div class="tab-content">
                                <!--Panel 17-->
                                <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

                                <!--Body-->
                                <div class="modal-body text-center mb-1">
                                <h5 class="mt-1 mb-2">PILIH PROMOSI YANG AKAN DI VOID</h5>
                                <div class="row scrollpage mh5">
                                <div class="col-md-12 nopadding">
                                <?php
                                include "koneksi.php";
                                $sqlvoidpromotion=mysqli_query($koneksi,"SELECT * FROM pos_promotion_h where notrans = '$transtempprm'");
                                while($hsqlvoidpromotion = mysqli_fetch_array($sqlvoidpromotion)) 
                                {
                                $idpromotionvoid=$hsqlvoidpromotion['id_promotion'];
                                $detvoidpromotion=mysqli_query($koneksi,"SELECT * FROM promotion_h where id_promotion = '$idpromotionvoid'");
                                $hdetvoidpromotion = mysqli_fetch_array($detvoidpromotion);
                                ?>
                                <a href="voidpromotion.php?transtempprm=<?php echo $transtempprm;?>&bill=<?php echo $prmbill;?>&promotionid=<?php echo $idpromotionvoid;?>" class="btn btn-nahm btn-block"><?php echo $hdetvoidpromotion['promotion_name'];?></a> 
                                <?php
                                }
                                ?>
                                </div>
                                </div>
                                </div>
                                <!--Body-->
                                </div>
                                <!--/.Panel 17-->
                                </div>

                                </div>
                                </div>
                                <!--/.Content-->
                                </div>
                                </div>
                                <!--end: void promotion-->
                                <!--Modal: member-->
                                <!--
                                <div class="col-md-12">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalredeem" style="padding-left: 0px;padding-right: 0px;">REDEEM</a>
                                </div>
                                <div class="modal fade" id="modalredeem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog cascading-modal" role="document">
                                <div class="modal-content">

                                <div class="modal-c-tabs">

                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                <li class="nav-item">
                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">REDEEM</a>
                                </li>
                                </ul>

                                <div class="tab-content">
                                <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

                                <div class="modal-body text-center mb-1">
                                <script type="text/javascript">
                                function displynumrdm(n1)
                                {
                                calcformrdm.txt1.value=calcformrdm.txt1.value+n1;
                                }
                                function displyclearrdm()
                                {
                                calcformrdm.txt1.value="";
                                }
                                </script>
                                <form name="calcformrdm" action="addpositemrdm.php" method="post">

                                <table width="65%" align="center">
                                <tr>
                                <td colspan="3">
                                <input type="hidden" name="notrans" value="<?php /*echo $transtempprm;*/?>" class="form-control ml-0">
                                <input type="text" name="txt1" class="form-control ml-0" placeholder="INPUT ATAU SCAN VOUCHER">
                                </td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn7cash" value=7 onclick="displynumrdm(btn7cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn8cash" value=8 onclick="displynumrdm(btn8cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn9cash" value=9 onclick="displynumrdm(btn9cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn4cash" value=4 onclick="displynumrdm(btn4cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn5cash" value=5 onclick="displynumrdm(btn5cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn6cash" value=6 onclick="displynumrdm(btn6cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn1cash" value=1 onclick="displynumrdm(btn1cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn2cash" value=2 onclick="displynumrdm(btn2cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn3cash" value=3 onclick="displynumrdm(btn3cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td><input type=button name="btn0cash" value=0 onclick="displynumrdm(btn0cash.value)" class="btn btn-nahm btn-block"></td>
                                <td></td>
                                </tr>
                                <tr>
                                <td colspan="3"><input type=button name="clrbtn" value=clear onclick="displyclearrdm()" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td colspan="3">
                                <div class="text-center mt-4">
                                <button class="btn btn-nahm btn-block">Proses
                                <i class="fa fa-sign-in ml-1"></i>
                                </button>
                                </div>
                                </td>
                                </tr>
                                </table>
                                </form>
                                </div>

                                </div>
                                </div>

                                </div>
                                </div>
                                </div>
                                </div>
                                -->
                                <?php
                                if($grandtotalbill == 0)
                                {
                                ?>
                                <script>
                                function paymentalert() {
                                alert("ANDA BELUM MELAKUKAN TRANSAKSI");
                                }
                                </script>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="paymentalert()" style="padding-left: 0px;padding-right: 0px;">PEMBAYARAN</a>
                                </div>
                                <?php
                                }
                                else
                                {
                                ?>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpayment" style="padding-left: 0px;padding-right: 0px;">PEMBAYARAN</a>
                                </div>
                                <!--Modal: payment-->
                                <div class="modal fade" id="modalpayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog cascading-modal" role="document">
                                <!--Content-->
                                <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                <li class="nav-item">
                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel17" role="tab">
                                <i class="fa fa-money mr-1"></i> <br>Cash</a>
                                </li>
                                <li class="nav-item">
                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel18" role="tab">
                                <i class="fa fa-cc-mastercard mr-1"></i><i class="fa fa-cc-visa mr-1"></i> <br>Kartu</a>
                                </li>
                                <li class="nav-item">
                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelvoucher" role="tab">
                                <i class="fa fa-cc-mastercard mr-1"></i><i class="fa fa-cc-visa mr-1"></i> <br>Voucher</a>
                                </li>
                                </ul>

                                <!-- Tab panels -->
                                <div class="tab-content">
                                <!--Panel 17-->
                                <div class="tab-pane fade in show active" id="panel17" role="tabpanel">

                                <!--Body-->
                                <div class="modal-body text-center mb-1">
                                <h5 class="mt-1 mb-2">Input Jumlah Pembayaran cash</h5>
                                <script type="text/javascript">
                                function displynumcash(n1)
                                {
                                calcformcash.txt1.value=calcformcash.txt1.value+n1;
                                }
                                function displyclearcash()
                                {
                                calcformcash.txt1.value="";
                                }
                                </script>
                                <form name="calcformcash" action="addpayment.php" method="post">

                                <!--/.numpad-->
                                <table width="65%" align="center">
                                <tr>
                                <td colspan="3">
                                <input type="hidden" name="notrans" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                <input type="hidden" name="bill" value="<?php echo $prmbill;?>" class="form-control ml-0">
                                <input type="hidden" name="jnspay" value="CASH" class="form-control ml-0">
                                <input type="hidden" name="jnscard" value="" class="form-control ml-0">
                                <input type="hidden" name="bank" value="" class="form-control ml-0">
                                <input type="hidden" name="num" value="" class="form-control ml-0">
                                <input type="text" name="txt1" class="form-control ml-0" placeholder="masukan jumlah bayar">
                                <input type="hidden" name="lastuser" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
                                <input type="hidden" name="lastmodify" value="<?php echo "".date("d-m-Y", $tanggal)."";?>" class="form-control ml-0">
                                </td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn7cash" value=7 onclick="displynumcash(btn7cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn8cash" value=8 onclick="displynumcash(btn8cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn9cash" value=9 onclick="displynumcash(btn9cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn4cash" value=4 onclick="displynumcash(btn4cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn5cash" value=5 onclick="displynumcash(btn5cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn6cash" value=6 onclick="displynumcash(btn6cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn1cash" value=1 onclick="displynumcash(btn1cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn2cash" value=2 onclick="displynumcash(btn2cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn3cash" value=3 onclick="displynumcash(btn3cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td><input type=button name="btn0cash" value=0 onclick="displynumcash(btn0cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn00cash" value=00 onclick="displynumcash(btn00cash.value)" class="btn btn-nahm btn-block"></td>
                                <td><input type=button name="btn000cash" value=000 onclick="displynumcash(btn000cash.value)" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td colspan="3"><input type=button name="clrbtn" value=clear onclick="displyclearcash()" class="btn btn-nahm btn-block"></td>
                                </tr>
                                <tr>
                                <td colspan="3">
                                <div class="text-center mt-4">
                                <button class="btn btn-nahm btn-block">Proses
                                <i class="fa fa-sign-in ml-1"></i>
                                </button>
                                </div>
                                </td>
                                </tr>
                                </table>
                                <!--/.numpad-->
                                </form>
                                </div>

                                </div>
                                <!--/.Panel 17-->

                                <!--Panel 18-->
                                <div class="tab-pane fade" id="panel18" role="tabpanel">

                                <!--Body-->
                                <div class="modal-body text-center mb-1">
                                <h5 class="mt-1 mb-2">Input Jumlah Pembayaran Kartu</h5>
                                <script type="text/javascript">
                                function displynumcard(n1)
                                {
                                calcformcard.txt1.value=calcformcard.txt1.value+n1;
                                }
                                function displyclearcard()
                                {
                                calcformcard.txt1.value="";
                                }
                                </script>
                                <form name="calcformcard" action="addpayment.php" method="post">

                                <!--/.numpad-->
                                <table width="65%" align="center">
                                <tr>
                                <td colspan="3">
                                <input type="hidden" name="notrans" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                <input type="hidden" name="bill" value="<?php echo $prmbill;?>" class="form-control ml-0">
                                <input type="hidden" name="jnspay" value="CARD" class="form-control ml-0">
                                <input type="hidden" name="num" value="" class="form-control ml-0">
                                <select class="form-control" name="jnscard" required>
                                <option value="" disabled selected>Pilih Jenis Kartu</option>
                                <option value="DEBIT">DEBIT</option>
                                <option value="VISA">VISA</option>
                                <option value="MASTER">MASTER</option>
                                </select>
                                <select class="form-control" name="bank" required>
                                <option value="" disabled selected>Pilih Bank</option>
                                <option value="BCA">BCA</option>
                                <option value="MANDIRI">MANDIRI</option>
                                <option value="OTHER">OTHER</option>
                                </select>
                                <input type="text" name="txt1" class="form-control ml-0" placeholder="masukan jumlah bayar" value="<?php echo $sisabayar;?>" required>
                                <input type="hidden" name="lastuser" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
                                <input type="hidden" name="lastmodify" value="<?php echo "".date("d-m-Y", $tanggal)."";?>" class="form-control ml-0">
                                </td>
                                </tr>
                                <tr>
                                <td colspan="3">
                                <div class="text-center mt-4">
                                <button class="btn btn-nahm btn-block">Proses
                                <i class="fa fa-sign-in ml-1"></i>
                                </button>
                                </div>
                                </td>
                                </tr>
                                </table>
                                <!--/.numpad-->
                                </form>
                                </div>
                                </div>
                                <!--/.Panel 18-->
                                <!--Panel 19-->
                                <div class="tab-pane fade" id="panelvoucher" role="tabpanel">

                                <!--Body-->
                                    <div class="modal-body text-center mb-1">
                                                <h5 class="mt-1 mb-2">Input nomor voucher</h5>
                                                <script type="text/javascript">
                                                function displynumvoucher(n1)
                                                {
                                                    calcformvoucher.num.value=calcformvoucher.num.value+n1;
                                                }
                                                function displyclearvoucher()
                                                {
                                                    calcformvoucher.num.value="";
                                                }
                                                </script>
                                                <form name="calcformvoucher" action="addpaymentvoucher.php" method="post">

                                                <!--/.numpad-->
                                                <table width="65%" align="center">
                                                    <tr>
                                                    <td colspan="3">
                                                    <input type="hidden" name="notrans" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
                                                    <input type="hidden" name="jnspay" value="VOUCHER" class="form-control ml-0">
                                                    <input type="hidden" name="jnscard" value="" class="form-control ml-0">
                                                    <input type="hidden" name="bank" value="" class="form-control ml-0">
                                                    <input type="hidden" name="txt1" value="" class="form-control ml-0">
                                                    <input type="text" name="num" class="form-control ml-0" placeholder="masukan nomor voucher">
                                                    <input type="hidden" name="lastuser" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
                                                    <input type="hidden" name="lastmodify" value="<?php echo "".date("d-m-Y", $tanggal)."";?>" class="form-control ml-0">
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type=button name="btn7voucher" value=7 onclick="displynumvoucher(btn7voucher.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn8voucher" value=8 onclick="displynumvoucher(btn8voucher.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn9voucher" value=9 onclick="displynumvoucher(btn9voucher.value)" class="btn btn-nahm btn-block"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type=button name="btn4voucher" value=4 onclick="displynumvoucher(btn4voucher.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn5voucher" value=5 onclick="displynumvoucher(btn5voucher.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn6voucher" value=6 onclick="displynumvoucher(btn6voucher.value)" class="btn btn-nahm btn-block"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type=button name="btn1voucher" value=1 onclick="displynumvoucher(btn1voucher.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn2voucher" value=2 onclick="displynumvoucher(btn2voucher.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn3voucher" value=3 onclick="displynumvoucher(btn3voucher.value)" class="btn btn-nahm btn-block"></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><input type=button name="btn0voucher" value=0 onclick="displynumvoucher(btn0voucher.value)" class="btn btn-nahm btn-block"></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"><input type=button name="clrbtn" value=clear onclick="displyclearvoucher()" class="btn btn-nahm btn-block"></td>
                                                    </tr>
                                                    <tr>
                                                    <td colspan="3">
                                                    <div class="text-center mt-4">
                                                        <button class="btn btn-nahm btn-block">Proses
                                                            <i class="fa fa-sign-in ml-1"></i>
                                                        </button>
                                                    </div>
                                                    </td>
                                                    </tr>
                                                </table>
                                                <!--/.numpad-->
                                                </form>
                                            </div>
                                </div>
                                <!--/.Panel 19-->
                                </div>

                                </div>
                                </div>
                                <!--/.Content-->
                                </div>
                                </div>
                                <?php
                                }
                                ?>
                                <!--Modal: payment-->
                                <?php
                                if($grandtotalbill == 0)
                                {
                                ?>
                                <script>
                                function paymentalert() {
                                alert("ANDA BELUM MELAKUKAN TRANSAKSI");
                                }
                                </script>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="paymentalert()" style="padding-left: 0px;padding-right: 0px;">PEMBAYARAN LAIN-LAIN</a>
                                </div>
                                <?php
                                }
                                else
                                {
                                ?>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalotherpayment" style="padding-left: 0px;padding-right: 0px;">PEMBAYARAN LAIN-LAIN</a>
                                </div>
                                <!--Modal: payment-->
                                <div class="modal fade" id="modalotherpayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg cascading-modal" role="document">
                                <!--Content-->
                                <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                <li class="nav-item">
                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelothetpay" role="tab">PEMBAYARAN LAIN-LAIN</a>
                                </li>
                                </ul>

                                <!-- Tab panels -->
                                <div class="tab-content">
                                <!--Panel 17-->
                                <div class="tab-pane fade in show active" id="panelothetpay" role="tabpanel">

                                <!--Body-->
                                <div class="modal-body text-center mb-1">
                                </script>
                                <div class="row">
                                <?php
                                include "koneksi.php";
                                $paymentprm=mysqli_query($koneksi,"SELECT * FROM pos_other_payment_prm");
                                while($hpaymentprm = mysqli_fetch_array($paymentprm)) 
                                {
                                ?>
                                <?php
                                $idotherpay=$hpaymentprm['id_other_payment'];
                                $namaotherpay=$hpaymentprm['nama_other_payment'];
                                $jumlahotherpay=$hpaymentprm['jumlah_other_payment'];
                                ?>
                                <div class="col-md-3">
                                <a href="addotherpayment.php?transtempprm=<?php echo $transtempprm;?>&jnspay=<?php echo $idotherpay;?>&jml=<?php echo $jumlahotherpay;?>&lastuser=<?php echo $_SESSION['iduser'];?>&lastmodify=<?php echo "".date("d-m-Y", $tanggal)."";?>&bill=<?php echo $prmbill;?>" class="btn btn-nahm btn-block"><?php echo $namaotherpay;?></a>
                                </div>
                                <?php
                                }
                                ?>
                                </div>
                                </div>

                                </div>
                                <!--/.Panel 17-->
                                </div>

                                </div>
                                </div>
                                <!--/.Content-->
                                </div>
                                </div>
                                <?php
                                }
                                ?>
                                <!--Modal: other payment-->
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpaymentvoid" style="padding-left: 0px;padding-right: 0px;">VOID PEMBAYARAN</a>
                                </div>
                                <!--Modal: void payment-->
                                <div class="modal fade" id="modalpaymentvoid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog cascading-modal" role="document">
                                <!--Content-->
                                <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                <li class="nav-item">
                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">VOID PEMBAYARAN</a>
                                </li>
                                </ul>

                                <!-- Tab panels -->
                                <div class="tab-content">
                                <!--Panel 17-->
                                <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

                                <!--Body-->
                                <div class="modal-body text-center mb-1">
                                <h5 class="mt-1 mb-2">PILIH PEMBAYARAN YANG AKAN DI VOID</h5>
                                <div class="row scrollpage mh5">
                                <div class="col-md-12 nopadding">
                                <?php
                                include "koneksi.php";
                                $pospaymenttemp=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where NoTrans = '$transtempprm' AND bill = '$prmbill'");
                                while($hpospaymenttemp = mysqli_fetch_array($pospaymenttemp)) 
                                {
                                $paytype=$hpospaymenttemp['JnsTrans'];
                                $jpay=$hpospaymenttemp['Jumlah'];
                                ?>
                                <?php
                                if ($paytype!='CASH' AND $paytype!='CARD' AND $paytype!='VOUCHER' AND $paytype!='EVOUCHER')
                                    {
                                        $cekvoidpayment=mysqli_query($koneksi,"SELECT * FROM pos_other_payment_prm where id_other_payment = '$paytype'");
                                        $hcekvoidpayment= mysqli_fetch_array($cekvoidpayment);
                                    ?>
                                    <a href="hapuspospaymenttemp.php?transtempprm=<?php echo $transtempprm;?>&paytype=<?php echo $paytype;?>&jpay=<?php echo $jpay;?>&bill=<?php echo $prmbill;?>" class="btn btn-nahm btn-block"><?php echo $hcekotherpayment['nama_other_payment'];?> : Rp <?php echo $hpospaymenttemp['Jumlah'];?></a>
                                    <?php
                                    }
                                else
                                    {
                                    ?>
                                    <a href="hapuspospaymenttemp.php?transtempprm=<?php echo $transtempprm;?>&paytype=<?php echo $paytype;?>&jpay=<?php echo $jpay;?>&bill=<?php echo $prmbill;?>" class="btn btn-nahm btn-block"><?php echo $paytype;?> : Rp <?php echo $hpospaymenttemp['Jumlah'];?></a>
                                    <?php
                                    }
                                }
                                ?>
                                </div>
                                </div>
                                </div>
                                <!--Body-->
                                </div>
                                <!--/.Panel 17-->
                                </div>

                                </div>
                                </div>
                                <!--/.Content-->
                                </div>
                                </div>
                                <!--Modal: void payment-->
                                <?php
                                if($grandtotalbill == "")
                                {
                                ?>
                                <script>
                                function tutuptransaksi() 
                                {
                                alert("ANDA BELUM MELAKUKAN TRANSAKSI");
                                }
                                </script>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="tutuptransaksi()" style="padding-left: 0px;padding-right: 0px;">PROSES PEMBAYARAN</a>
                                </div>
                                <?php
                                }
                                elseif($grandtotalbill > $payment)
                                {
                                ?>
                                <script>
                                function tutuptransaksi1() 
                                {
                                alert("PEMBAYARAN KURANG");
                                }
                                </script>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="tutuptransaksi1()" style="padding-left: 0px;padding-right: 0px;">PROSES PEMBAYARAN</a>
                                </div>
                                <?php
                                }
                                else
                                {
                                ?>
                                <div class="col-md-3 nopadding">
                                <a href="savetransaction.php?usr=<?php echo $usrpay;?>&notranstemp=<?php echo $transtemp;?>&date=<?php echo $datepay;?>&time=<?php echo $timepay;?>&outlet=<?php echo $outletpay;?>&gt=<?php echo $prmsubtotal;?>&gttax=<?php echo $gttax;?>&finalgt=<?php echo $grandtotalbill;?>&jumbay=<?php echo $jb;?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">PROSES PEMBAYARAN</a>
                                </div>
                                <?php
                                }
                                ?>
                                <!--split bill
                                <div class="col-md-3 nopadding">
                                <a href="tambahbill.php?transtempprm=<?php echo $transtempprm;?>" class="btn btn-nahm btn-block maxwidthheight" onclick="return confirm('Apakah anda yakin akan menambah bill dalam transaksi ini?')">TAMBAH BILL</a>
                                </div>
                                <?php
                                if($billx1<2)
                                {
                                ?>
                                <?php
                                }
                                else
                                {
                                ?>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpindahitemkebilllain">PINDAH ITEM KE BILL LAIN</a>
                                    <div class="modal fade" id="modalpindahitemkebilllain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog cascading-modal" role="document">
                                        <div class="modal-content">
                                        <div class="modal-c-tabs">
                                        <ul class="nav nav-tabs tabs-2" role="tablist">
                                        <li class="nav-item">
                                        <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">PINDAH ITEM</a>
                                        </li>
                                        </ul>
                                        <form action="order/voidorderproses.php" method="post">
                                        <div class="tab-content">
                                        <div class="tab-pane fade in show active" id="panel171" role="tabpanel">
                                        <div class="modal-body mb-1">
                                        <h5 class="mt-1 mb-2 text-center">PILIH ITEM YANG AKAN DI PINDAH KE BILL LAIN</h5>
                                        <input type="hidden" name ="prmvoid" value="<?php echo $transtempprm;?>" style="width: 100%;">
                                        <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-8" style="padding: 3px;margin: 0px;"><strong>NAMA MENU</strong></div>
                                        <div class="col-4" style="padding: 3px;margin: 0px;"><strong>JUMLAH</strong></div>
                                        </div>
                                        <?php
                                        include "koneksi.php";
                                        $sqlplu=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtemp'group by kditem");
                                        while($hsqlplu = mysqli_fetch_array($sqlplu)) 
                                        {
                                        $qtycek=$hsqlplu['kditem'];
                                        $maxqtyvoid=$hsqlplu['qty'];
                                        $fetchitem = "SELECT * FROM pos_item WHERE kditem = '$qtycek'";
                                        $resultfetchitem = mysqli_query($koneksi,$fetchitem) or die (mysqli_error());
                                        $hresultfetchitem= mysqli_fetch_array($resultfetchitem);
                                        ?>
                                        <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-8" style="padding: 3px;margin: 0px;"><strong><?php echo $hresultfetchitem['nmitem'];?></strong></div>
                                        <div class="col-4" style="padding: 3px;margin: 0px;"><input type="number" name ="<?php echo $hresultfetchitem['kditem'];?>" value="" style="width: 100%;" min="0" max="<?php echo $maxqtyvoid;?>"></div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-12" style="padding: 3px;margin: 0px;"><button class="btn btn-nahm btn-block" type="submit" id="btnputorder">PROSES PINDAH ITEM</button></div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </form>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 nopadding">
                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalhapusbill">HAPUS BILL</a>
                                <div class="modal fade" id="modalhapusbill" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog cascading-modal" role="document">
                                        <div class="modal-content">
                                        <div class="modal-c-tabs">
                                        <ul class="nav nav-tabs tabs-2" role="tablist">
                                        <li class="nav-item">
                                        <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">PINDAH ITEM</a>
                                        </li>
                                        </ul>
                                        <form action="order/voidorderproses.php" method="post">
                                        <div class="tab-content">
                                        <div class="tab-pane fade in show active" id="panel171" role="tabpanel">
                                        <div class="modal-body mb-1">
                                        <h5 class="mt-1 mb-2 text-center">PILIH ITEM YANG AKAN DI PINDAH KE BILL LAIN</h5>
                                        <input type="hidden" name ="prmvoid" value="<?php echo $transtempprm;?>" style="width: 100%;">
                                        <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-8" style="padding: 3px;margin: 0px;"><strong>NAMA MENU</strong></div>
                                        <div class="col-4" style="padding: 3px;margin: 0px;"><strong>JUMLAH</strong></div>
                                        </div>
                                        <?php
                                        include "koneksi.php";
                                        $sqlplu=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtemp'");
                                        while($hsqlplu = mysqli_fetch_array($sqlplu)) 
                                        {
                                        $qtycek=$hsqlplu['kditem'];
                                        $maxqtyvoid=$hsqlplu['qty'];
                                        $fetchitem = "SELECT * FROM pos_item WHERE kditem = '$qtycek'";
                                        $resultfetchitem = mysqli_query($koneksi,$fetchitem) or die (mysqli_error());
                                        $hresultfetchitem= mysqli_fetch_array($resultfetchitem);
                                        ?>
                                        <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-8" style="padding: 3px;margin: 0px;"><strong><?php echo $hresultfetchitem['nmitem'];?> (<?php echo $maxqtyvoid;?>)</strong></div>
                                        <div class="col-4" style="padding: 3px;margin: 0px;"><input type="number" name ="<?php echo $hresultfetchitem['kditem'];?>" value="" style="width: 100%;" min="0" max="<?php echo $maxqtyvoid;?>"></div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-12" style="padding: 3px;margin: 0px;"><button class="btn btn-nahm btn-block" type="submit" id="btnputorder">PROSES PINDAH ITEM</button></div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                -->
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="card" style="background-color: #ffffff;color: #fff;">
                        <div class="card-header" style="background-color: #8c0000;color: #fff;">
                        <h5 class="text-center mb-0">SUB MENU</h5>
                        </div>
                        <div class="card-body" style="padding: 0px;">
                            <div class="row" style="margin: 0px;padding: 0px;">
                                <div class="col-md-3 nopadding">
                                <a href="keluar.php" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">LOGOUT</a>
                                </div>
                                <div class="col-md-3 nopadding">
                                <a href="tutupposkasir.php?iduser=<?php echo $usrpay;?>&idterminal=<?php echo $idterminal;?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">TUTUP POS KASIR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php }
?>
</div>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script>
    $(function () {
        $('.button-checkbox').each(function () {

            // Settings
            var $widget = $(this),
                $button = $widget.find('button'),
                $checkbox = $widget.find('input:checkbox'),
                color = $button.data('color'),
                settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
                };

            // Event Handlers
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });

            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');

                // Set the button's state
                $button.data('state', (isChecked) ? "on" : "off");

                // Set the button's icon
                $button.find('.state-icon')
                    .removeClass()
                    .addClass('state-icon ' + settings[$button.data('state')].icon);

                // Update the button's color
                if (isChecked) {
                    $button
                        .removeClass('btn-default')
                        .addClass('btn-' + color + ' active');
                }
                else {
                    $button
                        .removeClass('btn-' + color + ' active')
                        .addClass('btn-default');
                }
            }

            // Initialization
            function init() {

                updateDisplay();

                // Inject the icon if applicable
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                }
            }
            init();
        });
    });
    </script>
    <script>
    function positem1() {
        document.getElementById("item0").style.display = "none";
        document.getElementById("item1").style.display = "block";
        document.getElementById("item2").style.display = "none";
        document.getElementById("item3").style.display = "none";
        document.getElementById("item4").style.display = "none";
        document.getElementById("item5").style.display = "none";
        document.getElementById("item6").style.display = "none";
    }
    function positem2() {
        document.getElementById("item0").style.display = "none";
        document.getElementById("item1").style.display = "none";
        document.getElementById("item2").style.display = "block";
        document.getElementById("item3").style.display = "none";
        document.getElementById("item4").style.display = "none";
        document.getElementById("item5").style.display = "none";
        document.getElementById("item6").style.display = "none";
    }
    function positem3() {
        document.getElementById("item0").style.display = "none";
        document.getElementById("item1").style.display = "none";
        document.getElementById("item2").style.display = "none";
        document.getElementById("item3").style.display = "block";
        document.getElementById("item4").style.display = "none";
        document.getElementById("item5").style.display = "none";
        document.getElementById("item6").style.display = "none";
    }
    function positem4() {
        document.getElementById("item0").style.display = "none";
        document.getElementById("item1").style.display = "none";
        document.getElementById("item2").style.display = "none";
        document.getElementById("item3").style.display = "none";
        document.getElementById("item4").style.display = "block";
        document.getElementById("item5").style.display = "none";
        document.getElementById("item6").style.display = "none";
    }
    function positem5() {
        document.getElementById("item0").style.display = "none";
        document.getElementById("item1").style.display = "none";
        document.getElementById("item2").style.display = "none";
        document.getElementById("item3").style.display = "none";
        document.getElementById("item4").style.display = "none";
        document.getElementById("item5").style.display = "block";
        document.getElementById("item6").style.display = "none";
    }
    function positem6() {
        document.getElementById("item0").style.display = "none";
        document.getElementById("item1").style.display = "none";
        document.getElementById("item2").style.display = "none";
        document.getElementById("item3").style.display = "none";
        document.getElementById("item4").style.display = "none";
        document.getElementById("item5").style.display = "none";
        document.getElementById("item6").style.display = "block";
    }
    </script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="ajax.js"></script>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script>
    //doughnut
    var ctxD = document.getElementById("doughnutChart").getContext('2d');
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
            datasets: [
                {
                    data: [300, 50, 100, 40, 120],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                }
            ]
        },
        options: {
            responsive: true
        }    
    });
    </script>
    <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    </script>
</body>

</html>
<?php }?>