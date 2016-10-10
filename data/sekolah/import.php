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
						$cek= $db->prepare("select npsn from e_sekolah where npsn=? limit 1");
						$cek->execute(array($row[0]));
						if(empty($row[0])){
							exit;
						}
						else  if(!$cek->rowCount()>0){
							
							$sql="INSERT INTO e_sekolah (npsn, nama_sp, alamat_jalan, desa_kelurahan, kec_, jenjang, status_sekolah, waktu_penyelenggaraan, akreditasi, sk_akreditasi, tanggal_sk_akreditasi, sk_pendirian_sekolah, tanggal_sk_pendirian, sk_izin_operasional, tanggal_sk_izin_operasional, mbs, sertifikasi_iso, akses_internet, nomor_telepon, nomor_fax, email, website, no_rekening, nama_bank, cabang_kcp_unit, lintang, bujur) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
							$stmt = $db->prepare($sql);
							$stmt->execute(array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13], $row[14], $row[15], $row[16], $row[17], $row[18], $row[19], $row[20], $row[21], $row[22], $row[23], $row[24], $row[25], $row[26]));
							echo "berhasil ";
						}
						else{
							echo "<small class='text-red'><i  class='fa fa-info-circle'></i> Arsip dengan kode NPSN <b>".$row[0]."</b> sudah ada!</small><br/>";
						}
					}
				}
	}

?>