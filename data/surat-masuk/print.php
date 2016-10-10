<?php
require '../../library/wordwrap.php';


class Surat {
    public function all() {
        try {
			require '../../include/koneksi.php';
			$mulai=isset($_GET['mulai'])?$_GET['mulai']:'';
			$akhir=isset($_GET['akhir'])?$_GET['akhir']:'';
            $query = $db->prepare("SELECT tanggal, nomor_surat, perihal, pengirim, penerima, keterangan FROM e_surat_masuk WHERE tanggal BETWEEN '$mulai' AND '$akhir' ");
			$query->execute();
            $surat = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            //echo "Exeption: " .$e->getMessage();
            $result = false;
        }
        $query = null;
        $db = null;
        return $surat;        
    }
}
class SuratPDF extends FPDF {
    // Create basic table
    public function CreateTable($header, $data)
    {
        // Header
		$mulai=isset($_GET['mulai'])?$_GET['mulai']:'';
		$akhir=isset($_GET['akhir'])?$_GET['akhir']:'';
		$this->SetFont('TIMES','',18);
			$this->Cell(300, 5, 'PEMERINTAH KOTA SALATIGA', 0, 1, 'C');
			$this->SetFont('TIMES','',20);
			$this->Cell(300, 15, 'DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA', 0, 1, 'C');
			$this->Image('../../images/logo-kop.jpg',10,6,30);
			$this->SetFont('TIMES','',14);
			$this->Cell(300,0,'Jalan LMU Adisucipto Nomor 2 Salatiga Kodepos 50724 Telp (0298) 324979',0,1,'C');
			$this->Cell(300,14,'Fax. 324844 Website www.pemkot-salatiga.go.id',0,1,'C');
			$this->Cell(300,0,'Email. dispora@pemkot-salatiga.go.id',0,1,'C');
			$this->Line(10,48.7,287,48.7);
			$this->SetLineWidth(1);
			$this->Line(10,50,287,50);
			$this->SetFont('TIMES','',18);
			$this->Cell(300, 25, 'ARSIP SURAT MASUK', 0, 1, 'C');
			$this->SetLineWidth(0);
			$this->Line(127,60,193,60);
			$this->SetFont('TIMES','',12);
			$this->Cell(300, -10, $mulai." s/d ".$akhir, 0, 1, 'C');
        $this->SetFillColor(0);
        $this->SetTextColor(255);
        $this->SetFont('TIMES','',13);
		$this->Multicell(0,10,"");
        foreach ($header as $col) {
            //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
            $this->Cell($col[1], 10, $col[0], 1, 0, 'L', true);
        }
        $this->Ln();
        // Data
        $this->SetFillColor(255);
        $this->SetTextColor(0);
        $this->SetFont('');
        foreach ($data as $row)
        {
            $i = 0;
            foreach ($row as $field) {
                $this->MultiCell($header[$i][1], 6, $field, 1, 0, 'L', false);
                $i++;
            }
            $this->Ln();
        }
    }
}
$header = array(
             array('Tanggal',  37), 
             array('Nomor Surat', 37), 
             array('Perihal',   37),
             array('Pengirim',         37),
             array('Penerima',       37),
             array('Keterangan',       37)
          );
// Get data
$surat = new Surat();
$data = $surat->all();
$pdf = new SuratPDF('L','mm','A4');
$pdf->AddPage();
$pdf->CreateTable($header,$data);
$pdf->Output();
