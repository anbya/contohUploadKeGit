<?php 
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
$nmusrpos=$_SESSION['namausernahmpos'];
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <!-- MDBootstrap Datatables  -->
    <link href="css/addons/datatables.min.css" rel="stylesheet">
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
    .scrollpageall
    {
    overflow-x: scroll;
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

<body>
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
        <div class="col-md-6">
            <h4 style="font-weight: bold;">POS SYSTEM</h4>
        </div>
        <div class="col-md-3 nopadding">
            <h4 style="font-weight: bold;"></h4>
        </div>
        <?php
        $ceknamauser=mysqli_query($koneksi,"SELECT * FROM user where id_user = '$usrpay'");
        $hceknamauser = mysqli_fetch_array($ceknamauser);
        ?>
        <div class="col-md-3">
            <h4 style="font-weight: bold;text-align: right;"><?php echo $hceknamauser['nama_user'];?></h4>
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
                                    <a style="font-size: 2.5vh;"><b>TOTAL BILL</b></a>
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
                                    <a style="font-size: 2.5vh;"><b>SUBTOTAL BILL</b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-4" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>Rp. <?php echo number_format("$subtotalbill");?></b></a>
                                </div>
                            </div>
                            <?php
                            $addpayprm=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$transtempprm'");
                        	$haddpayprm = mysqli_fetch_array($addpayprm);
                        	if($haddpayprm['service_charge']>0)
                        	{
                            $servicecharge=$haddpayprm['service_charge'];
                            $taxbill=$haddpayprm['tax'];
                            ?>
                            <div class="row">
                                <div class="col-7">
                                    <a style="font-size: 2vh;"><b>SERVICE CHARGE</b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-4" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2vh;"><b>Rp. <?php echo number_format("$servicecharge");?></b></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <a style="font-size: 2vh;"><b>TAX BILL</b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-4" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2vh;"><b>Rp. <?php echo number_format("$taxbill");?></b></a>
                                </div>
                            </div>
                            <?php
                        	}
                        	else
                        	{
                            $servicecharge=$haddpayprm['service_charge'];
                            $taxbill=$haddpayprm['tax'];
                            ?>
                            <div class="row">
                                <div class="col-7">
                                    <a style="font-size: 2vh;"><b>TAX BILL</b></a>
                                </div>
                                <div class="col-1" style="border-bottom: solid;">
                                    <a style="font-size: 2.5vh;"><b>:</b></a>
                                </div>
                                <div class="col-4" style="text-align: right;border-bottom: solid;">
                                    <a style="font-size: 2vh;"><b>Rp. <?php echo number_format("$taxbill");?></b></a>
                                </div>
                            </div>
                            <?php
                        	}
                        	?>
                            <?php
                            $grandtotalbill=$subtotalbill+$taxbill+$servicecharge;
                            ?>
                            <div class="row">
                                <div class="col-7">
                                    <a style="font-size: 2.5vh;"><b>GRAND TOTAL BILL</b></a>
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
                                <div class="row">
                                    <div class="col-6">
                                        <a style="font-size: 2vh;"><?php echo $hpaytype['JnsCard'];?></a>
                                    </div>
                                    <div class="col-1">
                                        <a style="font-size: 2vh;">:</a>
                                    </div>
                                    <div class="col-5" style="text-align: right;">
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
                                $cekpembayaran=mysqli_query($koneksi,"SELECT sum(jumlah) as totaljumpay FROM pos_paymenttemp where NoTrans = '$transtempprm' and JnsTrans != 'CASH' and JnsTrans != 'CARD' ");
                                $rcekpembayaran = mysqli_num_rows($cekpembayaran);
                                $hcekpembayaran = mysqli_fetch_array($cekpembayaran);
                                $ceknonchange=$hcekpembayaran['totaljumpay']-$grandtotalbill;
                                if($ceknonchange>=0)
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
                                $sqlpaidstatus = "SELECT * FROM pos_salestemp where notrans ='$transtempprm'";
                                $resultsqlpaidstatus = mysqli_query($koneksi,$sqlpaidstatus) or die (mysqli_error());
                                $hsqlpaidstatus= mysqli_fetch_array($resultsqlpaidstatus);
                                if($hsqlpaidstatus['status']=="OPEN"){?>
                                <h2 style="text-align: center;font-weight: bold;color: #ff0000;">UNPAID</h2>
                                <?php
                                }
                                elseif($hsqlpaidstatus['status']=="CLOSED"){?>
                                <h2 style="text-align: center;font-weight: bold;color: #00d820;">PAID</h2>
                                <?php
                                }
                                elseif($hsqlpaidstatus['status']=="CANCELED"){?>
                                <h2 style="text-align: center;font-weight: bold;color: #00d820;">CANCELED</h2>
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
										                            <div class="col-4" style="padding: 3px;margin: 0px;">
										                                <label class="containercheckbox"><?php echo $hviewpostable1['nama_table'];?>
										                                  <input type="checkbox" id="<?php echo $hviewpostable1['id_table'];?>" name = "table[]" value="<?php echo $hviewpostable1['id_table'];?>" <?php echo $discheck1;?>>
										                                  <span class="checkmark"></span>
										                                </label>
										                            </div>
										                        <?php
										                        }
										                        ?>
										                            <div class="col-12" style="padding: 3px;margin: 0px;">
										                                <label class="containercheckbox">TAKE AWAY
										                                  <input type="checkbox" id="takeaway" name = "table[]" value="takeaway">
										                                  <span class="checkmark"></span>
										                                </label>
										                            </div>
                                                                </div>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-8" style="padding: 3px;margin: 0px;"><strong>JUMLAH CUSTOMER</strong></div>
                                                                    <div class="col-4" style="padding: 3px;margin: 0px;">
                                                                    	<button type="button" onclick="min('jumcust')"><b>-</b></button>
																		<input type="text" id="jumcust" name ="jumcust" value="0" style="width: 40%;text-align:center;">
																		<button type="button" onclick="plus('jumcust',999)"><b>+</b></button>
                                                                    </div>
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
                                                <div class="modal-dialog modal-lg cascading-modal" role="document">
                                                <!--Content-->
                                                <div class="modal-content">

                                                <!--Modal cascading tabs-->
                                                <div class="modal-c-tabs">

                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                                <li class="nav-item">
                                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelbukatransdinein" role="tab">DINE IN</a>
                                                </li>
                                                <li class="nav-item">
                                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelbukatranstakeaway" role="tab">TAKE AWAY</a>
                                                </li>
                                                </ul>

                                                <!-- Tab panels -->
                                                <div class="tab-content">
                                                <!--Panel 17-->
                                                <div class="tab-pane fade in show active" id="panelbukatransdinein" role="tabpanel">

	                                                <!--Body-->
	                                                <div class="modal-body scrollpage mh3 mb-1">
	                                                	<h5 style="text-align: center;">PILIH TRANSAKSI YANG AKAN DI BUKA</h5>
		                                                <div class="row nopadding">
			                                                <?php
			                                                include "koneksi.php";
			                                                $postemp=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where status = 'OPEN' and meja !='takeaway' ");
			                                                while($hpostemp = mysqli_fetch_array($postemp)) 
			                                                {
			                                                $opentrans=$hpostemp['notrans'];
			                                                $tabletrans=$hpostemp['meja'];
			                                                /*pos table*/
			                                                if($tabletrans!="takeaway")
			                                                {
			                                                $viewpostable1=mysqli_query($koneksi,"SELECT * FROM pos_table where notrans = '$opentrans' ");
			                                                $hviewpostable1 = mysqli_fetch_array($viewpostable1);
			                                                $namatable=$hviewpostable1['nama_table'];
			                                            	}
			                                            	else
			                                            	{
			                                            	$namatable=$tabletrans;
			                                            	}
			                                                /*pos table*/
			                                                ?>
			                                                <div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
			                                                <a><?php echo $namatable;?></a>
			                                                </div>
			                                                <div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
			                                                <a><?php echo $hpostemp['notrans'];?></a>
			                                                </div>
			                                                <div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
			                                                <a><?php echo number_format($hpostemp['gross_sales']);?></a>
			                                                </div>
			                                                <div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
			                                                <a href="index.php?transtempprm=<?php echo $opentrans;?>" class="btn btn-nahm btn-block maxwidthheight">PILIH TRANSAKSI INI</a>
			                                                </div>
			                                                <?php
			                                                }
			                                                ?>
		                                                </div>
	                                                </div>
	                                                <!--Body-->
                                                </div>
                                                <!--/.Panel 17-->
                                                <!--Panel 17-->
                                                <div class="tab-pane fade in" id="panelbukatranstakeaway" role="tabpanel">

	                                                <!--Body-->
	                                                <div class="modal-body scrollpage mh3 mb-1">
	                                                	<h5 style="text-align: center;">PILIH TRANSAKSI YANG AKAN DI BUKA</h5>
		                                                <div class="row nopadding">
			                                                <?php
			                                                include "koneksi.php";
			                                                $postemp=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where status = 'OPEN' and meja ='takeaway' ");
			                                                while($hpostemp = mysqli_fetch_array($postemp)) 
			                                                {
			                                                $opentrans=$hpostemp['notrans'];
			                                                $tabletrans=$hpostemp['meja'];
			                                                /*pos table*/
			                                                if($tabletrans!="takeaway")
			                                                {
			                                                $viewpostable1=mysqli_query($koneksi,"SELECT * FROM pos_table where notrans = '$opentrans' ");
			                                                $hviewpostable1 = mysqli_fetch_array($viewpostable1);
			                                                $namatable=$hviewpostable1['nama_table'];
			                                            	}
			                                            	else
			                                            	{
			                                            	$namatable=$tabletrans;
			                                            	}
			                                                /*pos table*/
			                                                ?>
			                                                <div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
			                                                <a><?php echo $namatable;?></a>
			                                                </div>
			                                                <div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
			                                                <a><?php echo $hpostemp['notrans'];?></a>
			                                                </div>
			                                                <div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
			                                                <a><?php echo number_format($hpostemp['gross_sales']);?></a>
			                                                </div>
			                                                <div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
			                                                <a href="index.php?transtempprm=<?php echo $opentrans;?>" class="btn btn-nahm btn-block maxwidthheight">PILIH TRANSAKSI INI</a>
			                                                </div>
			                                                <?php
			                                                }
			                                                ?>
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
                                    $salesstatus=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans ='$transtempprm'");
                        			$hsalesstatus = mysqli_fetch_array($salesstatus);
                        			?>
                        			<?php
                        			if($hsalesstatus['status']=="OPEN")
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
                                                                                <div class="row scrollpage mh6">
                                                                                <input type="hidden" name="notrans" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                                                                    <?php
                                                                                    $prmtable = "SELECT * FROM pos_table order by id_table ASC";
                                                                                    $resultprmtable = mysqli_query($koneksi,$prmtable) or die (mysqli_error());
                                                                                    while($hresultprmtable= mysqli_fetch_array($resultprmtable))
                                                                                    {
                                                                                    ?>
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
                                                                                        <div class="col-4" style="padding: 3px;margin: 0px;">
															                                <label class="containercheckbox"><?php echo $hresulttabelcek1['nama_table'];?>
															                                  <input type="checkbox" id="<?php echo $hresulttabelcek1['id_table'];?>" name = "table[]" value="<?php echo $hresulttabelcek1['id_table'];?>" <?php echo $discheck1;?>>
															                                  <span class="checkmark"></span>
															                                </label>
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
                                                   <a href="bataltrans.php?usr=<?php echo $usrpay;?>&transtemp=<?php echo $transtempprm;?>" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalcanceltrans" style="padding-left: 0px;padding-right: 0px;">BATALKAN TRANSAKSI</a>
                                            </div>
                                            <div class="modal fade" id="modalcanceltrans" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                                               <div class="modal-dialog cascading-modal modal-lg" role="document">
	                                                      <!--Content-->
	                                                      <div class="modal-content">

	                                                             <!--Modal cascading tabs-->
	                                                             <div class="modal-c-tabs">

	                                                             <!-- Nav tabs -->
	                                                             <ul class="nav nav-tabs tabs-2" role="tablist">
	                                                             <li class="nav-item">
	                                                             <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">BATALKAN TRANSAKSI</a>
	                                                             </li>
	                                                             </ul>

	                                                             <!-- Tab panels -->
	                                                             <div class="tab-content">
	                                                                    <!--Panel 17-->
	                                                                    <div class="tab-pane fade in show active" id="panel171" role="tabpanel">
	                                                                           <!--Body-->
	                                                                           <div class="modal-body text-center mb-1">
	                                                                           <h5 class="mt-1 mb-2">PILIH ALASAN PEMBATALAN</h5>
	                                                                           <form action="bataltrans.php" method="POST">
	                                                                                <div class="row">
                                                                    					<input type="hidden" name ="transtemp" value="<?php echo $transtempprm;?>" style="width: 100%;">
                                                                    					<input type="hidden" name ="usr" value="<?php echo $usrpay;?>" style="width: 100%;">
				                                                                        <div class="col-12" style="padding: 3px;margin: 0px;">
				                                                                            <select class="form-control" name="cancelremarks" required>
				                                                                            <option value="" disabled selected>PILIH ALASAN PEMBATALAN</option>
				                                                                            <option value="PERMINTAAN CUSTOMER">PERMINTAAN CUSTOMER</option>
				                                                                            </select>
				                                                                        </div>
				                                                                        <button class="btn btn-nahm btn-block" type= "submit">Proses</button>
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
                        			elseif($hsalesstatus['status']=="CLOSED")
                                    {
                                    ?>
                                	<div class="row" style="margin: 0px;padding: 0px;">
									    <div class="col-12" style="padding: 0px;margin: 0px;">
                                        <a href="index.php" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">KEMBALI KE LAYAR UTAMA</a>
                                        </div>
									</div>
                                	<?php
                                	}
                        			elseif($hsalesstatus['status']=="CANCELED")
                                    {
                                    ?>
                                	<div class="row" style="margin: 0px;padding: 0px;">
									    <div class="col-12" style="padding: 0px;margin: 0px;">
                                        <a href="index.php" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">KEMBALI KE LAYAR UTAMA</a>
                                        </div>
									</div>
                                	<?php
                                	}
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
                    $submenustatus=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans ='$transtempprm'");
                    $hsubmenustatus = mysqli_fetch_array($submenustatus);
                    ?>
                    	<?php
                    	if($hsubmenustatus['status']=="OPEN")
	                    {
	                    ?>
	                    <div class="card" style="background-color: #ffffff;">
	                        <div class="card-header" style="background-color: #8c0000;color: #fff;">
	                        <h5 class="text-center mb-0">SUB MENU</h5>
	                        </div>
	                        <div class="card-body" style="padding: 0px;">
	                            <div class="row" style="margin: 0px;padding: 0px;">
	                                    <div class="col-md-3 nopadding">
	                                    <a href="tambahitem.php?transtempprm=<?php echo $transtempprm?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">TAMBAH ORDER</a>
	                                    </div>
	                                    <div class="col-md-3 nopadding">
	                                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalcetakorder" style="padding-left: 0px;padding-right: 0px;">CETAK ORDER</a>
	                                    </div>
	                                    <!--Modal: cetakorder-->
	                                        <div class="modal fade active" id="modalcetakorder" tabindex="-1" role="dialog" aria-labelledby="modalcetakorder" aria-hidden="true">
	                                            <div class="modal-dialog cascading-modal" role="document">
	                                                <!--Content-->
	                                                <div class="modal-content">
										                <div class="card">
										                    <div class="card-header">
										                        <h5 class="text-center mb-0">LIST ORDER</h5>
										                    </div>
										                    <div class="card-body">
										                        <?php
										                        include "koneksi.php";
										                        $lihatorder1=mysqli_query($koneksi,"SELECT * FROM pos_salestemp WHERE notrans = '$transtempprm' ");
										                        while($hlihatorder1 = mysqli_fetch_array($lihatorder1)) 
										                        {
										                            /*pos table*/
										                            $postable=mysqli_query($koneksi,"SELECT * FROM pos_table where notrans = '$hlihatorder1[notrans]' ");
										                            $rpostable = mysqli_num_rows($postable);
										                            $hpostable = mysqli_fetch_array($postable);
										                            /*pos table*/
										                            /*squenceorder*/
										                            $squenceorder1=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$hlihatorder1[notrans]'  ORDER BY squenceorder desc");
										                            $rsquenceorder1 = mysqli_num_rows($squenceorder1);
										                            $hsquenceorder1 = mysqli_fetch_array($squenceorder1);
										                            $keysquenceorder=$hsquenceorder1['squenceorder'];
										                            /*squenceorder*/
										                        ?>
										                            <?php
										                            for ($x = 0; $x<$keysquenceorder; $x++) 
										                            {
										                                $noorder=$x+1;
										                            ?>
										                            <div class="row" style="margin-bottom: 5px;padding: 1em;background-color: #eaeaea;">
										                                <div class="col-12" style="padding: 3px;margin: 0px;">
										                                <b>ORDER KE <?php echo $noorder;?></b>
										                                </div>
										                                <div class="col-12" style="padding: 3px;margin: 0px;">
										                                <div class="row" style="margin: 0px;padding: 0px;">
												                            <div class="col-8" style="padding: 3px;margin: 0px;"><strong>NAMA MENU</strong></div>
												                            <div class="col-4" style="padding: 3px;margin: 0px;"><strong>JUMLAH</strong></div>
												                        </div>
												                        <?php
												                        $itemtemp1=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtempprm' AND squenceorder = '$noorder' group by kditem ");
																		$ritemtemp1 = mysqli_num_rows($itemtemp1);
												                        while($hitemtemp1 = mysqli_fetch_array($itemtemp1)) 
												                        {
												                        $keyitem=$hitemtemp1['kditem'];
												                        /*pos item*/
												                        $sqlplu=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$keyitem' ");
												                        $hsqlplu = mysqli_fetch_array($sqlplu);
												                        /*pos item*/
												                        /*count qty itemtemp*/
												                        $countqtyitem=mysqli_query($koneksi,"SELECT sum(qty) as total_qty FROM pos_itemtemp where kditem = '$keyitem' AND transtemp = '$transtempprm' AND squenceorder = '$noorder'");
												                        $hcountqtyitem = mysqli_fetch_array($countqtyitem);
												                        /*count qty itemtemp*/
												                        ?>
												                        <div class="row" style="margin: 0px;padding: 0px;border-bottom-width: 1px;border-bottom-color: #111;border-bottom-style: solid;">
												                            <div class="col-8" style="padding: 3px;margin: 0px;"><strong><?php echo $hsqlplu['nmitem'];?></strong></div>
												                            <div class="col-4" style="padding: 3px;margin: 0px;"><strong><?php echo $hcountqtyitem['total_qty'];?></strong></div>
												                        </div>
												                        <?php
												                        }
												                        ?>
										                                </div>
										                                <div class="col-12" style="padding: 3px;margin: 0px;">
										                                <a class="btn btn-nahm btn-block" role="button" href="escpos/cetakorder.php?keytrans=<?php echo $transtempprm;?>&sqnc=<?php echo $noorder;?>&header=pos">KIRIM ORDER KE KITCHEN</a>
										                                </div>
										                            </div>
										                            <?php
										                            }
										                            ?>
										                        <?php
										                        }
										                        ?>
										                    </div>
										                </div>
	                                                </div>
	                                                <!--/.Content-->
	                                            </div>
	                                        </div>
	                                    <!--Modal: cetakorder-->
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
	                                                                    <input type="hidden" name ="idterminal" value="<?php echo $idterminal;?>" style="width: 100%;">
	                                                                    <div class="row" style="margin: 0px;padding: 0px;">
	                                                                        <div class="col-8" style="padding: 3px;margin: 0px;"><strong>NAMA MENU</strong></div>
	                                                                        <div class="col-4" style="padding: 3px;margin: 0px;"><strong>JUMLAH</strong></div>
	                                                                    </div>
	                                                                    <?php
	                                                                    include "koneksi.php";
	                                                                    $sqlplu=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtemp'  group by kditem");
	                                                                    while($hsqlplu = mysqli_fetch_array($sqlplu)) 
	                                                                    {
	                                                                    $qtycek=$hsqlplu['kditem'];
	                                                                    $fetchitem = "SELECT * FROM pos_item WHERE kditem = '$qtycek'";
	                                                                    $resultfetchitem = mysqli_query($koneksi,$fetchitem) or die (mysqli_error());
	                                                                    $hresultfetchitem= mysqli_fetch_array($resultfetchitem);
	                                                                    $sumqtyitemvoid=mysqli_query($koneksi,"SELECT SUM(qty) AS sumsqty FROM pos_itemtemp where kditem = $qtycek AND transtemp ='$transtempprm' ");
	                                                                    $hsumqtyitemvoid = mysqli_fetch_array($sumqtyitemvoid);
	                                                                    $maxqtyvoid=$hsumqtyitemvoid['sumsqty'];
	                                                                    ?>
	                                                                    <div class="row" style="margin: 0px;padding: 0px;">
	                                                                        <div class="col-8" style="padding: 3px;margin: 0px;"><strong><?php echo $hresultfetchitem['nmitem'];?> (<?php echo $maxqtyvoid;?>)</strong></div>
	                                                                        <div class="col-4" style="padding: 3px;margin: 0px;">
	                                                                        	<button type="button" onclick="min(<?php echo $qtycek;?>)"><b>-</b></button>
																				<input type="text" id="<?php echo $qtycek;?>" name ="<?php echo $qtycek;?>" value="0" style="width: 40%;text-align:center;">
																				<button type="button" onclick="plus(<?php echo $qtycek;?>,<?php echo $maxqtyvoid;?>)"><b>+</b></button>
	                                                                        </div>
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
	                                                                            <option value="Komplen Customer">Permintaan Customer</option>
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
	                                    <!--Modal: void-->
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
			                                    $xtestdays=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
			                                    $prmtestdays=(explode(",",$xtestdays));
			                                    $countprmtestdays=in_array($testdays,$xtestdays);
			                                    if($countprmtestdays>0)
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
						                                    <a href="addpromotion.php?transtempprm=<?php echo $transtempprm;?>&bill=<?php echo $prmbill;?>&promotionid=<?php echo $hpromotionprm['id_promotion'];?>&idterminal=<?php echo $idterminal;?>" class="btn btn-nahm btn-block maxwidthheight"><?php echo $hpromotionprm['promotion_name'];?></a>
						                                    </div>
						                                    <?php
						                                    }
						                                    else
						                                    {
						                                    	echo "D";
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
	                                    <div class="col-md-3 nopadding">
	                                    <a href="printopenbill.php?keytrans=<?php echo $transtempprm;?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">CETAK OPEN BILL</a>
	                                    </div>
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
	                                    <div class="modal-dialog modal-lg cascading-modal" role="document">
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
	                                    <li class="nav-item">
	                                    <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelevoucher" role="tab">
	                                    <i class="fa fa-cc-mastercard mr-1"></i><i class="fa fa-cc-visa mr-1"></i> <br>E-Voucher</a>
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
	                                    <input type="hidden" name="idterminal" value="<?php echo $idterminal;?>" class="form-control ml-0">
	                                    <input type="hidden" name="jnspay" value="CASH" class="form-control ml-0">
	                                    <select class="form-control" name="jnscard" required>
	                                    <option value="" disabled selected>Pilih Kategori Cash</option>
	                                    <option value="CASH">CASH</option>
	                                    <option value="GOPAY">GOPAY</option>
	                                    </select>
	                                    <input type="hidden" name="bank" value="" class="form-control ml-0">
	                                    <input type="hidden" name="num" value="" class="form-control ml-0">
	                                    <input type="text" name="txt1" class="form-control ml-0" placeholder="masukan jumlah bayar">
	                                    <input type="hidden" name="lastuser" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
	                                    <input type="hidden" name="lastmodify" value="<?php echo "".date("Y-m-d", $tanggal)."";?>" class="form-control ml-0">
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
	                                    <td colspan="3" style="padding: 0px;"><input type=button name="clrbtn" value=clear onclick="displyclearcash()" class="btn btn-nahm btn-block"></td>
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
	                                    <input type="hidden" name="idterminal" value="<?php echo $idterminal;?>" class="form-control ml-0">
	                                    <input type="hidden" name="jnspay" value="CARD" class="form-control ml-0">
	                                    <input type="hidden" name="num" value="" class="form-control ml-0">
	                                    <select class="form-control" name="jnscard" required>
	                                    <option value="" disabled selected>Pilih Jenis Kartu</option>
	                                    <option value="DEBIT BCA">DEBIT BCA</option>
	                                    <option value="VISA">VISA</option>
	                                    <option value="MASTER">MASTER</option>
	                                    <input type="text" name="txt1" class="form-control ml-0" placeholder="masukan jumlah bayar" value="<?php echo $sisabayar;?>" required>
	                                    <input type="hidden" name="lastuser" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
	                                    <input type="hidden" name="lastmodify" value="<?php echo "".date("Y-m-d", $tanggal)."";?>" class="form-control ml-0">
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
	                                    <div class="tab-pane fade" id="panelevoucher" role="tabpanel">

	                                    <!--Body-->
	                                        <div class="modal-body text-center mb-1">
	                                                    <h5 class="mt-1 mb-2">Input nomor e-voucher</h5>
	                                                    <script type="text/javascript">
	                                                    function displynumevoucher(n1)
	                                                    {
	                                                        calcformevoucher.num.value=calcformevoucher.num.value+n1;
	                                                    }
	                                                    function displyclearevoucher()
	                                                    {
	                                                        calcformevoucher.num.value="";
	                                                    }
	                                                    </script>
	                                                    <form name="calcformevoucher" action="addpaymentevoucher.php" method="post">

	                                                    <!--/.numpad-->
	                                                    <table width="65%" align="center">
	                                                        <tr>
	                                                        <td colspan="3">
	                                                        <input type="hidden" name="notrans" value="<?php echo $transtempprm;?>" class="form-control ml-0">
	                                    					<input type="hidden" name="idterminal" value="<?php echo $idterminal;?>" class="form-control ml-0">
	                                                        <input type="hidden" name="jnspay" value="VOUCHER" class="form-control ml-0">
	                                                        <input type="hidden" name="jnscard" value="" class="form-control ml-0">
	                                                        <input type="hidden" name="bank" value="" class="form-control ml-0">
	                                                        <input type="hidden" name="txt1" value="" class="form-control ml-0">
	                                                        <input type="text" name="num" class="form-control ml-0" placeholder="masukan nomor e-voucher" required>
	                                                        <input type="hidden" name="lastuser" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
	                                                        <input type="hidden" name="lastmodify" value="<?php echo "".date("Y-m-d", $tanggal)."";?>" class="form-control ml-0">
	                                                        </td>
	                                                        </tr>
	                                                        <tr>
	                                                            <td><input type=button name="btn7evoucher" value=7 onclick="displynumevoucher(btn7evoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                            <td><input type=button name="btn8evoucher" value=8 onclick="displynumevoucher(btn8evoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                            <td><input type=button name="btn9evoucher" value=9 onclick="displynumevoucher(btn9evoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                        </tr>
	                                                        <tr>
	                                                            <td><input type=button name="btn4evoucher" value=4 onclick="displynumevoucher(btn4evoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                            <td><input type=button name="btn5evoucher" value=5 onclick="displynumevoucher(btn5evoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                            <td><input type=button name="btn6evoucher" value=6 onclick="displynumevoucher(btn6evoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                        </tr>
	                                                        <tr>
	                                                            <td><input type=button name="btn1evoucher" value=1 onclick="displynumevoucher(btn1evoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                            <td><input type=button name="btn2evoucher" value=2 onclick="displynumevoucher(btn2evoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                            <td><input type=button name="btn3evoucher" value=3 onclick="displynumevoucher(btn3evoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                        </tr>
	                                                        <tr>
	                                                            <td><input type=button name="btn0evoucher" value=0 onclick="displynumevoucher(btn0evoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                            <td colspan="2"><input type=button name="btnnhmevoucher" value="NHV" onclick="displynumevoucher(btnnhmevoucher.value)" class="btn btn-nahm btn-block"></td>
	                                                        </tr>
	                                                        <tr>
	                                                            <td colspan="3"><input type=button name="clrbtn" value=clear onclick="displyclearevoucher()" class="btn btn-nahm btn-block"></td>
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
	                                                        <input type="hidden" name="notrans" value="<?php echo $transtempprm;?>" class="form-control ml-0">
	                                    					<input type="hidden" name="idterminal" value="<?php echo $idterminal;?>" class="form-control ml-0">
	                                                        <input type="hidden" name="jnspay" value="VOUCHER" class="form-control ml-0">
	                                                        <input type="hidden" name="bank" value="" class="form-control ml-0">
	                                                        <input type="hidden" name="txt1" value="" class="form-control ml-0">
	                                                        <input type="text" name="num" class="form-control ml-0" placeholder="masukan nomor voucher" required>
	                                                        <input type="hidden" name="lastuser" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
	                                                        <input type="hidden" name="lastmodify" value="<?php echo "".date("Y-m-d", $tanggal)."";?>" class="form-control ml-0">
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
	                                                            <td><input type=button name="btn0voucher" value=0 onclick="displynumvoucher(btn0voucher.value)" class="btn btn-nahm btn-block"></td>
	                                                            <td colspan="2"><input type=button name="btnnhmvoucher" value="NHV" onclick="displynumvoucher(btnnhmvoucher.value)" class="btn btn-nahm btn-block"></td>
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
	                                    <a href="addotherpayment.php?transtempprm=<?php echo $transtempprm;?>&jnspay=<?php echo $namaotherpay;?>&jml=<?php echo $jumlahotherpay;?>&lastuser=<?php echo $_SESSION['iduser'];?>&lastmodify=<?php echo "".date("d-m-Y", $tanggal)."";?>&bill=<?php echo $prmbill;?>&idterminal=<?php echo $idterminal;?>" class="btn btn-nahm btn-block"><?php echo $namaotherpay;?></a>
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
	                                        <a href="hapuspospaymenttemp.php?transtempprm=<?php echo $transtempprm;?>&paytype=<?php echo $paytype;?>&jpay=<?php echo $jpay;?>&bill=<?php echo $prmbill;?>" class="btn btn-nahm btn-block"><?php echo $hpospaymenttemp['JnsCard'];?> : Rp <?php echo $hpospaymenttemp['Jumlah'];?></a>
	                                        <?php
	                                        }
	                                    else
	                                        {
	                                        ?>
	                                        <a href="hapuspospaymenttemp.php?transtempprm=<?php echo $transtempprm;?>&paytype=<?php echo $paytype;?>&jpay=<?php echo $jpay;?>&bill=<?php echo $prmbill;?>" class="btn btn-nahm btn-block"><?php echo $hpospaymenttemp['JnsCard'];?> : Rp <?php echo $hpospaymenttemp['Jumlah'];?></a>
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
	                                    <a href="savetransaction.php?usr=<?php echo $usrpay;?>&notranstemp=<?php echo $transtemp;?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">PROSES PEMBAYARAN</a>
	                                    </div>
	                                    <?php
	                                    }
	                                    ?>
	                                </div>
	                        </div>
	                    </div>
	                    <?php 
	                    }
                    	elseif($hsubmenustatus['status']=="CLOSED")
	                    {
	                    ?>
	                    <div class="card" style="background-color: #ffffff;color: #fff;">
	                        <div class="card-header" style="background-color: #8c0000;color: #fff;">
	                        <h5 class="text-center mb-0">SUB MENU</h5>
	                        </div>
	                        <div class="card-body" style="padding: 0px;">
	                            <div class="row" style="margin: 0px;padding: 0px;">
	                                <!--Modal: sales summary-->
	                                <div class="col-md-3 nopadding">
	                                <a href="escpos/cetakreprintbill.php?transtempprm=<?php echo $hsubmenustatus['notrans'];?>&billid=<?php echo $hsubmenustatus['bill_number'];?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">RE-PRINT</a>
	                                </div>  
                                    <?php
                                    $cekrefund=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$transtempprm'");
                                    $hcekrefund = mysqli_fetch_array($cekrefund);
                                    if($hcekrefund['terminal_id']==$idterminal)
                                    {
                                    ?>
                                    <!--
	                                <div class="col-md-3 nopadding">
	                                <a href="saverefund.php?notranstemp=<?php //echo $transtempprm;?>&usr=<?php //echo $usrpay;?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;" onclick="return confirm('ANDA YAKIN AKAN MEREFUND TRANSAKSI INI ?')">REFUND</a>
	                                </div>
                                    -->
                                    <div class="col-md-3 nopadding">
                                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalmember" style="padding-left: 0px;padding-right: 0px;">REFUND</a>
                                    </div>
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
                                                <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelidmem" role="tab">PASS <br>SUPERVISOR</a>
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
                                                            calcformmbr.usr.value=calcformmbr.usr.value+n1;
                                                            }
                                                            function displyclearmbr()
                                                            {
                                                            calcformmbr.usr.value="";
                                                            }
                                                            </script>
                                                                <form name="calcformmbr" action="saverefund.php" method="post">
                                                                    <!--/.numpad-->
                                                                    <table width="65%" align="center">
                                                                        <tr>
                                                                            <td colspan="3">
                                                                            <input type="hidden" name="notranstemp" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                                                            <input type="text" name="usr" class="form-control ml-0" value="" placeholder="MASUKAN PASS SUPERVISOR">
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
                                                                            <td><input type=button name="btn0cash" value=0 onclick="displynummbr(btn0cash.value)" class="btn btn-nahm btn-block"></td>
                                                                            <td colspan="2"><input type=button name="btnnhmcash" value=BPU onclick="displynummbr(btnnhmcash.value)" class="btn btn-nahm btn-block"></td>
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
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.Content-->
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
	                            </div>
	                        </div>
	                      </div>
	                    <?php
	                    }
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
	                                <a href="laporantransaksi.php" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalrekaptrans" style="padding-left: 0px;padding-right: 0px;">REKAP TRANSAKSI</a>
	                                </div>
	                                <!--Modal: sales summary-->
									<div class="modal fade active" id="modalrekaptrans" tabindex="-1" role="dialog" aria-labelledby="modalrekaptrans" aria-hidden="true">
									    <div class="modal-dialog modal-fluid" role="document">
									        <!--Content-->
									            <div class="modal-content">
										        <!--Header-->
										        <div class="modal-header" style="background-color: #6c0000;">
										          <p class="heading lead">REKAP TRANSAKSI</p>

										          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										            <span aria-hidden="true" class="white-text">&times;</span>
										          </button>
										        </div>

										        <!--Body-->
										        <div class="modal-body">
													<div class="card">
														<div class="card-body scrollpageall" style="background-color: #ffffff;color: #000;" onkeypress="return">
															<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
											                  <thead>
											                    <tr>
											                      <th class="th-sm">TOOLS
											                      </th>
											                      <th class="th-sm">NOMOR BILL
											                      </th>
											                      <th class="th-sm">TANGGAL TRANSAKSI
											                      </th>
											                      <th class="th-sm">WAKTU TRANSAKSI
											                      </th>
											                      <th class="th-sm">GROSS SALES
											                      </th>
											                      <th class="th-sm">DISC
											                      </th>
											                      <th class="th-sm">TAX
											                      </th>
											                      <th class="th-sm">NETT SALES
											                      </th>
											                      <th class="th-sm">JUMLAH BAYAR
											                      </th>
											                      <th class="th-sm">STATUS
											                      </th>
											                      <th class="th-sm">NOMOR TRANSAKSI
											                      </th>
											                      <th class="th-sm">TANGGAL TRANSAKSI
											                      </th>
											                      <th class="th-sm">WAKTU TRANSAKSI
											                      </th>
											                      <th class="th-sm">GROSS SALES
											                      </th>
											                      <th class="th-sm">DISC
											                      </th>
											                      <th class="th-sm">TAX
											                      </th>
											                      <th class="th-sm">NETT SALES
											                      </th>
											                      <th class="th-sm">JUMLAH BAYAR
											                      </th>
											                      <th class="th-sm">STATUS
											                      </th>
											                    </tr>
											                  </thead>
											                  <tbody>
											                    <?php
											                    // membuka file JSON
											                    $file = file_get_contents("http://localhost/bypos/fetchrekappenjualan.php");
											                    $json = json_decode($file, true);
											                    $hitung=count($json);
											                    for($x=0;$x<$hitung;$x++)
											                    {
											                    ?>
											                    <tr>
											                      <td><a href="index.php?transtempprm=<?php echo $json[$x]['notrans'];?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;color: #fff;">BUKA TRANSAKSI</a></td>
											                      <td class="align-middle"><?php echo $json[$x]['bill_number'];?></td>
											                      <td class="align-middle"><?php echo $json[$x]['close_date'];?></td>
											                      <td class="align-middle"><?php echo $json[$x]['close_time'];?></td>
											                      <td class="align-middle"><?php echo number_format($json[$x]['gross_sales']);?></td>
											                      <td class="align-middle"><?php echo number_format($json[$x]['disc']);?></td>
											                      <td class="align-middle"><?php echo number_format($json[$x]['tax']);?></td>
											                      <td class="align-middle" class="align-middle"><?php echo number_format($json[$x]['nett_sales']);?></td>
											                      <td class="align-middle"><?php echo number_format($json[$x]['jumlah_bayar']);?></td>
											                      <td class="align-middle"><?php echo $json[$x]['status'];?></td>
											                      <td class="align-middle"><?php echo $json[$x]['notrans'];?></td>
											                      <td class="align-middle"><?php echo $json[$x]['date'];?></td>
											                      <td class="align-middle"><?php echo $json[$x]['time'];?></td>
											                      <td class="align-middle"><?php echo number_format($json[$x]['gross_sales']);?></td>
											                      <td class="align-middle"><?php echo number_format($json[$x]['disc']);?></td>
											                      <td class="align-middle"><?php echo number_format($json[$x]['tax']);?></td>
											                      <td class="align-middle" class="align-middle"><?php echo number_format($json[$x]['nett_sales']);?></td>
											                      <td class="align-middle"><?php echo number_format($json[$x]['jumlah_bayar']);?></td>
											                      <td class="align-middle"><?php echo $json[$x]['status'];?></td>
											                    </tr>
											                    <?php
											                    }
											                    ?>
											                  </tbody>
											                </table>
														</div>
													</div>
												</div>
									            </div>
									        <!--/.Content-->
									    </div>
									</div>
									<!--Modal: sales summary-->
	                            	<div class="col-md-3 nopadding">
	                                <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalsalessum" style="padding-left: 0px;padding-right: 0px;">SALES SUMMARY</a>
	                                </div>
	                                <!--Modal: sales summary-->
	                                    <div class="modal fade active" id="modalsalessum" tabindex="-1" role="dialog" aria-labelledby="modalsalessum" aria-hidden="true">
	                                        <div class="modal-dialog modal-lg cascading-modal" role="document">
	                                            <!--Content-->
	                                            <div class="modal-content">
										            <div class="card">
										                <div class="card-header" style="background-color: #620000;color: #fff;">
										                    <h5 class="text-center mb-0">SALES SUMMARY</h5>
										                </div>
										                <div class="card-body" style="background-color: #ffffff;color: #000;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                			( + )
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
										                			( - )
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
										                			( - )
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
										                			( - )
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
										                			( - )
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
										                			( = )
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
															$sumestimatedsales=mysqli_query($koneksi,"SELECT sum(gross_sales) as sumgrosssales, sum(disc) as sumsalesdisc FROM pos_salestemp where terminal_id = '$idterminal' AND status != 'CANCELED'");
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
																$sumdetpayvcr=mysqli_query($koneksi,"SELECT sum(bill) as qtybill, sum(jumlah_bayar) as sumpay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED' AND JnsCard = '$keyJnsCardvcr'");
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
										                		</div>
										                	</div>
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                	<?php
										                	/*sumtax*/
															$sumtax=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as sumjumbay FROM pos_paymenttemp where terminal_id = '$idterminal' AND payment_status = 'CLOSED'");
															$hsumtax = mysqli_fetch_array($sumtax);
															$aftertax=$hsumtax['sumjumbay']/1.1;
															$tax=$hsumtax['sumjumbay']-$aftertax;
															/*sumtax*/
										                	?>
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
										                		</div>
										                	</div>
										                	<?php
										                	/*discitemdet*/
															$discitemdet=mysqli_query($koneksi,"SELECT sum(qty) as sumqtyitemdisc, sum(disc) as sumdiscitem FROM pos_promotion_d where terminal_id = '$idterminal' and promotion_type = 'DISC ITEM' and paid_status = 'PAID' group by id_promotion");
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
										                			<?php echo number_format($hdiscbilldet['sumqtyitemdisc']);?>
										                			</p>
										                		</div>
										                		<div class="col-3">
										                			<p style="margin-top: 1px;margin-bottom: 1px;text-align: right;">
										                			<?php echo number_format($hdiscbilldet['sumdiscitem']);?>
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                		<div class="col-12" style="border-bottom-width: 1px;border-bottom-color: #000;border-bottom-style: dashed;">
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
										                			( + )
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
										                			( = )
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
										                	<div class="row" style="padding-top: 15px;padding-bottom: 15px;">
										                		<div class="col-12 nopadding">
	                            								<a href="printsalessummary.php?transtempprm=<?php echo $transtempprm;?>&user=$usrpay" class="btn btn-nahm btn-block" style="color:#fff;background-color: #861919;text-decoration: none;border-radius: 0px;">PRINT SALES SUMMARY</a>
										                		</div>
										                	</div>
										                </div>
										            </div>
	                                            </div>
	                                            <!--/.Content-->
	                                        </div>
	                                    </div>
	                                <!--Modal: sales summary-->
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
    <script type="text/javascript">
    function plus(xx,xxmax)
        {
        var x1plus=document.getElementById(xx).value;
        var x2plus=parseInt(x1plus)+1;
            if (x1plus < xxmax) {
                document.getElementById(xx).value=x2plus;
            }
            else {
                document.getElementById(xx).value=x1plus;
            }
        }
        function min(xx)
        {
        var x1plus=document.getElementById(xx).value;
        var x2plus=parseInt(x1plus)-1;
            if (x1plus < 1) {
                document.getElementById(xx).value=x1plus;
            }
            else {
                document.getElementById(xx).value=x2plus;
            }
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
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>
    <script>
    $(document).ready(function () {
    $('#dtBasicExample').DataTable({
	"searching": false // false to disable search (or any other option)
	});
	$('.dataTables_length').addClass('bs-select');
    });
    </script>
    <script>
	function cancelorderconfirm() {
	  confirm("ANDA YAKIN AKAN MEMBATALKAN TRANSAKSI INI ?");
	}
	</script>
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