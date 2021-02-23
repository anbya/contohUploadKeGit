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
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
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
    <div class="modal fade" role="dialog" tabindex="-1" id="lihatorder">
        <div class="modal-dialog" role="document">
            <form action="voidorder.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">PILIH TABLE YANG AKAN DI VOID</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body scrollpage" style="height:50vh;">
                <?php
                include "koneksi.php";
                $lihatorder1=mysqli_query($koneksi,"SELECT * FROM pos_salestemp WHERE status = 'OPEN' ");
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
                    <div class="row" style="margin: 0px;padding: 0px;">
                        <div class="col-12" style="padding: 3px;margin: 0px;">
                        <b><?php echo $hpostable['nama_table'];?></b>
                        </div>
                        <div class="col-12" style="padding: 3px;margin: 0px;">
                        <?php
                        for ($x = 0; $x<$keysquenceorder; $x++) 
                        {
                            $noorder=$x+1;
                        ?>
                        <a class="btn btn-dark btn-block" role="button" href="tampilorder.php?notrans=<?php echo $hlihatorder1['notrans'];?>&squenceorder=<?php echo $noorder;?>">ORDER KE <?php echo $noorder;?></a>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                <?php
                }
                ?>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">BATAL</button><button class="btn btn-dark" type="submit">PROSES</button></div>
            </div>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" style="margin-top: 5%;">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5 style="font-weight: bold;">POS ORDER</h5>
                            </div>
                            <?php
                            $ceknamauser=mysqli_query($koneksi,"SELECT * FROM user where id_user = '$usrpay'");
                            $hceknamauser = mysqli_fetch_array($ceknamauser);
                            ?>
                            <div class="col-6">
                                <h5 style="font-weight: bold;text-align: right;"><?php echo $hceknamauser['nama_user'];?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-12" style="padding: 0px;margin: 0px;"><a class="btn btn-dark btn-block" role="button" href="buatorder.php">BUAT ORDER</a></div>
                        </div>
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-12" style="padding: 0px;margin: 0px;"><a class="btn btn-dark btn-block" role="button" href="tambahorder.php">TAMBAH ORDER</a></div>
                        </div>
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-12" style="padding: 0px;margin: 0px;"><a class="btn btn-dark btn-block" role="button" href="listorder.php">LIHAT ORDER</a></div>
                        </div>
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-12" style="padding: 0px;margin: 0px;">
                                <a href="keluar.php" class="btn btn-dark btn-block" role="button">LOGOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/modal.js"></script>
<?php }?>
</body>

</html>
<?php }?>