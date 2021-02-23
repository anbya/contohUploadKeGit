<?php
ob_start();
session_start();
include "koneksi.php";
$nmusrpos=$_SESSION['namausernahmposorder'];
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
$prminsert=$_POST["meja"];
/*terminal*/
/*header*/
/*header*/
/*squenceorder*/
$squenceorder1=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$prminsert'  ORDER BY squenceorder desc");
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
/*detail*/
$sqlpludetail=mysqli_query($koneksi,"SELECT * FROM pos_item");
while($hsqlpludetail = mysqli_fetch_array($sqlpludetail))
{
$cekqty=$hsqlpludetail['kditem'];
$qtydetail=$_POST["$cekqty"];
if($qtydetail>0)
    {
    for ($x = 0; $x<$qtydetail; $x++)
        {
        $paramdetail=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$prminsert' and kditem = '$cekqty' ORDER BY squence desc");
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
        $kddetail=$hsqlpludetail['kditem'];
        $pricedetail=$hsqlpludetail['price'];
        $cat=$hsqlpludetail['kdcategory'];
        $subcat=$hsqlpludetail['kdsubcategory'];
        $gpdetail=$pricedetail;
        $salestempdetail = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$prminsert' ");
        $hsalestempdetail = mysqli_fetch_array($salestempdetail);
        $keyoutlet = mysqli_query($koneksi,"SELECT * FROM pos_parameter");
        $hkeyoutlet = mysqli_fetch_array($keyoutlet);
        $grosssalesdetail=$hsalestempdetail['gross_sales']+$gpdetail;
        $nettsalesdetail=$hsalestempdetail['nett_sales']+$gpdetail;
        $note=$_POST["note$cekqty"];
        $sqldetail="INSERT INTO pos_itemtemp values('$prminsert','$kddetail','$cat','$subcat','$pricedetail','1','$gpdetail','0','$gpdetail','$nomatdetail','1','$nosqncorder','$prmterminal','$hkeyoutlet[id_outlet]','UNPAID','$note','')";
        mysqli_query($koneksi,$sqldetail) or die(mysqli_error());
        $sql1detail="UPDATE pos_salestemp SET gross_sales = '$grosssalesdetail' WHERE notrans = '$prminsert'";
        mysqli_query($koneksi,$sql1detail) or die(mysqli_error());
        }
    }
}
/*detail*/
echo "<script>location='tampilorder.php?notrans=$prminsert&squenceorder=$nosqncorder'</script>";
ob_flush();
}
?>
