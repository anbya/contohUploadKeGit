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
$keyoutlet = mysqli_query($koneksi,"SELECT * FROM pos_parameter");
$hkeyoutlet = mysqli_fetch_array($keyoutlet);
if(empty($rresultterminalcek))
{
    echo "<script>alert('void tidak dapat diproses karena terminal belum dibuka');location='index.php'</script>";
    ob_flush();
}
else
{
/*terminal*/
/*header*/
/*header*/
/*detail*/
$prmvoid=$_GET["prmvoid"];
$kditemvoid=$_GET["kditemvoid"];
$squence=$_GET["squence"];
$subcat=$_GET["subcat"];
$hapus = "DELETE FROM pos_itemtemp WHERE transtemp = '$prmvoid' AND kditem = '$kditemvoid' AND squence = '$squence' AND squenceorder = 'tmp'";
mysqli_query($koneksi,$hapus) or die(mysqli_error());
/*detail*/
echo "<script>location='tambahitem.php?transtempprm=$prmvoid&subcat=$subcat'</script>";
ob_flush();
}
?>