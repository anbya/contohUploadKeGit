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
$prmvoid=$_POST["meja"];
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" style="margin-top: 5%;">
                <form action="voidorderproses.php" method="post">
                    <div class="card-header">
                        <h5 class="text-center mb-0">VOID ORDER</h5>
                    </div>
                    <div class="card-body">
                    <input type="hidden" name ="prmvoid" value="<?php echo $prmvoid;?>" style="width: 100%;">
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-8" style="padding: 3px;margin: 0px;"><strong>NAMA MENU</strong></div>
                            <div class="col-4" style="padding: 3px;margin: 0px;"><strong>JUMLAH</strong></div>
                        </div>
                        <?php
                        include "koneksi.php";
                        $sqlplu=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$prmvoid'");
                        while($hsqlplu = mysqli_fetch_array($sqlplu)) 
                        {
                        $qtycek=$hsqlplu['kditem'];
                        $maxqtyvoid=$hsqlplu['qty'];
                        $fetchitem = "SELECT * FROM pos_item WHERE kditem = '$qtycek'";
                        $resultfetchitem = mysqli_query($koneksi,$fetchitem) or die (mysqli_error());
                        $hresultfetchitem= mysqli_fetch_array($resultfetchitem);
                        ?>
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-8" style="padding: 3px;margin: 0px;"><strong><?php echo $hresultfetchitem['nmitem'];?> (<?php echo $maxqtyvoid;?>)</strong></div>
                            <div class="col-4" style="padding: 3px;margin: 0px;"><input type="number" name ="<?php echo $hresultfetchitem['kditem'];?>" value="" style="width: 100%;" min="0" max="<?php echo $maxqtyvoid;?>"></div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-12" style="padding: 3px;margin: 0px;"><button class="btn btn-primary btn-block" type="submit" id="btnputorder">PROSES VOID ORDER</button></div>
                        </div>
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <div class="col-12" style="padding: 3px;margin: 0px;"><a class="btn btn-primary btn-block" role="button" href="index.php" id="btnvoidorder">BATAL</a></div>
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
</body>

</html>