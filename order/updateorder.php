<?php
ob_start();
session_start();
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i");
$dateopn=date("d/m/Y", $tanggal);
$timeopn=$jam;
$nowyears=date("y");
/*terminal*/
$terminalcek = "SELECT * FROM terminal_parameter WHERE openterminal = '' OR closeterminal ='' ";
$resultterminalcek = mysqli_query($koneksi,$terminalcek) or die (mysqli_error());
$rresultterminalcek= mysqli_num_rows($resultterminalcek);
$hresultterminalcek= mysqli_fetch_array($resultterminalcek);
$prmterminal=$hresultterminalcek['terminal_id'];
if(empty($rresultterminalcek))
{
    echo "<script>alert('order tidak dapat diproses karena terminal belum dibuka');location='index.php'</script>";
    ob_flush();
}
else
{
$transtempprm=$_GET["transtempprm"];
$squenceorder1=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtempprm' AND squenceorder != 'tmp' ORDER BY squenceorder desc");
$rsquenceorder1 = mysqli_num_rows($squenceorder1);
$hsquenceorder1 = mysqli_fetch_array($squenceorder1);
$nosqncorderx1=$hsquenceorder1['squenceorder'];
$nosqncorderx2=$nosqncorderx1+1;
$nosqncorder=$nosqncorderx2;
/*terminal*/
/*header*/
/*header*/
/*detail*/
$sumgross=mysqli_query($koneksi,"SELECT sum(price) as sumprice  FROM pos_itemtemp where transtemp = '$transtempprm'");
$hsumgross = mysqli_fetch_array($sumgross);
$grossupdated=$hsumgross['sumprice'];
$updatesalestemp="UPDATE pos_itemtemp SET squenceorder = '$nosqncorder' WHERE transtemp = '$transtempprm' AND squenceorder = 'tmp'";
mysqli_query($koneksi,$updatesalestemp) or die(mysqli_error());
$updategrosssales="UPDATE pos_salestemp SET gross_sales = '$grossupdated' WHERE notrans = '$transtempprm'";
mysqli_query($koneksi,$updategrosssales) or die(mysqli_error());
/*detail*/

//echo "<script>location='index.php?transtempprm=$transtempprm'</script>";
echo "<script>location='../escpos/cetakorder.php?keytrans=$transtempprm&sqnc=$nosqncorder&header=server'</script>";
ob_flush();
}
?>