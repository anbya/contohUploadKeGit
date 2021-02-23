<?php
$ftp_server="nahmthaisukibbq.com";
$ftp_user_name="backup";
$ftp_user_pass="qaz741852963";
$file = "../closedaydata/".$_GET['terminal'];//tobe uploaded
$remote_file = "uploaddataisoide/".$_GET['terminal'];

// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// upload a file
if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
   echo "<script>alert('TERMINAL BERHASIL DITUTUP');location='../keluar.php'</script>";
   exit;
} else {
   echo "<script>alert('TERMINAL BERHASIL DITUTUP NAMUN GAGAL MENGIRIM DATA KE SERVER');location='../keluar.php'</script>";
   exit;
   }
// close the connection
ftp_close($conn_id);
?>