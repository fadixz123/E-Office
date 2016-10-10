<?php
if (isset($_GET['term'])){
require '../../include/koneksi.php'; 
$pilih = $db->prepare("SELECT DISTINCT meta_key, meta_value FROM wordpress.wp_usermeta where meta_key='jabatan' and meta_value like :term");
$pilih->execute(array('term' => $_GET['term'].'%'));
$return_arr = array();
while($row = $pilih->fetch()) {
    $return_arr[] =  $row['meta_value'];
    }
echo json_encode($return_arr);
exit;
	}
require '../../include/koneksi.php'; 
$kode=isset($_GET['kode'])?$_GET['kode']:'';
$pilih = $db->prepare('SELECT * FROM e_surat_keluar where nomor_surat=?');
$pilih->bindValue(1, $kode, PDO::PARAM_STR);
$pilih->execute();
$row = $pilih->fetch(PDO::FETCH_BOTH);


?>
<div class="row edit" style="width:700px">
    <form id="form-disposisi">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="nosurat" class="">No. Surat</label>
				<input type="text" name="nosurat" id="nosurat" value="<?php echo $row['nomor_surat']; ?>" class="form-control" readonly="readonly"/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="tanggal-disposisi" class="">Tanggal Disposisi</label>
				<input type="text" id="tanggal-disposisi" value="<?php echo $row['tanggal_disposisi']; ?>" name="tanggal-disposisi" class="form-control tanggal" />
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="tujuan-disposisi" class="">Tujuan Disposisi</label>
				<input type="text" name="tujuan-disposisi" value="<?php echo $row['tujuan_disposisi']; ?>" id="tujuan-disposisi" class="form-control"/>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="isi-disposisi" class="">Isi Disposisi</label>
				<textarea type="text" name="isi-disposisi" id="isi-disposisi" class="form-control"><?php echo $row['isi_disposisi']; ?></textarea>
			</div>
			<i class="error text-danger"></i>

	</form>
</div>
<script>
$(function(){
$(".tanggal").datepicker({dateFormat: 'dd MM yy' });
});
</script>
	