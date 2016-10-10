<?php
require_once dirname(__FILE__) . '/../../library/PHPExcel/PHPExcel.php';
require_once dirname(__FILE__) . '/../../koneksi.php';
$jenjang				= isset($_GET['jenjang'])?$_GET['jenjang']:'';
$jumlah					= isset($_GET['jumlah'])?$_GET['jumlah']:'';
$jjg					= !empty($jenjang)?$jenjang:'Semua jenjang'; 
if(empty($jenjang)){
	if(empty($jumlah)){
		$pilih = $db->query("SELECT * FROM e_sekolah order by nama_sp asc");
	}
	else{
		$pilih = $db->query("SELECT * FROM e_sekolah order by nama_sp asc limit $jumlah");
	}
}
else{
	if(empty($jumlah)){
		$pilih = $db->query("SELECT * FROM e_sekolah where jenjang='$jenjang' order by nama_sp asc");
	}
	else{
		$pilih = $db->query("SELECT * FROM e_sekolah where jenjang='$jenjang' order by nama_sp asc limit $jumlah");
	}
	
}
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
$no = 2;
$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->SetCellValue('A1', "NPSN");
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue('B1', "NAMA SEKOLAH");
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$objPHPExcel->getActiveSheet()->SetCellValue('C1', "ALAMAT");
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->SetCellValue('D1', "KELURAHAN");
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$objPHPExcel->getActiveSheet()->SetCellValue('E1', "KECAMATAN");
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue('F1', "JENJANG");
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue('G1', "STATUS");
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue('H1', "WAKTU PBM");
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue('I1', "AKREDITASI");
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue('J1', "SK AKREDITASI");
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(23);
$objPHPExcel->getActiveSheet()->SetCellValue('K1', "TANGGAL AKREDITASI");
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(24);
$objPHPExcel->getActiveSheet()->SetCellValue('L1', "SK PENDIRIAN");
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue('M1', "TANGGAL SK PENDIRIAN");
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(26);
$objPHPExcel->getActiveSheet()->SetCellValue('N1', "SK IJIN OPERASIOANAL");
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(26);
$objPHPExcel->getActiveSheet()->SetCellValue('O1', "TANGGAL SK IJIN OPERASIONAL");
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
$objPHPExcel->getActiveSheet()->SetCellValue('P1', "MBS");
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue('Q1', "SERTIFIKASI ISO");
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue('R1', "AKSES INTERNET");
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue('S1', "TELPON");
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue('T1', "FAX");
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue('U1', "EMAIL");
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(31);
$objPHPExcel->getActiveSheet()->SetCellValue('V1', "WEBSITE");
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(40);
$objPHPExcel->getActiveSheet()->SetCellValue('W1', "NO. REKENING");
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue('X1', "NAMA BANK");
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue('Y1', "CABANG BANK");
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);

while($row = $pilih->fetch(PDO::FETCH_BOTH)) {
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$no, $row['npsn']);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$no, $row['nama_sp']);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$no, $row['alamat_jalan']);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$no, $row['desa_kelurahan']);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$no, $row['kec_']);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$no, $row['jenjang']);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$no, $row['status_sekolah']);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$no, $row['waktu_penyelenggaraan']);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$no, $row['akreditasi']);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$no, $row['sk_akreditasi']);
$objPHPExcel->getActiveSheet()->SetCellValue('K'.$no, $row['tanggal_sk_akreditasi']);
$objPHPExcel->getActiveSheet()->SetCellValue('L'.$no, $row['sk_pendirian_sekolah']);
$objPHPExcel->getActiveSheet()->SetCellValue('M'.$no, $row['tanggal_sk_pendirian']);
$objPHPExcel->getActiveSheet()->SetCellValue('N'.$no, $row['sk_izin_operasional']);
$objPHPExcel->getActiveSheet()->SetCellValue('O'.$no, $row['tanggal_sk_izin_operasional']);
$objPHPExcel->getActiveSheet()->SetCellValue('P'.$no, $row['mbs']);
$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$no, $row['sertifikasi_iso']);
$objPHPExcel->getActiveSheet()->SetCellValue('R'.$no, $row['akses_internet']);
$objPHPExcel->getActiveSheet()->SetCellValue('S'.$no, $row['nomor_telepon']);
$objPHPExcel->getActiveSheet()->SetCellValue('T'.$no, $row['nomor_fax']);
$objPHPExcel->getActiveSheet()->SetCellValue('U'.$no, $row['email']);
$objPHPExcel->getActiveSheet()->SetCellValue('V'.$no, $row['website']);
$objPHPExcel->getActiveSheet()->SetCellValue('W'.$no, $row['no_rekening']);
$objPHPExcel->getActiveSheet()->SetCellValue('X'.$no, $row['nama_bank']);
$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$no, $row['cabang_kcp_unit']);
$no++;
} 
$objPHPExcel->getActiveSheet()
    ->getStyle('A1:Y1')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('79166197');
$objPHPExcel->getActiveSheet()
    ->getStyle('A1:Y1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 10,
        'name'  => 'Verdana'
    ));

$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray($styleArray);

$objPHPExcel->getProperties()->setCreator("Ahmad Budairi")
							 ->setLastModifiedBy("Ahmad Budairi")
							 ->setTitle("Percobaan")
							 ->setSubject("Percobaan PHPExcel")
							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Test result file");
$objPHPExcel->getActiveSheet()->setTitle('Data');
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Data Sekolah Jenjang '.$jjg.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
