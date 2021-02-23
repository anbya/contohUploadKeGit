<?php
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$idmember=$_POST["inputx"];
$namamember=$_POST["input1"];
$telepon=$_POST["input2"];
$email=$_POST["input3"];
$referral=$_POST["input4"];
$card=$_POST["input5"];
$cari=mysql_query("select * from member where telepon='$telepon' OR email='$email' ");
$ketemu=mysql_num_rows($cari);
$tampil=mysql_fetch_array($cari);
if ($ketemu > 0)
{
echo "<script>alert('nomor telepon atau email yang anda daftarkan sudah terdaftar');location='tambahmember.php'</script>";
}
else
{
if (empty($referral))
{
	$sql="INSERT INTO member values('$idmember','$namamember','$telepon','$email','$referral','$card','VERIFIED')";
	mysql_query($sql) or die(mysql_error());
	echo "<script>alert('berhasil mendaftarkan member');location='member.php'</script>";
}
else
{
	$cekprm=mysql_query("select * from promo where id_promo='PRM000001'");
	$tampilprm=mysql_fetch_array($cekprm);
	if ($tampilprm['status_promo'] == "ON")
	{
		$cekref=mysql_query("select * from member where telepon='$referral' OR email='$referral' ");
		$ketemuref=mysql_num_rows($cekref);
		$tampilref=mysql_fetch_array($cekref);
		$idref=$tampilref['id_member'];
		$isiprm=$tampilprm['isi_promo'];
		$deskprm=$tampilprm['deskripsi_promo'];
		if ($ketemuref > 0)
			{	
			$sql="INSERT INTO member values('$idmember','$namamember','$telepon','$email','$referral','$card','nahm123','VERIFIED')";
			mysql_query($sql) or die(mysql_error());
			header("Location:addvoucher.php?REF=$idref&PRM=$isiprm&DSK=$deskprm");
			}
		else
			{
				echo "<script>alert('data referral tidak ditemukan');location='tambahmember.php'</script>";
			}
	}
	elseif ($tampilprm['status_promo'] == "OFF")
	{
		$sql="INSERT INTO member values('$idmember','$namamember','$telepon','$email','$referral','$card','VERIFIED')";
		mysql_query($sql) or die(mysql_error());
		echo "<script>alert('berhasil mendaftarkan member');location='member.php'</script>";
	}
}
}
ob_flush();
?>