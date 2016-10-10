<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'konfig.php';

$admintitle = "Import Surat Masuk";
require 'include/koneksi.php';
include 'header.php';
if($akses!='pegawai'){echo("Anda tidak memiliki hak akses halaman ini. Silahkan hubungi administrator jika ini merupakan kesalahan! <a style='text-decoration:none;color:green' href='http://localhost/wordpress'> <<< Kembali Ke Beranda</a>");exit;}
?>
<div data-title="<?php echo $admintitle; ?>">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Import Surat Masuk</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ciutkan">
                        <i class="fa fa-minus"></i></button>

                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
<div class="row import" style="width:350px">
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
			<button id="import-outbox" type="submit" class="btn btn-info">Import</button>
        </div>
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
  
									$("#import-outbox").click(function(){
										var file_data = $('#csv').prop('files')[0];   
											var form_data = new FormData();
											form_data.append('file', file_data);
											$(this).html("<i class='fa fa-refresh fa-spin'></i> Loading");
											$.ajax({
												url: 'data/surat-keluar/import.php',
												method: 'post',
												dataType: 'text',
												cache: false,
												contentType: false,
												processData: false,
												data: form_data,
												success: function(msg){
													$("#import-outbox").html("Import");
													if(msg.toLowerCase().indexOf("berhasil") >= 0){
														$(".help-block").html("<i class='text-info glyphicon glyphicon-info-sign'> Berhasil menambahkan data ke dalam database.</i>")
														document.location.href='outbox.php';
														
													}
													else{
														$(".help-block").html(msg)
													}
												},
												error:function(er){
													alert(er.responseText)
												}
											});
			
		});
  
});
</script>
            </div>
        </div>
        <!-- /.box -->




    </div>

<?php include 'footer.php'; ?>



