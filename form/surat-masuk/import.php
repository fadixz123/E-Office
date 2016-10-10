<?php 
require '../../include/koneksi.php'; 
try{
	$pilih = $db->query('SELECT tanggal FROM e_surat_masuk order by tanggal desc');
	$opsi='';
	while($row = $pilih->fetch(PDO::FETCH_BOTH)) {
		$opsi.= "<option>".$row['tanggal']."</option>";
	}
}catch(PDOException $ex){
	echo "Kesalahan".$ex->getMessage();
}
 ?>
<div class="row tambah" style="width:350px">
    <form id="form-print">
        <div class="col-sm-12">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
						<form id="import-csv">
                        Pilih&hellip; <input id="csv" name='csv' type="file" style="display: none;" enctype="multipart/form-data">
						</form>
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div>
            <span class="help-block">
                Pilih file dengan format CSV untuk mengimport data ke arsip database.
            </span>
        </div>
    </form>
</div>
<script>
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
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
  
});
</script>