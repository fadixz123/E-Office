<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'konfig.php';

$admintitle = "Satuan Pendidikan";

include 'header.php';
?>
<div data-title="<?php echo $admintitle; ?>">

        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo "Data ".$admintitle; ?></h3>
                <div class="pull-right box-tools">
					<?php if($akses=="pegawai"){ ?>
					<button class="btn btn-info btn-sm"  id="upload-sekolah" title="" ><i class="fa  fa-upload"> Upload</i></button>
                    <button class="btn btn-info btn-sm"  id="download-sekolah" title="" ><i class="fa  fa-download"> Download</i></button>
                    <button class="btn btn-info btn-sm"  id="tambah-sekolah" title="" ><i class="fa fa-file-text-o"> Tambah</i></button>
					<?php }?>
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ciutkan">
                        <i class="fa fa-minus"></i></button>

                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
				<div class="table-responsive">
					<table  id="tabel-sekolah" class="table stripe table-hover" style="overflow-x:auto">
						<thead>
							<tr>
								<th>NPSN</th>
								<th>NAMA SEKOLAH</th>
								<th>ALAMAT</th>
								<th>KELURAHAN</th>
								<th>JENJANG</th>
								<th>STATUS</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
								<th>NPSN</th>
								<th>NAMA SEKOLAH</th>
								<th>ALAMAT</th>
								<th>KELURAHAN</th>
								<th>JENJANG</th>
								<th>STATUS</th>
								<th>AKSI</th>
							</tr>
						</tfoot>
					</table>
				</div>
            </div>
        </div>
        <!-- /.box -->




    </div>




<script>
    $(function () {
        fetch_sekolah();
		$("#tambah-sekolah").click(function(){
			$.ajax({
				url: 'form/sekolah/tambah.php',
				success: function(s){
					dialog("<span class='text-info'><i class='glyphicon glyphicon-info-sign'></i>  Tambah Data</span>",s);
					auto("#npsn","data/sekolah/autocomplete.php?npsn");
					auto("#alamat","data/sekolah/autocomplete.php?alamat");
					auto("#jenjang","data/sekolah/autocomplete.php?jenjang");
					auto("#kelurahan","data/sekolah/autocomplete.php?kelurahan");
					auto("#kecamatan","data/sekolah/autocomplete.php?kecamatan");
					auto("#status","data/sekolah/autocomplete.php?status");
					auto("#waktu","data/sekolah/autocomplete.php?waktu");
					auto("#akreditasi","data/sekolah/autocomplete.php?akreditasi");
					auto("#nama-bank","data/sekolah/autocomplete.php?nama-bank");
					auto("#cabang-bank","data/sekolah/autocomplete.php?cabang-bank");

					$("#dialog").dialog({
						buttons: [
									{
									  text: "Batal",
									  'class':'btn btn-warning',
									  click: function() {
										  tutup_dialog();
									  }
									},
									{
									  text: "Kirim",
									  'class':'btn btn-info button-tambah-sekolah',
									  click: function() {
										  tambah_sekolah();
									  }
									}
						]
					});
				}
			});
		});
		$('#tabel-sekolah').on('click', 'a#hapus-sekolah', function (e) {
			e.preventDefault();
			kode = $(this).attr("kode");
			dialog("<span class='text-danger'><i class='glyphicon glyphicon-info-sign'></i> Peringatan</span>","Apakah Anda serius akan menghapus arsip dengan nomor NPSN <b>"+kode+"</b>?");
			$("#dialog").dialog({
						buttons: [
									{
									  text: "Batal",
									  'class':'btn btn-warning',
									  click: function() {
										  tutup_dialog();
									  }
									},
									{
									  text: "Betul",
									  'class':'btn btn-info button-hapus-sekolah',
									  click: function() {
											$.ajax({
												url:"data/sekolah/hapus.php?kode="+kode+"",
												method: "POST",
												success: function(msg){
												$( "#dialog" ).dialog( "close" );
												$( "#dialog" ).on( "dialogclose", function( event, ui ) {
													fetch_sekolah();
												});
												},
												error: function(e){ alert(e.responseText);} 
											});
									  }
									}
						]
					});
		});
		$('#tabel-sekolah').on('click', 'a#edit-sekolah', function (e) {
			e.preventDefault();
			kode = $(this).attr("kode");
			$.ajax({
				url:"form/sekolah/edit.php?kode="+kode+"",
				success: function(msg){
					dialog("<span class='text-info'><i class='glyphicon glyphicon-info-sign'></i> Edit Data</span>",msg);
					auto("#npsn","data/sekolah/autocomplete.php?npsn");
					auto("#alamat","data/sekolah/autocomplete.php?alamat");
					auto("#jenjang","data/sekolah/autocomplete.php?jenjang");
					auto("#kelurahan","data/sekolah/autocomplete.php?kelurahan");
					auto("#kecamatan","data/sekolah/autocomplete.php?kecamatan");
					auto("#status","data/sekolah/autocomplete.php?status");
					auto("#waktu","data/sekolah/autocomplete.php?waktu");
					auto("#akreditasi","data/sekolah/autocomplete.php?akreditasi");
					auto("#nama-bank","data/sekolah/autocomplete.php?nama-bank");
					auto("#cabang-bank","data/sekolah/autocomplete.php?cabang-bank");
					$("#dialog").dialog({
						buttons: [
									{
									  text: "Batal",
									  'class':'btn btn-warning',
									  click: function() {
										  tutup_dialog();
									  }
									},
									{
									  text: "Update",
									  'class':'btn btn-info button-edit-sekolah',
									  click: function() {
											data=$("#form-edit-sekolah").serialize();
											$(".button-edit_sekolah").html("<i class='fa fa-refresh fa-spin'></i> Loading");
											$.ajax({
												url:"data/sekolah/edit.php",
												method: "POST",
												data:data,
												success: function(msg){
												$(".error").addClass('glyphicon glyphicon-info-sign');
												$(".error").text(" "+msg);
												if(msg=="berhasil"){
													$(".error").removeClass('glyphicon glyphicon-info-sign');
													$(".error").text("");
													$( "#dialog" ).dialog( "close" );
												$( "#dialog" ).on( "dialogclose", function( event, ui ) {
													fetch_sekolah();
												});
												}
												},
												error: function(e){ alert(e.responseText);} 
											});
									  }
									}
						]
					});
				},
				error: function(e){ alert(e.responseText);} 
			});
			
			
		});
		$("#download-sekolah").click(function(){
			$.ajax({
				url:'form/sekolah/print.php',
				success:function(msg){
					dialog("<span class='text-info'><i class='glyphicon glyphicon-info-sign'></i> Download</span>",msg);
					$("#dialog").dialog({
						buttons: [
									{
									  text: "Batal",
									  'class':'btn btn-warning',
									  click: function() {
										  tutup_dialog();
									  }
									},
									{
									  text: "Print",
									  'class':'btn btn-info button-tambah',
									  click: function() {
											var data=$("#form-print").serialize();
											window.open('data/sekolah/export.php?'+data,'_blank');
											tutup_dialog();
									  }
									}
						]
					});
				},
				error: function(e){ alert(e.responseText);} 
			})
			
		});
		$("#upload-sekolah").click(function(){
			$.ajax({
				url:'form/sekolah/import.php',
				success:function(msg){
					dialog("<span class='text-info'><i class='glyphicon glyphicon-info-sign'></i> Upload Data Sekolah</span>",msg);
					$("#dialog").dialog({
						buttons: [
									{
									  text: "Batal",
									  'class':'btn btn-warning',
									  click: function() {
										  tutup_dialog();
									  }
									},
									{
									  text: "Import",
									  'class':'btn btn-info button-import-gedung',
									  click: function() {
											var file_data = $('#csv').prop('files')[0];   
											var form_data = new FormData();
											form_data.append('file', file_data);
											$(".button-import-gedung").html("<i class='fa fa-refresh fa-spin'></i> Loading");
											$.ajax({
												url: 'data/sekolah/import.php',
												method: 'post',
												dataType: 'text',
												cache: false,
												contentType: false,
												processData: false,
												data: form_data,
												success: function(msg){
													if(msg.toLowerCase().indexOf("berhasil") >= 0){
														tutup_dialog();
														$( "#dialog" ).on( "dialogclose", function( event, ui ) {
															fetch_gedung();
														});
														
													}
													else{
														$(".help-block").html(msg)
														$(".button-import-gedung").html("Import");
													}
												},
												error:function(er){
													alert(er.responseText)
												}
											});
											
									  }
									}
						]
					});
				},
				error: function(e){ alert(e.responseText);} 
			})
			
		});
    });
</script>
<?php 
//define("GREETING","Hello you! How are you today?");
//define("DIKNAS","kapan");
include 'footer.php'; ?>



