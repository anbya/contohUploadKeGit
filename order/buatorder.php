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
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />
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
<?php
include "koneksi.php";
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" style="margin-top: 5%;">
                <form action="saveorder.php" method="post">
                    <div class="card-header">
                        <h5 class="text-center mb-0">BUAT ORDER</h5>
                    </div>
                    <div class="card-body">
                        <div class="row" style="margin: 0px;padding-top: 25px;padding-bottom: 25px;">
                        <?php
                        $viewpostable1=mysqli_query($koneksi,"SELECT * FROM pos_table");
                        while($hviewpostable1 = mysqli_fetch_array($viewpostable1))
                        {
                        if(empty($hviewpostable1['notrans'])){
                            $discheck1="";
                        }
                        else{
                            $discheck1="disabled";
                        }
                        ?>
                            <div class="col-3" style="padding: 3px;margin: 0px;">
                                <label class="containercheckbox"><?php echo $hviewpostable1['nama_table'];?>
                                  <input type="checkbox" id="<?php echo $hviewpostable1['id_table'];?>" name = "table[]" value="<?php echo $hviewpostable1['id_table'];?>" <?php echo $discheck1;?>>
                                  <span class="checkmark"></span>
                                </label>
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                        <div class="row" style="margin: 0px;padding-bottom: 25px;">
                            <div class="col-7" style="padding: 3px;margin: 0px;"><strong>JUMLAH CUSTOMER</strong></div>
                            <div class="col-5" style="padding: 3px;margin: 0px;"><button type="button" class="btn btn-dark" onclick="min('jumcust')"><b>-</b></button><input type="text" id="jumcust" value="0" name="jumcust" style="width: 40%;text-align:center;" required><button type="button" class="btn btn-dark" onclick="plus('jumcust')"><b>+</b></button></div>
                        </div>
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-12" style="padding: 3px;margin: 0px;"><button class="btn btn-dark btn-block" type="submit" id="btnputorder">PROSES ORDER</button></div>
                        </div>
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