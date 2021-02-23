<?php
ob_start();
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$idmember=$_POST["input1"];
$ceksts=mysql_query("select * from member where id_member='$idmember'");
$tampilceksts=mysql_fetch_array($ceksts);
$sts=$tampilceksts['statusmembership'];
if ($sts == "NOT VERIFIED")
{
  $cekprm=mysql_query("select * from promo where id_promo='PRM000001'");
  $tampilprm=mysql_fetch_array($cekprm);
  $isiprm=$tampilprm['isi_promo'];
  $deskprm=$tampilprm['deskripsi_promo'];
  if ($tampilprm['status_promo'] == "ON")
  {
    $cari=mysql_query("select * from member WHERE id_member = '$idmember'");
    $tampil=mysql_fetch_array($cari);
    $dataref=$tampil['referal'];
    $caria=mysql_query("select * from member where telepon='$dataref' OR email='$dataref' ");
    $ketemua=mysql_num_rows($caria);
    $tampila=mysql_fetch_array($caria);
    $idref=$tampila['id_member'];
    if ($idref == "")
    {
    $sql="UPDATE member SET statusmembership = 'VERIFIED' WHERE id_member = '$idmember'";
    mysql_query($sql) or die(mysql_error()); 
    header("Location:detailaktivasi.php?ID=$idmember");
    }
    else
    {
    $sql="UPDATE member SET statusmembership = 'VERIFIED' WHERE id_member = '$idmember'";
    mysql_query($sql) or die(mysql_error()); 
    header("Location:addvoucheraktivasi.php?REF=$idref&PRM=$isiprm&DSK=$deskprm&ID=$idmember");
    }
  }
  elseif ($tampilprm['status_promo'] == "OFF")
  {
    $sql="UPDATE member SET statusmembership = 'VERIFIED' WHERE id_member = '$idmember'";
    mysql_query($sql) or die(mysql_error()); 
    header("Location:detailaktivasi.php?ID=$idmember");
  }
}
else
{
    header("Location:teraktivasi.php?ID=$idmember");
}


ob_flush();
?>