<div class="row tambah" style="width:700px">
    <form id="form-tambah">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="tanggal" class="">Tanggal Surat</label>
				<input type="hidden" class="form-control" autofocus="true"  />
				<input type="text" id="tanggal" name="tanggal" class="form-control tanggal" />
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="tanggal-masuk" class="">Tanggal Masuk</label>
				<input type="text" id="tanggal-masuk" name="tanggal-masuk" class="form-control tanggal" />
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="nosurat" class="">No. Surat</label>
				<input type="text" name="nosurat" id="nosurat" class="form-control"/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="pengirim" class="">Pengirim</label>
				<input type="text" name="pengirim" id="pengirim" class="form-control"/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="perihal" class="">Perihal</label>
				<input type="text" name="perihal" id="perihal" class="form-control"/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="penjelasan" class="">Penjelasan</label>
				<textarea type="text" name="penjelasan" id="penjelasan" class="form-control"></textarea>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="input-group">
				<label class="input-group-btn">
					<span class="btn btn-primary">
						Pilih&hellip; <input id="file" name="file" type="file" style="display:none">
					</span>
				</label>
				<input type="text" class="form-control" readonly>
				<input type="hidden" name="tambah-data-surat-masuk" value="1">
			</div>
			<span class="text-danger error"><i class="help-block"></i>Pilih file dengan format png, jpg, jpeg.</span>
		</div>
	</form>
</div>
<script>
$(function(){
	$(".tanggal").datepicker({dateFormat: 'yy-mm-dd' });
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