<?php
if(isset($_GET['npsn']) && isset($_GET['term'])){
	require '../../include/koneksi.php'; 
	$pilih = $db->prepare("SELECT DISTINCT npsn FROM e_sekolah where npsn like :term");
	$pilih->execute(array('term' => $_GET['term'].'%'));
	$return_arr = array();
	while($row = $pilih->fetch()) {
		$return_arr[] =  $row['npsn'];
		}
	echo json_encode($return_arr);
}

if(isset($_GET['alamat']) && isset($_GET['term'])){
	require '../../include/koneksi.php'; 
	$pilih = $db->prepare("SELECT DISTINCT alamat_jalan FROM e_sekolah where alamat_jalan like :term");
	$pilih->execute(array('term' => $_GET['term'].'%'));
	$return_arr = array();
	while($row = $pilih->fetch()) {
		$return_arr[] =  $row['alamat_jalan'];
		}
	echo json_encode($return_arr);
}
	
if(isset($_GET['jenjang']) && isset($_GET['term'])){
	require '../../include/koneksi.php'; 
	$pilih = $db->prepare("SELECT DISTINCT jenjang FROM e_sekolah where jenjang like :term");
	$pilih->execute(array('term' => $_GET['term'].'%'));
	$return_arr = array();
	while($row = $pilih->fetch()) {
		$return_arr[] =  $row['jenjang'];
		}
	echo json_encode($return_arr);
}
	
if(isset($_GET['kelurahan']) && isset($_GET['term'])){
	require '../../include/koneksi.php'; 
	$pilih = $db->prepare("SELECT DISTINCT desa_kelurahan FROM e_sekolah where desa_kelurahan like :term");
	$pilih->execute(array('term' => $_GET['term'].'%'));
	$return_arr = array();
	while($row = $pilih->fetch()) {
		$return_arr[] =  $row['desa_kelurahan'];
		}
	echo json_encode($return_arr);

}

if(isset($_GET['kecamatan']) && isset($_GET['term'])){
	require '../../include/koneksi.php'; 
	$pilih = $db->prepare("SELECT DISTINCT kec_ FROM e_sekolah where kec_ like :term");
	$pilih->execute(array('term' => $_GET['term'].'%'));
	$return_arr = array();
	while($row = $pilih->fetch()) {
		$return_arr[] =  $row['kec_'];
		}
	echo json_encode($return_arr);

}

if(isset($_GET['status']) && isset($_GET['term'])){
	require '../../include/koneksi.php'; 
	$pilih = $db->prepare("SELECT DISTINCT status_sekolah FROM e_sekolah where status_sekolah like :term");
	$pilih->execute(array('term' => $_GET['term'].'%'));
	$return_arr = array();
	while($row = $pilih->fetch()) {
		$return_arr[] =  $row['status_sekolah'];
		}
	echo json_encode($return_arr);

}

if(isset($_GET['waktu']) && isset($_GET['term'])){
	require '../../include/koneksi.php'; 
	$pilih = $db->prepare("SELECT DISTINCT waktu_penyelenggaraan FROM e_sekolah where waktu_penyelenggaraan like :term");
	$pilih->execute(array('term' => $_GET['term'].'%'));
	$return_arr = array();
	while($row = $pilih->fetch()) {
		$return_arr[] =  $row['waktu_penyelenggaraan'];
		}
	echo json_encode($return_arr);

}

if(isset($_GET['akreditasi']) && isset($_GET['term'])){
	require '../../include/koneksi.php'; 
	$pilih = $db->prepare("SELECT DISTINCT akreditasi FROM e_sekolah where akreditasi like :term");
	$pilih->execute(array('term' => $_GET['term'].'%'));
	$return_arr = array();
	while($row = $pilih->fetch()) {
		$return_arr[] =  $row['akreditasi'];
		}
	echo json_encode($return_arr);

}

if(isset($_GET['nama-bank']) && isset($_GET['term'])){
	require '../../include/koneksi.php'; 
	$pilih = $db->prepare("SELECT DISTINCT nama_bank FROM e_sekolah where nama_bank like :term");
	$pilih->execute(array('term' => $_GET['term'].'%'));
	$return_arr = array();
	while($row = $pilih->fetch()) {
		$return_arr[] =  $row['nama_bank'];
		}
	echo json_encode($return_arr);

}

if(isset($_GET['cabang-bank']) && isset($_GET['term'])){
	require '../../include/koneksi.php'; 
	$pilih = $db->prepare("SELECT DISTINCT cabang_kcp_unit FROM e_sekolah where cabang_kcp_unit like :term");
	$pilih->execute(array('term' => $_GET['term'].'%'));
	$return_arr = array();
	while($row = $pilih->fetch()) {
		$return_arr[] =  $row['cabang_kcp_unit'];
		}
	echo json_encode($return_arr);

}