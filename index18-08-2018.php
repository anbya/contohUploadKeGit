<?php 
error_reporting(0);
session_start();
if (empty($_SESSION['namauser']))
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
    #menukanan
    {
        display: block;
    }
    #menukanan1
    {
        display: none;
    }
    </style>
</head>

<body onkeypress='return false'>
<div class="container-fluid" style="background-color: #ffe6e6;">
<div class="row mh2">
    <div class="col-md-4 tepian">
        <div class="row mh3">
            <div class="col-md-12 tepian">

                        <!-- Nav tabs -->
                <div class="row">
                    <div class="col-md-12 nopadding">
                        <table width="100%">
                            <tr>
                                <td width="40%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 10px; font-weight: bold;">Item Name</td>
                                <td width="30%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 10px; font-weight: bold;">Qty<div id="result"></div></td>
                                <td width="30%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 10px; font-weight: bold;">amount</td>
                            </tr>
                            <?php
                            include "koneksi.php";
                            $itemtemp=mysql_query("SELECT * FROM pos_itemtemp");
                            while($hitemtemp = mysql_fetch_array($itemtemp)) 
                            {
                            ?>
                            <?php
                            $kditem=$hitemtemp['kditem'];
                            $itemdet=mysql_query("SELECT * FROM pos_item where kditem = $kditem");
                            $hitemdet = mysql_fetch_array($itemdet);
                            $price=$hitemtemp['grandprice'];
                            ?>
                            <tr>
                                <td width="40%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 10px; font-weight: bold;"><?php echo $hitemdet['nmitem'];?></td>
                                <td width="30%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 10px; font-weight: bold;"><?php echo $hitemtemp['qty'];?></td>
                                <td width="30%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 10px; font-weight: bold;"><?php echo number_format("$price");?></td>
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
        <div class="row mh4">
            <div class="col-md-12 tepian">

                        <!-- Nav tabs -->
                <div class="row">
                    <div class="col-md-12 nopadding">
                        <table width="100%">
                            <?php
                            $transtemp=$_SESSION['iduser'];
                            $query1 = "SELECT SUM(grandprice) AS grand_total FROM `pos_itemtemp` WHERE transtemp = $transtemp ";
                            $result1 = mysql_query($query1) or die (mysql_error());
                            $gtfetch = mysql_fetch_array($result1);
                            $gt=$gtfetch['grand_total'];
                            $gttax=10*$gt/100;
                            $finalgt=$gt+$gttax;
                            ?>
                            <?php
                            $transtemp=$_SESSION['iduser'];
                            $query2 = "SELECT SUM(Jumlah) AS jumlahbayar FROM `pos_paymenttemp` where NoTrans = $transtemp ";
                            $result2 = mysql_query($query2) or die (mysql_error());
                            $jbfetch = mysql_fetch_array($result2);
                            $jb=$jbfetch['jumlahbayar'];
                            $kembalian=$jb-$finalgt;
                            ?>
                            <?php
                            $transtemp=$_SESSION['iduser'];
                            $query3 = "SELECT * FROM pos_salestemp WHERE notrans = $transtemp ";
                            $result3 = mysql_query($query3) or die (mysql_error());
                            $salesh = mysql_fetch_array($result3);
                            $member=$salesh['id_member'];
                            $custqty=$salesh['custqty'];
                            $query4 = "SELECT * FROM member where id_member = '$member' OR telepon = '$member' ";
                            $result4 = mysql_query($query4) or die (mysql_error());
                            $nmmbr = mysql_fetch_array($result4);
                            $namamember=$nmmbr['nama_member'];
                            ?>

                            <tr>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;"></td>
                                <td width="30%" style="padding-left: 10px; font-weight: bold;">Sub Total</td>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;" class="tepibawah">:</td>
                                <td width="50%" style="padding-left: 10px; font-weight: bold; text-align: right;" class="tepibawah">
                                <?php echo number_format("$gt");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;"></td>
                                <td width="30%" style="padding-left: 10px; font-weight: bold;">Tax</td>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;" class="tepibawah">:</td>
                                <td width="50%" style="padding-left: 10px; font-weight: bold; text-align: right;" class="tepibawah">
                                <?php echo number_format("$gttax");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;"></td>
                                <td width="30%" style="padding-left: 10px; font-weight: bold;">Grand Total</td>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;" class="tepibawah">:</td>
                                <td width="50%" style="padding-left: 10px; font-weight: bold; text-align: right;" class="tepibawah">
                                <?php echo number_format("$finalgt");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;"></td>
                                <td width="30%" style="padding-left: 10px; font-weight: bold;">Jumlah Bayar</td>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;" class="tepibawah">:</td>
                                <td width="50%" style="padding-left: 10px; font-weight: bold; text-align: right;" class="tepibawah">
                                <?php echo number_format("$jb");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;"></td>
                                <td width="30%" style="padding-left: 10px; font-weight: bold;">Kembalian</td>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;" class="tepibawah">:</td>
                                <td width="50%" style="padding-left: 10px; font-weight: bold; text-align: right;" class="tepibawah">
                                <?php echo number_format("$kembalian");?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;"></td>
                                <td width="30%" style="padding-left: 10px; font-weight: bold;">Member</td>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;" class="tepibawah">:</td>
                                <td width="50%" style="padding-left: 10px; font-weight: bold; text-align: right;" class="tepibawah">
                                <?php echo $namamember;?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;"></td>
                                <td width="30%" style="padding-left: 10px; font-weight: bold;">Jumlah Customer</td>
                                <td width="10%" style="padding-left: 10px; font-weight: bold;" class="tepibawah">:</td>
                                <td width="50%" style="padding-left: 10px; font-weight: bold; text-align: right;" class="tepibawah">
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
                $transtemp=$_SESSION['iduser'];
                $itemtemp=mysql_query("select * from pos_salestemp where notrans ='$transtemp'");
                $ritemtemp=mysql_num_rows($itemtemp);
                if ($ritemtemp > 0)
                {   
                ?>
                    <div class="col-md-12">
                    <a href="kosongpos.php?id=<?php echo $_SESSION['iduser'];?>" class="btn btn-nahm btn-block maxwidthheight">BATAL</a>
                    </div>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalmember">MEMBER</a>
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
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">Input ID Member</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panels -->
                                    <div class="tab-content">
                                        <!--Panel 17-->
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
                                                    calcformmbr.txt1.value="";
                                                }
                                                </script>
                                                <form name="calcformmbr" action="updateposmember.php" method="post">

                                                <!--/.numpad-->
                                                <table width="65%" align="center">
                                                    <tr>
                                                    <td colspan="3">
                                                    <input type="hidden" name="notrans" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
                                                    <input type="text" name="txt1" class="form-control ml-0" placeholder="masukan ID Member">
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
                                        <!--/.Panel 17-->
                                    </div>

                                </div>
                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!--Modal: member-->
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalpayment">PAYMENT</a>
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
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel19" role="tab">
                                                <i class="fa fa-newspaper-o mr-1"></i> <br>Voucher</a>
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
                                                    <input type="hidden" name="notrans" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
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
                                                    <input type="hidden" name="notrans" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
                                                    <input type="hidden" name="jnspay" value="CASH" class="form-control ml-0">
                                                    <input type="hidden" name="num" value="" class="form-control ml-0">
                                                    <select class="form-control" name="jnscard">
                                                        <option value="" disabled selected>Pilih Jenis Kartu</option>
                                                        <option value="DEBIT">DEBIT</option>
                                                        <option value="VISA">VISA</option>
                                                        <option value="MASTER">MASTER</option>
                                                    </select>
                                                    <select class="form-control" name="bank">
                                                        <option value="" disabled selected>Pilih Bank</option>
                                                        <option value="BCA">BCA</option>
                                                        <option value="MANDIRI">MANDIRI</option>
                                                        <option value="OTHER">OTHER</option>
                                                    </select>
                                                    <input type="text" name="txt1" class="form-control ml-0" placeholder="masukan jumlah bayar">
                                                    <input type="hidden" name="lastuser" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
                                                    <input type="hidden" name="lastmodify" value="<?php echo "".date("d-m-Y", $tanggal)."";?>" class="form-control ml-0">
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type=button name="btn7card" value=7 onclick="displynumcard(btn7card.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn8card" value=8 onclick="displynumcard(btn8card.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn9card" value=9 onclick="displynumcard(btn9card.value)" class="btn btn-nahm btn-block"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type=button name="btn4card" value=4 onclick="displynumcard(btn4card.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn5card" value=5 onclick="displynumcard(btn5card.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn6card" value=6 onclick="displynumcard(btn6card.value)" class="btn btn-nahm btn-block"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type=button name="btn1card" value=1 onclick="displynumcard(btn1card.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn2card" value=2 onclick="displynumcard(btn2card.value)" class="btn btn-nahm btn-block"></td>
                                                        <td><input type=button name="btn3card" value=3 onclick="displynumcard(btn3card.value)" class="btn btn-nahm btn-block"></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><input type=button name="btn0card" value=0 onclick="displynumcard(btn0card.value)" class="btn btn-nahm btn-block"></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"><input type=button name="clrbtn" value=clear onclick="displyclearcard()" class="btn btn-nahm btn-block"></td>
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
                                        <div class="tab-pane fade" id="panel19" role="tabpanel">

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
                    <!--Modal: payment-->
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight">TUTUP TRANSAKSI</a>
                    </div>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalvoid">ITEM VOID</a>
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
                                                $postemp=mysql_query("SELECT * FROM pos_itemtemp ");
                                                while($hpostemp = mysql_fetch_array($postemp)) 
                                                {
                                                ?>
                                                <?php
                                                $kdpostemp=$hpostemp['kditem'];
                                                $nmpostemp=mysql_query("SELECT * FROM pos_item where kditem = '$kdpostemp'");
                                                $nmpostemp = mysql_fetch_array($nmpostemp); 
                                                ?>
                                                    <a href="hapuspositemtemp.php?KDITEM=<?php echo $kdpostemp;?>" class="btn btn-nahm btn-block"><?php echo $nmpostemp['nmitem'];?></a> 
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
                    <!--Modal: void-->
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="menukanan1()">CRM</a>
                    </div>
                <?php
                }
                else
                {
                ?>
                    <div class="col-md-12">
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight" data-toggle="modal" data-target="#modalmulaitans">MULAI TRANSAKSI</a>
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
                                            <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel17" role="tab">Jumlah Customer</a>
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
                                                <table width="65%" align="center">
                                                    <tr>
                                                    <td colspan="3">
                                                    <input type="hidden" name="notrans" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
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
                    <a href="#" class="btn btn-nahm btn-block maxwidthheight">REFUND</a>
                    </div>
                    <div class="col-md-12">
                    <a href="keluar.php" class="btn btn-nahm btn-block maxwidthheight">LOGOUT</a>
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
    $transtemp=$_SESSION['iduser'];
    $itemtemp=mysql_query("select * from pos_salestemp where notrans ='$transtemp'");
    $ritemtemp=mysql_num_rows($itemtemp);
    if ($ritemtemp > 0)
    {   
    ?>
    <!--menukanan-->
    <div class="col-md-6 tepian" id="menukanan">
        <div class="row mh1">
        <!-- /menu -->
            <div class="col-md-12 tepian mh1 scrollpage">
                <div class="row">
                <?php
                    include "koneksi.php";
                    $cat=mysql_query("SELECT * FROM pos_subcategory");
                    while($hcat = mysql_fetch_array($cat)) 
                    {
                    $nomatx1=substr($hcat['kdsubcategory'],1);
                    $nomatx2=intval($nomatx1);
                    ?> 
                    <div class="col-md-3 nopadding">
                    <a href="#" class="btn btn-nahm maxwidthheight" onclick="positem<?php echo $nomatx2;?>()"><?php echo $hcat['nmsubcategory'];?></a>
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
                    $sc=mysql_query("SELECT * FROM pos_item where kdsubcategory = '200001' ");
                    while($hsc = mysql_fetch_array($sc)) 
                    {
                    ?>
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="#" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()"><?php echo $hsc['nmitem'];?></a>
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
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
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
                    $sc=mysql_query("SELECT * FROM pos_item where kdsubcategory = '200002' ");
                    while($hsc = mysql_fetch_array($sc)) 
                    {
                    ?> 
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="input/inputkeranjang.php?KDITEM=<?php echo $hsc['kditem'];?>&SUBCAT=<?php echo $subcat;?>" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()"><?php echo $hsc['nmitem'];?></a>
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
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
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
                    $sc=mysql_query("SELECT * FROM pos_item where kdsubcategory = '200003' ");
                    while($hsc = mysql_fetch_array($sc)) 
                    {
                    ?> 
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="input/inputkeranjang.php?KDITEM=<?php echo $hsc['kditem'];?>&SUBCAT=<?php echo $subcat;?>" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()"><?php echo $hsc['nmitem'];?></a>
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
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
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
                    $sc=mysql_query("SELECT * FROM pos_item where kdsubcategory = '200004' ");
                    while($hsc = mysql_fetch_array($sc)) 
                    {
                    ?> 
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="input/inputkeranjang.php?KDITEM=<?php echo $hsc['kditem'];?>&SUBCAT=<?php echo $subcat;?>" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()"><?php echo $hsc['nmitem'];?></a>
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
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
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
                    $sc=mysql_query("SELECT * FROM pos_item where kdsubcategory = '200005' ");
                    while($hsc = mysql_fetch_array($sc)) 
                    {
                    ?> 
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="input/inputkeranjang.php?KDITEM=<?php echo $hsc['kditem'];?>&SUBCAT=<?php echo $subcat;?>" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()"><?php echo $hsc['nmitem'];?></a>
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
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
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
                    $sc=mysql_query("SELECT * FROM pos_item where kdsubcategory = '200006' ");
                    while($hsc = mysql_fetch_array($sc)) 
                    {
                    ?> 
                    <?php
                    $kd=$hsc['kditem'];
                    ?>
                    <div class="col-md-3 nopadding">
                    <a href="input/inputkeranjang.php?KDITEM=<?php echo $hsc['kditem'];?>&SUBCAT=<?php echo $subcat;?>" class="btn btn-nahm maxwidthheight" data-toggle="modal" data-target="#modal<?php echo $hsc['kditem'];?>" onclick="displyclear<?php echo $kd;?>()"><?php echo $hsc['nmitem'];?></a>
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
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['iduser'];?>" class="form-control ml-0">
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
    <!--menukanan1-->
    <div class="col-md-6 tepian" id="menukanan1">
    <div class="row mh2 justify-content-md-center tepian" style="background-color: rgba(0, 0, 0, 0.2);">
        <!--/.postitem-->
        <div class="col-md-12">
                <table width="80%" align="center">
                <tr>
                <td></td>
                </tr>
                <tr>
                <td align="center"><h5 class="mt-1 mb-2">TEKAN TOMBOL <b>MULAI TRANSSAKSI</b> UNTUK MEMBUKA MENU</h5></td>
                </tr>
                <tr>
                <td align="center"><a href="#" class="btn btn-nahm btn-block maxwidthheight" onclick="menukanan()">TUTUP</a></td>
                </tr>
                </table>
        </div>
    </div>
    </div>
    <!--menukanan1-->
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
    function menukanan() {
        document.getElementById("menukanan").style.display = "block";
        document.getElementById("menukanan1").style.display = "none";
    }
    function menukanan1() {
        document.getElementById("menukanan").style.display = "none";
        document.getElementById("menukanan1").style.display = "block";
    }
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