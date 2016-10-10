<?php
if(isset($_GET['nip'])){
	$nip=$_GET['nip'];
	require '../../include/koneksi.php';
	$pilih = $db->prepare("SELECT * FROM e_cuti where nip=?");
	$pilih->execute(array($nip));
	$data=array();
	while($row = $pilih->fetch()) {
    $data[] = $row;
    }
	echo json_encode($data);
	flush();
	exit;
}
if (isset($_GET['term'])){
require '../../include/koneksi.php'; 
$pilih = $db->prepare("SELECT DISTINCT nip FROM e_cuti where nip like :term");
$pilih->execute(array('term' => $_GET['term'].'%'));
$return_arr = array();
while($row = $pilih->fetch()) {
    $return_arr[] =  $row['nip'];
    }
echo json_encode($return_arr);
	}