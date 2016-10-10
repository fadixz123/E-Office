<?php
//require('library/dompdf/src/Autoloader.php');
require('../../library/dompdf/dompdf_config.inc.php');

require('../../koneksi.php');
try {
			$jenjang=isset($_GET['jenjang'])?$_GET['jenjang']:'';
			$judul="Arsip Data Satuan Pendidikan ";
			$tanggal='';
			if($jenjang!=""){
            $query = $db->prepare("SELECT npsn, nama_sp, alamat_jalan, desa_kelurahan, jenjang, status_sekolah FROM e_sekolah WHERE jenjang='$jenjang' ");
			$query->execute();
			}
			else{
				$query = $db->prepare("SELECT npsn, nama_sp, alamat_jalan, desa_kelurahan, jenjang, status_sekolah FROM e_sekolah ");
				$query->execute();
			}
			while($row = $query->fetch(PDO::FETCH_BOTH)) {
				$tanggal.= '<tr><td>'.$row['npsn'].'</td><td>'.$row['nama_sp'].'</td><td>'.$row['alamat_jalan'].'</td><td>'.$row['jenjang'].'</td><td>'.$row['jenjang'].'</td><td>'.$row['status_sekolah'].'</td></tr>';
			}
        } catch (PDOException $e) {
            echo "Exeption: " .$e->getMessage();
            $result = false;
        }

$kop='
<html>
<head>
<title>Cetak '.$judul.' jenjang '.$jenjang.'</title>
<link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
<style>
tbody:before, tbody:after { display: none; }
.table > tbody > tr > td {
     vertical-align: middle;
}
</style>
</head>

<body>
';



$tabel = <<<html
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<img width="160" style="position:absolute;top:-10px;left:0px" src="../../images/logo-kop.png"/>
			<table width="770" style="width:100%;">
				<tr>
					<td style="text-align:center"><span style="font-size:16px"></span></td>
				</tr>
				<tr>
					<td align="center"><span style="font-size:16px;font-family:helvetica">PEMERINTAH KOTA SALATIGA</span></td>
				</tr>
				<tr>
					<td align="center"><span style="font-size:20px;font-family:helvetica">DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA</span></td>
				</tr>
				<tr>
					<td align="center"><span style="font-size:12px;font-family:helvetica">Jalan LMU Adisucipto Nomor 2 Salatiga Kodepos 50724 Telp (0298) 324979</span></td>
				</tr>
				<tr>
					<td align="center"><span style="font-size:12px;font-family:helvetica">Fax. 324844 Website www.pemkot-salatiga.go.id</span></td>
				</tr>
				<tr>
					<td align="center"><span style="font-size:12px;font-family:helvetica">Email. dispora@pemkot-salatiga.go.id<br/></span></td>
				</tr>
			</table>
			<div style="display:block;width:100%;padding-top:5px"><img style="width:100%" src="../../images/line1.png"/></div>
		</div>
		<div class="col-md-12 text-center">
				<span style="font-size:13px;font-family:Arial;text-transform: uppercase;"><b><u>$judul</u></b></span><br/>
				<span style="font-size:11px;font-family:Arial;">Jenjang $jenjang</span>
		</div>
		<div class="col-md-12">
			<table class="table table-bordered">
				<tr class="info">
					<th class="text-center">NPSN</th>
					<th class="text-center">NAMA SEKOLAH</th>
					<th class="text-center">ALAMAT</th>
					<th class="text-center">KELURAHAN</th>
					<th class="text-center">JENJANG</th>
					<th class="text-center">STATUS</th>
				</tr>
				$tanggal
			</table>
		</div>
	</div>
</div>
</body>
</html>
html;
$pdf = new DOMPDF();
$pdf->set_paper('A4', 'landscape');
$pdf->load_html($kop.$tabel);
$pdf->render();
$pdf->stream("".$judul." jenjang ".$jenjang.".pdf", array("Attachment" => false));
$dom_pdf = $pdf->getDomPDF();

$canvas = $dom_pdf ->get_canvas();
$canvas->page_text(0, 0, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
exit(0);