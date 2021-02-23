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
    <link rel="stylesheet" type="text/css" href="css/stylekeyboard.css" />
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
    .mhnew
        {
          height: 74vh; /* 30% of viewport height*/
          max-height: 74vh;
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
    .scrollpagewidth
    {
    overflow-x: scroll;
    overflow-y: hidden;
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

<body>
<div class="container-fluid">
<?php
$terminalcek = "SELECT * FROM terminal_parameter WHERE openterminal = '' OR closeterminal ='' ";
$resultterminalcek = mysqli_query($koneksi,$terminalcek) or die (mysqli_error());
$rresultterminalcek= mysqli_num_rows($resultterminalcek);
$hresultterminalcek= mysqli_fetch_array($resultterminalcek);
if(empty($rresultterminalcek)){?>
<div class="row mh2 justify-content-md-center tepian" style="background-color: rgba(0, 0, 0, 0.2);">
    <div class="col-md-12" style="padding: 20vh;text-align: center;">
    <a><img src="logo.png" alt="Responsive image" width="20%"></a><br>
    <a href="bukaposkasir.php?iduser=<?php echo $usrpay;?>" class="btn btn-nahm">BUKA POS KASIR</a>
    </div>
</div>
<?php }
else{ $idterminal=$hresultterminalcek['terminal_id'];?>
    <div class="row headerheight1" style="background-color: #e0e0e0;">
        <div class="col-md-12 nopadding">
            <h4 style="font-weight: bold;">POS SYSTEM</h4>
        </div>
    </div>
    <div class="row mh2">
        <div class="col-md-4" style="background-color: #8c0000;"> <!--style="padding: 15px;"-->
            <div class="row" style="padding: 2vh;">
                <div class="col-md-12 tepian" style="background-color: #ffffff;">
                    <div class="row tepian" style="background-color: #6c0000;color: #fff;height: 7vh;">
                        <div class="col-10">
                            <a>Item Name</a>
                        </div>
                        <div class="col-2">
                            <a>Qty</a>
                        </div>
                    </div>
                    <div class="row mhnew scrollpage" style="background-color: #ffffff;">
                        <div class="col-12">
                        <?php
                        include "koneksi.php";
                        $itemtemp=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp ='$transtempprm' AND squenceorder = 'tmp' group by kditem");
                        while($hitemtemp = mysqli_fetch_array($itemtemp)) 
                            {
                            ?>
                            <?php
                            $kditem=$hitemtemp['kditem'];
                            $itemdet=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = $kditem");
                            $hitemdet = mysqli_fetch_array($itemdet);
                            $sumsubtotalitem=mysqli_query($koneksi,"SELECT SUM(price) AS sumsubtotal FROM pos_itemtemp where kditem = $kditem AND transtemp ='$transtempprm' AND bill = '$prmbill' ");
                            $hsumsubtotalitem = mysqli_fetch_array($sumsubtotalitem);
                            $sumqtyitem=mysqli_query($koneksi,"SELECT SUM(qty) AS sumsqty FROM pos_itemtemp where kditem = $kditem AND transtemp ='$transtempprm' AND squenceorder = 'tmp' ");
                            $hsumqtyitem = mysqli_fetch_array($sumqtyitem);
                            $price=$hsumsubtotalitem['sumsubtotal'];
                            ?>
                            <div class="row">
                            <div class="col-10">
                                <a><?php echo $hitemdet['nmitem'];?></a>
                            </div>
                            <div class="col-2">
                                <a><?php echo $hsumqtyitem['sumsqty'];?></a>
                            </div>
                            </div>
                            <?php
                            }
                        ?>
                        </div>
                    </div>
                    <div class="row" style="background-color: #ffffff;">
                        <div class="col-12 col-md-6 nopadding">
                            <a href="kosongorder.php?transtempprm=<?php echo $transtempprm;?>" class="btn btn-nahm btn-block" style="color:#fff;background-color: #b30000;text-decoration: none;border-radius: 0px;">BATAL</a>
                        </div>
                        <div class="col-12 col-md-6 nopadding">
                            <a href="updateorder.php?transtempprm=<?php echo $transtempprm;?>" class="btn btn-nahm btn-block" style="color:#fff;background-color: #b30000;text-decoration: none;border-radius: 0px;">PROSES ORDER</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8" style="background-color: #8c0000;">
            <div class="row mh2 scrollpage" style="padding: 2vh;">
                <div class="col-md-12 tepian scrollpagewidth" style="background-color: #ffffff;"> 
                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">TOOLS
                        </th>
                        <th class="th-sm">NOMOR TRANSAKSI
                        </th>
                        <th class="th-sm">TANGGAL TRANSAKSI
                        </th>
                        <th class="th-sm">WAKTU TRANSAKSI
                        </th>
                        <th class="th-sm">GROSS SALES
                        </th>
                        <th class="th-sm">DISC
                        </th>
                        <th class="th-sm">TAX
                        </th>
                        <th class="th-sm">NETT SALES
                        </th>
                        <th class="th-sm">JUMLAH BAYAR
                        </th>
                        <th class="th-sm">STATUS
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // membuka file JSON
                    $file = file_get_contents("http://localhost/bypos/fetchrekappenjualan.php");
                    $json = json_decode($file, true);
                    $hitung=count($json);
                    for($x=0;$x<$hitung;$x++)
                    {
                    ?>
                    <tr>
                        <td><a href="#" class="btn btn-nahm btn-block maxwidthheight" style="padding-left: 0px;padding-right: 0px;color: #fff;">REKAP TRANSAKSI</a></td>
                        <td class="align-middle"><?php echo $json[$x]['notrans'];?></td>
                        <td class="align-middle"><?php echo $json[$x]['date'];?></td>
                        <td class="align-middle"><?php echo $json[$x]['time'];?></td>
                        <td class="align-middle"><?php echo number_format($json[$x]['gross_sales']);?></td>
                        <td class="align-middle"><?php echo number_format($json[$x]['disc']);?></td>
                        <td class="align-middle"><?php echo number_format($json[$x]['tax']);?></td>
                        <td class="align-middle" class="align-middle"><?php echo number_format($json[$x]['nett_sales']);?></td>
                        <td class="align-middle"><?php echo number_format($json[$x]['jumlah_bayar']);?></td>
                        <td class="align-middle"><?php echo $json[$x]['status'];?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
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
    <script type="text/javascript" src="js/keyboard.js"></script>
    <script>
    $(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
    });
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