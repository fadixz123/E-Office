function load_data(){
	var oTable = $('#example2').dataTable();
	$.ajax({
		url: 'data/surat-masuk/ambil.php',
		dataType: 'json',
		success: function(s){
				oTable.fnClearTable();
			for(var i = 0; i < s.length; i++) 
				{ 
				oTable.fnAddData([s[i][0], s[i][1], s[i][2], s[i][3],s[i][4],s[i][5] ]);
					} // End For	
			}, 
			error: function(e){ console.log(e.responseText);} 
		}); 
}

function tambah_data(){
	var form_data = new FormData($("#form-tambah")[0]);
	$(".button-tambah").html("<i class='fa fa-refresh fa-spin'></i> Loading");
		$.ajax({
		method: "POST",
		url: "data/surat-masuk/tambah.php",
		data: form_data,
		cache: true,
		contentType: false,
		processData: false,
		success: function(msg){
		if(msg!=='1'){
			$(".button-tambah").text("Tambah");
			$(".error").addClass('glyphicon glyphicon-info-sign');
			$(".error").text(" "+msg);
		}else{
			$(".error").removeClass('glyphicon glyphicon-info-sign');
			$(".error").text(" ");
			tutup_dialog();
			load_data();
		}
		
		},
		error: function(){

		}
	});
}


