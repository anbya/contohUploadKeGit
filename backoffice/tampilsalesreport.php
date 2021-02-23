<?php
include "koneksi.php";
$keyoutlet=$_GET['data1'];
$keydatefrom=$_GET['data2'];
$keydateto=$_GET['data3'];
$postemp=mysqli_query($koneksi,"SELECT * FROM pos_salestemp where id_outlet ='$keyoutlet' AND status = 'CLOSED' AND close_date between '$keydatefrom' AND '$keydateto' ");
while($hpostemp = mysqli_fetch_array($postemp))
{
$keytrans=$hpostemp['notrans'];
$sumcash=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_cash FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsTrans = 'CASH' ");
$hsumcash = mysqli_fetch_array($sumcash);
$cash=$hsumcash['total_cash'];
//------//
$sumbcadebit=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_bcadebit FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'DEBIT BCA' ");
$hsumbcadebit = mysqli_fetch_array($sumbcadebit);
$bcadebit=$hsumbcadebit['total_bcadebit'];
//------//
$sumbcacc=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_bcacc FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'BCA CREDIT CARD' ");
$hsumbcacc = mysqli_fetch_array($sumbcacc);
$bcacc=$hsumbcacc['total_bcacc'];
//------//
$sumbnidebit=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_bnidebit FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'BNI DEBIT' ");
$hsumbnidebit = mysqli_fetch_array($sumbnidebit);
$bnidebit=$hsumbnidebit['total_bnidebit'];
//------//
$sumbnicc=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_bnicc FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'BNI CREDIT CARD' ");
$hsumbnicc = mysqli_fetch_array($sumbnicc);
$bnicc=$hsumbnicc['total_bnicc'];
//------//
$summandiridebit=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_mandiridebit FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'MANDIRI DEBIT' ");
$hsummandiridebit = mysqli_fetch_array($summandiridebit);
$mandiridebit=$hsummandiridebit['total_mandiridebit'];
//------//
$summandiricc=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_mandiricc FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'MANDIRI CREDIT CARD' ");
$hsummandiricc = mysqli_fetch_array($summandiricc);
$mandiricc=$hsummandiricc['total_mandiricc'];
//------//
$sumbridebit=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_bridebit FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'BRI DEBIT' ");
$hsumbridebit = mysqli_fetch_array($sumbridebit);
$bridebit=$hsumbridebit['total_bridebit'];
//------//
$sumvisa=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_visa FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'VISA' ");
$hsumvisa = mysqli_fetch_array($sumvisa);
$visa=$hsumvisa['total_visa'];
//------//
$summaster=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_master FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsCard = 'MASTER' ");
$hsummaster = mysqli_fetch_array($summaster);
$master=$hsummaster['total_master'];
//------//
$sumvoucher=mysqli_query($koneksi,"SELECT sum(jumlah_bayar) as total_voucher FROM pos_paymenttemp where NoTrans = '$keytrans' AND JnsTrans = 'VOUCHER' ");
$hsumvoucher = mysqli_fetch_array($sumvoucher);
$voucher=$hsumvoucher['total_voucher'];
//------//
?>
<tr>
<td class="align-middle"><?php echo $hpostemp['bill_number'];?></td>
<td class="align-middle"><?php echo $hpostemp['close_date'];?></td>
<td class="align-middle"><?php echo $hpostemp['close_time'];?></td>
<td class="align-middle"><?php echo $hpostemp['gross_sales'];?></td>
<td class="align-middle"><?php echo $hpostemp['disc'];?></td>
<td class="align-middle"><?php echo $hpostemp['tax'];?></td>
<td class="align-middle"><?php echo $hpostemp['service_charge'];?></td>
<td class="align-middle"><?php echo $hpostemp['nett_sales'];?></td>
<td class="align-middle"><?php echo $cash;?></td>
<td class="align-middle"><?php echo $bcadebit;?></td>
<td class="align-middle"><?php echo $bcacc;?></td>
<td class="align-middle"><?php echo $bnidebit;?></td>
<td class="align-middle"><?php echo $bnicc;?></td>
<td class="align-middle"><?php echo $mandiridebit;?></td>
<td class="align-middle"><?php echo $mandiricc;?></td>
<td class="align-middle"><?php echo $bridebit;?></td>
<td class="align-middle"><?php echo $visa;?></td>
<td class="align-middle"><?php echo $master;?></td>
<td class="align-middle"><?php echo $voucher;?></td>
</tr>
<?php
}
?>