<?php
print_r($_POST);

require '../../include/koneksi.php';
$tanggal=isset($_GET['tanggal-keluar'])?$_GET['tanggal-keluar']:'';
$nosurat=isset($_GET['nosurat-keluar'])?$_GET['nosurat-keluar']:'';
$pengirim=isset($_GET['pengirim-keluar'])?$_GET['pengirim-keluar']:'';
$perihal=isset($_GET['perihal-keluar'])?$_GET['perihal-keluar']:'';
$penjelasan=isset($_GET['penjelasan-keluar'])?$_GET['penjelasan-keluar']:'';
$masuk=isset($_GET['penerima-keluar'])?$_GET['penerima-keluar']:'';
$target_dir = "file/";
$nama=isset($_FILES["file"]["name"])?$_FILES["file"]["name"]:'';
$error=isset($_FILES['file']['error'])?$_FILES['file']['error']:'';
$target_file = $target_dir . basename($nama);
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
function clean($string){
	$string = str_replace('/', '-', $string);
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}
$gambar =clean($nosurat);
if(empty($tanggal)){
	echo 'Kolom tanggal tidak boleh kosong!';
}
else if(empty($nosurat)){
	echo 'Kolom No. Surat tidak boleh kosong!';
}
else if(empty($pengirim)){
	echo 'Kolom pengirim tidak boleh kosong!';
}
else if(empty($perihal)){
	echo 'Kolom Perihal tidak boleh kosong!';
}
else if(empty($penjelasan)){
	echo 'Kolom Keterangan tidak boleh kosong!';
}
else if(empty($masuk)){
	echo 'Kolom Masuk tidak boleh kosong!';
}
else if (empty($_FILES) ) {
     echo "Silahkan pilih gambar!";
}
else if($error){
	echo "Gambar tidak bisa diupload. Silahkan pilih yang lain!";
}
else if($FileType != "png" && $FileType != "jpg" && $FileType != "jpeg"){
	echo $nama." bukan file jpg, jpeg, atau png.";
}
else{
	try{
	$cek= $db->prepare("select nomor_surat from e_surat_keluar where nomor_surat=? limit 1");
	$cek->execute(array($nosurat));
	if(!$cek->rowCount()>0){
		if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$gambar.'.jpg')){
			$sql="INSERT INTO e_surat_keluar (tanggal, nomor_surat, perihal, pengirim, penerima, keterangan, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($tanggal, $nosurat, $perihal, $pengirim, $masuk, $penjelasan, $gambar));
			echo "berhasil";
		}
		else {
			echo "Gambar gagal diupload";
		}
	}
	else{
		echo "Arsip dengan kode ".$nosurat." sudah ada dalam database";
	}
		}catch(PDOException $ex){echo $sql." Gagal menambahkan ke database dengan kode kesalahan ".$ex->getMessage();}
}