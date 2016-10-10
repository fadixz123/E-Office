<?php
 
require('../../../wp-load.php' );

// Pastikan telah login
if (!($uid = @get_current_user_id())) return;

// Check tipe formulir
if (empty($_POST['form-data-disposisi'])) exit('Kesalahan formulir');

require '../../include/koneksi.php';

// Validasi pos data
if (pos_kosong('nosurat', $nosurat)) exit('Kolom No. Surat tidak boleh kosong!');
if (pos_kosong('tanggal-disposisi', $tanggal)) exit('Kolom tanggal tidak boleh kosong!');
if (pos_kosong('disposisi_status', $status)) exit('Harap di centang salah satu!');
$keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';


// Check data surat
$data = $db->query(
	'select disposisi_kabid, user_id, disposisi_kadin from e_surat_masuk where nomor_surat = '
	. $db->quote($nosurat) . ' limit 1'
);
if (!($data && ($data = $data->fetchObject()))) exit('Data surat tidak ditemukan');

// Check peranan
$disp = $db->query('select user_role from e_user where user_id = "'.(int)$uid.'" limit 1');
$disp = $disp ? $disp->fetchObject()->user_role : null;
if (!$disp || !($disp === 'kabid' || 'kadin' === $disp)) exit('Pastikan Anda berhak untuk disposisi surat masuk');


// Simpan keterangan disposisi
$data_disposisi = array(
	'tanggal' => $tanggal, 'keterangan' => $keterangan, 'status' => $status
);
$update = $db->prepare(
	'update e_surat_masuk set disposisi_status=?, disposisi_'.$disp.'=?	where nomor_surat=?'
);
if($update->execute(array($status, serialize($data_disposisi), $nosurat))){
	require_once '../../api/firebase.php';
	if($disp=='kabid' && $status=='terima'){
		$firebase = $db->query("SELECT user_token FROM e_user where user_role='kabid' ");
		$row = $firebase->fetch(PDO::FETCH_BOTH);
        $device = array($row['user_token']);
        $gcpm = new GCMPushMessage($apiKey);
        $gcpm->setDevices($device);
        $response = $gcpm->send($keterangan, array('title' => 'Surat Masuk', 'nomor' => $nosurat));
	}
		$firebase = $db->query("SELECT user_token FROM e_user where user_id='{$data->user_id}'");
		$row = $firebase->fetch(PDO::FETCH_BOTH);
        $device = array($row['user_token']);
        $gcpm = new GCMPushMessage($apiKey);
        $gcpm->setDevices($device);
        $response = $gcpm->send($keterangan, array('title' => 'Status Disposisi: '.$nosurat, 'nomor' => $nosurat));
	echo "berhasil";
}
exit;



//==========================================================================
/*


$nomor_surat = isset($_POST['nosurat']) ? $_POST['nosurat'] : '';
$tanggal_disposisi = isset($_POST['tanggal-disposisi']) ? $_POST['tanggal-disposisi'] : '';
$tujuan_disposisi = isset($_POST['tujuan-disposisi']) ? $_POST['tujuan-disposisi'] : '';
$isi_disposisi = isset($_POST['isi-disposisi']) ? $_POST['isi-disposisi'] : '';

if (empty($tanggal_disposisi)) {
    echo "Tanggal disposisi harus diisi!";
} else if (empty($tujuan_disposisi)) {
    echo "Tujuan disposisi harus diisi!";
} else if (empty($isi_disposisi)) {
    echo "Isi disposisi harus diisi!";
} else {
    try {
        $update = $db->prepare("UPDATE e_surat_masuk SET tanggal_disposisi=?, tujuan_disposisi=?, isi_disposisi=? WHERE nomor_surat=?");
        $update->execute(array($tanggal_disposisi, $tujuan_disposisi, $isi_disposisi, $nomor_surat));
        $firebase = $db->query("SELECT token FROM e_user where hak_akses='pimpinan' ");
        $row = $firebase->fetch(PDO::FETCH_BOTH);
        $device = array($row['token']);
        $gcpm = new GCMPushMessage($apiKey);
        $gcpm->setDevices($device);
        $response = $gcpm->send($isi_disposisi, array('title' => 'Status Disposisi', 'nomor' => $nomor_surat));
        echo 'berhasil';
    } catch (PDOException $ex) {
        echo " Gagal melakukan disposisi dengan kode kesalahan " . $ex->getMessage();
    }
}
*/