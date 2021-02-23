<html>
<head>
<link rel="shortcut icon" href="../favicon.ico">
<title>PT SANGGAR CATUR UTAMA</title>
<link rel="stylesheet" href="paper.css">
<style>
body
{
	font-family: "OMEGA CT";
    padding: 0px;
}
.badana4
{
	height: 5.82in;
	width: 8.26in;page-break-after:always;
}
h2
{
	font-size: 20px;
	font-weight: bold;
	color: #000000;
	text-align: center;
}
.border
{
	border: thin solid #000;
	vertical-align: top;
}
.borderangka
{
	border: thin solid #000;
	vertical-align: middle;
	text-align: right;
}
.borderheader
{
	border-top-width: thin;
	border-right-width: thin;
	border-left-width: thin;
	border-top-style: solid;
	border-right-style: solid;
	border-left-style: solid;
	border-top-color: #000;
	border-right-color: #000;
	border-left-color: #000;
}
.borderbadan
{
	border-right-width: thin;
	border-bottom-width: thin;
	border-left-width: thin;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-right-color: #000;
	border-bottom-color: #000;
	border-left-color: #000;
}
.borderbottom
{
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #000;
}
a
{
	font-size: 10px;
}
</style>

</head>
<body class="A5.landscape">
<?php
include "koneksi.php";
?>
<?php 
$tgl1=$_POST["input1"];
$tgl2=$_POST["input2"];
$profil=mysql_query("SELECT * FROM karyawan");
while($hprofil = mysql_fetch_array($profil)) 
{
?> 
<div>
<table width="98%" align="center">
<tr><td width="10%" height="0"></td><td width="20%"></td><td width="15%"></td><td width="20%"></td><td width="15%"></td></tr>
<tr><td height="30"><img src="../images/SCU.png" width="100%" style="margin-left: 50%;"></td><td colspan="3" align="center"><a style="font-size: 20px; font-weight: bold;">PT SANGGAR CATUR UTAMA</a><br><a style="font-size: 20px; font-weight: bold;">SLIP  GAJI BULAN JANUARI 2018</a></td><td></td></tr>
</table>

<table width="98%" align="center">
<tr><td width="30%" height="0"></td></td><td width="20%"></td><td width="30%"></td><td width="20%"></td></tr>
<tr style=" font-size: 15px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px;">NIP</td>
    <td colspan="3" style="border-style: solid; border-width: 1px; padding-left: 10px;">
    <?php
    echo $hprofil['nik'];
    ?>    
    </td>
</tr>
<tr style=" font-size: 15px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px;">NAMA</td>
    <td colspan="3" style="border-style: solid; border-width: 1px; padding-left: 10px;">
    <?php
    echo $hprofil['nama_karyawan'];
    ?>    
    </td>
</tr>
<tr style=" font-size: 15px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px;">GOLONGAN</td>
    <td colspan="3" style="border-style: solid; border-width: 1px; padding-left: 10px;">
    <?php
    echo $hprofil['nama_golongan'];
    ?>    
    </td>
</tr>
<tr style=" font-size: 15px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px;">JABATAN</td>
    <td colspan="3" style="border-style: solid; border-width: 1px; padding-left: 10px;">
    <?php
    echo $hprofil['nama_jabatan'];
    ?>    
    </td>
</tr>
<tr style=" font-size: 15px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px;">UNIT</td>
    <td colspan="3" style="border-style: solid; border-width: 1px; padding-left: 10px;">
    <?php
    echo $hprofil['unit'];
    ?>    
    </td>
</tr>
<tr style=" font-size: 15px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px;">STORE / SUB UNIT</td>
    <td colspan="3" style="border-style: solid; border-width: 1px; padding-left: 10px;">
    <?php
    echo $hprofil['sub_unit'];
    ?>    
    </td>
</tr>
<tr style=" font-size: 15px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px;">NO REKENING</td>
    <td colspan="3" style="border-style: solid; border-width: 1px; padding-left: 10px;">
    -
    </td>
</tr>
<tr style=" font-size: 15px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px;">BANK</td>
    <td colspan="3" style="border-style: solid; border-width: 1px; padding-left: 10px;">
    -   
    </td>
</tr>
<tr  height="20" style=" font-size: 13px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px; font-weight: bold; text-align: center;" colspan="2">A. UPAH</td>
    <td style="border-style: solid; border-width: 1px; padding-left: 10px; font-weight: bold; text-align: center;" colspan="2">B. POTONGAN</td>
</tr>
<tr style=" font-size: 13px;">
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">GAJI POKOK</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $gapok=mysql_query("SELECT * FROM golongan where golongan = '$hprofil[nama_golongan]' ");
    $hgapok = mysql_fetch_array($gapok);
    echo 'Rp. ' . number_format($hgapok['gaji_pokok'], 0 , '' , ',' );
    ?>   
    </td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">PAJAK (PPH21)</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $pajak=mysql_query("SELECT * FROM karyawan where nik = '$hprofil[nik]' ");
    $hpajak = mysql_fetch_array($pajak);
    echo 'Rp. ' . number_format($hpajak['pajak'], 0 , '' , ',' );
    ?>     
    </td>
</tr>
<tr style=" font-size: 13px;">
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">LEMBUR</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $lembur=mysql_query("SELECT * FROM karyawan where nik = '$hprofil[nik]' ");
    $hlembur = mysql_fetch_array($lembur);
    echo 'Rp. ' . number_format($hlembur['lembur'], 0 , '' , ',' );
    ?>  
    </td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">BPJS KETENAGAKERJAAN</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $bpjsket=mysql_query("SELECT * FROM karyawan where nik = '$hprofil[nik]' ");
    $hbpjsket = mysql_fetch_array($bpjsket);
    echo 'Rp. ' . number_format($hbpjsket['bpjsket'], 0 , '' , ',' );
    ?>  
    </td>
</tr>
<tr style=" font-size: 13px;">
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">INSENTIF HARIAN</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $insentifharian=mysql_query("SELECT * FROM insentif_harian where golongan = '$hprofil[nama_golongan]'");
    $hinsentifharian = mysql_fetch_array($insentifharian);
     if($hprofil['unit']=='Store')
    {
        $ih=$hinsentifharian['nominal_insentif']*26;
    }
    else
    {
        $ih=$hinsentifharian['nominal_insentif']*22;
    }
    echo 'Rp. ' . number_format($ih, 0 , '' , ',' );
    ?>   
    </td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">BPJS KESEHATAN</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $bpjskes=mysql_query("SELECT * FROM karyawan where nik = '$hprofil[nik]' ");
    $hbpjskes = mysql_fetch_array($bpjskes);
    echo 'Rp. ' . number_format($hbpjskes['bpjskes'], 0 , '' , ',' );
    ?>
    </td>
</tr>
<tr style=" font-size: 13px;">
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">INSENTIF JABATAN</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $insentifjabatan=mysql_query("SELECT * FROM jabatan where unit = '$hprofil[unit]' and nama_jabatan = '$hprofil[nama_jabatan]'");
    $hinsentifjabatan = mysql_fetch_array($insentifjabatan);
    echo 'Rp. ' . number_format($hinsentifjabatan['insentif_jabatan'], 0 , '' , ',' );
    ?>   
    </td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">ABSENSI</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $ig=mysql_query("SELECT * FROM realisasi where nik = '$hprofil[nik]' and isi_realisasi = 'IG' and tgl between '$tgl1' and '$tgl2' ");
    $hig = mysql_num_rows($ig);
    if($hprofil['unit']=='Store')
    {
    $potig=$hgapok['gaji_pokok']/30*$hig;
    }
    else
    {
    $potig=$hgapok['gaji_pokok']/30*$hig;
    }
    $alp=mysql_query("SELECT * FROM realisasi where nik = '$hprofil[nik]' and isi_realisasi = 'ALP' and tgl between '$tgl1' and '$tgl2' ");
    $halp = mysql_num_rows($alp);
    if($hprofil['unit']=='Store')
    {
    $potalp=$hgapok['gaji_pokok']/30*$halp;
    }
    else
    {
    $potalp=$hgapok['gaji_pokok']/30*$halp;
    }
    $st=mysql_query("SELECT * FROM realisasi where nik = '$hprofil[nik]' and isi_realisasi = 'ST' and tgl between '$tgl1' and '$tgl2' ");
    $hst = mysql_num_rows($st);
    $potst=$hinsentifharian['nominal_insentif']*$hst;
    $potabsensi=$potig+$potalp+$potst;
    echo 'Rp. ' . number_format($potabsensi, 0 , '' , ',' );
    ?>  
    </td>
</tr>
<tr style=" font-size: 13px;">
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;"></td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;"></td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">KETERLAMBATAN</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $ih=mysql_query("SELECT * FROM realisasi where nik = '$hprofil[nik]' and isi_realisasi = 'IH' and tgl between '$tgl1' and '$tgl2' ");
    $hih = mysql_num_rows($ih);
    $potih=$hih*$hinsentifharian['nominal_insentif'];
    $ish=mysql_query("SELECT * FROM realisasi where nik = '$hprofil[nik]' and isi_realisasi = 'ISH' and tgl between '$tgl1' and '$tgl2' ");
    $hish = mysql_num_rows($ish);
    $nomish=$hinsentifharian['nominal_insentif']/2;
    $potish=$hish*$nomish;
    $potketerlambatan=$potih+$potish;
    echo 'Rp. ' . number_format($potketerlambatan, 0 , '' , ',' );
    ?></td>
</tr>
<tr style=" font-size: 13px;">
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;"></td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;"></td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">PINJAMAN</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $pinjaman=mysql_query("SELECT * FROM karyawan where nik = '$hprofil[nik]' ");
    $hpinjaman = mysql_fetch_array($pinjaman);
    echo 'Rp. ' . number_format($hpinjaman['pinjaman'], 0 , '' , ',' );
    ?>
    </td>
</tr>
<tr style=" font-size: 13px;">
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">LAIN-LAIN*</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $penlain=mysql_query("SELECT * FROM karyawan where nik = '$hprofil[nik]' ");
    $hpenlain = mysql_fetch_array($penlain);
    echo 'Rp. ' . number_format($hpenlain['penlain'], 0 , '' , ',' );
    ?>   
    </td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-left: 10px;">LAIN-LAIN*</td>
    <td style="border-style: solid; border-width: 1px; font-size: 14px; padding-right: 10px; text-align: right;">
    <?php 
    $potlain=mysql_query("SELECT * FROM karyawan where nik = '$hprofil[nik]' ");
    $hpotlain = mysql_fetch_array($potlain);
    echo 'Rp. ' . number_format($hpotlain['potlain'], 0 , '' , ',' );
    ?>
    </td>
</tr>
<tr style=" font-size: 13px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px;">TOTAL A</td>
    <td style="border-style: solid; border-width: 1px; padding-right: 10px; text-align: right;">
    <?php
    $insentifharian=mysql_query("SELECT * FROM insentif_harian where golongan = '$hprofil[nama_golongan]'");
    $hinsentifharian = mysql_fetch_array($insentifharian);
     if($hprofil['unit']=='Store')
    {
        $ih=$hinsentifharian['nominal_insentif']*26;
    }
    else
    {
        $ih=$hinsentifharian['nominal_insentif']*22;
    }
    $totala=$hgapok['gaji_pokok']+$ih+$hinsentifjabatan['insentif_jabatan']+$hlembur['lembur']+$hpenlain['penlain'];
    echo 'Rp. ' . number_format($totala, 0 , '' , ',' );
    ?>    
    </td>
    <td style="border-style: solid; border-width: 1px; padding-left: 10px;">TOTAL B</td>
    <td style="border-style: solid; border-width: 1px; padding-right: 10px; text-align: right;">
    <?php
    $totalb=$hpajak['pajak']+$hbpjsket['bpjsket']+$hbpjskes['bpjskes']+$potabsensi+$potketerlambatan+$hpinjaman['pinjaman']+$hpotlain['potlain'];
    echo 'Rp. ' . number_format($totalb, 0 , '' , ',' );
    ?>  
    </td>
</tr>
<tr style=" font-size: 13px;">
    <td style="border-style: solid; border-width: 1px; padding-left: 10px; font-weight: bold; text-align: center;" colspan="3">UPAH DITERIMA</td>
    <td style="border-style: solid; border-width: 1px; padding-right: 10px; text-align: right;">
    <?php
    $totalupah=$totala-$totalb;
    echo 'Rp. ' . number_format($totalupah, 0 , '' , ',' );
    ?>
    </td>
</tr>
</table>
</div>
<?php
}
?> 

</body>
</html>