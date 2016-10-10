<?php
if(isset($_GET['edit'])){
	require '../../include/koneksi.php';
	$id=isset($_POST['id'])?$_POST['id']:'';
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
		$edit = $db->prepare("UPDATE e_cuti SET nip=?, nama=?, jabatan=?, perihal=?, mulai=?, berakhir=?, keterangan=? WHERE id=?");
		$edit->execute(array($nip, $nama,$jabatan, $perihal, $mulai, $berakhir, $keterangan, $id));
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
		$edit = $db->prepare("UPDATE e_cuti set status=?, catatan=? where id=?");
		$edit->execute(array($putusan, $catatan, $id));
		exit('berhasil');
	}catch(PDOException $ex){
		echo " Gagal memperbarui database dengan kode kesalahan ".$ex->getMessage();
	}
	
}