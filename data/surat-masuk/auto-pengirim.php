<?php
if (isset($_GET['term'])){
require '../../include/koneksi.php'; 
$pilih = $db->prepare("SELECT DISTINCT pengirim FROM e_surat_masuk where pengirim like :term");
$pilih->execute(array('term' => $_GET['term'].'%'));
$return_arr = array();
while($row = $pilih->fetch()) {
    $return_arr[] =  $row['pengirim'];
    }
echo json_encode($return_arr);
	}