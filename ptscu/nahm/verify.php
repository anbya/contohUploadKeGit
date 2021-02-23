<?php
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$username = $_POST['id'];
$password = $_POST['pass'];
	if (empty($password) || empty($username))
	{
		echo "<script>alert('isi semua field');location='login.php'</script>";
	}
	else
	{
		if (!ctype_alnum($username) OR !ctype_alnum($password))
		{
			echo "<script>alert('anda memasukan karakter yang salah');location='login.php'</script>";
		}
		else
		{
			$login=mysql_query("select * from user where id_user='$username' and pass_user='$password' ");
			$ketemu=mysql_num_rows($login);
			$tampil=mysql_fetch_array($login);
	
			//ada user
			if ($ketemu > 0)
			{	
					session_start();
					$_SESSION['namauser'] = $tampil['nama_user'];
					$_SESSION['previlage'] = $tampil['previlage'];
					$_SESSION['outlet'] = $tampil['outlet'];
	  				header('location:index.php');
			}
			else
			{
				echo "<script>alert('Username dan password salah');location='login.php'</script>";
			}
		}
	}
?>
