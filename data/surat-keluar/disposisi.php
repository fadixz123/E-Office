<?php
require '../../include/koneksi.php';
$nomor_surat=isset($_POST['nosurat'])?$_POST['nosurat']:'';
$tanggal_disposisi=isset($_POST['tanggal-disposisi'])?$_POST['tanggal-disposisi']:'';
$tujuan_disposisi=isset($_POST['tujuan-disposisi'])?$_POST['tujuan-disposisi']:'';
$isi_disposisi=isset($_POST['isi-disposisi'])?$_POST['isi-disposisi']:'';

if(empty($tanggal_disposisi)){
	echo "Tanggal disposisi harus diisi!";
}
else if(empty($tujuan_disposisi)){
	echo "Tujuan disposisi harus diisi!";
}
else if(empty($isi_disposisi)){
	echo "Isi disposisi harus diisi!";
}
else{
	try{
			$update = $db->prepare("UPDATE e_surat_keluar SET tanggal_disposisi=?, tujuan_disposisi=?, isi_disposisi=? WHERE nomor_surat=?");
			$update->execute(array($tanggal_disposisi, $tujuan_disposisi, $isi_disposisi, $nomor_surat));
			echo 'berhasil';
	}catch(PDOException $ex){echo " Gagal melakukan disposisi dengan kode kesalahan ".$ex->getMessage();}
}