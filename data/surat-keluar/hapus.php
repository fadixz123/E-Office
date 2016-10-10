<?php
require '../../include/koneksi.php';
function clean($string){
	$string = str_replace('/', '-', $string);
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}
$kode = isset($_GET['kode'])?$_GET['kode']:'';
$file=clean($kode);
unlink('file/'.$file.'.jpg');
$stmt = $db->prepare("DELETE FROM e_surat_keluar WHERE nomor_surat=:kode");
$stmt->bindValue(':kode', $kode, PDO::PARAM_STR);
$stmt->execute();
$affected_rows = $stmt->rowCount();