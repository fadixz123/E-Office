<?php
if (isset($_GET['edit'])){
	require '../../include/koneksi.php';
$id=isset($_POST['id'])?$_POST['id']:'';
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
	$edit = $db->prepare("UPDATE e_gedung SET tanggal=?, mulai=?, selesai=?, tempat=?, pelaksana=?, keperluan=?, keterangan=? WHERE id=?");
	$edit->execute(array($tanggal, $mulai, $selesai, $tempat, $pelaksana, $keperluan, $keterangan, $id));
	//echo $id.$nip.$nama.$jabatan.$perihal.$mulai.$berakhir.$keterangan;
	echo 'berhasil';
	
	}catch(PDOException $ex){echo " Gagal menambahkan ke database dengan kode kesalahan ".$ex->getMessage();}
}
}
if (isset($_GET['tindakan'])){
	require '../../include/koneksi.php';
	$id=isset($_POST['id'])?$_POST['id']:'';
	$putusan=isset($_POST['putusan'])?$_POST['putusan']:'';
	$catatan=isset($_POST['catatan'])?$_POST['catatan']:'';
	try{
		$edit = $db->prepare("UPDATE e_gedung set status=?, catatan=? where id=?");
		$edit->execute(array($putusan, $catatan, $id));
		exit('berhasil');
	}catch(PDOException $ex){
		echo " Gagal memperbarui database dengan kode kesalahan ".$ex->getMessage();
	}
	
}