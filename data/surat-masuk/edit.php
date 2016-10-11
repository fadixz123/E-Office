<?php
require '../../include/koneksi.php';
$tanggal=isset($_GET['tanggal'])?$_GET['tanggal']:'';
$nosurat=isset($_GET['nosurat'])?$_GET['nosurat']:'';
$pengirim=isset($_GET['pengirim'])?$_GET['pengirim']:'';
$perihal=isset($_GET['perihal'])?$_GET['perihal']:'';
$penjelasan=isset($_GET['penjelasan'])?$_GET['penjelasan']:'';
$masuk=isset($_GET['masuk'])?$_GET['masuk']:'';
$target_dir = "file/";
$file = !empty($_FILES['file']) ? $_FILES['file'] : null;
$nama=isset($_FILES["file"]["name"])?$_FILES["file"]["name"]:'';
$error=isset($_FILES['file']['error'])?$_FILES['file']['error']:'';
$target_file = $target_dir . basename($nama);
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
function clean($string){
	$string = str_replace('/', '-', $string);
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}
$gambar =isset($_FILES["file"]["name"])?clean($nosurat):'';
if(empty($pengirim)){
	echo 'Kolom pengirim tidak boleh kosong!';
}
else if(empty($perihal)){
	echo 'Kolom Perihal tidak boleh kosong!';
}
else if(empty($penjelasan)){
	echo 'Kolom Keterangan tidak boleh kosong!';
}
else if(empty($masuk)){
	echo 'Kolom Penerima tidak boleh kosong!';
}
else{
	try{
		$backup_data = $db->prepare("select pengirim, perihal, keterangan, penerima from e_surat_masuk where nomor_surat=? limit 1");
		$backup_data->execute(array($nosurat));
		$row = $backup_data->fetchObject();
		$backup= $db->prepare("insert into e_office.e_backup (backup_key, backup_content) values (?,?)");
		$backup->execute(array($nosurat, serialize($row)));
		$update = $db->prepare("UPDATE e_surat_masuk SET pengirim=?, perihal=?, keterangan=?, penerima=?, gambar=? WHERE nomor_surat=?");
		$update->execute(array($pengirim, $perihal,$penjelasan, $masuk, $gambar, $nosurat));
		if($file || $file['size']){
			if($error){
				echo "Gambar tidak bisa diupload. Silahkan pilih yang lain!";
			}
			else if($FileType != "png" && $FileType != "jpg" && $FileType != "jpeg"){
				echo $nama." bukan file jpg, jpeg, atau png.";
			}
			else{
                            if(move_uploaded_file($_FILES["file"]["tmp_name"], 'file/'.md5($nosurat).'.jpg')){
                            }
                            
			}
		}
		echo 'berhasil';
	}catch(PDOException $ex){echo " Gagal menambahkan ke database dengan kode kesalahan ".$ex->getMessage();}
}