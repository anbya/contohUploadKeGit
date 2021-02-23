<table>
<?php
include "koneksi.php";
$prm=$_GET['test'];
$postemp=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where terminal_id ='$prm' AND status = 'OPEN' and meja !='takeaway' ");
while($hpostemp = mysqli_fetch_array($postemp))
{
$opentrans=$hpostemp['notrans'];
$tabletrans=$hpostemp['meja'];
/*pos table*/
if($tabletrans!="takeaway")
{
$viewpostable1=mysqli_query($koneksi,"SELECT * FROM pos_table where notrans = '$opentrans' ");
$hviewpostable1 = mysqli_fetch_array($viewpostable1);
$namatable=$hviewpostable1['nama_table'];
}
else
{
$namatable=$tabletrans;
}
/*pos table*/
?>
<div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
<a><?php echo $namatable;?></a>
</div>
<div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
<a><?php echo $hpostemp['notrans'];?></a>
</div>
<div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
<a><?php echo number_format($hpostemp['gross_sales']);?></a>
</div>
<div class="col-12 col-md-3 nopadding d-flex justify-content-center align-items-center" style="border-width: 1px;border-color: #000;border-style: solid;">
<a href="index.php?transtempprm=<?php echo $opentrans;?>" class="btn btn-nahm btn-block maxwidthheight">PILIH TRANSAKSI INI</a>
</div>
<?php
}
?>