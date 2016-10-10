<?php
if (isset($_GET['term'])){
require '../../include/koneksi.php'; 
$pilih = $db->prepare("SELECT DISTINCT jabatan FROM e_cuti where jabatan like :term");
$pilih->execute(array('term' => $_GET['term'].'%'));
$return_arr = array();
while($row = $pilih->fetch()) {
    $return_arr[] =  $row['jabatan'];
    }
echo json_encode($return_arr);
	}