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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
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
        <div class="col-md-5" style="background-color: #8c0000;"> <!--style="padding: 15px;"-->
            <div class="row" style="padding: 2vh;">
                <div class="col-md-12 tepian" style="background-color: #ffffff;">
                    <div class="row tepian" style="background-color: #6c0000;color: #fff;height: 7vh;">
                        <div class="col-8 d-flex justify-content-left align-items-center">
                            <a>Item Name</a>
                        </div>
                        <div class="col-2 d-flex justify-content-left align-items-center">
                            <a>Qty</a>
                        </div>
                        <div class="col-2 d-flex justify-content-left align-items-center">
                            <a>Hapus</a>
                        </div>
                    </div>
                    <div class="row mhnew scrollpage" style="background-color: #ffffff;">
                        <div class="col-12">
                        <?php
                        include "koneksi.php";
                        $itemtemp=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp ='$transtempprm' AND squenceorder = 'tmp' group by additional, kditem");
                        while($hitemtemp = mysqli_fetch_array($itemtemp)) 
                            {
                            ?>
                            <?php
                            $kditem=$hitemtemp['kditem'];
                            $itemdet=mysqli_query($koneksi,"SELECT * FROM pos_item where kditem = $kditem");
                            $hitemdet = mysqli_fetch_array($itemdet);
                            $sumsubtotalitem=mysqli_query($koneksi,"SELECT SUM(price) AS sumsubtotal FROM pos_itemtemp where kditem = $kditem AND transtemp ='$transtempprm' AND squenceorder = 'tmp' AND additional = '$hitemtemp[additional]'");
                            $hsumsubtotalitem = mysqli_fetch_array($sumsubtotalitem);
                            $sumqtyitem=mysqli_query($koneksi,"SELECT SUM(qty) AS sumsqty FROM pos_itemtemp where kditem = $kditem AND transtemp ='$transtempprm' AND squenceorder = 'tmp' AND additional = '$hitemtemp[additional]'");
                            $hsumqtyitem = mysqli_fetch_array($sumqtyitem);
                            $price=$hsumsubtotalitem['sumsubtotal'];
                            ?>
                            <div class="row">
                            <div class="col-8 d-flex justify-content-left align-items-center">
                                <a><?php echo $hitemdet['nmitem'];?></a>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center">
                                <a><?php echo $hsumqtyitem['sumsqty'];?></a>
                            </div>
                            <div class="col-2 nopadding">
                                <a href="voidbuatorder.php?prmvoid=<?php echo $transtempprm;?>&kditemvoid=<?php echo $kditem;?>&subcat=<?php echo $_GET['subcat'];?>&squence=<?php echo $hitemtemp['squence'];?>" class="btn btn-nahm btn-block" style="color: #fff;">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>
                            </div>
                            <?php
                            if($hitemtemp['additional']==$kditem)
                            {
                                $tampiladd="";
                            }
                            else
                            {
                                $tampiladd=$hitemtemp['additional'];
                            }
                            ?>
                            <div class="row" style="border-bottom-width: 1px;border-bottom-color: #6c0000;border-bottom-style: solid;">
                            <div class="col-12 d-flex justify-content-left align-items-center">
                                <a><?php echo $tampiladd.$hitemtemp['note'];?></a>
                            </div>
                            </div>
                            <div class="row" style="border-bottom-width: 1px;border-bottom-color: #6c0000;border-bottom-style: solid;">
                            <div class="col-12 d-flex justify-content-left align-items-center nopadding">
                                <a href="#" class="btn btn-nahm btn-block" style="color: #fff;" data-toggle="modal" data-target="#modalremarks<?php echo $hitemtemp['kditem'].$hitemtemp['additional'];?>">
                                        NOTE
                                </a>
                            </div>
                                <!--Modal: remarks-->
                                <div class="modal fade" id="modalremarks<?php echo $hitemtemp['kditem'].$hitemtemp['additional'];?>" tabindex="-1" role="dialog" aria-labelledby="modalremarks" aria-hidden="true">
                                    <div class="modal-dialog cascading-modal" role="document">
                                                    <!--Content-->
                                        <div class="modal-content">

                                            <!--Modal cascading tabs-->
                                            <div class="modal-c-tabs">

                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs tabs-2" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="btn btn-nahm btn-block" data-toggle="tab" href="#panel171" role="tab">NOTE</a>
                                                    </li>
                                                </ul>

                                                    <!-- Tab panels -->
                                                    <form action="updatenote.php" method="post">
                                                        <div class="tab-content">
                                                            <!--Panel 17-->
                                                            <div class="tab-pane fade in show active" id="panel171" role="tabpanel">

                                                                <!--Body-->
                                                                <div class="modal-body mb-1">
                                                                    <input type="hidden" name ="prmnote" value="<?php echo $transtempprm;?>" style="width: 100%;">
                                                                    <input type="hidden" name ="iditemnote" value="<?php echo $hitemtemp['kditem'];?>" style="width: 100%;">
                                                                    <input type="hidden" name ="squancenote" value="<?php echo $hitemtemp['squence'];?>" style="width: 100%;">
                                                                    <input type="hidden" name ="subcat" value="<?php echo $_GET['subcat'];?>" style="width: 100%;">
                                                                    <div class="form-group">
                                                                        <label for="comment">ISI NOTE DI BAWAH :</label>
                                                                        <textarea class="form-control" rows="5" id="comment" name="note"><?php echo $hitemtemp['note'];?></textarea>
                                                                    </div>
                                                                    <div class="row" style="margin: 0px;padding: 0px;">
                                                                        <div class="col-12" style="padding: 3px;margin: 0px;"><button class="btn btn-nahm btn-block" type="submit" id="btnputorder">SIMPAN NOTE</button></div>
                                                                    </div>
                                                                </div>
                                                                <!--Body-->
                                                            </div>
                                                            <!--/.Panel 17-->
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--/.Content-->
                                        </div>
                                    </div>
                                <!--Modal: remarks-->
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

        <div class="col-md-7">
            <div class="row mh1 scrollpage">
                <div class="col-12 col-md-12 tepian">
                    <div class="row nopadding">
                        <?php
                        $subcat=mysqli_query($koneksi,"select * from pos_subcategory");
                                while($hsubcat=mysqli_fetch_array($subcat))
                        {
                        ?>
                        <div class="col-12 col-md-3 nopadding">
                            <a href="tambahitem.php?transtempprm=<?php echo $transtempprm;?>&subcat=<?php echo $hsubcat['kdsubcategory'];?>" class="btn btn-nahm btn-block" style="color:#fff;background-color: #861919;text-decoration: none;border-radius: 0px;"><?php echo $hsubcat['nmsubcategory'];?></a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row mh1 scrollpage">
            <!-- /menu -->
                <div class="col-md-12 nopadding">
                    <div class="row nopadding">
                    <?php
                    if(empty($_GET['subcat']))
                    {
                        echo "";
                    }
                    else
                    {
                        $additem=mysqli_query($koneksi,"select * from pos_item where kdsubcategory = '$_GET[subcat]' AND state = 'ACTIVE' ORDER BY nmitem ASC");
                        while($hadditem=mysqli_fetch_array($additem))
                        {
                        $keyadditem=$hadditem['kditem'];
                        ?>
                        <div class="col-12 col-md-3 nopadding">
                            <a href="#" class="btn btn-block maxwidthheight" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;" data-toggle="modal" data-target="#tes<?php echo $hadditem['kditem'];?>"><?php echo $hadditem['nmitem'];?></a>
                        </div>
                        <!--Modal: -->
                        <div class="modal fade" id="tes<?php echo $hadditem['kditem'];?>" tabindex="-1" role="dialog" aria-labelledby="tes12345" aria-hidden="true">
                            <div class="modal-dialog modal-sm cascading-modal" role="document">
                            <!--Content-->
                                <div class="modal-content">
                                    <div class="card">
                                        <div class="card-header" style="text-align: center;">
                                        <h5><b><?php echo $hadditem['nmitem'];?></b></h5>
                                        <a>input jumlah item</a>
                                        </div>
                                        <div class="card-body justify-content-center">
                                            <script type="text/javascript">
                                            function numadditem<?php echo $keyadditem;?>(n1)
                                            {
                                            calcform<?php echo $keyadditem;?>.txt1.value=calcform<?php echo $keyadditem;?>.txt1.value+n1;
                                            }
                                            function numadditemclr<?php echo $keyadditem;?>()
                                            {
                                            calcform<?php echo $keyadditem;?>.txt1.value="";
                                            }
                                            </script>
                                            <form name="calcform<?php echo $keyadditem;?>" action="tambahorderproses.php" method="post">
                                                <input type="hidden" name="squenceorder" class="form-control ml-0" value="tmp">
                                                <input type="hidden" name="notrans" class="form-control ml-0" value="<?php echo $transtempprm;?>">
                                                <input type="hidden" name="subcat" class="form-control ml-0" value="<?php echo $_GET['subcat'];?>">
                                                <input type="hidden" name="iditem" class="form-control ml-0" value="<?php echo $keyadditem;?>">
                                                <input type="text" name="txt1" class="form-control ml-0" placeholder="input jumlah item" required>
                                            <?php
                                            $arradditional= explode(',',$hadditem['additional']);
                                            $countadd=count($arradditional);
                                            if($countadd>1)
                                            {
                                                for($add=0;$add<$countadd;$add++)
                                                {
                                                ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="containerradio"><?php echo $arradditional[$add];?>
                                                            <input type="radio" name="additional" value="<?php echo $arradditional[$add];?>" required>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                            }
                                            else
                                            {
                                            ?>
                                            <input type="hidden" name="additional" class="form-control ml-0" value="<?php echo $keyadditem;?>">
                                            <?php
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-4 nopadding">
                                                    <input type=button name="btn7<?php echo $keyadditem;?>" value=7 onclick="numadditem<?php echo $keyadditem;?>(btn7<?php echo $keyadditem;?>.value)" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                                <div class="col-4 nopadding">
                                                    <input type=button name="btn8<?php echo $keyadditem;?>" value=8 onclick="numadditem<?php echo $keyadditem;?>(btn8<?php echo $keyadditem;?>.value)" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                                <div class="col-4 nopadding">
                                                    <input type=button name="btn9<?php echo $keyadditem;?>" value=9 onclick="numadditem<?php echo $keyadditem;?>(btn9<?php echo $keyadditem;?>.value)" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4 nopadding">
                                                    <input type=button name="btn4<?php echo $keyadditem;?>" value=4 onclick="numadditem<?php echo $keyadditem;?>(btn4<?php echo $keyadditem;?>.value)" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                                <div class="col-4 nopadding">
                                                    <input type=button name="btn5<?php echo $keyadditem;?>" value=5 onclick="numadditem<?php echo $keyadditem;?>(btn5<?php echo $keyadditem;?>.value)" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                                <div class="col-4 nopadding">
                                                    <input type=button name="btn6<?php echo $keyadditem;?>" value=6 onclick="numadditem<?php echo $keyadditem;?>(btn6<?php echo $keyadditem;?>.value)" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4 nopadding">
                                                    <input type=button name="btn1<?php echo $keyadditem;?>" value=1 onclick="numadditem<?php echo $keyadditem;?>(btn1<?php echo $keyadditem;?>.value)" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                                <div class="col-4 nopadding">
                                                    <input type=button name="btn2<?php echo $keyadditem;?>" value=2 onclick="numadditem<?php echo $keyadditem;?>(btn2<?php echo $keyadditem;?>.value)" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                                <div class="col-4 nopadding">
                                                    <input type=button name="btn3<?php echo $keyadditem;?>" value=3 onclick="numadditem<?php echo $keyadditem;?>(btn3<?php echo $keyadditem;?>.value)" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4 nopadding">
                                                    <input type=button name="btn0<?php echo $keyadditem;?>" value=0 onclick="numadditem<?php echo $keyadditem;?>(btn0<?php echo $keyadditem;?>.value)" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                                <div class="col-8 nopadding">
                                                    <input type=button name="clrbtn" value=clear onclick="numadditemclr<?php echo $keyadditem;?>()" class="btn" style="color:#fff;background-color: #720000;text-decoration: none;border-radius: 0px;width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button class="btn btn-nahm btn-block">
                                                    Proses
                                                    </button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!--/.Content-->
                            </div>
                        </div>
                        <!--Modal: -->
                        <?php
                        }
                    }
                    ?>
                    </div>
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