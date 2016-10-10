function fetch_outbox(){
	var outTable = $('#tabel-outbox').dataTable();
	$.ajax({
		url: 'data/surat-keluar/ambil.php',
		dataType: 'json',
		success: function(s){
				outTable.fnClearTable();
			for(var i = 0; i < s.length; i++) 
				{ 
				outTable.fnAddData([s[i][0], s[i][1], s[i][2], s[i][3],s[i][5],s[i][6],s[i][7] ]);
					} // End For	
			}, 
			error: function(e){ console.log(e.responseText);} 
		}); 
}
function tambah_outbox(){
	var form_data = new FormData($("#tambah-outbox-form")[0]);
	$(".button-tambah-outbox").html("<i class='fa fa-refresh fa-spin'></i> Loading");
		$.ajax({
		method: "POST",
		url: "data/surat-keluar/tambah.php",
		data: form_data,
		cache: true,
		contentType: false,
		processData: false,
		success: function(msg){
		if(msg!="berhasil"){
			$(".button-tambah-outbox").text("Tambah");
			$(".error").addClass('glyphicon glyphicon-info-sign');
			$(".error").text(" "+msg);
		}else{
			$(".error").removeClass('glyphicon glyphicon-info-sign');
			$(".error").text(" ");
			tutup_dialog();
			fetch_outbox();
		}
		
		},
		error: function(){

		}
	});
}
