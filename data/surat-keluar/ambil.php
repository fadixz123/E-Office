<?php
require '../../include/koneksi.php';
require('../../../wp-load.php' );
global $user;
$user 			= wp_get_current_user();
$akses			= $user->roles[0];
$menu			="";
$pilih 			= $db->query('SELECT * FROM e_surat_keluar order by tanggal desc');
	while($row = $pilih->fetch(PDO::FETCH_BOTH)) {
		$lihat='';
		if(!empty($row['gambar'])){
			$lihat="<a data-lihat='".$row['gambar']."' title='Surat Nomor ".$row['nomor_surat']."' rel='gallery' href='data/surat-keluar/file/".$row['gambar'].".jpg' id='lihat'><i class='glyphicon glyphicon-eye-open'></i> </a>";
		}
		if($akses=='pegawai'){
			$menu="<center>".$lihat." <a data-edit='".$row[2]."' href='data/surat-keluar/edit.php?edit=".$row[2]."' id='edit-outbox'><i class='glyphicon glyphicon-edit'></i></a> <a id='hapus-outbox' data-hapus='".$row[2]."' href='data/surat-keluar/hapus.php?kode=".$row[2]."'><i class='glyphicon glyphicon-trash'></i></a></center>";
		}
		else if($akses=='kadin'){
			$menu="<center>".$lihat." <a data-disposisi='".$row[2]."' href='data/surat-masuk/edit.php?disposisi=".$row[2]."' id='disposisi'><i class='fa fa-legal'></i></a></center>";
		}
		else{
			$menu=$lihat;
		}
		$disposisi="";
		if(!empty($row['tanggal_disposisi'])&&$row['tanggal_disposisi']!='-'){
			$disposisi="<i class='glyphicon glyphicon-send'></i> ".$row['tujuan_disposisi']."<br><i class='glyphicon glyphicon-list-alt'></i> ".$row['isi_disposisi']."<br><i class='glyphicon glyphicon-time'></i> ".$row['tanggal_disposisi'];
		}
    $data[]=array($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$disposisi,$menu);
	}
echo json_encode($data);