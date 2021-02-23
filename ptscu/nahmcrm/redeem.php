<?php 
error_reporting(0);
session_start();
if (empty($_SESSION['id']))
{
  include "koneksi.php";
    session_destroy();
    header('Location: index.php');
    exit(); 
}
else
{
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$idv=$_GET['IDV'];
$cari=mysql_query("select * from member where id_member='$id'");
$ketemu=mysql_num_rows($cari);
$tampil=mysql_fetch_array($cari);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Profile Page - Now Ui Kit by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body class="profile-page sidebar-collapse">
    <!-- Navbar -->
    
    <!-- End Navbar -->
    <div class="wrapper">
        <div class="page-header page-header-small" filter-color="orange">
            <div class="page-header-image" data-parallax="true" style="background-image: url('assets/img/login.jpg');">
            </div>
            <div class="container">
                <div class="content-center">
                    <div class="photo-container">
                    <img src='https://chart.googleapis.com/chart?chs=350x350&amp;cht=qr&amp;chl=<?php echo $idv;?>' />
                    </div>
                    <h4 class="title">Scan Kode QR Di Atas Untuk Meredeem Voucher Anda</h4>
                    <div class="col text-center">
                        <a href="memberarea.php" class="btn btn-simple btn-round btn-danger btn-lg">BATAL</a>
                    </div>
                </div>
            </div>
        </div>

            <div class="section" id="carousel">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img src="assets/img/nahm1.jpg" alt="First slide" width="100%">
                                        <div class="carousel-caption d-none d-md-block">
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/img/nahm2.jpg" alt="Second slide" width="100%">
                                        <div class="carousel-caption d-none d-md-block">
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/img/nahm3.jpg" alt="Third slide" width="100%">
                                        <div class="carousel-caption d-none d-md-block">
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <i class="now-ui-icons arrows-1_minimal-left"></i>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <i class="now-ui-icons arrows-1_minimal-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
                    <div class="col text-center">
                        <a href="keluar.php" class="btn btn-simple btn-round btn-danger btn-lg">LOGOUT</a>
                    </div>
        <footer class="footer">
            <div class="container">
                <div class="copyright">
                    &copy; Designed and created by
                    SCU IT DEPARTMENT.
                </div>
            </div>
        </footer>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

</html>
<?php }?>