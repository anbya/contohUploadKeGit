<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>NAHM CRM SYSTEM</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-nav">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">
      <img src='http://ptscu.net/123.png' align='absbottom' style='display:block;width:100%;height:auto;margin-left: auto;margin-right: auto;'>
      </div>
      <div class="card-body">
      <table width="100%">
      <?php
      error_reporting(0);
      include "koneksi.php";
      $id=$_GET['ID'];
      $mem=mysql_query("SELECT * FROM member where id_member = '$id'");
      $hmem = mysql_fetch_array($mem);
      $nama=$hmem['nama_member'];
      $alamat=$hmem['email'];
      $status=$hmem['statusmembership'];
      if ($status == "NOT VERIFIED")
      {
      $sql="UPDATE member SET statusmembership = 'VERIFIED' WHERE id_member = '$id'";
      mysql_query($sql) or die(mysql_error());
      ?>
      <tr>
      <td>
      <h1 style="margin:0;font-size:16px;font-weight:bold;line-height:24px;color:rgba(0,0,0,0.70)">Halo <?php echo $nama;?></h1>
      </td>
      </tr>
      <tr>
      <td>
      <p style="margin:0;font-size:16px;line-height:24px;color:rgba(0,0,0,0.70)">Selamat, Akun anda telah berhasil di aktivasi</p>
      </td>
      </tr>

      <tr>
      <td>
      </br>
      </td>
      </tr>
      <?php
      }
      else
      {
      ?>
      <tr>
      <td>
      <h1 style="margin:0;font-size:16px;font-weight:bold;line-height:24px;color:rgba(0,0,0,0.70)">Halo <?php echo $nama;?></h1>
      </td>
      </tr>
      <tr>
      <td>
      <p style="margin:0;font-size:16px;line-height:24px;color:rgba(0,0,0,0.70)">Akun anda telah di Aktivasi</p>
      </td>
      </tr>

      <tr>
      <td>
      </br>
      </td>
      </tr>
      <?php
      }
      ?>
      <tr style="text-align: center;">
      <td style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0'>
      <h1 style="margin:0;font-size:16px;font-weight:bold;line-height:24px;color:rgba(0,0,0,0.70)">Ikuti Kami</h1>
      </td>
      </tr>

      <tr>
      <td>
      </br>
      </td>
      </tr>

      <tr style="text-align: center;">
      <td style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0'>
      <a href='#blank' style='border-radius:3px;color:#ee6a56;text-decoration:underline' target='_blank' ><img src='https://ci6.googleusercontent.com/proxy/hpkmiDtehvMUkzI6NQ6XxbIyirGT45tdKbdIzboposYocCcs_dWmXX3aNbXt8ROnlJvo8CA6LphY5vLGZcKuOk02xDtOMbqED9SbOrrgqeUuIgxqlnlAtza2iLFy=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/300452016/11/1480307762.png' alt='Facebook' width='25' style='border-width:0;border-radius:90%;max-width:25px'></a>

      <a href='#blank' style='border-radius:3px;color:#ee6a56;text-decoration:underline' target='_blank' ><img src='https://ci3.googleusercontent.com/proxy/GIsQ666UaY-N1YHMNhXRYjUTObALsZDyqQ51u2t8uFNXI1TlYtWJ4-1fQrLdutgnyNgM9qu43Ang9jKuZ38oUrCBsSD4YPslXDPvP6scSXyIJmyQ6VTB2c0aGVlw=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/300452016/11/1480307869.png' alt='Twitter' width='25' style='border-width:0;border-radius:90%;max-width:25px'></a>

      <a href='#blank' style='border-radius:3px;color:#ee6a56;text-decoration:underline' target='_blank' ><img src='https://ci4.googleusercontent.com/proxy/JOX0gbWvJ4vDUCHPWyne4LMiRgkAfgnuTnWfu68HnovFepHvdjChQ7hrOSwMbKA53IPW0Xd3XS1I-Q8amoGXRxNvRMDCnO4GVAH2coMKT0cn2QMu6FMiENJXzfMM=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/300452016/11/1480307832.png' alt='Instagram' width='25' style='border-width:0;border-radius:90%;max-width:25px'>
      </a>

      </td>
      </tr>
      </table>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
