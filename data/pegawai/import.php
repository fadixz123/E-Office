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
		require('../../../wp-load.php' );
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

						if(empty($row[0])||empty($row[1])||empty($row[2])){
							exit;
						}
						else {
							$userData = array(
								'user_login' => $row[0],
								'user_pass' => $row[1],
								'user_email' => $row[2],
								'role' => $row[3]
							);
							$user_id = username_exists( $row[0] );
								if ( $user_id ) {
									echo 'Username '.$row[0].' sudah ada! <br/>';
								}
								else if(email_exists($row[2]) == false){
									echo 'Email '.$row[2].' sudah ada! <br/>';
								}
								else{
									wp_insert_user( $userData );
									echo 'berhasil';
								}
						}
					}
				}
	}

?>