<?php

header("Content-type:application/json");

//koneksi ke database
$connection = mysqli_connect("localhost", "root", "", "masterisoidepos") or die("Error " . mysqli_error($connection));

//menampilkan data dari database, table tb_anggota
mysqli_set_charset($connection, 'utf8');
//if(empty($_GET['keyparameter']))
//{
$sql = "select * from user ";
//}
//else
//{
//$sql = "select * from member where id_member = '$_GET[keyparameter]'";
//}
$result = mysqli_query($connection, $sql) or die("Error " . mysqli_error($connection));
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}

echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);

//tutup koneksi ke database
mysqli_close($connection);
?>