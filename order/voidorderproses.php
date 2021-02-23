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
$prmvoid=$_POST["prmvoid"];
$idterminal=$_POST["idterminal"];
$statusvoid=$_POST["statusvoid"];
$alasanvoid=$_POST["alasanvoid"];
$sqlpludetail=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$prmvoid' group by additional");
while($hsqlpludetail = mysqli_fetch_array($sqlpludetail)) 
{
$prmkeysqn=$hsqlpludetail['kditem'].$hsqlpludetail['additional'];
$prmkey=$hsqlpludetail['kditem'];
$qtydetail=$_POST["$prmkeysqn"];
if($qtydetail>0)
    {
    for ($x = 0; $x<$qtydetail; $x++) 
        {
        $prmsquence=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$prmvoid' and kditem = '$prmkey' order by squence DESC");
        $hprmsquence = mysqli_fetch_array($prmsquence);
        $hapussquence = $hprmsquence['squence'];
        $voidprice = $hprmsquence['price'];
        $prmupdateitemtemp = mysqli_query($koneksi,"SELECT * FROM pos_itemtemp WHERE transtemp = '$prmvoid' AND kditem = '$prmkey' AND squence = '$hapussquence' ");
        $hprmupdateitemtemp = mysqli_fetch_array($prmupdateitemtemp);
        $prmupdatesalestemp = mysqli_query($koneksi,"SELECT * FROM pos_salestemp WHERE notrans = '$prmvoid'");
        $hprmupdatesalestemp = mysqli_fetch_array($prmupdatesalestemp);
        $updatedgrosssales=$hprmupdatesalestemp['gross_sales']-$hprmupdateitemtemp['price'];
        $updatednettsales=$hprmupdatesalestemp['nett_sales']-$hprmupdateitemtemp['price'];
        $updatesalestemp="UPDATE pos_salestemp SET gross_sales = '$updatedgrosssales' WHERE notrans = '$prmvoid'";
        mysqli_query($koneksi,$updatesalestemp) or die(mysqli_error());
        $insertvoid="INSERT INTO item_void values('$prmvoid','$idterminal','$hkeyoutlet[id_outlet]','$prmkey','$hprmsquence[additional]','1','$voidprice','$statusvoid','$alasanvoid')";
        mysqli_query($koneksi,$insertvoid) or die(mysqli_error());
        $hapus = "DELETE FROM pos_itemtemp WHERE transtemp = '$prmvoid' AND kditem = '$prmkey' AND squence = '$hapussquence' ";
        mysqli_query($koneksi,$hapus) or die(mysqli_error());
        }
    }
}
/*detail*/
echo "<script>location='../index.php?transtempprm=$prmvoid'</script>";
ob_flush();
}
?>