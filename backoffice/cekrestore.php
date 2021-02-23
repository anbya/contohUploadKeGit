<?php
ob_start();
session_start();
include "koneksi.php";
if($_POST['upload']){
$terminal = $_FILES['file']['name'];
$file_tmp = $_FILES['file']['tmp_name'];
$cekterminal=mysqli_query($koneksi,"SELECT * FROM data_import where terminal_id = '$terminal'");
$rcekterminal= mysqli_num_rows($cekterminal);
$hcekterminal = mysqli_fetch_array($cekterminal);
if($rcekterminal>0)
{
echo "<script>alert('data sudah pernah diimport');location='importsales.php'</script>";
ob_flush();
}
else
{
move_uploaded_file($file_tmp, 'file/'.$terminal);
echo "<script>location='restore.php?terminal=$terminal'</script>";
ob_flush();
}
}
?>