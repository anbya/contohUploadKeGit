<?php 
error_reporting(0);
session_start();
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$usrpay=$_SESSION['iduser'];
$transtempprm=$_GET['transtempprm'];
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
    .mh1
        {
          height: 50vh; /* 30% of viewport height*/
          max-height: 50vh;
        }
    .mh2
        {
          height: 100vh; /* 30% of viewport height*/
          max-height: 100vh;
        }
    .mh3
        {
          height: 70vh; /* 30% of viewport height*/
          max-height: 70vh;
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
    .mh6
        {
          height: 60vh; /* 30% of viewport height*/
          max-height: 60vh;
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
<div class="container-fluid" style="background-color: #ffe6e6;">
<div class="row mh2">
    <div class="col-md-4 tepian">
        <div class="row mh6 scrollpage scrollbar-inner" style="background-color: #ffe6e6;">
            <div class="col-md-12 tepian">

                        <!-- Nav tabs -->
                <div class="row">
                    <div class="col-md-12 nopadding">
                        <table width="100%">
                            <tr>
                                <td width="50%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 1%; font-weight: bold; font-size: 75%;">Item Name</td>
                                <td width="10%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 1%; font-weight: bold; font-size: 75%;">Qty<div id="result"></div></td>
                                <td width="40%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 1%; font-weight: bold; font-size: 75%;">amount</td>
                            </tr>
                            <?php
                            include "koneksi.php";
                            $itemtemp=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp ='$transtempprm'");
                            while($hitemtemp = mysqli_fetch_array($itemtemp)) 
                            {
                            ?>
                            <?php
                            $kditem=$hitemtemp['kditem'];
                            $itemdet=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = $kditem");
                            $hitemdet = mysqli_fetch_array($itemdet);
                            $price=$hitemtemp['subtotal'];
                            ?>
                            <tr>
                                <td width="40%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 1%; font-weight: bold; font-size: 75%;"><?php echo $hitemdet['nmitem'];?></td>
                                <td width="30%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 1%; font-weight: bold; font-size: 75%;"><?php echo $hitemtemp['qty'];?></td>
                                <td width="30%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 1%; font-weight: bold; font-size: 75%;"><?php echo number_format("$price");?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <!-- Nav tabs -->

            </div>
        </div>
        <div class="row mh5" style="background-color: #ffe6e6;">
            <div class="col-md-12 tepian">

                        <!-- Nav tabs -->
                <div class="row">
                    <div class="col-md-12" style="padding-left: 2%;padding-right: 2%;padding-top: 2%;">
                        <table width="100%">
                            <?php
                            $transtemp=$transtempprm;
                            $query1 = "SELECT SUM(grandprice) AS grand_total FROM pos_itemtemp WHERE transtemp = '$transtemp' ";
                            $result1 = mysqli_query($koneksi,$query1) or die (mysqli_error());
                            $gtfetch = mysqli_fetch_array($result1);
                            ?>
                            <?php
                            $query2 = "SELECT * FROM pos_salestemp WHERE NoTrans = '$transtemp' ";
                            $result2 = mysqli_query($koneksi,$query2) or die (mysqli_error());
                            $jbfetch = mysqli_fetch_array($result2);
                            $gt=$jbfetch['nett_sales'];
                            $prmsubtotal=$jbfetch['gross_sales'];
                            $prmdisc=$jbfetch['disc'];
                            $prmdiscdesk=$jbfetch['disc_desk'];
                            $jb=$jbfetch['jumlah_bayar'];
                            $gttax=10*$gt/100;
                            $finalgt=$gt+$gttax;
                            $kembalian=$jb-$finalgt;
                            $sisabayar=$finalgt-$jb;
                            ?>
                            <?php
                            $query3 = "SELECT * FROM pos_salestemp WHERE notrans = '$transtemp' ";
                            $result3 = mysqli_query($koneksi,$query3) or die (mysqli_error());
                            $salesh = mysqli_fetch_array($result3);
                            $member=$salesh['id_member'];
                            $custqty=$salesh['custqty'];
                            $query4 = "SELECT * FROM member where id_member = '$member' OR telepon = '$member' ";
                            $result4 = mysqli_query($koneksi,$query4) or die (mysqli_error());
                            $nmmbr = mysqli_fetch_array($result4);
                            $namamember=$nmmbr['nama_member'];
                            ?>

                            <tr>
                                <td width="60%" style="padding-left: 1%; font-weight: bold; font-size: 75%;">Total</td>
                                <td width="10%" style="padding-left: 1%; font-weight: bold; font-size: 75%;" class="tepibawah">:</td>
                                <td width="30%" style="padding-left: 1%; font-weight: bold; font-size: 75%; text-align: right;" class="tepibawah">
                                <?php echo number_format("$prmsubtotal");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="60%" style="padding-left: 1%; font-weight: bold; font-size: 75%;">Disc</td>
                                <td width="10%" style="padding-left: 1%; font-weight: bold; font-size: 75%;"></td>
                                <td width="30%" style="padding-left: 1%; font-weight: bold; font-size: 75%; text-align: right;">
                                <?php echo $prmdiscdesk;?>
                                </td>
                            </tr>
                            <tr>
                                <td width="60%" style="padding-left: 1%; font-weight: bold; font-size: 75%;"></td>
                                <td width="10%" style="padding-left: 1%; font-weight: bold; font-size: 75%;" class="tepibawah">:</td>
                                <td width="30%" style="padding-left: 1%; font-weight: bold; font-size: 75%; text-align: right;" class="tepibawah">-
                                <?php echo number_format("$prmdisc");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="60%" style="padding-left: 1%; font-weight: bold; font-size: 75%;">Sub Total</td>
                                <td width="10%" style="padding-left: 1%; font-weight: bold; font-size: 75%;" class="tepibawah">:</td>
                                <td width="30%" style="padding-left: 1%; font-weight: bold; font-size: 75%; text-align: right;" class="tepibawah">
                                <?php echo number_format("$gt");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="60%" style="padding-left: 1%; font-weight: bold; font-size: 75%;">Tax</td>
                                <td width="10%" style="padding-left: 1%; font-weight: bold; font-size: 75%;" class="tepibawah">:</td>
                                <td width="30%" style="padding-left: 1%; font-weight: bold; font-size: 75%; text-align: right;" class="tepibawah">
                                <?php echo number_format("$gttax");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="60%" style="padding-left: 1%; font-weight: bold; font-size: 75%;">Grand Total</td>
                                <td width="10%" style="padding-left: 1%; font-weight: bold; font-size: 75%;" class="tepibawah">:</td>
                                <td width="30%" style="padding-left: 1%; font-weight: bold; font-size: 75%; text-align: right;" class="tepibawah">
                                <?php echo number_format("$finalgt");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="60%" style="padding-left: 1%; font-weight: bold; font-size: 75%;">Jumlah Bayar</td>
                                <td width="10%" style="padding-left: 1%; font-weight: bold; font-size: 75%;" class="tepibawah">:</td>
                                <td width="30%" style="padding-left: 1%; font-weight: bold; text-align: right;" class="tepibawah">
                                <?php echo number_format("$jb");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="60%" style="padding-left: 1%; font-weight: bold; font-size: 75%;">Kembalian</td>
                                <td width="10%" style="padding-left: 1%; font-weight: bold; font-size: 75%;" class="tepibawah">:</td>
                                <td width="30%" style="padding-left: 1%; font-weight: bold; font-size: 75%; text-align: right;" class="tepibawah">
                                <?php echo number_format("$kembalian");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="60%" style="padding-left: 1%; font-weight: bold; font-size: 75%;">Member</td>
                                <td width="10%" style="padding-left: 1%; font-weight: bold; font-size: 75%;" class="tepibawah">:</td>
                                <td width="30%" style="padding-left: 1%; font-weight: bold; font-size: 75%; text-align: right;" class="tepibawah">
                                <?php echo $namamember;?>
                                </td>
                            </tr>
                            <tr>
                                <td width="60%" style="padding-left: 1%; font-weight: bold; font-size: 75%;">Jumlah Customer</td>
                                <td width="10%" style="padding-left: 1%; font-weight: bold; font-size: 75%;" class="tepibawah">:</td>
                                <td width="30%" style="padding-left: 1%; font-weight: bold; font-size: 75%; text-align: right;" class="tepibawah">
                                <?php echo $custqty;?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Nav tabs -->

            </div>
        </div>
    </div>

    <div class="col-md-2 tepian">
        <div class="row mh2">
        <!-- /menu -->
            <div class="col-md-12 tepian">
                        <!-- Nav tabs -->
                <div class="row nopadding">
                <?php
                $transtemp=$transtempprm;
                $itemtemp=mysqli_query($koneksi,"select * from pos_salestemp where notrans ='$transtemp'");
                $ritemtemp=mysqli_num_rows($itemtemp);
                if ($ritemtemp > 0)
                {   
                ?>
                    <div class="col-md-12">
                    <a href="kosongpos.php?id=<?php echo $transtempprm;?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">BATAL</a>
                    </div>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalmember" style="padding-left: 0px;padding-right: 0px;">MEMBER</a>
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
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">ID Member</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel172" role="tab">Telepon Member</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panels -->
                                    <div class="tab-content">
                                        <!--Panel 171-->
                                        <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

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
                                        <!--/.Panel 171-->
                                        <!--/.Panel 172-->
                                        <div class="tab-pane fade" id="panel172" role="tabpanel">

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
                    <!--Modal: member-->
                    <div class="col-md-12">
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
                                    <div class="tab-content">
                                        <!--Panel 17-->
                                        <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

                                            <!--Body-->
                                            <div class="modal-body text-center mb-1">
                                                <h5 class="mt-1 mb-2">PILIH ITEM YANG AKAN DI VOID</h5>
                                                <div class="row scrollpage mh5">
                                                <div class="col-md-12 nopadding">
                                                <?php
                                                include "koneksi.php";
                                                $subcat=$_GET['SUBCAT'];
                                                $postemp=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtempprm'");
                                                while($hpostemp = mysqli_fetch_array($postemp)) 
                                                {
                                                ?>
                                                <?php
                                                $kdpostemp=$hpostemp['kditem'];
                                                $squence=$hpostemp['squence'];
                                                $nmpostemp=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$kdpostemp'");
                                                $nmpostemp = mysqli_fetch_array($nmpostemp); 
                                                ?>
                                                    <a href="hapuspositemtemp.php?transtempprm=<?php echo $transtempprm;?>&KDITEM=<?php echo $kdpostemp;?>&squence=<?php echo $squence;?>" class="btn btn-nahm btn-block"><?php echo $nmpostemp['nmitem'];?></a> 
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
                    if($finalgt == 0)
                    {
                    ?>
                    <script>
                    function paymentalert() {
                        alert("ANDA BELUM MELAKUKAN TRANSAKSI");
                    }
                    </script>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="paymentalert()" style="padding-left: 0px;padding-right: 0px;">PAYMENT</a>
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpayment" style="padding-left: 0px;padding-right: 0px;">PAYMENT</a>
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
                    if($finalgt == 0)
                    {
                    ?>
                    <script>
                    function paymentalert() {
                        alert("ANDA BELUM MELAKUKAN TRANSAKSI");
                    }
                    </script>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="paymentalert()" style="padding-left: 0px;padding-right: 0px;">OTHER PAYMENT</a>
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalotherpayment" style="padding-left: 0px;padding-right: 0px;">OTHER PAYMENT</a>
                    </div>
                    <!--Modal: payment-->
                    <div class="modal fade" id="modalotherpayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fluid cascading-modal" role="document">
                            <!--Content-->
                            <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tabs-2" role="tablist">
                                        <li class="nav-item">
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelothetpay" role="tab">Other Payment</a>
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
                                                <div class="col-md-2">
                                                    <a href="addotherpayment.php?transtempprm=<?php echo $transtempprm;?>&jnspay=<?php echo $idotherpay;?>&jml=<?php echo $jumlahotherpay;?>&lastuser=<?php echo $_SESSION['iduser'];?>&lastmodify=<?php echo "".date("d-m-Y", $tanggal)."";?>" class="btn btn-nahm btn-block"><?php echo $namaotherpay;?></a>
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
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpaymentvoid" style="padding-left: 0px;padding-right: 0px;">PAYMENT VOID</a>
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
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">PAYMENT VOID</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panels -->
                                    <div class="tab-content">
                                        <!--Panel 17-->
                                        <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

                                            <!--Body-->
                                            <div class="modal-body text-center mb-1">
                                                <h5 class="mt-1 mb-2">PILIH PAYMENT YANG AKAN DI VOID</h5>
                                                <div class="row scrollpage mh5">
                                                <div class="col-md-12 nopadding">
                                                <?php
                                                include "koneksi.php";
                                                $pospaymenttemp=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where NoTrans = '$transtempprm'");
                                                while($hpospaymenttemp = mysqli_fetch_array($pospaymenttemp)) 
                                                {
                                                $paytype=$hpospaymenttemp['JnsTrans'];
                                                $jpay=$hpospaymenttemp['Jumlah'];
                                                ?>
                                                    <a href="hapuspospaymenttemp.php?transtempprm=<?php echo $transtempprm;?>&paytype=<?php echo $paytype;?>&jpay=<?php echo $jpay;?>" class="btn btn-nahm btn-block"><?php echo $paytype;?> : Rp <?php echo $hpospaymenttemp['Jumlah'];?></a> 
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
                    <!--Modal: void payment-->
                    <?php
                    if($finalgt == 0)
                    {
                    ?>
                    <script>
                    function promotionalert() {
                        alert("ANDA BELUM MELAKUKAN TRANSAKSI");
                    }
                    </script>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="promotionalert()" style="padding-left: 0px;padding-right: 0px;">PROMOTION</a>
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpromotion" style="padding-left: 0px;padding-right: 0px;">PROMOTION</a>
                    </div>
                    <!--Modal: payment-->
                    <div class="modal fade" id="modalpromotion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fluid cascading-modal" role="document">
                            <!--Content-->
                            <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tabs-2" role="tablist">
                                        <li class="nav-item">
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelpromotion" role="tab">PROMOTION</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panels -->
                                    <div class="tab-content">
                                        <!--Panel 17-->
                                        <div class="tab-pane fade in show active" id="panelpromotion" role="tabpanel">

                                            <!--Body-->
                                            <div class="modal-body text-center mb-1">
                                                </script>
                                                <div class="row">
                                                    <div class="col-md-6">
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
                                                                        <div class="col-md-4">
                                                                            <a href="addpromotion.php?transtempprm=<?php echo $transtempprm;?>&promotionid=<?php echo $hpromotionprm['id_promotion'];?>" class="btn btn-nahm btn-block"><?php echo $hpromotionprm['promotion_name'];?></a>
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
                                                    <div class="col-md-6">  
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
                                                                        <div class="col-md-4 nopadding">
                                                                            <a href="addpromotion.php?transtempprm=<?php echo $transtempprm;?>&promotionid=<?php echo $hpromotionprm['id_promotion'];?>" class="btn btn-nahm maxwidthheight"><?php echo $hpromotionprm['promotion_name'];?></a>
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
                    <?php
                    if($finalgt == 0)
                    {
                    ?>
                    <script>
                    function promotionalert() {
                        alert("ANDA BELUM MELAKUKAN TRANSAKSI");
                    }
                    </script>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="promotionalert()" style="padding-left: 0px;padding-right: 0px;">OTHER PROMOTION</a>
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalotherpromotion" style="padding-left: 0px;padding-right: 0px;">OTHER PROMOTION</a>
                    </div>
                    <!--Modal: payment-->
                    <div class="modal fade" id="modalotherpromotion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fluid cascading-modal" role="document">
                            <!--Content-->
                            <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tabs-2" role="tablist">
                                        <li class="nav-item">
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panelpromotion" role="tab">OTHER PROMOTION</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panels -->
                                    <div class="tab-content">
                                        <!--Panel 17-->
                                        <div class="tab-pane fade in show active" id="panelpromotion" role="tabpanel">

                                            <!--Body-->
                                            <div class="modal-body text-center mb-1">
                                                </script>
                                                <div class="row">
                                                    <div class="col-md-6">
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
                                                                        <div class="col-md-4">
                                                                            <a href="addpromotion.php?transtempprm=<?php echo $transtempprm;?>&promotionid=<?php echo $hpromotionprm['id_promotion'];?>" class="btn btn-nahm btn-block"><?php echo $hpromotionprm['promotion_name'];?></a>
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
                                                    <div class="col-md-6">  
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
                                                                        <div class="col-md-4 nopadding">
                                                                            <a href="addpromotion.php?transtempprm=<?php echo $transtempprm;?>&promotionid=<?php echo $hpromotionprm['id_promotion'];?>" class="btn btn-nahm maxwidthheight"><?php echo $hpromotionprm['promotion_name'];?></a>
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
                    <!--END: OTHER PROMOTION-->
                    <!--start: void promotion-->
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpromotionvoid" style="padding-left: 0px;padding-right: 0px;">PROMOTION VOID</a>
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
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">PROMOTION VOID</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panels -->
                                    <div class="tab-content">
                                        <!--Panel 17-->
                                        <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

                                            <!--Body-->
                                            <div class="modal-body text-center mb-1">
                                                <h5 class="mt-1 mb-2">PILIH PROMOTION YANG AKAN DI VOID</h5>
                                                <div class="row scrollpage mh5">
                                                <div class="col-md-12 nopadding">
                                                <?php
                                                include "koneksi.php";
                                                $pospaymenttemp=mysqli_query($koneksi,"SELECT * FROM pos_paymenttemp where NoTrans = '$transtempprm'");
                                                while($hpospaymenttemp = mysqli_fetch_array($pospaymenttemp)) 
                                                {
                                                $paytype=$hpospaymenttemp['JnsTrans'];
                                                $jpay=$hpospaymenttemp['Jumlah'];
                                                ?>
                                                    <a href="hapuspospaymenttemp.php?transtempprm=<?php echo $transtempprm;?>&paytype=<?php echo $paytype;?>&jpay=<?php echo $jpay;?>" class="btn btn-nahm btn-block"><?php echo $paytype;?> : Rp <?php echo $hpospaymenttemp['Jumlah'];?></a> 
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
                    <?php
                    if($finalgt == "")
                    {
                    ?>
                    <script>
                    function tutuptransaksi() 
                        {
                            alert("ANDA BELUM MELAKUKAN TRANSAKSI");
                        }
                    </script>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="tutuptransaksi()" style="padding-left: 0px;padding-right: 0px;">SELESAIKAN TRANSAKSI</a>
                    </div>
                    <div class="col-md-12">
                    <a href="index.php" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">HOLD TRANSAKSI</a>
                    </div>
                    <?php
                    }
                    elseif($finalgt > $jb)
                    {
                    ?>
                    <script>
                    function tutuptransaksi1() 
                        {
                            alert("PEMBAYARAN KURANG");
                        }
                    </script>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="tutuptransaksi1()" style="padding-left: 0px;padding-right: 0px;">SELESAIKAN TRANSAKSI</a>
                    </div>
                    <div class="col-md-12">
                    <a href="index.php" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">HOLD TRANSAKSI</a>
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="col-md-12">
                    <a href="savetransaction.php?usr=<?php echo $usrpay;?>&notranstemp=<?php echo $transtemp;?>&date=<?php echo $datepay;?>&time=<?php echo $timepay;?>&outlet=<?php echo $outletpay;?>&gt=<?php echo $prmsubtotal;?>&gttax=<?php echo $gttax;?>&finalgt=<?php echo $finalgt;?>&jumbay=<?php echo $jb;?>" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">SELESAIKAN TRANSAKSI</a>
                    </div>
                    <div class="col-md-12">
                    <a href="index.php" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">HOLD TRANSAKSI</a>
                    </div>
                    <?php
                    }
                    ?>
                    <!--Modal: selesaikan transaksi-->
                <?php
                }
                else
                {
                ?>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalmulaitans" style="padding-left: 0px;padding-right: 0px;">BUAT TRANSAKSI</a>
                    </div>
                    <!--Modal: mulai transaksi-->
                    <div class="modal fade" id="modalmulaitans" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal" role="document">
                            <!--Content-->
                            <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tabs-2" role="tablist">
                                        <li class="nav-item">
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel17" role="tab">DETAIL TRANSAKSI</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panels -->
                                    <div class="tab-content">
                                        <!--Panel 17-->
                                        <div class="tab-pane fade in show active" id="panel17" role="tabpanel">

                                            <!--Body-->
                                            <div class="modal-body text-center mb-1">
                                                <script type="text/javascript">
                                                function displynumcash(n1)
                                                {
                                                    calcformcust.txt1.value=calcformcust.txt1.value+n1;
                                                }
                                                function displyclearcash()
                                                {
                                                    calcformcust.txt1.value="";
                                                }
                                                </script>
                                                <form name="calcformcust" action="start.php" method="post">

                                                <!--/.numpad-->
                                                <div class="row">
                                                <div class="col-md-12">
                                                <table width="40%" align="center">
                                                    <tr>
                                                    <td colspan="3">
                                                    <input type="hidden" name="lastuser" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
                                                    <input type="text" name="txt1" class="form-control ml-0" placeholder="masukan jumlah customer">
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
                                                        <td></td>
                                                        <td><input type=button name="btn0cash" value=0 onclick="displynumcash(btn0cash.value)" class="btn btn-nahm btn-block"></td>
                                                        <td></td>
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
                                                </div>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                        <!--/.Panel 17-->
                                    </div>

                                </div>
                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!--Modal: mulai transaksi-->
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalbukatans" style="padding-left: 0px;padding-right: 0px;">buka TRANSAKSI</a>
                    </div>
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
                                                ?>
                                                    <a href="index.php?transtempprm=<?php echo $opentrans;?>" class="btn btn-nahm btn-block"><?php echo $opentrans;?></a> 
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
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">REFUND</a>
                    </div>
                    <div class="col-md-12">
                    <a href="keluar.php" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;">LOGOUT</a>
                    </div>
                <?php
                }
                ?>
                </div>
                <!-- Nav tabs -->
            </div>
        </div>
    </div>

    <?php
    $transtemp=$transtempprm;
    $itemtemp=mysqli_query($koneksi,"select * from pos_salestemp where notrans ='$transtemp'");
    $ritemtemp=mysqli_num_rows($itemtemp);
    if ($ritemtemp > 0)
    {   
    ?>
    <!--menukanan-->
    <div class="col-md-6 tepian">
        <div class="row mh1">
        <!-- /menu -->
            <div class="col-md-12 tepian mh1 scrollpage">
                <div class="row">
                <?php
                    include "koneksi.php";
                    $cat=mysqli_query($koneksi,"SELECT * FROM pos_subcategory");
                    while($hcat = mysqli_fetch_array($cat)) 
                    {
                    $nomatx1=substr($hcat['kdsubcategory'],1);
                    $nomatx2=intval($nomatx1);
                    ?> 
                    <div class="col-md-3 nopadding">
                    <a href="#" class="btn btn-nahm maxwidthheight" onclick="positem<?php echo $nomatx2;?>()" style="padding-left: 0px;padding-right: 0px;"><?php echo $hcat['nmsubcategory'];?></a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <!-- /menu -->
            <div class="col-md-12 tepian mh1 scrollpage" id="item0">
                <div class="row">
                </div>
            </div>
            <!--/.postitem-->
            <div class="col-md-12 tepian mh1 scrollpage" id="item1">
                <div class="row">
                    <?php
                    include "koneksi.php";
                    $subcat=$_GET['SUBCAT'];
                    $sc=mysqli_query($koneksi,"SELECT * FROM pos_item where kdsubcategory = '200001' ");
                    while($hsc = mysqli_fetch_array($sc)) 
                    {
                    ?>
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="#" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()" style="padding-left: 0px;padding-right: 0px;"><?php echo str_replace(" ", "</br>", $hsc['nmitem']);?></a>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <div class="modal fade" id="modal<?php echo $hsc['kditem'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                            <!--Content-->
                            <div class="modal-content">
                                <!--Header-->
                                <!--Body-->
                                <div class="modal-body text-center mb-1">

                                    <h5 class="mt-1 mb-2"><?php echo $hsc['nmitem'];?></h5>
                                    <a>Input Jumlah Pembelian</a>
                                    <script type="text/javascript">
                                    function displynum<?php echo $kd;?>(n1)
                                    {
                                        calcform<?php echo $kd;?>.txt1.value=calcform<?php echo $kd;?>.txt1.value+n1;
                                    }
                                    function displyclear<?php echo $kd;?>()
                                    {
                                        calcform<?php echo $kd;?>.txt1.value="";
                                    }
                                    </script>
                                    <form name="calcform<?php echo $kd;?>" action="addpositem.php" method="post">
                                    <div class="md-form">
                                        <input type="hidden" name="id" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                        <input type="hidden" name="kd" value="<?php echo $kd;?>" class="form-control ml-0">
                                        <input type="text" name="txt1" class="form-control ml-0">
                                    </div>

                                    <!--/.numpad-->
                                    <table width="100%">
                                        <tr>
                                            <td><input type=button name="btn7<?php echo $kd;?>" value=7 onclick="displynum<?php echo $kd;?>(btn7<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn8<?php echo $kd;?>" value=8 onclick="displynum<?php echo $kd;?>(btn8<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn9<?php echo $kd;?>" value=9 onclick="displynum<?php echo $kd;?>(btn9<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn4<?php echo $kd;?>" value=4 onclick="displynum<?php echo $kd;?>(btn4<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn5<?php echo $kd;?>" value=5 onclick="displynum<?php echo $kd;?>(btn5<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn6<?php echo $kd;?>" value=6 onclick="displynum<?php echo $kd;?>(btn6<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn1<?php echo $kd;?>" value=1 onclick="displynum<?php echo $kd;?>(btn1<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn2<?php echo $kd;?>" value=2 onclick="displynum<?php echo $kd;?>(btn2<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn3<?php echo $kd;?>" value=3 onclick="displynum<?php echo $kd;?>(btn3<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn0<?php echo $kd;?>" value=0 onclick="displynum<?php echo $kd;?>(btn0<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td colspan="2"><input type=button name="clrbtn" value=clear onclick="displyclear<?php echo $kd;?>()" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                    </table>
                                    <!--/.numpad-->
                                    <div class="text-center mt-4">
                                        <button class="btn btn-nahm btn-block">Proses
                                            <i class="fa fa-sign-in ml-1"></i>
                                        </button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!--/.postitem-->
            <div class="col-md-12 tepian mh1 scrollpage" id="item2">
                <div class="row">
                    <?php
                    include "koneksi.php";
                    $subcat=$_GET['SUBCAT'];
                    $sc=mysqli_query($koneksi,"SELECT * FROM pos_item where kdsubcategory = '200002' ");
                    while($hsc = mysqli_fetch_array($sc)) 
                    {
                    ?> 
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="input/inputkeranjang.php?KDITEM=<?php echo $hsc['kditem'];?>&SUBCAT=<?php echo $subcat;?>" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()" style="padding-left: 0px;padding-right: 0px;"><?php echo str_replace(" ", "</br>", $hsc['nmitem']);?></a>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <div class="modal fade" id="modal<?php echo $hsc['kditem'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                            <!--Content-->
                            <div class="modal-content">
                                <!--Header-->
                                <!--Body-->
                                <div class="modal-body text-center mb-1">

                                    <h5 class="mt-1 mb-2"><?php echo $hsc['nmitem'];?></h5>
                                    <a>Input Jumlah Pembelian</a>
                                    <script type="text/javascript">
                                    function displynum<?php echo $kd;?>(n1)
                                    {
                                        calcform<?php echo $kd;?>.txt1.value=calcform<?php echo $kd;?>.txt1.value+n1;
                                    }
                                    function displyclear<?php echo $kd;?>()
                                    {
                                        calcform<?php echo $kd;?>.txt1.value="";
                                    }
                                    </script>
                                    <form name="calcform<?php echo $kd;?>" action="addpositem.php" method="post">
                                    <div class="md-form">
                                        <input type="hidden" name="id" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                        <input type="hidden" name="kd" value="<?php echo $kd;?>" class="form-control ml-0">
                                        <input type="text" name="txt1" class="form-control ml-0">
                                    </div>

                                    <!--/.numpad-->
                                    <table width="100%">
                                        <tr>
                                            <td><input type=button name="btn7<?php echo $kd;?>" value=7 onclick="displynum<?php echo $kd;?>(btn7<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn8<?php echo $kd;?>" value=8 onclick="displynum<?php echo $kd;?>(btn8<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn9<?php echo $kd;?>" value=9 onclick="displynum<?php echo $kd;?>(btn9<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn4<?php echo $kd;?>" value=4 onclick="displynum<?php echo $kd;?>(btn4<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn5<?php echo $kd;?>" value=5 onclick="displynum<?php echo $kd;?>(btn5<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn6<?php echo $kd;?>" value=6 onclick="displynum<?php echo $kd;?>(btn6<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn1<?php echo $kd;?>" value=1 onclick="displynum<?php echo $kd;?>(btn1<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn2<?php echo $kd;?>" value=2 onclick="displynum<?php echo $kd;?>(btn2<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn3<?php echo $kd;?>" value=3 onclick="displynum<?php echo $kd;?>(btn3<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn0<?php echo $kd;?>" value=0 onclick="displynum<?php echo $kd;?>(btn0<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td colspan="2"><input type=button name="clrbtn" value=clear onclick="displyclear<?php echo $kd;?>()" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                    </table>
                                    <!--/.numpad-->
                                    <div class="text-center mt-4">
                                        <button class="btn btn-nahm btn-block">Proses
                                            <i class="fa fa-sign-in ml-1"></i>
                                        </button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!--/.postitem-->
            <div class="col-md-12 tepian mh1 scrollpage" id="item3">
                <div class="row">
                    <?php
                    include "koneksi.php";
                    $subcat=$_GET['SUBCAT'];
                    $sc=mysqli_query($koneksi,"SELECT * FROM pos_item where kdsubcategory = '200003' ");
                    while($hsc = mysqli_fetch_array($sc)) 
                    {
                    ?> 
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="input/inputkeranjang.php?KDITEM=<?php echo $hsc['kditem'];?>&SUBCAT=<?php echo $subcat;?>" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()" style="padding-left: 0px;padding-right: 0px;"><?php echo str_replace(" ", "</br>", $hsc['nmitem']);?></a>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <div class="modal fade" id="modal<?php echo $hsc['kditem'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                            <!--Content-->
                            <div class="modal-content">
                                <!--Header-->
                                <!--Body-->
                                <div class="modal-body text-center mb-1">

                                    <h5 class="mt-1 mb-2"><?php echo $hsc['nmitem'];?></h5>
                                    <a>Input Jumlah Pembelian</a>
                                    <script type="text/javascript">
                                    function displynum<?php echo $kd;?>(n1)
                                    {
                                        calcform<?php echo $kd;?>.txt1.value=calcform<?php echo $kd;?>.txt1.value+n1;
                                    }
                                    function displyclear<?php echo $kd;?>()
                                    {
                                        calcform<?php echo $kd;?>.txt1.value="";
                                    }
                                    </script>
                                    <form name="calcform<?php echo $kd;?>" action="addpositem.php" method="post">
                                    <div class="md-form">
                                        <input type="hidden" name="id" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                        <input type="hidden" name="kd" value="<?php echo $kd;?>" class="form-control ml-0">
                                        <input type="text" name="txt1" class="form-control ml-0">
                                    </div>

                                    <!--/.numpad-->
                                    <table width="100%">
                                        <tr>
                                            <td><input type=button name="btn7<?php echo $kd;?>" value=7 onclick="displynum<?php echo $kd;?>(btn7<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn8<?php echo $kd;?>" value=8 onclick="displynum<?php echo $kd;?>(btn8<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn9<?php echo $kd;?>" value=9 onclick="displynum<?php echo $kd;?>(btn9<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn4<?php echo $kd;?>" value=4 onclick="displynum<?php echo $kd;?>(btn4<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn5<?php echo $kd;?>" value=5 onclick="displynum<?php echo $kd;?>(btn5<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn6<?php echo $kd;?>" value=6 onclick="displynum<?php echo $kd;?>(btn6<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn1<?php echo $kd;?>" value=1 onclick="displynum<?php echo $kd;?>(btn1<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn2<?php echo $kd;?>" value=2 onclick="displynum<?php echo $kd;?>(btn2<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn3<?php echo $kd;?>" value=3 onclick="displynum<?php echo $kd;?>(btn3<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn0<?php echo $kd;?>" value=0 onclick="displynum<?php echo $kd;?>(btn0<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td colspan="2"><input type=button name="clrbtn" value=clear onclick="displyclear<?php echo $kd;?>()" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                    </table>
                                    <!--/.numpad-->
                                    <div class="text-center mt-4">
                                        <button class="btn btn-nahm btn-block">Proses
                                            <i class="fa fa-sign-in ml-1"></i>
                                        </button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!--/.postitem-->
            <div class="col-md-12 tepian mh1 scrollpage" id="item4">
            <div class="row">
                    <?php
                    include "koneksi.php";
                    $subcat=$_GET['SUBCAT'];
                    $sc=mysqli_query($koneksi,"SELECT * FROM pos_item where kdsubcategory = '200004' ");
                    while($hsc = mysqli_fetch_array($sc)) 
                    {
                    ?> 
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="input/inputkeranjang.php?KDITEM=<?php echo $hsc['kditem'];?>&SUBCAT=<?php echo $subcat;?>" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()" style="padding-left: 0px;padding-right: 0px;"><?php echo str_replace(" ", "</br>", $hsc['nmitem']);?></a>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <div class="modal fade" id="modal<?php echo $hsc['kditem'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                            <!--Content-->
                            <div class="modal-content">
                                <!--Header-->
                                <!--Body-->
                                <div class="modal-body text-center mb-1">

                                    <h5 class="mt-1 mb-2"><?php echo $hsc['nmitem'];?></h5>
                                    <a>Input Jumlah Pembelian</a>
                                    <script type="text/javascript">
                                    function displynum<?php echo $kd;?>(n1)
                                    {
                                        calcform<?php echo $kd;?>.txt1.value=calcform<?php echo $kd;?>.txt1.value+n1;
                                    }
                                    function displyclear<?php echo $kd;?>()
                                    {
                                        calcform<?php echo $kd;?>.txt1.value="";
                                    }
                                    </script>
                                    <form name="calcform<?php echo $kd;?>" action="addpositem.php" method="post">
                                    <div class="md-form">
                                        <input type="hidden" name="id" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                        <input type="hidden" name="kd" value="<?php echo $kd;?>" class="form-control ml-0">
                                        <input type="text" name="txt1" class="form-control ml-0">
                                    </div>

                                    <!--/.numpad-->
                                    <table width="100%">
                                        <tr>
                                            <td><input type=button name="btn7<?php echo $kd;?>" value=7 onclick="displynum<?php echo $kd;?>(btn7<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn8<?php echo $kd;?>" value=8 onclick="displynum<?php echo $kd;?>(btn8<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn9<?php echo $kd;?>" value=9 onclick="displynum<?php echo $kd;?>(btn9<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn4<?php echo $kd;?>" value=4 onclick="displynum<?php echo $kd;?>(btn4<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn5<?php echo $kd;?>" value=5 onclick="displynum<?php echo $kd;?>(btn5<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn6<?php echo $kd;?>" value=6 onclick="displynum<?php echo $kd;?>(btn6<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn1<?php echo $kd;?>" value=1 onclick="displynum<?php echo $kd;?>(btn1<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn2<?php echo $kd;?>" value=2 onclick="displynum<?php echo $kd;?>(btn2<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn3<?php echo $kd;?>" value=3 onclick="displynum<?php echo $kd;?>(btn3<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn0<?php echo $kd;?>" value=0 onclick="displynum<?php echo $kd;?>(btn0<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td colspan="2"><input type=button name="clrbtn" value=clear onclick="displyclear<?php echo $kd;?>()" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                    </table>
                                    <!--/.numpad-->
                                    <div class="text-center mt-4">
                                        <button class="btn btn-nahm btn-block">Proses
                                            <i class="fa fa-sign-in ml-1"></i>
                                        </button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!--/.postitem-->
            <div class="col-md-12 tepian mh1 scrollpage" id="item5">
                <div class="row">
                    <?php
                    include "koneksi.php";
                    $subcat=$_GET['SUBCAT'];
                    $sc=mysqli_query($koneksi,"SELECT * FROM pos_item where kdsubcategory = '200005' ");
                    while($hsc = mysqli_fetch_array($sc)) 
                    {
                    ?> 
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="input/inputkeranjang.php?KDITEM=<?php echo $hsc['kditem'];?>&SUBCAT=<?php echo $subcat;?>" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()" style="padding-left: 0px;padding-right: 0px;"><?php echo str_replace(" ", "</br>", $hsc['nmitem']);?></a>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <div class="modal fade" id="modal<?php echo $hsc['kditem'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                            <!--Content-->
                            <div class="modal-content">
                                <!--Header-->
                                <!--Body-->
                                <div class="modal-body text-center mb-1">

                                    <h5 class="mt-1 mb-2"><?php echo $hsc['nmitem'];?></h5>
                                    <a>Input Jumlah Pembelian</a>
                                    <script type="text/javascript">
                                    function displynum<?php echo $kd;?>(n1)
                                    {
                                        calcform<?php echo $kd;?>.txt1.value=calcform<?php echo $kd;?>.txt1.value+n1;
                                    }
                                    function displyclear<?php echo $kd;?>()
                                    {
                                        calcform<?php echo $kd;?>.txt1.value="";
                                    }
                                    </script>
                                    <form name="calcform<?php echo $kd;?>" action="addpositem.php" method="post">
                                    <div class="md-form">
                                        <input type="hidden" name="id" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                        <input type="hidden" name="kd" value="<?php echo $kd;?>" class="form-control ml-0">
                                        <input type="text" name="txt1" class="form-control ml-0">
                                    </div>

                                    <!--/.numpad-->
                                    <table width="100%">
                                        <tr>
                                            <td><input type=button name="btn7<?php echo $kd;?>" value=7 onclick="displynum<?php echo $kd;?>(btn7<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn8<?php echo $kd;?>" value=8 onclick="displynum<?php echo $kd;?>(btn8<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn9<?php echo $kd;?>" value=9 onclick="displynum<?php echo $kd;?>(btn9<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn4<?php echo $kd;?>" value=4 onclick="displynum<?php echo $kd;?>(btn4<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn5<?php echo $kd;?>" value=5 onclick="displynum<?php echo $kd;?>(btn5<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn6<?php echo $kd;?>" value=6 onclick="displynum<?php echo $kd;?>(btn6<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn1<?php echo $kd;?>" value=1 onclick="displynum<?php echo $kd;?>(btn1<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn2<?php echo $kd;?>" value=2 onclick="displynum<?php echo $kd;?>(btn2<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn3<?php echo $kd;?>" value=3 onclick="displynum<?php echo $kd;?>(btn3<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn0<?php echo $kd;?>" value=0 onclick="displynum<?php echo $kd;?>(btn0<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td colspan="2"><input type=button name="clrbtn" value=clear onclick="displyclear<?php echo $kd;?>()" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                    </table>
                                    <!--/.numpad-->
                                    <div class="text-center mt-4">
                                        <button class="btn btn-nahm btn-block">Proses
                                            <i class="fa fa-sign-in ml-1"></i>
                                        </button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!--/.postitem-->
            <div class="col-md-12 tepian mh1 scrollpage" id="item6">
                <div class="row">
                    <?php
                    include "koneksi.php";
                    $subcat=$_GET['SUBCAT'];
                    $sc=mysqli_query($koneksi,"SELECT * FROM pos_item where kdsubcategory = '200006' ");
                    while($hsc = mysqli_fetch_array($sc)) 
                    {
                    ?> 
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="input/inputkeranjang.php?KDITEM=<?php echo $hsc['kditem'];?>&SUBCAT=<?php echo $subcat;?>" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()" style="padding-left: 0px;padding-right: 0px;"><?php echo str_replace(" ", "</br>", $hsc['nmitem']);?></a>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <div class="modal fade" id="modal<?php echo $hsc['kditem'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                            <!--Content-->
                            <div class="modal-content">
                                <!--Header-->
                                <!--Body-->
                                <div class="modal-body text-center mb-1">

                                    <h5 class="mt-1 mb-2"><?php echo $hsc['nmitem'];?></h5>
                                    <a>Input Jumlah Pembelian</a>
                                    <script type="text/javascript">
                                    function displynum<?php echo $kd;?>(n1)
                                    {
                                        calcform<?php echo $kd;?>.txt1.value=calcform<?php echo $kd;?>.txt1.value+n1;
                                    }
                                    function displyclear<?php echo $kd;?>()
                                    {
                                        calcform<?php echo $kd;?>.txt1.value="";
                                    }
                                    </script>
                                    <form name="calcform<?php echo $kd;?>" action="addpositem.php" method="post">
                                    <div class="md-form">
                                        <input type="hidden" name="id" value="<?php echo $transtempprm;?>" class="form-control ml-0">
                                        <input type="hidden" name="kd" value="<?php echo $kd;?>" class="form-control ml-0">
                                        <input type="text" name="txt1" class="form-control ml-0">
                                    </div>

                                    <!--/.numpad-->
                                    <table width="100%">
                                        <tr>
                                            <td><input type=button name="btn7<?php echo $kd;?>" value=7 onclick="displynum<?php echo $kd;?>(btn7<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn8<?php echo $kd;?>" value=8 onclick="displynum<?php echo $kd;?>(btn8<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn9<?php echo $kd;?>" value=9 onclick="displynum<?php echo $kd;?>(btn9<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn4<?php echo $kd;?>" value=4 onclick="displynum<?php echo $kd;?>(btn4<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn5<?php echo $kd;?>" value=5 onclick="displynum<?php echo $kd;?>(btn5<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn6<?php echo $kd;?>" value=6 onclick="displynum<?php echo $kd;?>(btn6<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn1<?php echo $kd;?>" value=1 onclick="displynum<?php echo $kd;?>(btn1<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn2<?php echo $kd;?>" value=2 onclick="displynum<?php echo $kd;?>(btn2<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td><input type=button name="btn3<?php echo $kd;?>" value=3 onclick="displynum<?php echo $kd;?>(btn3<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                        <tr>
                                            <td><input type=button name="btn0<?php echo $kd;?>" value=0 onclick="displynum<?php echo $kd;?>(btn0<?php echo $kd;?>.value)" class="btn btn-nahm btn-block"></td>
                                            <td colspan="2"><input type=button name="clrbtn" value=clear onclick="displyclear<?php echo $kd;?>()" class="btn btn-nahm btn-block"></td>
                                        </tr>
                                    </table>
                                    <!--/.numpad-->
                                    <div class="text-center mt-4">
                                        <button class="btn btn-nahm btn-block">Proses
                                            <i class="fa fa-sign-in ml-1"></i>
                                        </button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!--Modal Form Login with Avatar Demo-->
                    <?php
                    }
                    ?>
                </div>
            </div>
        <!-- /menu -->

        </div><!-- /row -->
    </div>
    <!--menukanan-->
    <?php
    }
    else
    {
    ?>
    <div class="col-md-6 tepian">
    <div class="row mh2 justify-content-md-center tepian" style="background-color: rgba(0, 0, 0, 0.2);">
        <!--/.postitem-->
        <div class="col-md-12">
                <table width="60%" align="center" style="margin-top: 10%;margin-bottom: 10%;">
                <tr>
                <td><img src="lock.png" class="img-fluid" alt="Responsive image"></td>
                </tr>
                <tr>
                <td align="center"><h5 class="mt-1 mb-2">TEKAN TOMBOL <b>MULAI TRANSSAKSI</b> UNTUK MEMBUKA MENU</h5></td>
                </tr>
                </table>
        </div>
    </div>
    </div>
    <?php
    }
    ?>

</div>
</div>
    <!-- SCRIPTS -->
    <!-- JQuery -->
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