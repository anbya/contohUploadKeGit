
<?php
// Load file koneksi.php
include "koneksi.php";
$keyoutlet=$_GET['outlet'];
$keydatefrom=$_GET['datefrom'];
$keydateto=$_GET['dateto'];
// Load plugin PHPExcel nya
require_once 'PHPExcel/PHPExcel.php';

// Panggil class PHPExcel nya
$excel = new PHPExcel();

// Settingan awal fil excel
$excel->getProperties()->setCreator('My Notes Code')
					   ->setLastModifiedBy('My Notes Code')
					   ->setTitle("Data Siswa")
					   ->setSubject("Siswa")
					   ->setDescription("Laporan Semua Data Siswa")
					   ->setKeywords("Data Siswa");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
	'font' => array('bold' => true), // Set font nya jadi bold
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

$excel->setActiveSheetIndex(0)->setCellValue('A1', "SALES REPORT"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:S1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "BILL NUMBER");
$excel->setActiveSheetIndex(0)->setCellValue('B3', "TRANS DATE");
$excel->setActiveSheetIndex(0)->setCellValue('C3', "TRANS TIME");
$excel->setActiveSheetIndex(0)->setCellValue('D3', "GROSS SALES");
$excel->setActiveSheetIndex(0)->setCellValue('E3', "DISC");
$excel->setActiveSheetIndex(0)->setCellValue('F3', "TAX");
$excel->setActiveSheetIndex(0)->setCellValue('G3', "SERVICE CHARGE");
$excel->setActiveSheetIndex(0)->setCellValue('H3', "NET SALES");
$excel->setActiveSheetIndex(0)->setCellValue('I3', "CASH");
$excel->setActiveSheetIndex(0)->setCellValue('J3', "BCA DEBIT");
$excel->setActiveSheetIndex(0)->setCellValue('K3', "BCA CREDIT CARD");
$excel->setActiveSheetIndex(0)->setCellValue('L3', "BNI DEBIT");
$excel->setActiveSheetIndex(0)->setCellValue('M3', "BNI CREDIT CARD");
$excel->setActiveSheetIndex(0)->setCellValue('N3', "MANDIRI DEBIT");
$excel->setActiveSheetIndex(0)->setCellValue('O3', "MANDIRI CREDIT CARD");
$excel->setActiveSheetIndex(0)->setCellValue('P3', "BRI DEBIT");
$excel->setActiveSheetIndex(0)->setCellValue('Q3', "VISA");
$excel->setActiveSheetIndex(0)->setCellValue('R3', "MASTER");
$excel->setActiveSheetIndex(0)->setCellValue('S3', "VOUCHER");
// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa
$sql = mysqli_query($koneksi,"SELECT * FROM pos_salestemp where id_outlet ='$keyoutlet' AND status = 'CLOSED' AND close_date between '$keydatefrom' AND '$keydateto' ");

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql

	$keytrans=$data['notrans'];
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
	$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data['bill_number']);
	$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['close_date']);
	$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['close_time']);
	$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['gross_sales']);
	$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['disc']);
	$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['tax']);
	$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['service_charge']);
	$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['nett_sales']);
	$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $cash);
	$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $bcadebit);
	$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $bcacc);
	$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $bnidebit);
	$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $bnicc);
	$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $mandiridebit);
	$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $mandiricc);
	$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $bridebit);
	$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $visa);
	$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $master);
	$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $voucher);
	
	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
	
	$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
	
	$no++; // Tambah 1 setiap kali looping
	$numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('O')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('P')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('R')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D

// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Laporan Data Transaksi");
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="POS_SALES_REPORT.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
