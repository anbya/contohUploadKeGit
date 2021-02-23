<?php 
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>NAHM THAI SUKI AND BBQ</title>
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

<body class="login-page sidebar-collapse">
    <!-- Navbar -->
<?php
if(isset($_SESSION['pos']))
{
    $nama   =$_SESSION['pos']['input1'];
    $alamat =$_SESSION['pos']['input2'];
    $email   =$_SESSION['pos']['input3']; 
    $cariemail=mysql_query("select * from member where email='$email'");
    $ketemucariemail=mysql_num_rows($cariemail);
    $tampilcariemail=mysql_fetch_array($cariemail);
    if ($ketemucariemail > 0)
    {
    $statusemail="has-danger";
    $emailph="Email".$email." Sudah didaftarkan";
    $email1   ='';
    }
    else
    {
    $statusemail="";
    $email1=$email;
    }
    $telepon   =$_SESSION['pos']['input4'];  
    $caritelepon=mysql_query("select * from member where telepon='$telepon'");
    $ketemucaritelepon=mysql_num_rows($caritelepon);
    $tampilcaritelepon=mysql_fetch_array($caritelepon);
    if ($ketemucaritelepon > 0)
    {
    $statustelepon="has-danger";
    $teleponph="Nomor Telepon ".$telepon." Sudah didaftarkan"; 
    $telepon1   ='';
    }
    else
    {
    $statustelepon="";
    $telepon1=$telepon;
    }

    if(empty($_SESSION['pos']['input5']))
    {
            $statusreferal="";
            $referal1="";
    }
    else
    {   
            $referal   =$_SESSION['pos']['input5'];  
            $carireferal=mysql_query("select * from member where telepon='$referal' OR email='$referal'");
            $ketemucarireferal=mysql_num_rows($carireferal);
            $tampilcarireferal=mysql_fetch_array($carireferal);
            if ($ketemucarireferal > 0)
            {
            $statusreferal="";
            $referal1=$referal;
            }
            else
            {
            $statusreferal="has-danger";
            $referalph="Data ".$referal." Tidak Terdaftar Pada Sistem Kami"; 
            $referal1   ='';
            }
    }

    $pass =$_SESSION['pos']['input6'];
    $tahun   =$_SESSION['pos']['tahun']; 
    $bulan1   =$_SESSION['pos']['bulan'];
    if ($bulan1=="01") 
    {
        $bulan="Januari";
    }
    elseif ($bulan1=="02") 
        {
            $bulan="Februari";
        }
    elseif ($bulan1=="03") 
        {
            $bulan="Maret";
        }
    elseif ($bulan1=="04") 
        {
            $bulan="April";
        }
    elseif ($bulan1=="05") 
        {
            $bulan="Mei";
        }
    elseif ($bulan1=="06") 
        {
            $bulan="Juni";
        }
    elseif ($bulan1=="07") 
        {
            $bulan="Juli";
        }
    elseif ($bulan1=="08") 
        {
            $bulan="Agustus";
        }
    elseif ($bulan1=="09") 
        {
            $bulan="September";
        }
    elseif ($bulan1=="10") 
        {
            $bulan="Oktober";
        }
    elseif ($bulan1=="11") 
        {
            $bulan="November";
        }
    elseif ($bulan1=="12") 
        {
            $bulan="Desember";
        }
    $tgl   =$_SESSION['pos']['tgl']; 
    $gender   =$_SESSION['pos']['gender']; 
    session_destroy();
}
else
{
    $nama   ='';
    $alamat ='';
    $email1   ='';
    $emailph   ='Email...'; 
    $telepon1   =''; 
    $teleponph   ='Nomor Telepon...'; 
    $referal1   =''; 
    $referalph   ='Referal...';
    $pass ='';
    $tahun   ='Tahun Lahir';
    $bulan   ='Bulan Lahir'; 
    $tgl   ='Tanggal Lahir'; 
    $gender   ='Jenis Kelamin';
}
?>   
    <!-- End Navbar -->
    <div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url(assets/img/login.jpg)"></div>
        <div class="container">
            <div class="col-md-8 content-center">
                <div class="card card-login card-plain">
                    <form class="form" method="POST" action="addmember.php">
                        <div class="content">
                            <div class="input-group form-group-no-border">
                                <input type="text" name="input1" class="form-control" placeholder="Nama Lengkap..." value="<?php echo $nama; ?>" required>
                            </div>
                            <div class="form-group-no-border">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <select class="form-control" id="sel1" name="tahun">
                                            <option><?php echo $tahun; ?></option>
                                            <?php
                                            $mulai= date('Y') - 50;
                                            for($i = $mulai;$i<$mulai + 100;$i++){
                                            echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                            }
                                            ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <select class="form-control" id="sel1" name="bulan">
                                            <option><?php echo $bulan; ?></option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <select class="form-control" id="sel1" name="tgl">
                                            <option><?php echo $tgl; ?></option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                          </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-no-border">
                                <div class="form-group">
                                  <select class="form-control" id="sel1" name="gender">
                                    <option><?php echo $gender; ?></option>
                                    <option>Pria</option>
                                    <option>Wanita</option>
                                  </select>
                                </div>
                            </div>

                            <div class="input-group form-group-no-border">
                                <input type="text" name="input2" class="form-control" placeholder="Alamat..." value="<?php echo $alamat; ?>" required>
                            </div>

                            <div class="input-group form-group-no-border <?php echo "$statusemail" ?>">
                                <input type="text" name="input3" class="form-control" placeholder="<?php echo "$emailph" ?>" value="<?php echo $email1; ?>" required>
                            </div>
                            <div class="input-group form-group-no-border <?php echo "$statustelepon" ?>">
                                <input type="text" name="input4" class="form-control" placeholder="<?php echo "$teleponph" ?>" value="<?php echo $telepon1; ?>" required>
                            </div>
                            <div class="input-group form-group-no-border <?php echo "$statusreferal" ?>">
                                <input type="text" name="input5" class="form-control" placeholder="<?php echo "$referalph" ?>" value="<?php echo $referal1; ?>">
                            </div>
                            <div class="input-group form-group-no-border">
                                <input type="password" name="input6" class="form-control" placeholder="Password..." value="<?php echo $pass; ?>" required>
                            </div>
                            <div class="input-group form-group-no-border">
                                <button class="btn btn-nahm btn-round btn-lg btn-block" type="submit" name='btn' value="Submit">Daftar</button>
                            </div>
                        <div class="pull-left">
                            <h6>
                                <a href="index.php" class="link">Log In</a>
                            </h6>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="copyright">
                    &copy; Designed and created by
                    <a href="#" target="_blank">SCU IT DEPARTMENT</a>.
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