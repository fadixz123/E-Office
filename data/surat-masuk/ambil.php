 <?php
require '../../include/koneksi.php';
require('../../../wp-load.php' );
global $user;
$user 			= wp_get_current_user();
$akses			= $user->roles[0];
$menu			="";
$pilih 			= $db->query('SELECT * FROM e_surat_masuk order by tanggal desc');
	while($row = $pilih->fetch(PDO::FETCH_BOTH)) {
		$menu = '<center>';
		$gambar = md5($row['nomor_surat']).'.jpg';

		if(is_file('file/'.$gambar)){
			$menu .= "<a data-lihat='"
				. $row['gambar']
				. "' title='Surat Nomor "
				. $row['nomor_surat']
				. "' rel='gallery' href='data/surat-masuk/file/"
				. $gambar
				. "' id='lihat'><i class='glyphicon glyphicon-eye-open'></i> </a>";
		}

		// Data disposisi
		// $var['status'], $var['tanggal'], $var['keterangan']
		// atau kosong
		$disposisi_kadin = $row['disposisi_kadin'] ? unserialize($row['disposisi_kadin']) : null;
		$disposisi_kabid = $row['disposisi_kabid'] ? unserialize($row['disposisi_kabid']) : null;
		$ds_kadin = $disposisi_kadin && $disposisi_kadin['status'] !== 'tinjau';
		$ds_kabid = $disposisi_kabid && $disposisi_kabid['status'] !== 'tinjau';

		if($akses=='pegawai'){

			// Menu ditampilkan jika belum diterima Kadin/Kabid atau distatuskan lain
			if (!($ds_kadin || $ds_kabid)) {
				$menu .= " <a data-edit='"
				. $row['nomor_surat']
				. "' href='data/surat-masuk/edit.php?edit="
				. $row['nomor_surat']
				. "' id='edit'><i class='glyphicon glyphicon-edit'></i></a>";
			}

			// Menu ditampilkan jika belum diterima Kadin/Kabid
			if (!($disposisi_kadin || $disposisi_kabid)) {
				$menu .= " <a id='hapus' data-hapus='"
					. $row['nomor_surat']
					. "' href='data/surat-masuk/hapus.php?kode="
					. $row['nomor_surat']
					. "'><i class='glyphicon glyphicon-trash'></i></a>";
			}
		}
		else if($akses=='kadin'||('kabid'===$akses && $row['disposisi_kadin'])){
			$menu .= " <a data-disposisi='".$row['nomor_surat']."' href='data/surat-masuk/edit.php?disposisi=".$row['nomor_surat']."' id='disposisi'><i class='fa fa-legal'></i></a>";
		}
		$menu .= '</center>';

		$status = '';
		$keterangan = "== Detail Disposisi ==";
		if ($disposisi_kadin) {
			$status = 'Telah di'.$disposisi_kadin['status'].' Kadin';
			$keterangan .= "\n[Kadin, ".$disposisi_kadin['tanggal']."] \n".$disposisi_kadin['keterangan'];
		}

		if ($disposisi_kabid) {
			$status .= ($status ? ' dan ' : 'Telah ') . 'di'.$disposisi_kabid['status'].' Kabid';
			$keterangan .= "\n[Kabid, ".$disposisi_kabid['tanggal']."] \n".$disposisi_kabid['keterangan'];
		}
		if ($status) {
			$status = '<span style="cursor:pointer" title="'.htmlspecialchars($keterangan."\n").'" onclick="alert(this.title)">'.$status.'</span>';
		}

		/*
		$disposisi = "";
		if(!empty($row['tanggal_disposisi'])&&$row['tanggal_disposisi']!='-'){
			$disposisi="<i class='glyphicon glyphicon-send'></i> ".$row['tujuan_disposisi']."<br><i class='glyphicon glyphicon-list-alt'></i> ".$row['isi_disposisi']."<br><i class='glyphicon glyphicon-time'></i> ".$row['tanggal_disposisi'];
		}
		*/
    $data[]=array($row['tanggal_masuk'],$row['nomor_surat'],$row['perihal'],$row['pengirim'],$status,$menu);
	}
echo json_encode($data);

