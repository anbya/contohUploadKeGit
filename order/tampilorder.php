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
<?php
ob_start();
include "koneksi.php";
$notransaksi=$_GET['notrans'];
$squenceorder=$_GET['squenceorder'];
/*sales temp*/
$salestemp1=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$notransaksi' ");
$rsalestemp1 = mysqli_num_rows($salestemp1);
$hsalestemp1 = mysqli_fetch_array($salestemp1);
/*sales temp*/
/*pos table*/
$postable=mysqli_query($koneksi,"SELECT * FROM pos_table where notrans = '$notransaksi' ");
$rpostable = mysqli_num_rows($postable);
$hpostable = mysqli_fetch_array($postable);
/*pos table*/
/*item temp*/
$itemtemp1=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$notransaksi' AND squenceorder = '$squenceorder' group by kditem ");
$ritemtemp1 = mysqli_num_rows($itemtemp1);
/*item temp*/
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>pos order design</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
<style>
@media print {
    #non-printable { display: none; }
    #printable { 
        display: block;
        width:100%;
        }
    #printable h5{ 
        display: block;
        font-size:25vw;
        }
    #printable .card-body{ 
        display: block;
        font-size:15vw;
        }
}
</style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="printable">
                <div class="card" style="margin-top: 5%;">
                    <div class="card-header">
                        <h5 class="text-center mb-0">ORDER KE(<?php echo $squenceorder;?>) <?php echo $hpostable['nama_table'];?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-8" style="padding: 3px;margin: 0px;"><strong>NAMA MENU</strong></div>
                            <div class="col-4" style="padding: 3px;margin: 0px;"><strong>JUMLAH</strong></div>
                        </div>
                        <?php
                        while($hitemtemp1 = mysqli_fetch_array($itemtemp1)) 
                        {
                        $keyitem=$hitemtemp1['kditem'];
                        /*pos item*/
                        $sqlplu=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = '$keyitem' ");
                        $hsqlplu = mysqli_fetch_array($sqlplu);
                        /*pos item*/
                        /*count qty itemtemp*/
                        $countqtyitem=mysqli_query($koneksi,"SELECT sum(qty) as total_qty FROM pos_itemtemp where kditem = '$keyitem' AND transtemp = '$notransaksi'");
                        $hcountqtyitem = mysqli_fetch_array($countqtyitem);
                        /*count qty itemtemp*/
                        ?>
                        <div class="row" style="margin: 0px;padding: 0px;border-bottom-width: 1px;border-bottom-color: #111;border-bottom-style: solid;">
                            <div class="col-8" style="padding: 3px;margin: 0px;"><strong><?php echo $hsqlplu['nmitem'];?></strong></div>
                            <div class="col-4" style="padding: 3px;margin: 0px;"><strong><?php echo $hcountqtyitem['total_qty'];?></strong></div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-12" id="non-printable">
                <div class="row" style="margin: 0px;padding: 0px;">
                    <div class="col-12" style="padding: 3px;margin: 0px;">
                    <a class="btn btn-dark btn-block" role="button" href="../escpos/cetakorder.php?keytrans=<?php echo $notransaksi;?>&sqnc=<?php echo $squenceorder;?>&header=server">KIRIM ORDER KE KITCHEN</a>
                    </div>
                </div>
                <div class="row" style="margin: 0px;padding: 0px;">
                    <div class="col-12" style="padding: 3px;margin: 0px;"><a class="btn btn-dark btn-block" role="button" href="index.php" id="btnvoidorder">KEMBALI KE HALAMAN ORDER</a></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    user_pref("capability.policy.default.Window.print", "noAccess");
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/modal.js"></script>
</body>

</html>
<?php }?>