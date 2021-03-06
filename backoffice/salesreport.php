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
                                            <li class="breadcrumb-item active" aria-current="page">SALES REPORT PANEL</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <form action="salesreport.php" method="GET">
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
                    <?php
                    if(!empty($_GET['outlet']) AND !empty($_GET['datefrom']) AND !empty($_GET['dateto']))
                    {
                    $keyoutlet=$_GET['outlet'];
                    $keydatefrom=$_GET['datefrom'];
                    $keydateto=$_GET['dateto'];
                    }
                    ?>
                    </form>
                    <div class="row scollpagex" style="width: 100%;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>STORE NAME
                                        </th>
                                        <th>BILL NUMBER
                                        </th>
                                        <th>TRANS DATE
                                        </th>
                                        <th>TRANS TIME
                                        </th>
                                        <th>GROSS SALES
                                        </th>
                                        <th>DISC
                                        </th>
                                        <th>TAX
                                        </th>
                                        <th>SERVICE CHARGE
                                        </th>
                                        <th>NET SALES
                                        </th>
                                        <th>CASH
                                        </th>
                                        <th>BCA DEBIT
                                        </th>
                                        <th>BCA CREDIT CARD
                                        </th>
                                        <th>BNI DEBIT
                                        </th>
                                        <th>BNI CREDIT CARD
                                        </th>
                                        <th>MANDIRI DEBIT
                                        </th>
                                        <th>MANDIRI CREDIT CARD
                                        </th>
                                        <th>BRI DEBIT
                                        </th>
                                        <th>VISA
                                        </th>
                                        <th>MASTER
                                        </th>
                                        <th>VOUCHER
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "koneksi.php";
                                    if(!empty($_GET['outlet']) AND !empty($_GET['datefrom']) AND !empty($_GET['dateto']))
                                    {
                                        if($_GET['outlet']=="ALL")
                                        {
                                            $postemp=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where (status = 'CLOSED' OR status = 'REFUND') AND (close_date between '$keydatefrom' AND '$keydateto')");
                                        }
                                        else
                                        {
                                            $postemp=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where (id_outlet ='$keyoutlet') AND (status = 'CLOSED' OR status = 'REFUND') AND (close_date between '$keydatefrom' AND '$keydateto')");
                                        }
                                        while($hpostemp = mysqli_fetch_array($postemp))
                                        {
                                        $keytrans=$hpostemp['notrans'];
                                        $sumcash=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_cash FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsTrans = 'CASH' ");
                                        $hsumcash = mysqli_fetch_array($sumcash);
                                        $cash=$hsumcash['total_cash'];
                                        //------//
                                        $sumbcadebit=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_bcadebit FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'DEBIT BCA' ");
                                        $hsumbcadebit = mysqli_fetch_array($sumbcadebit);
                                        $bcadebit=$hsumbcadebit['total_bcadebit'];
                                        //------//
                                        $sumbcacc=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_bcacc FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'BCA CREDIT CARD' ");
                                        $hsumbcacc = mysqli_fetch_array($sumbcacc);
                                        $bcacc=$hsumbcacc['total_bcacc'];
                                        //------//
                                        $sumbnidebit=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_bnidebit FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'BNI DEBIT' ");
                                        $hsumbnidebit = mysqli_fetch_array($sumbnidebit);
                                        $bnidebit=$hsumbnidebit['total_bnidebit'];
                                        //------//
                                        $sumbnicc=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_bnicc FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'BNI CREDIT CARD' ");
                                        $hsumbnicc = mysqli_fetch_array($sumbnicc);
                                        $bnicc=$hsumbnicc['total_bnicc'];
                                        //------//
                                        $summandiridebit=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_mandiridebit FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'MANDIRI DEBIT' ");
                                        $hsummandiridebit = mysqli_fetch_array($summandiridebit);
                                        $mandiridebit=$hsummandiridebit['total_mandiridebit'];
                                        //------//
                                        $summandiricc=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_mandiricc FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'MANDIRI CREDIT CARD' ");
                                        $hsummandiricc = mysqli_fetch_array($summandiricc);
                                        $mandiricc=$hsummandiricc['total_mandiricc'];
                                        //------//
                                        $sumbridebit=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_bridebit FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'BRI DEBIT' ");
                                        $hsumbridebit = mysqli_fetch_array($sumbridebit);
                                        $bridebit=$hsumbridebit['total_bridebit'];
                                        //------//
                                        $sumvisa=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_visa FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'VISA' ");
                                        $hsumvisa = mysqli_fetch_array($sumvisa);
                                        $visa=$hsumvisa['total_visa'];
                                        //------//
                                        $summaster=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_master FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'MASTER' ");
                                        $hsummaster = mysqli_fetch_array($summaster);
                                        $master=$hsummaster['total_master'];
                                        //------//
                                        $sumvoucher=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_voucher FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsTrans = 'VOUCHER' ");
                                        $hsumvoucher = mysqli_fetch_array($sumvoucher);
                                        $voucher=$hsumvoucher['total_voucher'];
                                        //------//
                                        $tampiloutlet=mysqli_query($koneksi,"SELECT * FROM outlet where id_outlet = '$hpostemp[id_outlet]'");
                                        $htampiloutlet = mysqli_fetch_array($tampiloutlet);
                                        //------//
                                        ?>
                                            <?php
                                            if($hpostemp['status']=="CLOSED")
                                            {
                                            ?>
                                            <tr>
                                            <td><?php echo $htampiloutlet['nama_outlet'];?></td>
                                            <td><?php echo $hpostemp['bill_number'];?></td>
                                            <td><?php echo $hpostemp['close_date'];?></td>
                                            <td><?php echo $hpostemp['close_time'];?></td>
                                            <td><?php echo $hpostemp['gross_sales'];?></td>
                                            <td><?php echo $hpostemp['disc'];?></td>
                                            <td><?php echo $hpostemp['tax'];?></td>
                                            <td><?php echo $hpostemp['service_charge'];?></td>
                                            <td><?php echo $hpostemp['nett_sales'];?></td>
                                            <td><?php echo $cash;?></td>
                                            <td><?php echo $bcadebit;?></td>
                                            <td><?php echo $bcacc;?></td>
                                            <td><?php echo $bnidebit;?></td>
                                            <td><?php echo $bnicc;?></td>
                                            <td><?php echo $mandiridebit;?></td>
                                            <td><?php echo $mandiricc;?></td>
                                            <td><?php echo $bridebit;?></td>
                                            <td><?php echo $visa;?></td>
                                            <td><?php echo $master;?></td>
                                            <td><?php echo $voucher;?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if($hpostemp['status']=="REFUND")
                                            {
                                            ?>
                                            <tr>
                                            <td><?php echo $htampiloutlet['nama_outlet'];?></td>
                                            <td><?php echo $hpostemp['bill_number'];?></td>
                                            <td><?php echo $hpostemp['close_date'];?></td>
                                            <td><?php echo $hpostemp['close_time'];?></td>
                                            <td><?php echo $hpostemp['gross_sales'];?></td>
                                            <td><?php echo $hpostemp['disc'];?></td>
                                            <td><?php echo $hpostemp['tax'];?></td>
                                            <td><?php echo $hpostemp['service_charge'];?></td>
                                            <td><?php echo $hpostemp['nett_sales'];?></td>
                                            <td><?php echo $cash;?></td>
                                            <td><?php echo $bcadebit;?></td>
                                            <td><?php echo $bcacc;?></td>
                                            <td><?php echo $bnidebit;?></td>
                                            <td><?php echo $bnicc;?></td>
                                            <td><?php echo $mandiridebit;?></td>
                                            <td><?php echo $mandiricc;?></td>
                                            <td><?php echo $bridebit;?></td>
                                            <td><?php echo $visa;?></td>
                                            <td><?php echo $master;?></td>
                                            <td><?php echo $voucher;?></td>
                                            </tr>
                                            <tr>
                                            <td><?php echo $htampiloutlet['nama_outlet'];?></td>
                                            <td><?php echo $hpostemp['refund_bill_num'];?></td>
                                            <td><?php echo $hpostemp['refund_date'];?></td>
                                            <td><?php echo $hpostemp['refund_time'];?></td>
                                            <td><?php echo "-".$hpostemp['gross_sales'];?></td>
                                            <td><?php echo "-".$hpostemp['disc'];?></td>
                                            <td><?php echo "-".$hpostemp['tax'];?></td>
                                            <td><?php echo "-".$hpostemp['service_charge'];?></td>
                                            <td><?php echo "-".$hpostemp['nett_sales'];?></td>
                                            <td><?php echo "-".$cash;?></td>
                                            <td><?php echo "-".$bcadebit;?></td>
                                            <td><?php echo "-".$bcacc;?></td>
                                            <td><?php echo "-".$bnidebit;?></td>
                                            <td><?php echo "-".$bnicc;?></td>
                                            <td><?php echo "-".$mandiridebit;?></td>
                                            <td><?php echo "-".$mandiricc;?></td>
                                            <td><?php echo "-".$bridebit;?></td>
                                            <td><?php echo "-".$visa;?></td>
                                            <td><?php echo "-".$master;?></td>
                                            <td><?php echo "-".$voucher;?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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