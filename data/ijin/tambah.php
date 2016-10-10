<?php
require '../../include/koneksi.php';
$nip=isset($_POST['nip'])?$_POST['nip']:'';
$nama=isset($_POST['nama-pegawai'])?$_POST['nama-pegawai']:'';
$jabatan=isset($_POST['jabatan'])?$_POST['jabatan']:'';
$perihal=isset($_POST['perihal'])?$_POST['perihal']:'';
$mulai=isset($_POST['mulai'])?$_POST['mulai']:'';
$berakhir=isset($_POST['berakhir'])?$_POST['berakhir']:'';
$keterangan=isset($_POST['keterangan'])?$_POST['keterangan']:'';
if(empty($nip)){
	echo 'Kolom NIP tidak boleh kosong!';
}
else if(empty($nama)){
	echo 'Kolom nama pegawai tidak boleh kosong!';
}
else if(empty($jabatan)){
	echo 'Kolom jabatan tidak boleh kosong!';
}
else if(empty($perihal)){
	echo 'Kolom Perihal tidak boleh kosong!';
}
else if(empty($mulai)){
	echo 'Kolom mulai tidak boleh kosong!';
}
else if(empty($berakhir)){
	echo 'Kolom berakhir tidak boleh kosong!';
}
else if(empty($keterangan)){
	echo 'Kolom keterangan tidak boleh kosong!';
}
else{
	try{
		$sql="INSERT INTO e_cuti (nip, nama, jabatan, perihal, mulai, berakhir, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->execute(array($nip, $nama,$jabatan, $perihal, $mulai, $berakhir, $keterangan));
		echo 'berhasil';
	}catch(PDOException $ex){echo $sql." Gagal menambahkan ke database dengan kode kesalahan ".$ex->getMessage();}
}