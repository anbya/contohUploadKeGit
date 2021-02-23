<?php
error_reporting(0);
session_start();
if (empty($_SESSION['namausernahmposorder']))
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
$usrpay=$_SESSION['iduserorder'];
$nmusrpos=$_SESSION['namausernahmposorder'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>pos order design</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
<?php
include "koneksi.php";
$terminalcek = "SELECT * FROM terminal_parameter WHERE openterminal = '' OR closeterminal ='' ";
$resultterminalcek = mysqli_query($koneksi,$terminalcek) or die (mysqli_error());
$rresultterminalcek= mysqli_num_rows($resultterminalcek);
$hresultterminalcek= mysqli_fetch_array($resultterminalcek);
if(empty($rresultterminalcek)){?>
<div class="row justify-content-md-center">
    <!--/.postitem-->
    <div class="col-md-3 mh2">
            <table width="60%" align="center" style="margin-top: 10%;margin-bottom: 10%;">
            <tr>
            <td><img src="../logo.png" class="img-fluid" alt="Responsive image"></td>
            </tr>
            <tr>
            <td><p>TERMINAL POS BELUM DIBUKA, HARAP HUBUNGI KASIR ANDA</p></td>
            </tr>
            </table>
    </div>
</div>
<?php }
else{
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" style="margin-top: 5%;">
                <form action="tambahorderproses.php" method="post">
                    <div class="card-header">
                        <h5 class="text-center mb-0">PILIH TRANSAKSI YANG AKAN DI BUKA</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
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
                        <div class="col-12 col-md-3 d-flex justify-content-center align-items-center" style="padding: 15px;">
                            <div class="card">
                                <div class="card-header">
                                    <a><?php echo $namatable;?></a>
                                </div>
                                <div class="card-body">
                                    <a href="tambahitem.php?transtempprm=<?php echo $opentrans;?>" class="btn btn-dark btn-block maxwidthheight">PILIH TRANSAKSI INI</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-12" style="padding: 3px;margin: 0px;"><a class="btn btn-dark btn-block" role="button" href="index.php" id="btnvoidorder">BATAL</a></div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/modal.js"></script>
    <script type="text/javascript">
    function plus(xx)
        {
        var x1=document.getElementById(xx).value;
        var x2=parseInt(x1)+1;
        document.getElementById(xx).value=x2;
        }
        function min(xx)
        {
        var x1=document.getElementById(xx).value;
        var x2=parseInt(x1)-1;
            if (x1 < 1) {
                document.getElementById(xx).value=x1;
            }
            else {
                document.getElementById(xx).value=x2;
            }
        }
    </script>
<?php }?>
</body>

</html>
<?php }?>