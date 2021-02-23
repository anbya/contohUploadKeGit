<?php
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$nama=$_POST["input1"];
$alamat=$_POST["input2"];
$email=$_POST["input3"];
$telepon=$_POST["input4"];
$referal=$_POST["input5"];
$pass=$_POST["input6"];
$tahun=$_POST["tahun"];
$bulan=$_POST["bulan"];
$tgl=$_POST["tgl"];
$tanggallahir=$tahun."-".$bulan."-".$tgl;
$gender=$_POST["gender"];
$cari=mysql_query("select * from member where telepon='$telepon' OR email='$email' ");
$ketemu=mysql_num_rows($cari);
$tampil=mysql_fetch_array($cari);
if ($ketemu > 0)
{
session_start();
$_SESSION['pos']=$_POST;
$_session['validasi']="FALSE";
echo "<script>alert('nomor telepon atau email yang anda daftarkan sudah terdaftar');location='daftar.php'</script>";
}
else
{

			$idgol=mysql_query("SELECT * FROM member ORDER BY id_member desc");
	          $hidgol = mysql_fetch_array($idgol);
	          $rowgol = mysql_num_rows($idgol);
	          $nomatx1=substr($hidgol['id_member'],3);
	          $nomatx2=intval($nomatx1);
	          $nomatx3=$nomatx2+1;
	          if ($rowgol > 0)
	          {
	              if ($nomatx3>=0 && $nomatx3<=9)
	              {
	              $nomat='NHM00000'.$nomatx3;
	              }
	              elseif ($nomatx3>9 && $nomatx3<=99)
	              {
	              $nomat='NHM0000'.$nomatx3;
	              }
	              elseif ($nomatx3>99 && $nomatx3<=999)
	              {
	              $nomat='NHM000'.$nomatx3;
	              }
	              elseif ($nomatx3>999 && $nomatx3<=9999)
	              {
	              $nomat='NHM00'.$nomatx3;
	              }
	              elseif ($nomatx3>9999 && $nomatx3<=99999)
	              {
	              $nomat='NHM0'.$nomatx3;
	              }
	              elseif ($nomatx3>99999 && $nomatx3<=999999)
	              {
	              $nomat='NHM'.$nomatx3;
	              }
	          }
	          else
	          {
	            $nomat='NHM000001';
	          }

	if (empty($referal))
	{
		$sql="INSERT INTO member values('$nomat','$nama','$tanggallahir','$gender','$alamat','$telepon','$email','','','0','$pass','NOT VERIFIED')";
		mysql_query($sql) or die(mysql_error());
		echo "<script>alert('akun anda berhasil di daftarkan, silahkan login untuk mendapatkan kode aktivasi');location='index.php'</script>";
	}
	else
	{
		$cekprm=mysql_query("select * from promo where id_promo='PRM000001'");
		$tampilprm=mysql_fetch_array($cekprm);
		if ($tampilprm['status_promo'] == "ON")
		{
			$cekref=mysql_query("select * from member where telepon='$referal' OR email='$referal' ");
			$ketemuref=mysql_num_rows($cekref);
			$tampilref=mysql_fetch_array($cekref);
			$idref=$tampilref['id_member'];
			$isiprm=$tampilprm['isi_promo'];
			$deskprm=$tampilprm['deskripsi_promo'];
			if ($ketemuref > 0)
				{	
				$sql="INSERT INTO member values('$nomat','$nama','$tanggallahir','$gender','$alamat','$telepon','$email','$referal','','0','$pass','NOT VERIFIED')";
				mysql_query($sql) or die(mysql_error());
				echo "<script>alert('akun anda berhasil di daftarkan, silahkan login untuk mendapatkan kode aktivasi');location='index.php'</script>";
				}
			else
				{
					session_start();
					$_SESSION['pos']=$_POST;
					$_session['validasi']="FALSE";
					echo "<script>alert('data referral tidak ditemukan');location='daftar.php'</script>";
				}
		}
		elseif ($tampilprm['status_promo'] == "OFF")
		{
			$sql="INSERT INTO member values('$nomat','$nama','$tanggallahir','$gender','$alamat','$telepon','$email','$referal','','0','$pass','NOT VERIFIED')";
			mysql_query($sql) or die(mysql_error());
			echo "<script>alert('akun anda berhasil di daftarkan, silahkan login untuk mendapatkan kode aktivasi');location='index.php'</script>";
		}
	}
}
?>