<?php
ob_start();
error_reporting(0);
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$id=$_POST['input1'];
$card=$_POST['input2'];
$mem=mysql_query("SELECT * FROM member where telepon='$id' OR email='$id'");
$hmem = mysql_fetch_array($mem);
$rmem=mysql_num_rows($mem);
$idmember=$hmem['id_member'];
$ref=$hmem['referal'];
$nama=$hmem['nama_member'];
$alamat=$hmem['email'];
$status=$hmem['statusmembership'];
if ($rmem > 0)
{
      $ceksts=mysql_query("select * from member where id_member='$idmember'");
      $tampilceksts=mysql_fetch_array($ceksts);
      $sts=$tampilceksts['statusmembership'];
      if ($sts == "NOT VERIFIED")
      {
        $cekprm=mysql_query("select * from promo where id_promo='PRM000001'");
        $tampilprm=mysql_fetch_array($cekprm);
        $idprm=$tampilprm['id_promo'];
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
          if ($ref == "")
          {
          $sql="UPDATE member SET statusmembership = 'VERIFIED', no_kartu = '$card' WHERE id_member = '$idmember'";
          mysql_query($sql) or die(mysql_error()); 
          header("Location:aktivasi.php?ID=$idmember");
          }
          else
          {
          $sql="UPDATE member SET statusmembership = 'VERIFIED', no_kartu = '$card' WHERE id_member = '$idmember'";
          mysql_query($sql) or die(mysql_error()); 
          header("Location:addvoucheraktivasi.php?REF=$idref&PRM=$isiprm&DSK=$deskprm&ID=$idmember&idprm=$idprm");
          }
        }
        elseif ($tampilprm['status_promo'] == "OFF")
        {
          $sql="UPDATE member SET statusmembership = 'VERIFIED', no_kartu = '$card' WHERE id_member = '$idmember'";
          mysql_query($sql) or die(mysql_error()); 
          header("Location:aktivasi.php?ID=$idmember");
        }
      }
      else
      {
          header("Location:aktivasi.php?ID=$idmember");
      }
}
else
                        {
                        session_start();
                        $_SESSION['pos']=$_POST;
                        echo "<script>alert('nomor telepon atau email yang anda Input tidak Ditemukan');location='activationpage.php'</script>"; 
                        }
ob_flush();
?>