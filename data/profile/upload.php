<?php

$target_dir = "images/";
$nama=isset($_FILES["file"]["name"])?$_FILES["file"]["name"]:'';
$error=isset($_FILES['file']['error'])?$_FILES['file']['error']:'';
$target_file = $target_dir . basename($nama);
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);

if (empty($_FILES) ) {
        echo "<i  class='fa fa-info-circle text-red'> Silahkan pilih file CSV!</i>";
    }
	else if($error){
		echo "<span class='text-red'><i class='fa fa-info-circle'></i> Gambar tidak bisa diupload! Silahkan pilih gambar lain</span>";
	}
else if($FileType != "png" && $FileType != "jpg" && $FileType != "jpeg"){
	echo "<span class='text-red'><i class='fa fa-info-circle'></i> File ".$nama." bukan file jpg, jpeg, atau png.</span>";
}
    else {
			require('../../../wp-load.php' );
			global $user, $id;
			$user 			= wp_get_current_user();
			$id				= $user->id;
			$target_dir = "images/";
			$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = $id.'.png';
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $newfilename)){
				update_user_meta($id, 'gambar', $id.'.png');
				echo "<span class='text-success'><i class='fa fa-info-circle'></i> Gambar berhasil diupload!</span>";
			}
			else{
				echo "<span class='text-red'><i class='fa fa-info-circle'></i> Gambar gagal diupload! Coba ulangi lagi.</span>";
			}
    }
	
function resample($jpgFile, $thumbFile, $width, $orientation) {
    // Get new dimensions
    list($width_orig, $height_orig) = getimagesize($jpgFile);
    $height = (int) (($width / $width_orig) * $height_orig);
    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image   = imagecreatefromjpeg($jpgFile);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
    // Fix Orientation
    switch($orientation) {
        case 3:
            $image_p = imagerotate($image_p, 180, 0);
            break;
        case 6:
            $image_p = imagerotate($image_p, -90, 0);
            break;
        case 8:
            $image_p = imagerotate($image_p, 90, 0);
            break;
    }
    // Output
    imagejpeg($image_p, $thumbFile, 90);
}


?>