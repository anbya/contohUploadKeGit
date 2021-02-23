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
                                            <li class="breadcrumb-item active" aria-current="page">SUMMARY PLU SALES REPORT PANEL</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <form action="summaryplusalesreport.php" method="GET">
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
                            <a href="summaryplusalesreportprint.php?outlet=<?php echo $keyoutlet;?>&datefrom=<?php echo $keydatefrom;?>&dateto=<?php echo $keydateto;?>" target="_blank" class="btn btn-outline-dark btn-block">PRINT THIS REPORT</a>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: center;">
                            <h3>SUMMARY PLU SALES REPORT</h3>
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
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <b>Category Sales</b>
                                        </div>
                                    </div>
                                    <div class="row" style="border-color: #000;border-width: 1px;border-style: solid;margin: 1px;">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-5">
                                                    <b>Category Name</b>
                                                </div>
                                                <div class="col-1">
                                                    <b>Qty</b>
                                                </div>
                                                <div class="col-2">
                                                    <b>Price</b>
                                                </div>
                                                <div class="col-2">
                                                    <b>Disc</b>
                                                </div>
                                                <div class="col-2">
                                                    <b>Sales</b>
                                                </div>
                                                <?php
                                                include "koneksi.php";
                                                $katloop=mysqli_query($koneksi,"SELECT * FROM pos_kategoryitem");
                                                while($hkatloop = mysqli_fetch_array($katloop))
                                                {
                                                $sumcat=mysqli_query($koneksi,"SELECT (pos_itemtemp.transtemp), (pos_itemtemp.kdcategory),sum(pos_itemtemp.price) as totgp,sum(pos_itemtemp.disc) as totdisc,sum(pos_itemtemp.grandprice) as totafterdisc,sum(pos_itemtemp.qty) as totqty FROM pos_itemtemp INNER JOIN pos_salestemp ON (pos_itemtemp.transtemp = pos_salestemp.notrans) AND (pos_itemtemp.squenceorder !='tmp') AND (pos_salestemp.close_date between '$keydatefrom' AND '$keydateto') AND (pos_salestemp.id_outlet ='$keyoutlet') AND (pos_salestemp.status ='CLOSED') AND (pos_salestemp.status ='CLOSED') AND pos_itemtemp.kdcategory = '$hkatloop[kdcategory]'");
                                                $hsumcat = mysqli_fetch_array($sumcat);
                                                ?>
                                                <div class="col-5">
                                                    <?php echo $hkatloop['nmcategory'];?>
                                                </div>
                                                <div class="col-1">
                                                    <?php echo number_format($hsumcat['totqty']);?>
                                                </div>
                                                <div class="col-2">
                                                    <?php echo number_format($hsumcat['totgp']);?>
                                                </div>
                                                <div class="col-2">
                                                    <?php echo number_format($hsumcat['totdisc']);?>
                                                </div>
                                                <div class="col-2">
                                                    <?php echo number_format($hsumcat['totafterdisc']);?>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                include "koneksi.php";
                                                $totkatloop=mysqli_query($koneksi,"SELECT * FROM pos_kategoryitem");
                                                $htotkatloop = mysqli_fetch_array($totkatloop);
                                                $sumtotkatloop=mysqli_query($koneksi,"SELECT (pos_itemtemp.transtemp), (pos_itemtemp.kdcategory),sum(pos_itemtemp.price) as totgp,sum(pos_itemtemp.disc) as totdisc,sum(pos_itemtemp.grandprice) as totafterdisc,sum(pos_itemtemp.qty) as totqty FROM pos_itemtemp INNER JOIN pos_salestemp ON (pos_itemtemp.transtemp = pos_salestemp.notrans) AND (pos_itemtemp.squenceorder !='tmp') AND (pos_salestemp.close_date between '$keydatefrom' AND '$keydateto') AND (pos_salestemp.id_outlet ='$keyoutlet') AND (pos_salestemp.status ='CLOSED') AND (pos_salestemp.status ='CLOSED')");
                                                $hsumtotkatloop = mysqli_fetch_array($sumtotkatloop);
                                                ?>
                                                <div class="col-5">
                                                    <b>TOTAL</b>
                                                </div>
                                                <div class="col-1">
                                                    <b><?php echo number_format($hsumtotkatloop['totqty']);?></b>
                                                </div>
                                                <div class="col-2">
                                                    <b><?php echo number_format($hsumtotkatloop['totgp']);?></b>
                                                </div>
                                                <div class="col-2">
                                                    <b><?php echo number_format($hsumtotkatloop['totdisc']);?></b>
                                                </div>
                                                <div class="col-2">
                                                    <b><?php echo number_format($hsumtotkatloop['totafterdisc']);?></b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <b>Sub Category Sales</b>
                                        </div>
                                    </div>
                                    <div class="row" style="border-color: #000;border-width: 1px;border-style: solid;margin: 1px;">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-5">
                                                    <b>Sub Category Name</b>
                                                </div>
                                                <div class="col-1">
                                                    <b>Qty</b>
                                                </div>
                                                <div class="col-2">
                                                    <b>Price</b>
                                                </div>
                                                <div class="col-2">
                                                    <b>Disc</b>
                                                </div>
                                                <div class="col-2">
                                                    <b>Sales</b>
                                                </div>
                                                <?php
                                                include "koneksi.php";
                                                $subkatloop=mysqli_query($koneksi,"SELECT * FROM pos_subcategory");
                                                while($hsubkatloop = mysqli_fetch_array($subkatloop))
                                                {
                                                $sumsubcat=mysqli_query($koneksi,"SELECT (pos_itemtemp.transtemp), (pos_itemtemp.kdcategory),sum(pos_itemtemp.price) as totgp,sum(pos_itemtemp.disc) as totdisc,sum(pos_itemtemp.grandprice) as totafterdisc,sum(pos_itemtemp.qty) as totqty FROM pos_itemtemp INNER JOIN pos_salestemp ON (pos_itemtemp.transtemp = pos_salestemp.notrans) AND (pos_itemtemp.squenceorder !='tmp') AND (pos_salestemp.close_date between '$keydatefrom' AND '$keydateto') AND (pos_salestemp.id_outlet ='$keyoutlet') AND (pos_salestemp.status ='CLOSED') AND (pos_salestemp.status ='CLOSED') AND pos_itemtemp.kdsubcategory = '$hsubkatloop[kdsubcategory]'");
                                                $hsumsubcat = mysqli_fetch_array($sumsubcat);
                                                ?>
                                                <div class="col-5">
                                                    <?php echo $hsubkatloop['nmsubcategory'];?>
                                                </div>
                                                <div class="col-1">
                                                    <?php echo number_format($hsumsubcat['totqty']);?>
                                                </div>
                                                <div class="col-2">
                                                    <?php echo number_format($hsumsubcat['totgp']);?>
                                                </div>
                                                <div class="col-2">
                                                    <?php echo number_format($hsumsubcat['totdisc']);?>
                                                </div>
                                                <div class="col-2">
                                                    <?php echo number_format($hsumsubcat['totafterdisc']);?>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="col-5">
                                                    <b>TOTAL</b>
                                                </div>
                                                <div class="col-1">
                                                    <b><?php echo number_format($hsumtotkatloop['totqty']);?></b>
                                                </div>
                                                <div class="col-2">
                                                    <b><?php echo number_format($hsumtotkatloop['totgp']);?></b>
                                                </div>
                                                <div class="col-2">
                                                    <b><?php echo number_format($hsumtotkatloop['totdisc']);?></b>
                                                </div>
                                                <div class="col-2">
                                                    <b><?php echo number_format($hsumtotkatloop['totafterdisc']);?></b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <b>Plu Sales</b>
                                        </div>
                                    </div>
                                    <div class="row" style="border-color: #000;border-width: 1px;border-style: solid;margin: 1px;">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-5">
                                                    <b>PLU Name</b>
                                                </div>
                                                <div class="col-1">
                                                    <b>Qty</b>
                                                </div>
                                                <div class="col-2">
                                                    <b>Price</b>
                                                </div>
                                                <div class="col-2">
                                                    <b>Disc</b>
                                                </div>
                                                <div class="col-2">
                                                    <b>Sales</b>
                                                </div>
                                                <?php
                                                include "koneksi.php";
                                                $itemloop=mysqli_query($koneksi,"SELECT * FROM pos_item");
                                                while($hitemloop = mysqli_fetch_array($itemloop))
                                                {
                                                $sumtotplu=mysqli_query($koneksi,"SELECT (pos_itemtemp.transtemp), (pos_itemtemp.kditem),(pos_itemtemp.kdcategory),sum(pos_itemtemp.price) as totplugp,sum(pos_itemtemp.disc) as totdisc,sum(pos_itemtemp.grandprice) as totafterdisc, sum(pos_itemtemp.qty) as totpluqty FROM pos_itemtemp INNER JOIN pos_salestemp ON (pos_itemtemp.transtemp = pos_salestemp.notrans) AND (pos_itemtemp.squenceorder !='tmp') AND (pos_salestemp.close_date between '$keydatefrom' AND '$keydateto') AND (pos_salestemp.id_outlet ='$keyoutlet') AND (pos_salestemp.status ='CLOSED') AND (pos_salestemp.status ='CLOSED') AND pos_itemtemp.kditem = '$hitemloop[kditem]'");
                                                $hsumtotplu = mysqli_fetch_array($sumtotplu);
                                                ?>
                                                <div class="col-5">
                                                    <?php echo $hitemloop['nmitem'];?>
                                                </div>
                                                <div class="col-1">
                                                    <?php echo number_format($hsumtotplu['totpluqty']);?>
                                                </div>
                                                <div class="col-2">
                                                    <?php echo number_format($hsumtotplu['totplugp']);?>
                                                </div>
                                                <div class="col-2">
                                                    <?php echo number_format($hsumtotplu['totdisc']);?>
                                                </div>
                                                <div class="col-2">
                                                    <?php echo number_format($hsumtotplu['totafterdisc']);?>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="col-5">
                                                    <b>TOTAL</b>
                                                </div>
                                                <div class="col-1">
                                                    <b><?php echo number_format($hsumtotkatloop['totqty']);?></b>
                                                </div>
                                                <div class="col-2">
                                                    <b><?php echo number_format($hsumtotkatloop['totgp']);?></b>
                                                </div>
                                                <div class="col-2">
                                                    <b><?php echo number_format($hsumtotkatloop['totdisc']);?></b>
                                                </div>
                                                <div class="col-2">
                                                    <b><?php echo number_format($hsumtotkatloop['totafterdisc']);?></b>
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