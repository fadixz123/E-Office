<?php
require '../../include/koneksi.php';
require('../../../wp-load.php' );
global $user;
$user 			= wp_get_current_user();
$akses= $user->roles[0];
$menu="";
$label='';
$pilih = $db->query('SELECT * FROM e_gedung order by tanggal desc');
	while($row = $pilih->fetch(PDO::FETCH_BOTH)) {
		if($akses=='pegawai'){
			$menu="<center><a kode='".$row['id']."' href='data/gedung/edit.php?edit=".$row['id']."' id='edit-gedung'><i class='glyphicon glyphicon-edit'></i></a> <a id='hapus-gedung' kode='".$row['id']."' href='data/gedung/hapus.php?kode=".$row['id']."'><i class='glyphicon glyphicon-trash'></i></a></center>";
		}
		else if($akses=='kadin'){
			$menu="<center><a tindakan='".$row['id']."' href='data/gedung/edit.php?ijin=".$row['id']."' id='tindakan'><i class='glyphicon glyphicon-edit'></i> ".$row['status']."</a></center>";
		}
		else{
			$menu='Read Only';
		}
    $data[]=array($row['tanggal'],$row['mulai'].' s/d '.$row['selesai'],$row['tempat'],$row['pelaksana'],$row['keperluan'],$row['keterangan'],$menu);
	}
echo json_encode($data);