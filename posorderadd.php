<?php
error_reporting(0);
session_start();
if (empty($_SESSION['namausernahmpos']))
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
$usrpay=$_SESSION['iduser'];
$nmusrpos=$_SESSION['namausernahmpos'];
$transtempprm=$_GET['transtempprm'];
$bill=$_GET['bill'];
if(empty($bill))
{
    $prmbill=1;
}
else
{
    $prmbill=$bill;
}
$datepay=date("d/m/Y", $tanggal);
$timepay=date("H:i:s", $jam);
$otletpay = "SELECT * FROM setupparameter ";
$resultotletpay = mysqli_query($koneksi,$otletpay) or die (mysqli_error());
 $hresultotletpay = mysqli_fetch_array($resultotletpay);
$outletpay=$hresultotletpay['KdOutlet'];
?>
<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>NAHM POS</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <!-- MDBootstrap Datatables  -->
    <link href="css/addons/datatables.min.css" rel="stylesheet">
    <link href="sticky-footer.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <style>
    .abcd {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: red;
        color: white;
        text-align: center;
    }
    .headerheight1
        {
          height: 5vh; /* 30% of viewport height*/
          max-height: 5vh;
        }
    .mh1
        {
          height: 45vh; /* 30% of viewport height*/
          max-height: 45vh;
        }
    .mh1-4
        {
          height: 48vh; /* 30% of viewport height*/
          max-height: 48vh;
        }
    .mh2
        {
          height: 95vh; /* 30% of viewport height*/
          max-height: 95vh;
        }
    .mh96
        {
          height: 80vh; /* 30% of viewport height*/
          max-height: 80vh;
        }
    .mh3
        {
          height: 70vh; /* 30% of viewport height*/
          max-height: 70vh;
        }
    .mh25
        {
          height: 25vh; /* 30% of viewport height*/
          max-height: 25vh;
        }
    .mh4
        {
          height: 30vh; /* 30% of viewport height*/
          max-height: 30vh;
        }
    .mh5
        {
          height: 40vh; /* 30% of viewport height*/
          max-height: 40vh;
        }
    .mh50
        {
          height: 50vh; /* 30% of viewport height*/
          max-height: 50vh;
        }
    .mh6
        {
          height: 60vh; /* 30% of viewport height*/
          max-height: 60vh;
        }
    .mh7
        {
          height: 20vh; /* 30% of viewport height*/
          max-height: 20vh;
        }
    .mh10
        {
          height: 10vh; /* 30% of viewport height*/
          max-height: 10vh;
        }
    .mh8
        {
          height: 80vh; /* 30% of viewport height*/
          max-height: 80vh;
        }
    .maxwidthheight
    {
        text-align: center;
        width: 100%;
        height: 100%;
    }
    .tepian
    {
        border-width: 1px;
        border-color: #000;
        border-style: solid;
    }
    .tepibawah
    {
        border-bottom-width: 1px;
        border-bottom-color: #000;
        border-bottom-style: solid;
    }
    .nopadding
    {
        padding: 0px;
    }
    .nomargin
    {
        margin: 0px;
    }
    .scrollpage
    {
    overflow-x: hidden;
    overflow-y: scroll;
    }
    .scrollpageall
    {
    overflow-x: scroll;
    overflow-y: scroll;
    }
    #item0
    {
        display: block;
    }
    #item1
    {
        display: none;
    }
    #item2
    {
        display: none;
    }
    #item3
    {
        display: none;
    }
    #item4
    {
        display: none;
    }
    #item5
    {
        display: none;
    }
    #item6
    {
        display: none;
    }
    </style>
</head>

<body onkeypress='return false'>
<script type="text/javascript">
function displynum(n1)
{
    calcform.txt1.value=calcform.txt1.value+n1;
}
function displyclear()
{
    calcform.txt1.value="";
}
</script>
<div class="container-fluid" style="background-color: #ffe6e6;">
<?php
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
            <td><img src="logo.png" class="img-fluid" alt="Responsive image"></td>
            </tr>
            </table>
            <!--/.numpad-->
            <form name="calcform" action="bukaposkasir.php" method="post">
            <input type="hidden" name="iduser" value="<?php echo $usrpay;?>" class="form-control ml-0">
            <table width="80%" align="center">
            <tr>
                <td colspan="3">
                <input type="text" name="txt1" class="form-control ml-0" autofocus="true" placeholder="INPUT JUMLAH MODAL CASH" required>
                </td>
            </tr>
            <tr>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn7" value=7 onclick="displynum(btn7.value)">7
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn8" value=8 onclick="displynum(btn8.value)">8
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn9" value=9 onclick="displynum(btn9.value)">9
            </button>
            </td>
            </tr>
            <tr>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn4" value=4 onclick="displynum(btn4.value)">4
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn5" value=5 onclick="displynum(btn5.value)">5
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn6" value=6 onclick="displynum(btn6.value)">6
            </button>
            </td>
            </tr>
            <tr>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn1" value=1 onclick="displynum(btn1.value)">1
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn2" value=2 onclick="displynum(btn2.value)">2
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn3" value=3 onclick="displynum(btn3.value)">3
            </button>
            </td>
            </tr>
            <tr>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn0" value=0 onclick="displynum(btn0.value)">0
            </button>
            </td>
            <td colspan="2">
            <button type="button" class="btn btn-nahm btn-block" name="clrbtn" value=clear onclick="displyclear()">CLEAR
            </button>
            </td>
            </tr>
            <tr>
            <td colspan="3">
                <button type="submit" class="btn btn-nahm btn-block">BUKA POS KASIR
                </button>
            </td>
            </tr>
            <tr>
                <td colspan="3">
                <a href="keluar.php" class="btn btn-nahm btn-block">LOGOUT</a>
                </td>
            </tr>
            </table>
            <!--/.numpad-->
            </form>
        <!--Modal Form Login with Avatar Demo-->
    </div>
</div>
<?php }
else{ $idterminal=$hresultterminalcek['terminal_id'];?>
    <div class="row headerheight1" style="background-color: #e0e0e0;">
        <div class="col-6">
            <h4 style="font-weight: bold;">POS SYSTEM</h4>
        </div>
        <?php
        $ceknamauser=mysqli_query($koneksi,"SELECT * FROM user where id_user = '$usrpay'");
        $hceknamauser = mysqli_fetch_array($ceknamauser);
        ?>
        <div class="col-6">
            <h4 style="font-weight: bold;text-align: right;"><?php echo $hceknamauser['nama_user'];?></h4>
        </div>
    </div>
    <div class="row mh2">

        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-6 tepian">
                    <div class="row">
                    <div class="col-md-12 nopadding">
                        <div class="card" style="background-color: #e0e0e0;color: #fff;">
                            <div class="card-body" style="padding: 0px;">
                                    <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-12" style="padding: 0px;margin: 0px; color: #000;">
                                                    <div class="card">
                                                        <form action="saveorder.php" method="post">
                                                            <div class="card-body">
                                                                <div class="row" style="margin: 0px;padding: 0px;">
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
										                            <div class="col-4" style="padding: 3px;margin: 0px;">
										                                <label class="containercheckbox"><?php echo $hviewpostable1['nama_table'];?>
										                                  <input type="checkbox" id="<?php echo $hviewpostable1['id_table'];?>" name = "table[]" value="<?php echo $hviewpostable1['id_table'];?>" <?php echo $discheck1;?>>
										                                  <span class="checkmark"></span>
										                                </label>
										                            </div>
										                        <?php
										                        }
										                        ?>
                                                                </div>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-8" style="padding: 3px;margin: 0px;"><strong>JUMLAH CUSTOMER</strong></div>
                                                                    <div class="col-4" style="padding: 3px;margin: 0px;">
                                                                    	<button type="button" onclick="min('jumcust')"><b>-</b></button>
																		<input type="text" id="jumcust" name ="jumcust" value="0" style="width: 40%;text-align:center;">
																		<button type="button" onclick="plus('jumcust',999)"><b>+</b></button>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-12" style="padding: 3px;margin: 0px;"><button class="btn btn-nahm btn-block" type="submit" id="btnputorder">PROSES ORDER</button></div>
                                                                </div>
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="col-12" style="padding: 3px;margin: 0px;"><a class="btn btn-nahm btn-block" role="button" href="posorder.php" id="btnvoidorder">BATAL</a></div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                        </div>
                                    </div>
                            </div>
                            <!--
                            <div class="card-footer">
                                <h5 class="text-center mb-0">MENU</h5>
                            </div>
                            -->
                        </div>
                    </div>
                    </div>
                    <!-- Nav tabs -->

                </div>
            </div>
        </div>
    </div>
<?php }
?>
</div>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script>
    $(function () {
        $('.button-checkbox').each(function () {

            // Settings
            var $widget = $(this),
                $button = $widget.find('button'),
                $checkbox = $widget.find('input:checkbox'),
                color = $button.data('color'),
                settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
                };

            // Event Handlers
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });

            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');

                // Set the button's state
                $button.data('state', (isChecked) ? "on" : "off");

                // Set the button's icon
                $button.find('.state-icon')
                    .removeClass()
                    .addClass('state-icon ' + settings[$button.data('state')].icon);

                // Update the button's color
                if (isChecked) {
                    $button
                        .removeClass('btn-default')
                        .addClass('btn-' + color + ' active');
                }
                else {
                    $button
                        .removeClass('btn-' + color + ' active')
                        .addClass('btn-default');
                }
            }

            // Initialization
            function init() {

                updateDisplay();

                // Inject the icon if applicable
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                }
            }
            init();
        });
    });
    </script>
    <script type="text/javascript">
    function plus(xx,xxmax)
        {
        var x1plus=document.getElementById(xx).value;
        var x2plus=parseInt(x1plus)+1;
            if (x1plus < xxmax) {
                document.getElementById(xx).value=x2plus;
            }
            else {
                document.getElementById(xx).value=x1plus;
            }
        }
        function min(xx)
        {
        var x1plus=document.getElementById(xx).value;
        var x2plus=parseInt(x1plus)-1;
            if (x1plus < 1) {
                document.getElementById(xx).value=x1plus;
            }
            else {
                document.getElementById(xx).value=x2plus;
            }
        }
    </script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="ajax.js"></script>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>
    <script>
    $(document).ready(function () {
    $('#dtBasicExample').DataTable({
	"searching": false // false to disable search (or any other option)
	});
	$('.dataTables_length').addClass('bs-select');
    });
    </script>
    <script>
	function cancelorderconfirm() {
	  confirm("ANDA YAKIN AKAN MEMBATALKAN TRANSAKSI INI ?");
	}
	</script>
    <script>
	function logoutconfirm() {
	  confirm("ANDA YAKIN AKAN LOGOUT ?");
	}
	</script>
    <script>
	function terminalendconfirm() {
	  confirm("ANDA YAKIN AKAN MENUTUP TERMINAL POS INI ?");
	}
	</script>
    <script>
    //doughnut
    var ctxD = document.getElementById("doughnutChart").getContext('2d');
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
            datasets: [
                {
                    data: [300, 50, 100, 40, 120],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                }
            ]
        },
        options: {
            responsive: true
        }
    });
    </script>
    <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    </script>
</body>

</html>
<?php }?>
