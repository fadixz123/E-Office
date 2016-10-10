<?php
require '../../include/koneksi.php';
require('../../../wp-load.php' );
global $user;
$user 			= wp_get_current_user();
$akses= $user->roles[0];
$menu="";
$pilih = $db->query('SELECT npsn, nama_sp, alamat_jalan, desa_kelurahan, jenjang, status_sekolah FROM e_sekolah order by nama_sp desc');
	while($row = $pilih->fetch(PDO::FETCH_BOTH)) {
		if($akses=='pegawai'){
			$menu="<center><a kode='".$row['npsn']."' href='data/sekolah/edit.php?edit=".$row['npsn']."' id='edit-sekolah'><i class='glyphicon glyphicon-edit'></i></a> <a id='hapus-sekolah' kode='".$row['npsn']."' href='data/sekolah/hapus.php?kode=".$row['npsn']."'><i class='glyphicon glyphicon-trash'></i></a></center>";
		}
		else{
			$menu='Read Only';
		}
    $data[]=array($row['npsn'],$row['nama_sp'],$row['alamat_jalan'],$row['desa_kelurahan'],$row['jenjang'],$row['status_sekolah'],$menu);
	}
echo json_encode($data);