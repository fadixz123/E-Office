<?php
require '../../include/koneksi.php'; 
$kode=isset($_GET['kode'])?$_GET['kode']:'';
$pilih = $db->prepare('SELECT * FROM e_surat_keluar where nomor_surat=?');
$pilih->bindValue(1, $kode, PDO::PARAM_STR);
$pilih->execute();
$row = $pilih->fetch(PDO::FETCH_BOTH);
?>
<div class="row" style="width:700px">
    <form id="form-edit-outbox" enctype="multipart/form-data">>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="tanggal" class="">Tanggal</label>
				<input type="text" id="tanggal-keluar" value="<?php echo $row['tanggal']; ?>" name="tanggal-keluar" class="form-control" readonly="readonly"/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="nosurat" class="">No. Surat</label>
				<input type="text" name="nosurat-keluar" id="nosurat-keluar" value="<?php echo $row['nomor_surat']; ?>" class="form-control" readonly="readonly"/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="pengirim" class="">Pengirim</label>
				<input type="text" name="pengirim-keluar" value="<?php echo $row['pengirim']; ?>" id="pengirim-keluar" class="form-control"/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="perihal" class="">Perihal</label>
				<input type="text" name="perihal-keluar" id="perihal-keluar" value="<?php echo $row['perihal']; ?>" class="form-control"/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="penjelasan" class="">Penjelasan</label>
				<textarea type="text" name="penjelasan-keluar" id="penjelasan-keluar" class="form-control"><?php echo $row['keterangan']; ?></textarea>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="masuk" class="">Masuk</label>
				<input type="text" name="penerima-keluar" id="penerima-keluar" value="<?php echo $row['penerima']; ?>" class="form-control"/>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="input-group">
				<label class="input-group-btn">
					<span class="btn btn-primary">
						Pilih&hellip; <input id="file" name='file' type="file" style="display: none;">
					</span>
				</label>
				<input type="text" class="form-control" readonly>
			</div>
			<span class="text-danger error"><i class="help-block"></i>Pilih file dengan format png, jpg, jpeg.</span>
		</div>
	</form>
</div>
<script>
$(function(){
	$(document).on('change', ':file', function() {
	var input = $(this),
	numFiles = input.get(0).files ? input.get(0).files.length : 1,
	label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [numFiles, label]);
	
  });
	  $(':file').on('fileselect', function(event, numFiles, label) {

		  var input = $(this).parents('.input-group').find(':text'),
			  log = numFiles > 1 ? numFiles + ' files selected' : label;

		  if( input.length ) {
			  input.val(log);
		  } else {
			  if( log ) alert(log);
		  }

	  });
});
</script>
	