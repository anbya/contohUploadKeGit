<?php
$nama=$_POST['nama'];
if(empty($nama))
{
session_start();
$_SESSION['pos']=$_POST;
echo "<script>location='test.php'</script>";
}
?>