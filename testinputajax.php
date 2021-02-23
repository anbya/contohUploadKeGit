<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
$koneksi = mysqli_connect("localhost","root","","test16052019");
 
// Check connection
if (mysqli_connect_errno()){
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TEST TEST TEST</title>
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
          height: 82vh; /* 30% of viewport height*/
          max-height: 82vh;
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
    <div class="row headerheight1" style="background-color: #e0e0e0;">
        <div class="col-md-12 nopadding">
            <h4 style="font-weight: bold;">POS SYSTEM</h4>
        </div>
    </div>
    <div class="row mh2">
        <div class="col-5" style="background-color: #8c0000;"> <!--style="padding: 15px;"-->
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
                            <div class="row" style="border-bottom-width: 1px;border-bottom-color: #6c0000;border-bottom-style: solid;">
                            <div class="col-12 d-flex justify-content-left align-items-center">
                                <a><?php echo $tampiladd.$tampilnote;?></a>
                            </div>
                            </div>
                            <div class="row" style="border-bottom-width: 1px;border-bottom-color: #6c0000;border-bottom-style: solid;">
                                <!-- Collapse buttons -->
                                <div class="col-12 d-flex justify-content-left align-items-center nopadding">
                                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        Link with href
                                    </a>
                                </div>
                                <!-- / Collapse buttons -->

                                <!-- Collapsible element -->
                                <div class="collapse" id="collapseExample">
                                        <a href="#" class="btn btn-nahm btn-block" style="color: #fff;">
                                        NOTE
                                        </a>
                                </div>
                                <!-- / Collapsible element -->
                            </div>
                            <div class="row" style="border-bottom-width: 1px;border-bottom-color: #6c0000;border-bottom-style: solid;">
                            <div class="col-12 d-flex justify-content-left align-items-center nopadding">
                                <a href="#" class="btn btn-nahm btn-block" style="color: #fff;" data-toggle="modal" data-target="#modalremarks<?php echo $hitemtemp['kditem'];?>">
                                        NOTE
                                </a>
                            </div>
                                <!--Modal: remarks-->
                                <div class="modal fade" id="modalremarks<?php echo $hitemtemp['kditem'];?>" tabindex="-1" role="dialog" aria-labelledby="modalremarks" aria-hidden="true">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2" style="background-color: #8c0000;"> <!--style="padding: 15px;"-->
            <div class="row" style="padding: 2vh;">
                <div class="col-md-12 tepian" style="background-color: #ffffff;">
                </div>
            </div>
        </div>
        <div class="col-5" style="background-color: #8c0000;"> <!--style="padding: 15px;"-->
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
                            <div class="row" style="border-bottom-width: 1px;border-bottom-color: #6c0000;border-bottom-style: solid;">
                            <div class="col-12 d-flex justify-content-left align-items-center">
                                <a><?php echo $tampiladd.$tampilnote;?></a>
                            </div>
                            </div>
                            <div class="row" style="border-bottom-width: 1px;border-bottom-color: #6c0000;border-bottom-style: solid;">
                            <div class="col-12 d-flex justify-content-left align-items-center nopadding">
                                <a href="#" class="btn btn-nahm btn-block" style="color: #fff;" data-toggle="modal" data-target="#modalremarks<?php echo $hitemtemp['kditem'];?>">
                                        NOTE
                                </a>
                            </div>
                                <!--Modal: remarks-->
                                <div class="modal fade" id="modalremarks<?php echo $hitemtemp['kditem'];?>" tabindex="-1" role="dialog" aria-labelledby="modalremarks" aria-hidden="true">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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