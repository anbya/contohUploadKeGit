<?php
ob_start();
session_start();
include "koneksi.php";
$transtempprm=$_GET["transtempprm"];
$promotionid=$_GET["promotionid"];
$bill=$_GET["bill"];
	$sql1=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$transtempprm'");
	$hsql1= mysqli_fetch_array($sql1);
	$sql2=mysqli_query($koneksi,"SELECT * FROM pos_promotion_h where notrans = '$transtempprm' AND id_promotion = '$promotionid'");
	$hsql2= mysqli_fetch_array($sql2);
	$dischx=$hsql2['disc'];
	$disch=$hsql1['disc']-$dischx;
	$nettsales=$hsql1['nett_sales']+$dischx;
	/** UPDATED possalestemp **/
	$updatepossalestemp="UPDATE pos_salestemp SET disc = '$disch' WHERE notrans = '$transtempprm' ";
	mysqli_query($koneksi,$updatepossalestemp) or die(mysqli_error());
	/** **/
	$sql3=mysqli_query($koneksi,"SELECT * FROM pos_promotion_d where transtemp = '$transtempprm' AND id_promotion = '$promotionid'");
	while($hsql3= mysqli_fetch_array($sql3))
	{
	$keyitemtemp=$hsql3['kditem'];
	$keyisquance=$hsql3['squence'];
	$sql4=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$transtempprm' AND kditem = '$keyitemtemp' AND squence = '$keyisquance' ");
	$hsql4= mysqli_fetch_array($sql4);
	$discawal=$hsql4['disc'];
	$discprmd=$hsql3['disc'];
	$discakhir=$discawal-$discprmd;
	$gpakhir=$hsql4['grandprice']+$discprmd;
	$updatepositemtemp="UPDATE pos_itemtemp SET disc = '$discakhir', grandprice = '$gpakhir' WHERE transtemp = '$transtempprm' AND kditem = '$keyitemtemp' AND squence = '$keyisquance' ";
	mysqli_query($koneksi,$updatepositemtemp) or die(mysqli_error());
	}
mysqli_query($koneksi,"delete from pos_promotion_h where notrans = '$transtempprm' AND id_promotion = '$promotionid' AND bill = '$bill'");
mysqli_query($koneksi,"delete from pos_promotion_d where transtemp = '$transtempprm' AND id_promotion = '$promotionid' AND bill = '$bill'");
echo "<script>location='index.php?transtempprm=$transtempprm&bill=$bill'</script>";
ob_flush();
?>
