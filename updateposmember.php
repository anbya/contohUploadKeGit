<?php
error_reporting(0);
ob_start();
include "koneksi.php";
$notrans=$_POST["notrans"];
$num=$_POST["txt1"];

$keyparameter=$num;
$file = file_get_contents("http://nahmthaisukibbq.com/jsondata/index.php?keyparameter=$keyparameter");
$json = json_decode($file, true);

$idmember = $json[0]['id_member']." ".$json[0]['nama_member'];
$verify = $json[0]['statusmembership'];
if (!empty($idmember))
{
	if ($verify == "VERIFIED")
	{
		$sql="UPDATE pos_salestemp SET member = '$idmember' WHERE notrans = '$notrans'";
	    //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
	    mysqli_query($koneksi,$sql) or die(mysqli_error());
		echo "<script>location='index.php?transtempprm=$notrans'</script>";
	}
    else
    {
    	echo "<script>alert('MEMBER BELUM DIVERIFIKASI');location='index.php?transtempprm=$notrans'</script>";
    }
}
else
{
echo "<script>alert('DATA MEMBER TIDAK DITEMUKAN');location='index.php?transtempprm=$notrans'</script>";
}


ob_flush();
?>