<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'konfig.php';

$admintitle = "Managemen Pengguna";

include 'header.php';
if($akses!='administrator'){echo("Anda tidak memiliki hak akses halaman ini. Silahkan hubungi administrator jika ini merupakan kesalahan! <a style='text-decoration:none;color:green' href='http://localhost/wordpress'> <<< Kembali Ke Beranda</a>");exit;}
?>
<div data-title="<?php echo $admintitle; ?>">

        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo "Data Pengguna" ?></h3>
                <div class="pull-right box-tools">
					<button class="btn btn-info btn-sm"  id="import-pegawai" title="" ><i class="fa  fa-file-excel-o"> Import</i></button>
                    <button class="btn btn-info btn-sm"  id="tambah-pegawai" title="" ><i class="fa fa-file-text-o"> Tambah</i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ciutkan">
                        <i class="fa fa-minus"></i></button>

                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
				<div class="table-responsive">
					<table id="tabel-pegawai" class="table stripe table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Email</th>
								<th>Hak Akses</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
            </div>
        </div>
 </div>
 <script>
 $(function(){
	
	function fetch_pegawai(){
		var outTable = $('#tabel-pegawai').dataTable();
	$.ajax({
		url: 'data/pegawai/ambil.php',
		dataType: 'json',
		success: function(s){
			
				outTable.fnClearTable();
				var no=1;
			for(var i = 0; i < s.length; i++) 
				{ 
				outTable.fnAddData([no, s[i][1], s[i][2], s[i][3],s[i][4], "<center><a kode='"+s[i][0]+"' href='data/pegawai/edit.php?edit="+s[i][0]+"' id='edit-pegawai'><i class='glyphicon glyphicon-edit'></i></a> <a id='hapus-pegawai' kode='"+s[i][0]+"' href='data/pegawai/hapus.php?kode="+s[i][0]+"'><i class='glyphicon glyphicon-trash'></i></a></center>" ]);
				no++;
				} // End For
			outTable.fnSort( [ [5,'desc'] ] );
			}, 
			error: function(e){ console.log(e.responseText);} 
		}); 
	} 
	 fetch_pegawai();
		$('#tabel-pegawai').on('click', 'a#edit-pegawai', function (e) {
			e.preventDefault();
			kode = $(this).attr("kode");
			$.ajax({
				url:"form/pegawai/edit.php?kode="+kode+"",
				success: function(msg){
					dialog("<i class='text-info glyphicon glyphicon-info-sign'> Edit Data</i>",msg);
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
									  'class':'btn btn-info button-edit-pegawai',
									  click: function() {
											data=$("#form-edit-ijin").serialize();
											$(".button-edit-pegawai").html("<i class='fa fa-refresh fa-spin'></i> Loading");
											$.ajax({
												url:"data/pegawai/edit.php",
												method: "POST",
												data:data,
												success: function(msg){
													$(".button-edit-pegawai").html("Update");
													$(".error").html(msg);
													if(msg=="berhasil"){
													$( "#dialog" ).dialog( "close" );
													$( "#dialog" ).on( "dialogclose", function( event, ui ) {
														fetch_pegawai();
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
		$("#tambah-pegawai").click(function(){
			$.ajax({
				url: 'form/pegawai/tambah.php',
				success: function(s){
					dialog("<span class='text-info'><i class='glyphicon glyphicon-info-sign'></i> Tambah Data</span>",s);
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
									  'class':'btn btn-info button-tambah-pegawai',
									  click: function() {
										  var data=$("#form-tambah-pegawai").serialize();
											$(".button-tambah-pegawai").html("<i class='fa fa-refresh fa-spin'></i> Loading");
												$.ajax({
												method: "POST",
												url: "data/pegawai/tambah.php",
												data: data,
												success: function(msg){
													alert(msg)
												if(msg!="berhasil"){
													$(".button-tambah-pegawai").text("Tambah");
													$(".error").addClass('glyphicon glyphicon-info-sign');
													$(".error").text(" "+msg);
												}else{
													$(".error").removeClass('glyphicon glyphicon-info-sign');
													$(".error").text(" ");
													tutup_dialog();
													fetch_pegawai();
												}
												
												},
												error: function(){

												}
											});
									  }
									}
						]
					});
				}
			});
		});
		$('#tabel-pegawai').on('click', 'a#hapus-pegawai', function (e) {
			e.preventDefault();
			kode = $(this).attr("kode");
			dialog("<i class='text-warning glyphicon glyphicon-info-sign'> Peringatan</i>","Apakah Anda serius akan menghapus user dengan id <b>"+kode+"</b>?");
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
									  'class':'btn btn-info button-hapus-pegawai',
									  click: function() {
											$(".button-hapus-pegawai").html("<i class='fa fa-refresh fa-spin'></i> Loading");
											$.ajax({
												url:"data/pegawai/hapus.php?id="+kode+"",
												method: "POST",
												success: function(msg){
												$( "#dialog" ).dialog( "close" );
												$( "#dialog" ).on( "dialogclose", function( event, ui ) {
													fetch_pegawai();
												});
												},
												error: function(e){ alert(e.responseText);} 
											});
									  }
									}
						]
					});
		});
		$("#import-pegawai").click(function(){
			$.ajax({
				url:'form/pegawai/import.php',
				success:function(msg){
					dialog("<span class='text-info'><i class='glyphicon glyphicon-info-sign'></i> Import Data</span>",msg);
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
									  'class':'btn btn-info button-import-pegawai',
									  click: function() {
											var file_data = $('#csv').prop('files')[0];   
											var form_data = new FormData();
											form_data.append('file', file_data);
											$(".button-import-pegawai").html("<i class='fa fa-refresh fa-spin'></i> Loading");
											$.ajax({
												url: 'data/pegawai/import.php',
												method: 'post',
												dataType: 'text',
												cache: false,
												contentType: false,
												processData: false,
												data: form_data,
												success: function(msg){
													if(msg!="berhasil"){
													$(".button-import-pegawai").text("Import");
													$(".help-block").addClass('glyphicon glyphicon-info-sign');
													$(".help-block").html(" "+msg);
												}else{
													$(".help-block").removeClass('glyphicon glyphicon-info-sign');
													$(".help-block").text(" ");
													tutup_dialog();
													fetch_pegawai();
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

<?php include 'footer.php'; ?>



