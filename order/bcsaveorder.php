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
/*terminal*/
/*header*/
$headerparam=mysqli_query($koneksi,"SELECT * FROM pos_parameter ");
$hparamheader = mysqli_fetch_array($headerparam);
$nomatx2header=$hparamheader['counter_trans_temp'];
$prefixheader=$hparamheader['prefix'];
$id_outlet=$hparamheader['id_outlet'];
$nomatx3header=$nomatx2header+1;
if ($nomatx2header > 0)
{
	if ($nomatx3header>=0 && $nomatx3header<=9)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'000000'.$nomatx3header;
	}
	elseif ($nomatx3header>9 && $nomatx3header<=99)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'00000'.$nomatx3header;
	}
	elseif ($nomatx3header>99 && $nomatx3header<=999)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'0000'.$nomatx3header;
	}
	elseif ($nomatx3header>999 && $nomatx3header<=9999)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'000'.$nomatx3header;
	}
	elseif ($nomatx3header>9999 && $nomatx3header<=99999)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'00'.$nomatx3header;
	}
	elseif ($nomatx3header>99999 && $nomatx3header<=999999)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.'0'.$nomatx3header;
	}
	elseif ($nomatx3header>999999 && $nomatx3header<=9999999)
	{
		$nomatheader=$prefixheader.'T'.$nowyears.$nomatx3header;
	}
}
else
{
	$nomatheader=$prefixheader.'T'.$nowyears.'0000001';
}
$jumcustheader=$_POST["jumcust"];
$tableheader = implode(", ", $_POST['table']);
if(!empty($_POST['table'])) {
    foreach($_POST['table'] as $table) {
    $tableupdate="UPDATE pos_table SET notrans = '$nomatheader' where id_table = '$table' ";
	mysqli_query($koneksi,$tableupdate) or die(mysqli_error());
    }
}
$sqlheader="INSERT INTO pos_salestemp values('$nomatheader','','$jumcustheader','0','0','0','0','0','0','$dateopn','$timeopn','','','','$tableheader','OPEN','1','','','','','','','$prmterminal','$id_outlet')";
mysqli_query($koneksi,$sqlheader) or die(mysqli_error());
$sql4header="UPDATE pos_parameter SET counter_trans_temp = '$nomatx3header' ";
mysqli_query($koneksi,$sql4header) or die(mysqli_error());
/*header*/
/*squence order*/
$squenceorder1=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$nomatheader'  ORDER BY squenceorder desc");
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
/*squence order*/
/*detail*/
$sqlpludetail=mysqli_query($koneksi,"SELECT * FROM pos_item");
while($hsqlpludetail = mysqli_fetch_array($sqlpludetail))
{
$cekqty=$hsqlpludetail['kditem'];
$cat=$hsqlpludetail['kdcategory'];
$subcat=$hsqlpludetail['kdsubcategory'];
$qtydetail=$_POST["$cekqty"];
if($qtydetail>0)
	{
	for ($x = 1; $x<=$qtydetail; $x++)
        {
		$paramdetail=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$nomatheader' and kditem = '$cekqty' ORDER BY squence desc");
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
		$gpdetail=$pricedetail;
		$salestempdetail = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$nomatheader' ");
		$hsalestempdetail = mysqli_fetch_array($salestempdetail);
		$grosssalesdetail=$hsalestempdetail['gross_sales']+$gpdetail;
		$nettsalesdetail=$hsalestempdetail['nett_sales']+$gpdetail;
		$sqldetail="INSERT INTO pos_itemtemp values('$nomatheader','$kddetail','$cat','$subcat','$pricedetail','1','$gpdetail','0','$gpdetail','$nomatdetail','1','$nosqncorder','$prmterminal','$id_outlet','UNPAID')";
		mysqli_query($koneksi,$sqldetail) or die(mysqli_error());
		$sql1detail="UPDATE pos_salestemp SET gross_sales = '$grosssalesdetail' WHERE notrans = '$nomatheader'";
		mysqli_query($koneksi,$sql1detail) or die(mysqli_error());
		}
	}
}
/*detail*/
echo "<script>location='tampilorder.php?notrans=$nomatheader&squenceorder=$nosqncorder'</script>";
ob_flush();
}
?>
