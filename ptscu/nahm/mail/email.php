<?php
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
$id=$_GET['ID'];
$mem=mysql_query("SELECT * FROM member where id_member = '$id'");
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
$mail->Subject = 'Kirim Email via SMTP Server di PHP menggunakan PHPMailer';

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
<tr><td class='m_-9057779228787602403one-column' style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0'><table width='100%' border='0' style='border-spacing:0;font-family:sans-serif;color:#333333;background:#ffffff'><tbody><tr><td class='m_-9057779228787602403one-column' style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0'><table width='100%' style='border-spacing:0;font-family:sans-serif;color:#333333'><tbody><tr><td class='m_-9057779228787602403inner m_-9057779228787602403contents' style='background-color:#ffffff;padding-top:10px;padding-bottom:10px;padding-right:20px;padding-left:20px;width:100%;text-align:left;color:#333333;font-size:20px'><p style='color:#333333;font-size:20px;font-weight:600'>Dear, ".$nama."</p><p style='font-size:15px;line-height:1.8em'>Silahkan klik link aktivasi dibawah untuk memverifikasi email kamu
</p></td></tr>


<tr><td align='center' style='padding-top:10px;padding-bottom:20px;padding-right:10px;padding-left:10px;background:#ffffff'><table border='0' cellspacing='0' cellpadding='0'><tbody><tr><td align='center'>

<a href='http://ptscu.net/nahm/aktivasi.php?ID=".$id."' style='font-size:20px;font-family:Arial,sans-serif;font-weight:bold;color:#ffffff;text-decoration:none;border-radius:3px;background-color:#6c0000;border-top:12px solid #6c0000;border-bottom:12px solid #6c0000;border-right:20px solid #6c0000;border-left:20px solid #6c0000;display:inline-block' target='_blank'>AKTIVASI</a>




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
</table>";
$mail->Body = $mailContent;

// Menambahakn lampiran
//$mail->addAttachment('lmp/file1.pdf');
//$mail->addAttachment('lmp/file2.png', 'nama-baru-file2.png'); //atur nama baru

// Kirim email
if(!$mail->send()){
	echo 'Pesan tidak dapat dikirim.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    echo "<script>alert('berhasil mengirim pesan aktivasi akun member');location='../member.php'</script>";
}