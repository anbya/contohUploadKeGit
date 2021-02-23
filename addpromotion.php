<?php
/*CODE TANPA PENGGABUNGAN*/
ob_start();
include "koneksi.php";
$idtrans=$_GET["transtempprm"];
$bill=$_GET["bill"];
$idterminal=$_GET["idterminal"];
$idpromotion=$_GET["promotionid"];
$sql1=mysqli_query($koneksi,"SELECT * FROM promotion_h where id_promotion = '$idpromotion'");
$hsql1 = mysqli_fetch_array($sql1);
$sqlcekprmh=mysqli_query($koneksi,"SELECT * FROM pos_promotion_h where notrans = '$idtrans' AND id_promotion = '$idpromotion'");
$hsqlcekprmh = mysqli_fetch_array($sqlcekprmh);
$rsqlcekprmh = mysqli_num_rows($sqlcekprmh);
if($rsqlcekprmh>0)
{
echo "<script>alert('PROMO SUDAH ADA');location='index.php?transtempprm=$idtrans'</script>";
ob_flush();
}
else
{
$prmtype=$hsql1['promotion_type'];
$keyoutlet = mysqli_query($koneksi,"SELECT * FROM pos_parameter");
$hkeyoutlet = mysqli_fetch_array($keyoutlet);
if($prmtype=="DISC ALL")
	{
	$sql2=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$idtrans' AND bill = '$bill'");
	while($hsql2= mysqli_fetch_array($sql2))
		{
		$prmdisc=$hsql1['value_disc'];
		$prmdiscdesk=$hsql1['promotion_name'];
		$prmkditem=$hsql2['kditem'];
		$prmsquence=$hsql2['squence'];
		$itemtempdisc=$hsql2['subtotal']-$hsql2['disc'];
		$disc=ceil($itemtempdisc*$prmdisc/100);
		$discitemtemp=$hsql2['disc'];
		$totaldisc=$discitemtemp+$disc;
		$gpitemtemp=$hsql2['subtotal']-$totaldisc;
		$insertpromotiond="INSERT INTO pos_promotion_d values('$idtrans','$idpromotion','$prmtype','1','$bill','$prmkditem','$prmsquence','$disc','$idterminal','UNPAID','$hkeyoutlet[id_outlet]')";
		mysqli_query($koneksi,$insertpromotiond) or die(mysqli_error());
		$updatepossalestemp="UPDATE pos_itemtemp SET disc = '$totaldisc', grandprice = '$gpitemtemp' WHERE transtemp = '$idtrans' AND kditem = '$prmkditem' ";
		mysqli_query($koneksi,$updatepossalestemp) or die(mysqli_error());
		/** UPDATED possalestemp **/
		}
	$sql3=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$idtrans'");
	$hsql3= mysqli_fetch_array($sql3);
	$sql4=mysqli_query($koneksi,"SELECT SUM(disc) as grand_disc FROM pos_promotion_d where transtemp = '$idtrans' and id_promotion = '$idpromotion' ");
	$hsql4= mysqli_fetch_array($sql4);
	$prmdisch=$hsql1['value_disc'];
	$dischx=$hsql4['grand_disc'];
	$disch=$hsql3['disc']+$dischx;
	$nettsales=$hsql3['gross_sales']-$dischx;
	$discdesk=$hsql1['promotion_name'];
	$insertpromotionh="INSERT INTO pos_promotion_h values('$idtrans','$idpromotion','$prmtype','$bill','$dischx','$discdesk','$idterminal','UNPAID','$hkeyoutlet[id_outlet]')";
	mysqli_query($koneksi,$insertpromotionh) or die(mysqli_error());
	/** UPDATED possalestemp **/
	$updatepossalestemp="UPDATE pos_salestemp SET disc = '$disch' WHERE notrans = '$idtrans' ";
	mysqli_query($koneksi,$updatepossalestemp) or die(mysqli_error());
	/** **/
	}
elseif($prmtype=="DISC ITEM")
	{
	$sql2=mysqli_query($koneksi,"SELECT * FROM pos_itemtemp where transtemp = '$idtrans' AND bill = '$bill'");
	while($hsql2= mysqli_fetch_array($sql2))
		{
		$prmdisc=$hsql1['value_disc'];
		$prmdiscdesk=$hsql1['promotion_name'];
		$prmkditem=$hsql2['kditem'];
		$prmsquence=$hsql2['squence'];
		$itemtempdisc=$hsql2['subtotal']-$hsql2['disc'];
		$disc=ceil($itemtempdisc*$prmdisc/100);
		$discitemtemp=$hsql2['disc'];
		$totaldisc=$discitemtemp+$disc;
		$gpitemtemp=$hsql2['subtotal']-$totaldisc;
		$sqlcekitemtemp=mysqli_query($koneksi,"SELECT * FROM promotion_d where id_promotion = '$idpromotion' AND kditem = '$prmkditem'");
		$rsqlcekitemtemp= mysqli_fetch_array($sqlcekitemtemp);
		if(!empty($rsqlcekitemtemp))
		{
		$insertpromotiond="INSERT INTO pos_promotion_d values('$idtrans','$idpromotion','$prmtype','1','$bill','$prmkditem','$prmsquence','$disc','$idterminal','UNPAID','$hkeyoutlet[id_outlet]')";
		mysqli_query($koneksi,$insertpromotiond) or die(mysqli_error());
		$updatepossalestemp="UPDATE pos_itemtemp SET disc = '$totaldisc', grandprice = '$gpitemtemp' WHERE transtemp = '$idtrans' AND kditem = '$prmkditem'";
		mysqli_query($koneksi,$updatepossalestemp) or die(mysqli_error());
		}
		/** UPDATED possalestemp **/
		}
	$sql3=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$idtrans'");
	$hsql3= mysqli_fetch_array($sql3);
	$sql4=mysqli_query($koneksi,"SELECT SUM(disc) as grand_disc FROM pos_promotion_d where transtemp = '$idtrans' and id_promotion = '$idpromotion' ");
	$hsql4= mysqli_fetch_array($sql4);
	$prmdisch=$hsql1['value_disc'];
	$dischx=$hsql4['grand_disc'];
	$disch=$hsql3['disc']+$dischx;
	$nettsales=$hsql3['gross_sales']-$dischx;
	$discdesk=$hsql1['promotion_name'];
	$cekpromotiond=mysqli_query($koneksi,"SELECT * FROM pos_promotion_d where id_promotion = '$idpromotion' AND transtemp = '$idtrans'");
	$rcekpromotiond= mysqli_fetch_array($cekpromotiond);
	if(!empty($rcekpromotiond))
	{
	$insertpromotionh="INSERT INTO pos_promotion_h values('$idtrans','$idpromotion','$prmtype','$bill','$dischx','$discdesk','$idterminal','UNPAID','$hkeyoutlet[id_outlet]')";
	mysqli_query($koneksi,$insertpromotionh) or die(mysqli_error());
	/** UPDATED possalestemp **/
	$updatepossalestemp="UPDATE pos_salestemp SET disc = '$disch' WHERE notrans = '$idtrans' ";
	mysqli_query($koneksi,$updatepossalestemp) or die(mysqli_error());
	/** **/
	}
	}
elseif($prmtype=="POTONGAN HARGA")
	{
	$sql3=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where notrans = '$idtrans'");
	$hsql3= mysqli_fetch_array($sql3);
	$dischx=$hsql1['value_amount'];
	$disch=$hsql3['disc']+$dischx;
	$nettsales=$hsql3['gross_sales']-$dischx;
	$discdesk=$hsql1['promotion_name'];
	$insertpromotionh="INSERT INTO pos_promotion_h values('$idtrans','$idpromotion','$prmtype','$bill','$dischx','$discdesk','$idterminal','UNPAID','$hkeyoutlet[id_outlet]')";
	mysqli_query($koneksi,$insertpromotionh) or die(mysqli_error());
	/** UPDATED possalestemp **/
	$updatepossalestemp="UPDATE pos_salestemp SET disc = '$disch', nett_sales = '$nettsales' WHERE notrans = '$idtrans' ";
	mysqli_query($koneksi,$updatepossalestemp) or die(mysqli_error());
	/** **/
	}
echo "<script>location='index.php?transtempprm=$idtrans&bill=$bill'</script>";
ob_flush();
}
?>
