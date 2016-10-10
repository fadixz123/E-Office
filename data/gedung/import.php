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

						if(empty($row[1])){
							exit;
						}
						else {
							$sql="INSERT INTO e_gedung (tanggal, mulai, selesai, tempat, pelaksana, keperluan, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)";
							$stmt = $db->prepare($sql);
							$stmt->execute(array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]));
							echo "berhasil ";
						}
					}
				}
	}

?>