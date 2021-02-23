<?php
ob_start();
include "koneksi.php";
$prmnote=$_POST["prmnote"];
$iditemnote=$_POST["iditemnote"];
$squancenote=$_POST["squancenote"];
$note=$_POST["note"];
$subcat=$_POST["subcat"];
$sql="UPDATE pos_itemtemp SET note = '$note' WHERE transtemp = '$prmnote' AND kditem = '$iditemnote' AND squence = '$squancenote' ";
mysqli_query($koneksi,$sql) or die(mysqli_error());
echo "<script>location='tambahitem.php?transtempprm=$prmnote&subcat=$subcat'</script>";
ob_flush();
?>