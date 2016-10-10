<?php
require '../../include/koneksi.php';
require('../../../wp-load.php' );
global $user;
$user 			= wp_get_current_user();
$akses= $user->roles[0];
$menu="";
$pilih = $db->query('SELECT * FROM e_cuti order by mulai desc');
	while($row = $pilih->fetch(PDO::FETCH_BOTH)) {
		if($akses=='pegawai'){
			$menu="<center><a nip='".$row['id']."' href='data/ijin/edit.php?edit=".$row['id']."' id='edit-ijin'><i class='glyphicon glyphicon-edit'></i></a> <a id='hapus-ijin' nip='".$row['id']."' href='data/ijin/hapus.php?kode=".$row['id']."'><i class='glyphicon glyphicon-trash'></i></a></center>";
		}
		else if($akses=='kadin'){
			$menu="<a tindakan='".$row['id']."' href='data/ijin/edit.php?ijin=".$row['id']."' id='tindakan'><i class='glyphicon glyphicon-edit'></i> ".$row['status']."</a>";
		}
		else{
			$menu='Read Only';
		}
    $data[]=array($row['nip'],$row['nama'],$row['jabatan'],$row['perihal'],$row['mulai'],$row['berakhir'],$menu);
	}
echo json_encode($data);