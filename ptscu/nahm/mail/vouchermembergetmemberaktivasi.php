<?php
ob_start();
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

// Konfigurasi SMTP
$mail->isSMTP();
$mail->Host = 'mail.ptscu.net';
$mail->SMTPAuth = true;
$mail->Username = 'it.support@ptscu.net';
$mail->Password = 'wsx741852963';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('it.support@ptscu.net', 'NAHMCRM');
$mail->addReplyTo('no-reply', 'NAHMCRM');

// Menambahkan penerima
include "../koneksi.php";
$ref=$_GET['REF'];
$vcr=$_GET['VCR'];
$idaktivasi=$_GET['ID'];
$voucher=mysql_query("SELECT * FROM voucher where id_voucher = '$vcr'");
$hvoucher = mysql_fetch_array($voucher);
$mem=mysql_query("SELECT * FROM member where id_member = '$ref' ");
$hmem = mysql_fetch_array($mem);
$nama=$hmem['nama_member'];
$alamat=$hmem['email'];
$mail->addAddress($alamat);

// Menambahkan beberapa penerima
//$mail->addAddress('asep@ptscu.net');
//$mail->addAddress('penerima3@contoh.com');

// Menambahkan cc atau bcc 
//$mail->addCC('cc@contoh.com');
//$mail->addBCC('bcc@contoh.com');

// Subjek email
$mail->Subject = 'MEMBER GET MEMBER VOUCHER';

// Mengatur format email ke HTML
$mail->isHTML(true);

// Konten/isi email
$mailContent = "

<table class='m_-9057779228787602403outer' align='center' style='border-spacing:0;font-family:sans-serif;color:#333333;Margin:0 auto;width:100%;max-width:600px'>
<tbody>
<tr>
<td class='m_-9057779228787602403contents'>
<a target='_blank'><img src='http://ptscu.net/abc.jpg' align='absbottom' style='display:block;width:100%;height:auto;margin-left: auto;margin-right: auto;'>
</a>
</td>
</tr>
<tr>
<td class='m_-9057779228787602403one-column' style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0'>
<table width='100%' border='0' style='border-spacing:0;font-family:sans-serif;color:#333333;'>
<tbody>
<tr>
<td class='m_-9057779228787602403one-column' style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0'>
<table width='100%' style='border-spacing:0;font-family:sans-serif;color:#333333'>
<tbody>
<tr>
<td class='m_-9057779228787602403inner m_-9057779228787602403contents' style='padding-top:10px;padding-bottom:10px;padding-right:20px;padding-left:20px;width:100%;text-align:left;color:#333333;font-size:20px'>
<p style='color:#333333;font-size:20px;font-weight:600'>Selamat, ".$nama."!</p>
</b>
<p style='margin-top:10px'>
".$hvoucher['deskripsi']."
<br><br>
Sebagai wujud apresiasi, kamu berhak mendapatkan voucher ".$hvoucher['nama_voucher'].".
<br><br>Gunakan voucher berikut saat melakukan transaksi di NAHM THAI SUKI & BBQ.</p>
</div>
<div style='padding:0 20px'>
<div style='text-align:center;margin:20px;padding:0' align='center'>
<div style='display:inline-block;color:#000;background-color:#fff;padding:10px'>
<div style='padding-bottom:5px'>Kode Voucher</div>
<img src='https://chart.googleapis.com/chart?chs=250x250&amp;cht=qr&amp;chl=".$hvoucher['id_voucher']."' />
<div style='font-size:12px;color:#999;padding-top:8px'>Kadaluarsa: ".$hvoucher['exp']."</div>
</div>
</div>
</div>
<div style='padding:0 20px'>
<div style='color:#505050'>
<p style='margin-bottom:0px'>Syarat dan Ketentuan:
<br>
<ul style='margin-top:0px'>
<li>Periode promo: xx-xx xxxxxxxxx xxxx.</li>
<li>Kode promo berlaku hingga 7 hari, terhitung sejak pengguna menerima email ini.</li>
<li>Syarat dan ketentuan dapat berubah sewaktu-waktu dan tidak dapat diganggu gugat.</li>
</ul>
</p>

</td>
</tr>


<tr><td align='center' style='padding-top:10px;padding-bottom:20px;padding-right:10px;padding-left:10px;background:#ffffff;'><table border='0' cellspacing='0' cellpadding='0'><tbody><tr><td align='center'>


<tr><td class='m_-9057779228787602403two-column' style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;font-size:0;background:#f7f7f7'>

<div class='m_-9057779228787602403column' style='width:100%;max-width:300px;display:inline-block;vertical-align:top'><table width='100%' style='border-spacing:0;font-family:sans-serif;color:#333333'>

<tbody><tr><td class='m_-9057779228787602403inner' style='padding-top:20px;padding-bottom:20px;padding-right:20px;padding-left:20px'>

<table class='m_-9057779228787602403contents' style='border-spacing:0;font-family:sans-serif;width:100%;font-size:14px;text-align:center;color:#333333'>

<tbody>
<tr>
<td style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0'>
<p style='font-family:arial,sans-serif;font-size:11px;Margin:0;Margin-bottom:10px'>Ikuti Kami</p>

<a href='#blank' style='border-radius:3px;color:#ee6a56;text-decoration:underline' target='_blank' ><img src='https://ci6.googleusercontent.com/proxy/hpkmiDtehvMUkzI6NQ6XxbIyirGT45tdKbdIzboposYocCcs_dWmXX3aNbXt8ROnlJvo8CA6LphY5vLGZcKuOk02xDtOMbqED9SbOrrgqeUuIgxqlnlAtza2iLFy=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/300452016/11/1480307762.png' alt='Facebook' width='25' style='border-width:0;border-radius:90%;max-width:25px'></a>

<a href='#blank' style='border-radius:3px;color:#ee6a56;text-decoration:underline' target='_blank' ><img src='https://ci3.googleusercontent.com/proxy/GIsQ666UaY-N1YHMNhXRYjUTObALsZDyqQ51u2t8uFNXI1TlYtWJ4-1fQrLdutgnyNgM9qu43Ang9jKuZ38oUrCBsSD4YPslXDPvP6scSXyIJmyQ6VTB2c0aGVlw=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/300452016/11/1480307869.png' alt='Twitter' width='25' style='border-width:0;border-radius:90%;max-width:25px'></a>

<a href='#blank' style='border-radius:3px;color:#ee6a56;text-decoration:underline' target='_blank' ><img src='https://ci4.googleusercontent.com/proxy/JOX0gbWvJ4vDUCHPWyne4LMiRgkAfgnuTnWfu68HnovFepHvdjChQ7hrOSwMbKA53IPW0Xd3XS1I-Q8amoGXRxNvRMDCnO4GVAH2coMKT0cn2QMu6FMiENJXzfMM=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/300452016/11/1480307832.png' alt='Instagram' width='25' style='border-width:0;border-radius:90%;max-width:25px'>
</a>

</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>

<tr>
<td class='m_-9057779228787602403inner m_-9057779228787602403contents' align='left' style='color:#a9a9a9;font-family:arial;font-size:10px;padding-top:0;padding-bottom:20px;padding-right:20px;padding-left:20px;width:100%;text-align:center;width:600px'>
Copyright SCU IT DEPARTMENT 2018
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

";
$mail->Body = $mailContent;

// Menambahakn lampiran
//$mail->addAttachment('lmp/file1.pdf');
//$mail->addAttachment('lmp/file2.png', 'nama-baru-file2.png'); //atur nama baru

// Kirim email
if(!$mail->send()){
	echo 'Pesan tidak dapat dikirim.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    echo "<script>location='../detailaktivasi.php?ID=$idaktivasi'</script>";
}
ob_flush();