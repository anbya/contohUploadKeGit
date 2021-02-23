<?php
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$akun = $_POST['input1'];
$password = $_POST['input2'];
		$cari=mysql_query("select * from member where telepon='$akun' OR email='$akun' ");
		$ketemucari=mysql_num_rows($cari);
		$tampilcari=mysql_fetch_array($cari);
		$idakun=$tampilcari['id_member'];
		if ($ketemucari > 0)
		{
			$login=mysql_query("select * from member where id_member='$idakun' and password='$password' ");
			$ketemu=mysql_num_rows($login);
			$tampil=mysql_fetch_array($login);
	
			//ada user
			if ($ketemu > 0)
			{	
					session_start();
					$_SESSION['id'] = $tampil['id_member'];
	  				header('location:memberarea.php');
			}
			else
			{
				echo "<script>alert('Username dan password salah');location='index.php'</script>";
			}
		}
		else
		{
			echo "<script>alert('Akun Anda Tidak Ditemukan');location='index.php'</script>";
		}
?>
