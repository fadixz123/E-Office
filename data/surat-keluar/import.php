<?php

$target_dir = "tmp/";
$nama=isset($_FILES["file"]["name"])?$_FILES["file"]["name"]:'';
$error=isset($_FILES['file']['error'])?$_FILES['file']['error']:'';
$target_file = $target_dir . basename($nama);
$data="tmp/data.csv";
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);

if (empty($_FILES) ) {
        echo "<i  class='fa fa-info-circle text-red'> Silahkan pilih file CSV!</i>";
    }
	else if($error){
		echo "<i class='fa fa-info-circle text-red'> Kesalahan: silahkan pilih file lagi.!</i>";
	}
else if($FileType != "csv"){
	echo "<i  class='fa fa-info-circle text-red'> <b>".$nama."</b> bukan file csv.</i> ";
}
    else {
		if (file_exists($target_file)) {
			unlink($target_file);
			import_csv();
		}
        else{
			import_csv();
		}
    }
	
	function import_csv(){
		require '../../include/koneksi.php';
		$target_dir = "tmp/";
		$nama=isset($_FILES["file"]["name"])?$_FILES["file"]["name"]:'';
		$error=isset($_FILES['file']['error'])?$_FILES['file']['error']:'';
		$target_file = $target_dir . basename($nama);
		$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
					move_uploaded_file($_FILES['file']['tmp_name'], 'tmp/' . $nama);
			if (($handle = fopen($target_file, "r")) !== FALSE) {
					fgetcsv($handle);
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						$num = count($data);
						for ($c=0; $c < $num; $c++) {
						  $row[$c] = $data[$c];
						}
						$cek= $db->prepare("select nomor_surat from e_surat_keluar where nomor_surat=? limit 1");
						$cek->execute(array($row[1]));
						if(empty($row[1])){
							exit;
						}
						else if(!$cek->rowCount()>0){
							$sql="INSERT INTO e_surat_keluar (tanggal, nomor_surat, perihal, pengirim, penerima, keterangan) VALUES (:tanggal, :nosurat, :perihal, :pengirim, :masuk, :penjelasan)";
							$stmt = $db->prepare($sql);
							$stmt->bindParam(':tanggal', $row[0]);
							$stmt->bindParam(':nosurat', $row[1]);
							$stmt->bindParam(':perihal', $row[2]);
							$stmt->bindParam(':pengirim', $row[3]);
							$stmt->bindParam(':masuk', $row[4]);
							$stmt->bindParam(':penjelasan', $row[5]);
							$stmt->execute();
							echo "berhasil ";
						}
						else{
							echo "<i  class='fa fa-info-circle text-red'> Arsip dengan kode <b>".$row[1]."</b> sudah ada!</i><br/>";
						}
					}
				}
	}

?>