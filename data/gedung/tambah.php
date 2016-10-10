<?php
require '../../include/koneksi.php';
$tanggal=isset($_POST['tanggal'])?$_POST['tanggal']:'';
$mulai=isset($_POST['mulai'])?$_POST['mulai']:'';
$selesai=isset($_POST['selesai'])?$_POST['selesai']:'';
$tempat=isset($_POST['tempat'])?$_POST['tempat']:'';
$pelaksana=isset($_POST['pelaksana'])?$_POST['pelaksana']:'';
$keperluan=isset($_POST['keperluan'])?$_POST['keperluan']:'';
$keterangan=isset($_POST['keterangan'])?$_POST['keterangan']:'';
if(empty($tanggal)){
	echo 'Kolom tanggal tidak boleh kosong!';
}
else if(empty($mulai)){
	echo 'Kolom mulai pegawai tidak boleh kosong!';
}
else if(empty($selesai)){
	echo 'Kolom selesai tidak boleh kosong!';
}
else if(empty($tempat)){
	echo 'Kolom tempat tidak boleh kosong!';
}
else if(empty($pelaksana)){
	echo 'Kolom pelaksana tidak boleh kosong!';
}
else if(empty($keperluan)){
	echo 'Kolom keperluan tidak boleh kosong!';
}
else if(empty($keterangan)){
	echo 'Kolom keterangan tidak boleh kosong!';
}
else{
	try{
		$sql="INSERT INTO e_gedung (tanggal, mulai, selesai, tempat, pelaksana, keperluan, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->execute(array($tanggal, $mulai, $selesai, $tempat, $pelaksana, $keperluan, $keterangan));
		echo 'berhasil';
	}catch(PDOException $ex){echo $sql." Gagal menambahkan ke database dengan kode kesalahan ".$ex->getMessage();}
}