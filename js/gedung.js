function fetch_gedung(){
	var outTable = $('#tabel-gedung').dataTable();
	$.ajax({
		url: 'data/gedung/ambil.php',
		dataType: 'json',
		success: function(s){
				outTable.fnClearTable();
			for(var i = 0; i < s.length; i++) 
				{ 
				outTable.fnAddData([s[i][0], s[i][1], s[i][2], s[i][3],s[i][4],s[i][5],s[i][6] ]);
				} // End For
			outTable.fnSort( [ [5,'desc'] ] );
			}, 
			error: function(e){ console.log(e.responseText);} 
		}); 
}
function tambah_gedung(){
	var data=$("#form-tambah-gedung").serialize();
	$(".button-tambah-gedung").html("<i class='fa fa-refresh fa-spin'></i> Loading");
		$.ajax({
		method: "POST",
		url: "data/gedung/tambah.php",
		data: data,
		success: function(msg){
		if(msg!="berhasil"){
			$(".button-tambah-gedung").text("Tambah");
			$(".error").addClass('glyphicon glyphicon-info-sign');
			$(".error").text(" "+msg);
		}else{
			$(".error").removeClass('glyphicon glyphicon-info-sign');
			$(".error").text(" ");
			tutup_dialog();
			fetch_gedung();
		}
		
		},
		error: function(){

		}
	});
}


    $(function () {
        fetch_gedung();
		$("#tambah-gedung").click(function(){
			$.ajax({
				url: 'form/gedung/tambah.php',
				success: function(s){
					dialog("<i class='text-info glyphicon glyphicon-info-sign'> Tambah Data</i>",s);
					auto("#nip","data/ijin/auto-nip.php");
					auto("#nama-pegawai","data/ijin/auto-nama.php");
					auto("#jabatan","data/ijin/auto-jabatan.php");
					auto("#masuk-keluar","data/ijin/auto-penerima.php");
					$("#nip").keyup(function(){
						var nip =$(this).val(); 
						$.ajax({
							url:"data/ijin/auto-nip.php?nip="+nip,
							dataType: 'json',
							success: function(msg){
								if(nip=="" || msg.length == 0){
									$("#nama-pegawai").val("")
									$("#jabatan").val("")
								}
								else{
									$("#nama-pegawai").val(msg[0][3]);
									$("#jabatan").val(msg[0][4]);
								}
							},
							error: function(s){
								alert(s)
							}
						});
					});
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
									  'class':'btn btn-info button-tambah-gedung',
									  click: function() {
										  tambah_gedung();
									  }
									}
						]
					});
				}
			});
		});
		$('#tabel-gedung').on('click', 'a#hapus-gedung', function (e) {
			e.preventDefault();
			kode = $(this).attr("kode");
			dialog("<i class='text-warning glyphicon glyphicon-info-sign'> Peringatan</i>","Apakah Anda serius akan menghapus arsip dengan nomor id <b>"+kode+"</b>?");
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
									  'class':'btn btn-info button-hapus-gedung',
									  click: function() {
											$.ajax({
												url:"data/gedung/hapus.php?kode="+kode+"",
												method: "POST",
												success: function(msg){
												$( "#dialog" ).dialog( "close" );
												$( "#dialog" ).on( "dialogclose", function( event, ui ) {
													fetch_gedung();
												});
												},
												error: function(e){ alert(e.responseText);} 
											});
									  }
									}
						]
					});
		});
		$('#tabel-gedung').on('click', 'a#edit-gedung', function (e) {
			e.preventDefault();
			kode = $(this).attr("kode");
			
			$.ajax({
				url:"form/gedung/edit.php?edit="+kode+"",
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
									  'class':'btn btn-info button-edit-gedung',
									  click: function() {
											data=$("#form-edit-gedung").serialize();
											$(".button-gedung-ijin").html("<i class='fa fa-refresh fa-spin'></i> Loading");
											$.ajax({
												url:"data/gedung/edit.php",
												method: "POST",
												data:data+'&id='+kode,
												success: function(msg){
												$(".error").addClass('glyphicon glyphicon-info-sign');
												$(".error").text(" "+msg);
												if(msg=="berhasil"){
													$(".error").removeClass('glyphicon glyphicon-info-sign');
													$(".error").text("");
													$( "#dialog" ).dialog( "close" );
												$( "#dialog" ).on( "dialogclose", function( event, ui ) {
													fetch_gedung();
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
		
		$('#tabel-gedung').on('click', 'a#tindakan', function (e) {
			e.preventDefault();
			kode = $(this).attr("tindakan");
			
			$.ajax({
				url:"form/gedung/tindakan.php?kode="+kode+"",
				success: function(msg){
					dialog("<i class='text-info glyphicon glyphicon-info-sign'> Tindakan Pimpinan</i>",msg);
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
									  'class':'btn btn-info button-edit-tindakan',
									  click: function() {
											data=$("#form-edit-tindakan").serialize();
											$(".button-edit-tindakan").html("<i class='fa fa-refresh fa-spin'></i> Loading");
											$.ajax({
												url:"data/gedung/edit.php?tindakan",
												method: "POST",
												data:data+'&id='+kode,
												success: function(msg){
												$(".button-edit-tindakan").html("Update");
												$(".error").addClass('glyphicon glyphicon-info-sign');
												$(".error").text(" "+msg);
												if(msg=="berhasil"){
													$(".error").removeClass('glyphicon glyphicon-info-sign');
													$(".error").text("");
													$( "#dialog" ).dialog( "close" );
												$( "#dialog" ).on( "dialogclose", function( event, ui ) {
													fetch_gedung();
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
		
		$("#print-gedung").click(function(){
			$.ajax({
				url:'form/gedung/print.php',
				success:function(msg){
					dialog("<i class='text-info glyphicon glyphicon-info-sign'> Print</i>",msg);
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
											window.open('data/gedung/cetak.php?'+data,'_blank');
											tutup_dialog();
									  }
									}
						]
					});
				},
				error: function(e){ alert(e.responseText);} 
			})
			
		});
		$("#import-gedung").click(function(){
			$.ajax({
				url:'form/gedung/import.php',
				success:function(msg){
					dialog("<i class='text-info glyphicon glyphicon-info-sign'> Import Data</i>",msg);
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
												url: 'data/gedung/import.php',
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