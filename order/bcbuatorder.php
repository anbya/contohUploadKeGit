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
                        <div class="modal fade" role="dialog" tabindex="-1" id="modaladdorder">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">BUAT ORDER</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                    <div class="modal-body">
                                        <p>The content of your modal.</p>
                                    </div>
                                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-8" style="padding: 3px;margin: 0px;"><strong>NAMA MENU</strong></div>
                            <div class="col-4" style="padding: 3px;margin: 0px;"><strong>JUMLAH</strong></div>
                        </div>
                        <?php
                        include "koneksi.php";
                        $sqlplu=mysqli_query($koneksi,"SELECT * FROM pos_item");
                        while($hsqlplu = mysqli_fetch_array($sqlplu))
                        {
                        $qtycek=$hsqlplu['kditem'];
                        ?>
                        <div class="row" style="margin: 0px;padding: 0px;border-bottom-width: 1px;border-bottom-color: #111;border-bottom-style: solid;">
                            <div class="col-7 my-auto" style="padding: 0px;margin: 0px;"><strong><?php echo $hsqlplu['nmitem'];?></strong></div>
                            <div class="col-5 my-auto" style="padding: 0px;margin: 0px;"><button type="button" class="btn btn-dark" onclick="min(<?php echo $qtycek;?>)"><b>-</b></button><input type="text" id="<?php echo $qtycek;?>" name ="<?php echo $qtycek;?>" value="0" style="width: 40%;text-align:center;"><button type="button" class="btn btn-dark" onclick="plus(<?php echo $qtycek;?>)"><b>+</b></button></div>
                        </div>
                        <?php
                        }
                        ?>
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
</body>

</html>
