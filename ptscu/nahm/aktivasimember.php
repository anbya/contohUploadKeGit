<?php 
error_reporting(0);
session_start();
$previlege=$_SESSION['previlage'];
if (empty($_SESSION['namauser']))
{
  include "koneksi.php";
    session_destroy();
    header('Location: login.php');
    exit(); 
}
else
{
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>NAHM CRM SYSTEM</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-login" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-login bg-login fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">NAHM CRM SYSTEM</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <?php
    include "navigasi.php";
    ?>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <!-- Icon Cards-->
      <!-- Area Chart Example-->
      <!-- Card Columns Example Social Feed-->
      <!-- Example Social Card-->
      <!-- Example Social Card-->
      <!-- Example Social Card-->
      <!-- /Card Columns-->
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
        Aktivasi Akun Member
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <?php
        error_reporting(0);
        include "koneksi.php";
        $tanggal= mktime(date("m"),date("d"),date("Y"));
        $jam=date("H:i:s");
          ?>

          </div>
          <div class="table-responsive">

        <?php
        error_reporting(0);
        include "koneksi.php";
        $tanggal= mktime(date("m"),date("d"),date("Y"));
        $jam=date("H:i:s");
        date_default_timezone_set('Asia/Jakarta');
          ?>
          <form action="prosesaktivasi.php" enctype="multipart/form-data" class="formoid-solid-dark" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:480px;min-width:150px" method="post">
                        
                        <div class="form-group">
                            <label class="col-lg-6 control-label">SCAN CODE</label>
                            <div class="col-lg-7">
                                <input type="text" name="input1" value="" class="form-control" required autofocus>
                                <strong></strong>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label"></label>
                          <div class="col-lg-5">
                            <button class="btn btn-block btn-primary" type="submit" name='submit' value="Submit">SCAN</button><br>
                          </div>
                        </div>
          </form>

          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © SCU IT DEPARTMENT 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
<?php }?>
