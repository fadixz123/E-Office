function fetch_sekolah(){
	var outTable = $('#tabel-sekolah').dataTable();
	$.ajax({
		url: 'data/sekolah/ambil.php',
		dataType: 'json',
		success: function(s){
				outTable.fnClearTable();
			for(var i = 0; i < s.length; i++) 
				{ 
				outTable.fnAddData([s[i][0], s[i][1], s[i][2], s[i][3],s[i][4],s[i][5],s[i][6]]);
				} // End For
			outTable.fnSort( [ [5,'desc'] ] );
			}, 
			error: function(e){ console.log(e.responseText);} 
		}); 
}
function tambah_sekolah(){
	var data=$("#form-tambah-sekolah").serialize();
	$(".button-tambah-sekolah").html("<i class='fa fa-refresh fa-spin'></i> Loading");
		$.ajax({
		method: "POST",
		url: "data/sekolah/tambah.php",
		data: data,
		success: function(msg){
		if(msg!="berhasil"){
			$(".button-tambah-sekolah").text("Tambah");
			$(".error").html(" "+msg);
		}else{
			$(".error").html(" ");
			tutup_dialog();
			fetch_sekolah();
		}
		
		},
		error: function(){

		}
	});
}
