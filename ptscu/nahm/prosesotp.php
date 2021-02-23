<?php
ob_start();
error_reporting(0);
include "koneksi.php";
$tanggal= mktime(date("m"),date("d"),date("Y"));
$jam=date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$otp=$_POST["input1"];
$idv=$_POST["inputx"];
        $cekotp=mysql_query("SELECT * FROM otentikasi where id_voucher = '$idv' AND otp = '$otp' ");
        $hcekotp= mysql_fetch_array($cekotp);
        $rcekotp = mysql_num_rows($cekotp);
        if ($rcekotp > 0)
        {
        header("Location:prosesredeemotp.php?IDV=$idv");
        }
        else
        {
        header("Location:cekotp.php?IDV=$idv");
        }

ob_flush();?>