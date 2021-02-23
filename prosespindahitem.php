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
$prmpindahitem1=$_POST["prmpindahitem1"];
$prmpindahitem2=$_POST["prmpindahitem2"];
$idterminal=$_POST["idterminal"];
/*squenceorder*/
$squenceorder1=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$prmpindahitem2'  ORDER BY squenceorder desc");
$rsquenceorder1 = mysqli_num_rows($squenceorder1);
$hsquenceorder1 = mysqli_fetch_array($squenceorder1);
if ($rsquenceorder1 > 0)
{
    $nosqncorderx1=$hsquenceorder1['squenceorder'];
    $nosqncorderx2=$nosqncorderx1+1;
    $nosqncorder=$nosqncorderx2;
}
else
{
    $nosqncorder='1';
}
/*squenceorder*/
$sqlpludetail=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$prmpindahitem1' group by kditem");
while($hsqlpludetail = mysqli_fetch_array($sqlpludetail)) 
{
$prmkey=$hsqlpludetail['kditem'];
$qtydetail=$_POST["$prmkey"];
if($qtydetail>0)
    {
    for ($x = 0; $x<$qtydetail; $x++) 
        {
        //hapus//
        $prmsquence=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$prmpindahitem1' and kditem = '$prmkey' ORDER BY squence desc");
        $hprmsquence = mysqli_fetch_array($prmsquence);
        $hapussquence = $hprmsquence['squence'];
        $voidprice = $hprmsquence['price'];
        $prmupdateitemtemp = mysqli_query($koneksi,"SELECT * FROM pos_itemtemp WHERE transtemp = '$prmpindahitem1' AND kditem = '$prmkey' AND squence = '$hapussquence' ");
        $hprmupdateitemtemp = mysqli_fetch_array($prmupdateitemtemp);
        $prmupdatesalestemp = mysqli_query($koneksi,"SELECT * FROM pos_salestemp WHERE notrans = '$prmpindahitem1'");
        $hprmupdatesalestemp = mysqli_fetch_array($prmupdatesalestemp);
        $updatedgrosssales=$hprmupdatesalestemp['gross_sales']-$hprmupdateitemtemp['price'];
        $updatednettsales=$hprmupdatesalestemp['nett_sales']-$hprmupdateitemtemp['price'];
        $updatesalestemp="UPDATE pos_salestemp SET gross_sales = '$updatedgrosssales' WHERE notrans = '$prmpindahitem1'";
        mysqli_query($koneksi,$updatesalestemp) or die(mysqli_error());
        //hapus//
        //tambah//
        $paramdetail=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$prmpindahitem2' and kditem = '$prmkey' ORDER BY squence desc");
        $rparamdetail = mysqli_num_rows($paramdetail);
        $hparamdetail = mysqli_fetch_array($paramdetail);
        if ($rparamdetail > 0)
        {
            $nomatx2detail=$hparamdetail['squence'];
            $nomatx3detail=$nomatx2detail+1;
            if ($nomatx3detail>=0 && $nomatx3detail<=9)
            {
                $nomatdetail=$nomatx3detail;
            }
            elseif ($nomatx3detail>9 && $nomatx3detail<=99)
            {
                $nomatdetail=$nomatx3detail;
            }
            elseif ($nomatx3detail>99 && $nomatx3detail<=999)
            {
                $nomatdetail=$nomatx3detail;
            }
            elseif ($nomatx3detail>999 && $nomatx3detail<=9999)
            {
                $nomatdetail=$nomatx3detail;
            }
            elseif ($nomatx3detail>9999 && $nomatx3detail<=99999)
            {
                $nomatdetail=$nomatx3detail;
            }
            elseif ($nomatx3detail>99999 && $nomatx3detail<=999999)
            {
                $nomatdetail=$nomatx3detail;
            }
        }
        else
        {
            $nomatdetail='1';
        }
        $kddetail=$hprmupdateitemtemp['kditem'];
        $pricedetail=$hprmupdateitemtemp['price'];
        $cat=$hprmupdateitemtemp['kdcategory'];
        $subcat=$hprmupdateitemtemp['kdsubcategory'];
        $note=$hprmupdateitemtemp['note'];
        $additional=$hprmupdateitemtemp['additional'];
        $gpdetail=$pricedetail;
        $salestempdetail = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$prmpindahitem2' ");
        $hsalestempdetail = mysqli_fetch_array($salestempdetail);
        $keyoutlet = mysqli_query($koneksi,"SELECT * FROM pos_parameter");
        $hkeyoutlet = mysqli_fetch_array($keyoutlet);
        $grosssalesdetail=$hsalestempdetail['gross_sales']+$gpdetail;
        $nettsalesdetail=$hsalestempdetail['nett_sales']+$gpdetail;
        $sqldetail="INSERT INTO pos_itemtemp values('$prmpindahitem2','$kddetail','$cat','$subcat','$pricedetail','1','$gpdetail','0','$gpdetail','$nomatdetail','1','$nosqncorder','$prmterminal','$hkeyoutlet[id_outlet]','UNPAID','$note','$additional')";
        mysqli_query($koneksi,$sqldetail) or die(mysqli_error());
        $sql1detail="UPDATE pos_salestemp SET gross_sales = '$grosssalesdetail' WHERE notrans = '$prmpindahitem2'";
        mysqli_query($koneksi,$sql1detail) or die(mysqli_error());
        //tambah//
        $hapus = "DELETE FROM pos_itemtemp WHERE transtemp = '$prmpindahitem1' AND kditem = '$prmkey' AND squence = '$hapussquence' ";
        mysqli_query($koneksi,$hapus) or die(mysqli_error());
        }
    }
}
/*detail*/
echo "<script>location='index.php?transtempprm=$prmpindahitem1'</script>";
ob_flush();
}
?>