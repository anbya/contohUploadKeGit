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
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" style="margin-top: 1%;">
                    <div class="card-header">
                        <h5 class="text-center mb-0">LIST ORDER</h5>
                    </div>
                    <div class="card-body scrollpage" style="height:75vh;">
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
                            <div class="row" style="margin-bottom: 5px;padding: 1em;background-color: #eaeaea;">
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
                    <div class="card-footer">
                    <a class="btn btn-dark btn-block" role="button" href="index.php" id="btnvoidorder">KEMBALI KE HALAMAN ORDER</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/modal.js"></script>
</body>

</html>
<?php }?>