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
        CEK DATA MEMBER
        </div>
        <div class="card-body">
                                                <script type="text/javascript">
                                                function displynummbr(n1)
                                                {
                                                    calcformmbr.input1.value=calcformmbr.input1.value+n1;
                                                }
                                                function displyclearmbr()
                                                {
                                                    calcformmbr.input1.value="";
                                                }
                                                </script>
          <form name="calcformmbr" action="cekdatamember.php" enctype="multipart/form-data" class="formoid-solid-dark" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:480px;min-width:150px" method="post">
                                                <!--/.numpad-->
                                                <table width="65%" align="center">
                                                    <tr>
                                                        <td colspan="3" align="center"><h5>INPUT ATAU SCAN KARTU MEMBER</h5></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"><input type="text" name="input1" value="" class="form-control" required autofocus></td>
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
