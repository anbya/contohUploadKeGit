<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css"><!-- DataTables -->
        <link href="datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Multi Item Selection examples -->
        <link href="datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link href="assets/libs/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <title>ISOIDE SALES REPORT</title>
    <style>
    table.dataTable{border-collapse:collapse !important;}
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <?php
                        include "nav.php";
                        ?>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">ISOIDE POS BACK OFFICE DASHBOARD</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page">SUMMARY SALES REPORT PANEL</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <form action="summarysalesreport.php" method="GET">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding: 10px;">
                            <div class="form-group">
                                <label for="input-select">Outlet</label>
                                <select class="form-control" id="input-select" name="outlet">
                                    <?php
                                    include "koneksi.php";
                                    $idoutletprm=mysqli_query($koneksi,"SELECT * FROM pos_parameter");
                                    $hidoutletprm = mysqli_fetch_array($idoutletprm);
                                    $tampiloutlet=mysqli_query($koneksi,"SELECT * FROM outlet where id_outlet = '$hidoutletprm[id_outlet]'");
                                    while($htampiloutlet = mysqli_fetch_array($tampiloutlet))
                                    {
                                    ?>
                                    <option value="<?php echo $htampiloutlet['id_outlet']; ?>"><?php echo $htampiloutlet['nama_outlet']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6" style="padding: 10px;">
                            <div class="form-group">
                                <label for="inputText3" class="col-form-label">Date From</label>
                                <input type="text" id="datepicker1" name="datefrom" style="width: 100%" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6" style="padding: 10px;">
                            <div class="form-group">
                                <label for="inputText3" class="col-form-label">Date To</label>
                                <input type="text" id="datepicker2" name="dateto" style="width: 100%" />
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <button type="submit" class="btn btn-outline-dark btn-block">PROCEED</button>
                        </div>
                    </div>
                    </form>
                    <?php
                    include "koneksi.php";
                    if(!empty($_GET['outlet']) AND !empty($_GET['datefrom']) AND !empty($_GET['dateto']))
                    {
                    $keyoutlet=$_GET['outlet'];
                    $keydatefrom=$_GET['datefrom'];
                    $keydateto=$_GET['dateto'];
                    $nmoutlet=mysqli_query($koneksi,"SELECT * FROM outlet where id_outlet = '$keyoutlet'");
                    $hnmoutlet = mysqli_fetch_array($nmoutlet);
                    ?>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <a href="summarysalesreportprint.php?outlet=<?php echo $keyoutlet;?>&datefrom=<?php echo $keydatefrom;?>&dateto=<?php echo $keydateto;?>" target="_blank" class="btn btn-outline-dark btn-block">PRINT THIS REPORT</a>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: center;">
                            <h3>SUMMARY SALES REPORT</h3>
                            <h3><?php echo $hnmoutlet['nama_outlet'];?></h3>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <a>PERIODE <?php echo $keydatefrom;?> TO <?php echo $keydateto;?></a>
                        </div>
                    </div>
                    <div class="row" style="width: 100%;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-12">
                                            Item Sales
                                        </div>
                                    </div>
                                    <div class="row" style="border-color: #000;border-width: 1px;border-style: solid;margin: 1px;">
                                        <div class="col-12">
                                            <div class="row">
                                                <?php
                                                include "koneksi.php";
                                                $katloop=mysqli_query($koneksi,"SELECT * FROM pos_kategoryitem");
                                                while($hkatloop = mysqli_fetch_array($katloop))
                                                {
                                                $sumcat=mysqli_query($koneksi,"SELECT (pos_itemtemp.transtemp), (pos_itemtemp.kdcategory),sum(pos_itemtemp.price) as totgp FROM pos_itemtemp INNER JOIN pos_salestemp ON (pos_itemtemp.transtemp = pos_salestemp.notrans) AND (pos_itemtemp.squenceorder !='tmp') AND (pos_salestemp.close_date between '$keydatefrom' AND '$keydateto') AND (pos_salestemp.id_outlet ='$keyoutlet') AND (pos_salestemp.status ='CLOSED') AND (pos_salestemp.status ='CLOSED') AND pos_itemtemp.kdcategory = '$hkatloop[kdcategory]'");
                                                $hsumcat = mysqli_fetch_array($sumcat);
                                                ?>
                                                <div class="col-7">
                                                    <?php echo $hkatloop['nmcategory'];?>
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format($hsumcat['totgp']);?>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-12">
                                            Item Sales
                                        </div>
                                    </div>
                                    <div class="row" style="border-color: #000;border-width: 1px;border-style: solid;margin: 1px;">
                                        <?php
                                        include "koneksi.php";
                                        $sumtotsales=mysqli_query($koneksi,"SELECT (pos_itemtemp.transtemp), (pos_itemtemp.kdcategory),sum(pos_itemtemp.price) as totsales FROM pos_itemtemp INNER JOIN pos_salestemp ON (pos_itemtemp.transtemp = pos_salestemp.notrans) AND (pos_itemtemp.squenceorder !='tmp') AND (pos_salestemp.id_outlet ='$keyoutlet') AND (pos_salestemp.status ='CLOSED') AND (pos_salestemp.close_date between '$keydatefrom' AND '$keydateto')");
                                        $hsumtotsales = mysqli_fetch_array($sumtotsales);
                                        ?>
                                        <div class="col-6">
                                            ItemSales
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format($hsumtotsales['totsales']);?>
                                        </div>
                                        <?php
                                        include "koneksi.php";
                                        $sumtotitmdisc=mysqli_query($koneksi,"SELECT (pos_promotion_h.notrans),(pos_promotion_h.promotion_type),sum(pos_promotion_h.disc) as totitmdisc FROM pos_promotion_h INNER JOIN pos_salestemp ON (pos_promotion_h.notrans = pos_salestemp.notrans) WHERE pos_promotion_h.promotion_type = 'DISC ITEM' AND (pos_salestemp.close_date between '$keydatefrom' AND '$keydateto') AND (pos_salestemp.id_outlet ='$keyoutlet') AND (pos_salestemp.status ='CLOSED')");
                                        $hsumtotitmdisc = mysqli_fetch_array($sumtotitmdisc);
                                        ?>
                                        <div class="col-6">
                                            ItemDisc
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format($hsumtotitmdisc['totitmdisc']);?>
                                        </div>
                                        <?php
                                        include "koneksi.php";
                                        $sumtotbildisc=mysqli_query($koneksi,"SELECT (pos_promotion_h.notrans),(pos_promotion_h.promotion_type),sum(pos_promotion_h.disc) as totbildisc FROM pos_promotion_h INNER JOIN pos_salestemp ON (pos_promotion_h.notrans = pos_salestemp.notrans) WHERE pos_promotion_h.promotion_type = 'DISC ALL' AND (pos_salestemp.close_date between '$keydatefrom' AND '$keydateto') AND (pos_salestemp.id_outlet ='$keyoutlet') AND (pos_salestemp.status ='CLOSED')");
                                        $hsumtotbildisc = mysqli_fetch_array($sumtotbildisc);
                                        ?>
                                        <div class="col-6">
                                            BillDisc
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format($hsumtotbildisc['totbildisc']);?>
                                        </div>
                                        <div class="col-6">
                                            ItemFOC
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format("0");?>
                                        </div>
                                        <div class="col-6">
                                            BillFOC
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format("0");?>
                                        </div>
                                        <?php
                                        include "koneksi.php";
                                        $sumtotdisc=mysqli_query($koneksi,"SELECT (pos_promotion_h.notrans),(pos_promotion_h.promotion_type),sum(pos_promotion_h.disc) as totdisc FROM pos_promotion_h INNER JOIN pos_salestemp ON (pos_promotion_h.notrans = pos_salestemp.notrans) WHERE pos_salestemp.close_date between '$keydatefrom' AND '$keydateto' AND (pos_salestemp.id_outlet ='$keyoutlet') AND (pos_salestemp.status ='CLOSED')");
                                        $hsumtotdisc = mysqli_fetch_array($sumtotdisc);
                                        $totdisc=$hsumtotdisc['totdisc'];
                                        $salesmindisc=$hsumtotsales['totsales']-$totdisc;
                                        ?>
                                        <div class="col-6" style="border-top-color: #000;border-top-width: 1px;border-top-style: solid;border-bottom-color: #000;border-bottom-width: 1px;border-bottom-style: solid;">
                                            Sales
                                        </div>
                                        <div class="col-6" style="border-top-color: #000;border-top-width: 1px;border-top-style: solid;border-bottom-color: #000;border-bottom-width: 1px;border-bottom-style: solid;text-align: right;">
                                            <?php echo number_format($salesmindisc);?>
                                        </div>


                                        <div class="col-6">
                                            Surcharge
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format("0");?>
                                        </div>
                                        <?php
                                        include "koneksi.php";
                                        $sumtax10=mysqli_query($koneksi,"SELECT sum(tax) AS tot10tax FROM pos_salestemp where close_date between '$keydatefrom' AND '$keydateto' AND (id_outlet ='$keyoutlet') AND (status ='CLOSED')");
                                        $hsumtax10 = mysqli_fetch_array($sumtax10);
                                        ?>
                                        <div class="col-6">
                                            Tax 10%
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format($hsumtax10['tot10tax']);?>
                                        </div>
                                        <?php
                                        include "koneksi.php";
                                        $sumsrvchrg=mysqli_query($koneksi,"SELECT sum(service_charge) AS totsrvchrg FROM pos_salestemp where close_date between '$keydatefrom' AND '$keydateto' AND (id_outlet ='$keyoutlet') AND (status ='CLOSED')");
                                        $hsumsrvchrg = mysqli_fetch_array($sumsrvchrg);
                                        ?>
                                        <div class="col-6">
                                            Service 5%
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format($hsumsrvchrg['totsrvchrg']);?>
                                        </div>

                                        <div class="col-6">
                                            Local Tax 2
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format("0");?>
                                        </div>

                                        <div class="col-6">
                                            Tips
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format("0");?>
                                        </div>

                                        <div class="col-6">
                                            RndAdjmnt
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format("0");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-7">
                                            SalesCollections(Cards)
                                        </div>
                                        <div class="col-2" style="text-align: right;">
                                            Tips
                                        </div>
                                        <div class="col-3" style="text-align: right;">
                                            CardAmnt
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 1px;border-color: #000;border-width: 1px;border-style: solid;min-height: 150px;">
                                        <div class="col-12">
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaydbbca=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaydbbca from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'DEBIT BCA') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaydbbca = mysqli_fetch_array($sumtotpaydbbca);
                                            ?>
                                            <div class="row">
                                                <div class="col-4" style="font-size: 0.9em;">
                                                    DEBIT BCA
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaydbbca['totpaydbbca']);?>
                                                </div>
                                                <div class="col-2" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaydbbca['totpaydbbca']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaybcacc=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaybcacc from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'BCA CREDIT CARD') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaybcacc = mysqli_fetch_array($sumtotpaybcacc);
                                            ?>
                                            <div class="row">
                                                <div class="col-4" style="font-size: 0.9em;">
                                                    BCA CREDIT CARD
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaybcacc['totpaybcacc']);?>
                                                </div>
                                                <div class="col-2" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaybcacc['totpaybcacc']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaydbbni=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaydbbni from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'BNI DEBIT') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaydbbni = mysqli_fetch_array($sumtotpaydbbni);
                                            ?>
                                            <div class="row">
                                                <div class="col-4" style="font-size: 0.9em;">
                                                    BNI DEBIT
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaydbbni['totpaydbbni']);?>
                                                </div>
                                                <div class="col-2" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaydbbni['totpaydbbni']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaybnicc=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaybnicc from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'BNI CREDIT CARD') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaybnicc = mysqli_fetch_array($sumtotpaybnicc);
                                            ?>
                                            <div class="row">
                                                <div class="col-4" style="font-size: 0.9em;">
                                                    BNI CREDIT CARD
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaybnicc['totpaybnicc']);?>
                                                </div>
                                                <div class="col-2" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaybnicc['totpaybnicc']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaydbmandiri=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaydbmandiri from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'MANDIRI DEBIT') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaydbmandiri = mysqli_fetch_array($sumtotpaydbmandiri);
                                            ?>
                                            <div class="row">
                                                <div class="col-4" style="font-size: 0.9em;">
                                                    MANDIRI DEBIT
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaydbmandiri['totpaydbmandiri']);?>
                                                </div>
                                                <div class="col-2" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaydbmandiri['totpaydbmandiri']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaymandiricc=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaymandiricc from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'MANDIRI CREDIT CARD') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaymandiricc = mysqli_fetch_array($sumtotpaymandiricc);
                                            ?>
                                            <div class="row">
                                                <div class="col-4" style="font-size: 0.9em;">
                                                    MANDIRI CREDIT CARD
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaymandiricc['totpaymandiricc']);?>
                                                </div>
                                                <div class="col-2" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaymandiricc['totpaymandiricc']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaydbbri=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaydbbri from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'BRI DEBIT') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaydbbri = mysqli_fetch_array($sumtotpaydbbri);
                                            ?>
                                            <div class="row">
                                                <div class="col-4" style="font-size: 0.9em;">
                                                    BRI DEBIT
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaydbbri['totpaydbbri']);?>
                                                </div>
                                                <div class="col-2" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaydbbri['totpaydbbri']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpayvisa=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpayvisa from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'VISA') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpayvisa = mysqli_fetch_array($sumtotpayvisa);
                                            ?>
                                            <div class="row">
                                                <div class="col-4" style="font-size: 0.9em;">
                                                    VISA
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpayvisa['totpayvisa']);?>
                                                </div>
                                                <div class="col-2" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpayvisa['totpayvisa']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaymaster=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaymaster from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'MASTER') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaymaster = mysqli_fetch_array($sumtotpaymaster);
                                            ?>
                                            <div class="row">
                                                <div class="col-4" style="font-size: 0.9em;">
                                                    MASTER
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaymaster['totpaymaster']);?>
                                                </div>
                                                <div class="col-2" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaymaster['totpaymaster']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaycard=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaycard from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsTrans = 'CARD') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaycard = mysqli_fetch_array($sumtotpaycard);
                                            ?>
                                            <div class="row">
                                                <div class="col-4" style="font-size: 0.9em;">
                                                    Total Card
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaycard['totpaycard']);?>
                                                </div>
                                                <div class="col-2" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaycard['totpaycard']);?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6" style="font-size: 0.9em;">
                                            SalesCollections(Cash)
                                        </div>
                                        <div class="col-3" style="font-size: 0.9em;">
                                            Cash Amount
                                        </div>
                                        <div class="col-3" style="font-size: 0.9em;">
                                            Local Currency Change
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 1px;border-color: #000;border-width: 1px;border-style: solid;min-height: 150px;">
                                        <div class="col-12">
                                            <?php
                                            include "koneksi.php";
                                            $sumtottraveloka=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as tottraveloka from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'TRAVELOKA') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtottraveloka = mysqli_fetch_array($sumtottraveloka);
                                            ?>
                                            <div class="row">
                                                <div class="col-4">
                                                    TRAVELOKA
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtottraveloka['tottraveloka']);?>
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtottgopay=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totgopay from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'GOPAY') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtottgopay = mysqli_fetch_array($sumtottgopay);
                                            ?>
                                            <div class="row">
                                                <div class="col-4">
                                                    GOPAY
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtottgopay['totgopay']);?>
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotcashcat=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totcashcat from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsCard = 'CASH') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotcashcat = mysqli_fetch_array($sumtotcashcat);
                                            ?>
                                            <div class="row">
                                                <div class="col-4">
                                                    CASH
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotcashcat['totcashcat']);?>
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaycash=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaycash from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsTrans = 'CASH') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaycash = mysqli_fetch_array($sumtotpaycash);
                                            ?>
                                            <div class="row">
                                                <div class="col-4">
                                                    Total Cash
                                                </div>
                                                <div class="col-3" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaycash['totpaycash']);?>
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format("0");?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 1px;">
                                        <div class="col-7" style="border-color: #000;border-width: 1px;border-style: solid;min-height: 150px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    Sales Collections(All)
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaycard=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaycard from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsTrans = 'CARD') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaycard = mysqli_fetch_array($sumtotpaycard);
                                            ?>
                                            <div class="row">
                                                <div class="col-7">
                                                    CARD
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaycard['totpaycard']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpaycash=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpaycash from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsTrans = 'CASH') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpaycash = mysqli_fetch_array($sumtotpaycash);
                                            ?>
                                            <div class="row">
                                                <div class="col-7">
                                                    CASH
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpaycash['totpaycash']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpayvcr=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpayvcr from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsTrans = 'VOUCHER') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpayvcr = mysqli_fetch_array($sumtotpayvcr);
                                            ?>
                                            <div class="row">
                                                <div class="col-7">
                                                    VOUCHER
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpayvcr['totpayvcr']);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpay=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpembayaran from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpay = mysqli_fetch_array($sumtotpay);
                                            ?>
                                            <div class="row">
                                                <div class="col-7">
                                                    TOTAL
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpay['totpembayaran']);?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <?php
                                            $salesaftertaxdll=$salesmindisc+$hsumtax10['tot10tax']+$hsumsrvchrg['totsrvchrg'];
                                            ?>
                                            <?php
                                            include "koneksi.php";
                                            $sumcover=mysqli_query($koneksi,"SELECT sum(custqty) as totcover from pos_salestemp where close_date between '$keydatefrom' AND '$keydateto' AND (id_outlet ='$keyoutlet') AND (status ='CLOSED')");
                                            $hsumcover = mysqli_fetch_array($sumcover);
                                            $avgcover=$salesaftertaxdll/$hsumcover['totcover'];
                                            ?>
                                            <div class="row">
                                                <div class="col-8">
                                                    Covers
                                                </div>
                                                <div class="col-4" style="text-align: right;">
                                                    <?php echo number_format($hsumcover['totcover']);?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    Avg Covers
                                                </div>
                                                <div class="col-4" style="text-align: right;">
                                                    <?php echo number_format($avgcover);?>
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $sumbill=mysqli_query($koneksi,"SELECT sum(jumbill) as totbill from pos_salestemp where close_date between '$keydatefrom' AND '$keydateto' AND (id_outlet ='$keyoutlet') AND (status ='CLOSED')");
                                            $hsumbill = mysqli_fetch_array($sumbill);
                                            $avgbill=$salesaftertaxdll/$hsumbill['totbill'];
                                            ?>
                                            <div class="row">
                                                <div class="col-8">
                                                    Bills
                                                </div>
                                                <div class="col-4" style="text-align: right;">
                                                    <?php echo number_format($hsumbill['totbill']);?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    Avg Bills
                                                </div>
                                                <div class="col-4" style="text-align: right;">
                                                    <?php echo number_format($avgbill);?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="border-top-color: #000;border-top-width: 1px;border-top-style: solid;border-bottom-color: #000;border-bottom-width: 1px;border-bottom-style: solid;">
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-7">
                                                    Item Sales
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format($salesmindisc);?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-6">
                                            Sales Aft Tax
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <?php echo number_format($salesaftertaxdll);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-7">
                                            <?php
                                            include "koneksi.php";
                                            $sumtotpay=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as totpembayaran from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet')");
                                            $hsumtotpay = mysqli_fetch_array($sumtotpay);
                                            ?>
                                            <div class="row">
                                                <div class="col-7">
                                                    Collected
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpay['totpembayaran']);?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="border-top-color: #000;border-top-width: 1px;border-top-style: solid;border-bottom-color: #000;border-bottom-width: 1px;border-bottom-style: solid;">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <div class="row" style="margin: 1px;">
                                        <div class="col-7" style="border-color: #000;border-width: 1px;border-style: solid;min-height: 150px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    VOUCHER
                                                </div>
                                            </div>
                                            <?php
                                            include "koneksi.php";
                                            $looptotpayvcr=mysqli_query($koneksi,"SELECT NoTrans,JnsTrans,JnsCard,LastModify,id_outlet, sum(jumlah_bayar) as looppayvcr from pos_paymenttemp WHERE (payment_status = 'CLOSED') AND (JnsTrans = 'VOUCHER') AND (LastModify between '$keydatefrom' AND '$keydateto') AND (id_outlet='$keyoutlet') group by JnsCard");
                                            while($hlooptotpayvcr = mysqli_fetch_array($looptotpayvcr))
                                            {
                                            ?>
                                            <div class="row">
                                                <div class="col-7">
                                                    <?php echo $hlooptotpayvcr['JnsCard'];?>
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format($hlooptotpayvcr['looppayvcr']);?>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-7">
                                                    TOTAL
                                                </div>
                                                <div class="col-5" style="text-align: right;">
                                                    <?php echo number_format($hsumtotpayvcr['totpayvcr']);?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    }
                    ?>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- Required datatable js -->
        <script src="datatables/jquery.dataTables.min.js"></script>
        <script src="datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="datatables/dataTables.buttons.min.js"></script>
        <script src="datatables/buttons.bootstrap4.min.js"></script>
        <script src="datatables/jszip.min.js"></script>
        <script src="datatables/pdfmake.min.js"></script>
        <script src="datatables/vfs_fonts.js"></script>
        <script src="datatables/buttons.html5.min.js"></script>
        <script src="datatables/buttons.print.min.js"></script>

        <!-- Key Tables -->
        <script src="datatables/dataTables.keyTable.min.js"></script>

        <!-- Responsive examples -->
        <script src="datatables/dataTables.responsive.min.js"></script>
        <script src="datatables/responsive.bootstrap4.min.js"></script>

        <!-- Selection table -->
        <script src="datatables/dataTables.select.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                // Key Tables

                $('#key-table').DataTable({
                    keys: true
                });

                // Responsive Datatable
                $('#responsive-datatable').DataTable();

                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>
    <script src="assets/libs/js/gijgo.min.js"></script>
    <script>                    
    $('#datepicker1').datepicker({
        uiLibrary: 'bootstrap'
    });
    </script> 
    <script>                    
    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap'
    });
    </script> 
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
</body>
 
</html>