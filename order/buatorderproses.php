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
$prminsert=$_POST["notrans"];
$prmiditem=$_POST["iditem"];
$prmqty=$_POST["txt1"];
$nosqncorder=$_POST["squenceorder"];
$subcat=$_POST["subcat"];
$additional=$_POST["additional"];
/*terminal*/
/*header*/
/*header*/
/*detail*/
    for ($x = 0; $x<$prmqty; $x++) 
    {
        $paramdetail=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$prminsert' and kditem = '$prmiditem' ORDER BY squence desc");
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
        $viewitem=mysqli_query($koneksi,"SELECT * FROM pos_item where  kditem = '$prmiditem' ");
        $hviewitem = mysqli_fetch_array($viewitem);
        $kddetail=$hviewitem['kditem'];
        $pricedetail=$hviewitem['price'];
        $cat=$hviewitem['kdcategory'];
        $subcat=$hviewitem['kdsubcategory'];
        $gpdetail=$pricedetail;
        $salestempdetail = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$prminsert' ");
        $hsalestempdetail = mysqli_fetch_array($salestempdetail);
        $keyoutlet = mysqli_query($koneksi,"SELECT * FROM pos_parameter");
        $hkeyoutlet = mysqli_fetch_array($keyoutlet);
        $grosssalesdetail=$hsalestempdetail['gross_sales']+$gpdetail;
        $nettsalesdetail=$hsalestempdetail['nett_sales']+$gpdetail;
        $sqldetail="INSERT INTO pos_itemtemp values('$prminsert','$kddetail','$cat','$subcat','$pricedetail','1','$gpdetail','0','$gpdetail','$nomatdetail','1','$nosqncorder','$prmterminal','$hkeyoutlet[id_outlet]','UNPAID','','$additional')";
        mysqli_query($koneksi,$sqldetail) or die(mysqli_error());
    }
/*detail*/
echo "<script>location='tambahitem.php?transtempprm=$prminsert&subcat=$subcat'</script>";
ob_flush();
}
?>