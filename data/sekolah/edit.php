<?php
require '../../include/koneksi.php';
$npsn					= isset($_POST['npsn'])?$_POST['npsn']:'';
$nama					= isset($_POST['nama'])?$_POST['nama']:'';
$alamat					= isset($_POST['alamat'])?$_POST['alamat']:'';
$jenjang				= isset($_POST['jenjang'])?$_POST['jenjang']:'';
$kelurahan				= isset($_POST['kelurahan'])?$_POST['kelurahan']:'';
$kecamatan				= isset($_POST['kecamatan'])?$_POST['kecamatan']:'';
$status					= isset($_POST['status'])?$_POST['status']:'';
$waktu					= isset($_POST['waktu'])?$_POST['waktu']:'';
$akreditasi				= isset($_POST['akreditasi'])?$_POST['akreditasi']:'';
$sk_akreditasi			= isset($_POST['sk-akreditasi'])?$_POST['sk-akreditasi']:'';
$tanggal_sk_akreditasi	= isset($_POST['tanggal-sk-akreditasi'])?$_POST['tanggal-sk-akreditasi']:'';
$sk_pendirian			= isset($_POST['sk-pendirian'])?$_POST['sk-pendirian']:'';
$tanggal_sk_pendirian	= isset($_POST['tanggal-sk-pendirian'])?$_POST['tanggal-sk-pendirian']:'';
$sk_ijin				= isset($_POST['sk-ijin'])?$_POST['sk-ijin']:'';
$tanggal_sk_ijin		= isset($_POST['tanggal-sk-ijin'])?$_POST['tanggal-sk-ijin']:'';
$mbs					= isset($_POST['mbs'])?$_POST['mbs']:'';
$sertifikat_iso			= isset($_POST['sertifikat-iso'])?$_POST['sertifikat-iso']:'';
$akses_internet			= isset($_POST['akses-internet'])?$_POST['akses-internet']:'';
$telpon					= isset($_POST['telpon'])?$_POST['telpon']:'';
$fax					= isset($_POST['fax'])?$_POST['fax']:'';
$email					= isset($_POST['email'])?$_POST['email']:'';
$rekening				= isset($_POST['rekening-bank'])?$_POST['rekening-bank']:'';
$nama_bank				= isset($_POST['nama-bank'])?$_POST['nama-bank']:'';
$cabang_bank			= isset($_POST['cabang-bank'])?$_POST['cabang-bank']:'';
$website				= isset($_POST['website'])?$_POST['website']:'';
$lintang				= isset($_POST['lintang'])?$_POST['lintang']:'';
$bujur					= isset($_POST['bujur'])?$_POST['bujur']:'';
if(empty($npsn)){
	echo 'Kolom NPSN tidak boleh kosong!';
}
else if(empty($nama)){
	echo 'Kolom nama Satuan Pendidikan tidak boleh kosong!';
}
else if(empty($alamat)){
	echo 'Kolom alamat tidak boleh kosong!';
}
else if(empty($jenjang)){
	echo 'Kolom jenjang tidak boleh kosong!';
}
else if(empty($kelurahan)){
	echo 'Kolom kelurahan tidak boleh kosong!';
}
else if(empty($kecamatan)){
	echo 'Kolom kecamatan tidak boleh kosong!';
}
else if(empty($status)){
	echo 'Kolom status tidak boleh kosong!';
}
else if(empty($waktu)){
	echo 'Kolom waktu tidak boleh kosong!';
}
else{
	try{
	$edit = $db->prepare("UPDATE e_sekolah SET nama_sp=?, alamat_jalan=?, desa_kelurahan=?, kec_=?, jenjang=?, status_sekolah=?, waktu_penyelenggaraan=?, akreditasi=?, sk_akreditasi=?, tanggal_sk_akreditasi=?, sk_pendirian_sekolah=?, tanggal_sk_pendirian=?, sk_izin_operasional=?, tanggal_sk_izin_operasional=?, mbs=?, sertifikasi_iso=?, akses_internet=?, nomor_telepon=?, nomor_fax=?, email=?, website=?, no_rekening=?, nama_bank=?, cabang_kcp_unit=?, lintang=?, bujur=? WHERE npsn=?");
	$edit->execute(array($nama, $alamat, $kelurahan, $kecamatan, $jenjang, $status, $waktu, $akreditasi, $sk_akreditasi, $tanggal_sk_akreditasi, $sk_pendirian, 					$tanggal_sk_pendirian, $sk_ijin, $tanggal_sk_ijin, $mbs, $sertifikat_iso, $akses_internet, $telpon, $fax, $email, $website, $rekening, $nama_bank, 					$cabang_bank, $lintang, $bujur, $npsn));
	//echo $id.$nip.$nama.$jabatan.$perihal.$mulai.$berakhir.$keterangan;
	echo 'berhasil';
	
	}catch(PDOException $ex){echo " Gagal menambahkan ke database dengan kode kesalahan ".$ex->getMessage();}
}