<?php
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$password = $_POST['txt1'];
	if (empty($password))
	{
		echo "<script>alert('SILAHKAN MASUKAN PASSCODE');location='login.php'</script>";
	}
	else
	{
		$login=mysqli_query($koneksi,"select * from user where pass_user='$password'");
		$ketemu=mysqli_num_rows($login);
		$tampil=mysqli_fetch_array($login);
		if ($ketemu > 0)
		{	
			session_start();
			$_SESSION['namausernahmposorder'] = $tampil['nama_user'];
			$_SESSION['iduserorder'] = $tampil['id_user'];
			$_SESSION['previlageorder'] = $tampil['previlage'];
			$notrans=$tampil['id_user'];
	  		header('location:index.php');
		}
		else
		{
			echo "<script>alert('PASSCODE TIDAK DIKENALI');location='login.php'</script>";
		}
	}
?>
