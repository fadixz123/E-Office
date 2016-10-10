<?php

require_once '../../include/koneksi.php'; 
require_once('../../../wp-load.php' );

if (isset($_GET['term'])){
$pilih = $db->prepare("SELECT DISTINCT user_role FROM e_user where user_role like :term");
$pilih->execute(array('term' => $_GET['term'].'%'));
$return_arr = array();
while($row = $pilih->fetch()) {
    $return_arr[] =  $row['user_role'];
    }
echo json_encode($return_arr);
exit;
	}

$kode=isset($_GET['kode'])?$_GET['kode']:'';
$pilih = $db->prepare('SELECT * FROM e_surat_masuk where nomor_surat=?');
$pilih->bindValue(1, $kode, PDO::PARAM_STR);
$pilih->execute();
$row = $pilih->fetch(PDO::FETCH_BOTH);

// Cek peranan
$user_role = $db->query('select user_role from e_user where user_id="'.(int)get_current_user_id().'" limit 1');
$user_role = $user_role ? $user_role->fetchObject()->user_role : null;
$dispo = array(
	'status'	=> '',
	'tanggal'	=> '',
	'keterangan'	=> ''
);

if ($user_role === 'kadin') {
	if ($row['disposisi_kadin']) $dispo = array_merge($dispo, unserialize($row['disposisi_kadin']));
}
else if ($user_role === 'kabid') {
	if ($row['disposisi_kabid']) $dispo = array_merge($dispo, unserialize($row['disposisi_kabid']));
}
else exit("Pastikan Anda memiliki hak untuk tindakan ini");




?>
<div class="row edit" style="width:700px">
    <form id="form-disposisi">
		<div class="col-sm-12">
			<div class="form-group">
				<label for="nosurat" class="">No. Surat</label>
				<input type="text" name="nosurat" id="nosurat" value="<?php echo @$row['nomor_surat']; ?>" class="form-control" readonly="readonly"/>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="tanggal-disposisi" class="">Tanggal Disposisi</label>
				<input type="text" id="tanggal-disposisi" value="<?php echo $dispo['tanggal']; ?>" name="tanggal-disposisi" class="form-control tanggal" />
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="disposisi-status-terima" class="col-sm-2">
					<input id="disposisi-status-terima" type="radio" name="disposisi_status" class="form-control" value="terima" <?php
						echo $dispo['status'] === 'terima' ? 'checked' : ''
					?>>
					Terima
				</label>
				<label for="disposisi-status-tolak" class="col-sm-2">
					<input id="disposisi-status-tolak" type="radio" name="disposisi_status" class="form-control" value="tolak" <?php
						echo $dispo['status'] === 'tolak' ? 'checked' : ''
					?>>
					Tolak
				</label>
				<label for="tanggal-disposisi-lain" class="">
					<input type="radio" name="disposisi_status" class="form-control" value="tinjau" <?php
						echo $dispo['status'] === 'tinjau' ? 'checked' : ''
					?>>
					Lainnya
				</label>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="keterangan" class="">Keterangan</label>
				<textarea type="text" name="keterangan" id="keterangan" class="form-control"><?php echo $dispo['keterangan']; ?></textarea>
			</div>
		</div>
		<i class="error text-danger"></i>
		<input type="hidden" name="form-data-disposisi" value="1"/>
	</form>
</div>
<script>
$(function(){
$(".tanggal").datepicker({dateFormat: 'dd MM yy' });
});
</script>
	