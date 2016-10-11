<?php
require '../../include/koneksi.php';
require('../../../wp-load.php' );
//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', 1);

$user = wp_get_current_user();
if (!($user && !empty($_POST['tambah-data-surat-masuk']))) exit;

if (pos_kosong('tanggal', $tanggal)) exit('Kolom tanggal tidak boleh kosong!');
if (pos_kosong('tanggal-masuk', $tanggal_masuk)) exit('Kolom tanggal masuk tidak boleh kosong!');
if (pos_kosong('nosurat', $nosurat)) exit('Kolom No. Surat tidak boleh kosong!');
if (pos_kosong('pengirim', $pengirim)) exit('Kolom pengirim tidak boleh kosong!');
if (pos_kosong('perihal', $perihal)) exit('Kolom perihal tidak boleh kosong!');
if (pos_kosong('penerima', $penerima)) exit('Kolom Penerima tidak boleh kosong!');
if (pos_kosong('penjelasan', $penjelasan)) exit('Kolom penjelasan tidak boleh kosong!');

$file = !empty($_FILES['file']) ? $_FILES['file'] : null;
if (!$file || !$file['size']) exit('Pastikan scan surat telah dilampirkan');
if ($file['error']) exit("scan surat tidak bisa diunggah. Silahkan pilih yang lain!");
if (!preg_match('~/(png|jp(e|)g|bmp)$~', $file['type'])) exit("Formar gambar salah");

$status = $db->query('select nomor_surat from e_surat_masuk where nomor_surat='.$db->quote($nosurat).' limit 1');
if ($status && $status->fetchObject()) exit("Data Sudah ada!");

$stmt = $db->prepare(
	'insert into e_surat_masuk (
		tanggal, tanggal_masuk, nomor_surat, perihal, pengirim, penerima, keterangan, user_id, disposisi_kadin, disposisi_kabid 
	) VALUES (?, ?, ?, ?, ?, ?, ?, ?, "", "")'
);
$stmt = $stmt->execute(array($tanggal, $tanggal_masuk, $nosurat, $perihal, $pengirim, $penerima, $penjelasan, $user->id));
if($stmt) {
	if (!move_uploaded_file($_FILES["file"]["tmp_name"], 'file/'.md5($nosurat).'.jpg')) {
		exit("Gagal menyimpan gambar".$_FILES['file']['error']);
	}
	require '../../api/firebase.php';
	$firebase = $db->query("SELECT user_token FROM e_user where user_role='kadin'");
		$row = $firebase->fetch(PDO::FETCH_BOTH);
        $device = array($row['user_token']);
        $gcpm = new GCMPushMessage($apiKey);
        $gcpm->setDevices($device);
        $response = $gcpm->send($penjelasan, array('title' => 'Surat Masuk', 'nomor' => urlencode($nosurat)));
	echo '1';
} 

