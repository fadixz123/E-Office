<?php
if (isset($_GET['term'])){
require '../../include/koneksi.php'; 
$pilih = $db->prepare("SELECT DISTINCT nomor_surat FROM e_surat_keluar where nomor_surat like :term");
$pilih->execute(array('term' => $_GET['term'].'%'));
$return_arr = array();
while($row = $pilih->fetch()) {
    $return_arr[] =  $row['nomor_surat'];
    }
echo json_encode($return_arr);
	}