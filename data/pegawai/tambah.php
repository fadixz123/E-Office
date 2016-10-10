<?php
require('../../../wp-load.php' );
require '../../include/koneksi.php';
$username			= isset($_POST['username'])?$_POST['username']:'';
$email				= isset($_POST['email'])?$_POST['email']:'';
$password			= isset($_POST['password'])?$_POST['password']:'';
$password1			= isset($_POST['password1'])?$_POST['password1']:'';
$hakakses			= isset($_POST['hakakses'])?$_POST['hakakses']:'';
if(empty($username)){
	echo "Username tidak boleh kosong!";
}
else if(strlen($username)<5){
	echo "Username minimal 5 digit.";
}
else if(empty($email)){
	echo "Email tidak boleh kosong!";
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "Email sepertinya tidak valid!";
}
else if(empty($password)){
	echo "Password tidak boleh kosong!";
}
else if(empty($password1)){
	echo "Ulangi Password tidak boleh kosong!";
}
else if($password!=$password1){
	echo "Kolom Password dan ulangi Password harus sama!";
}
else{

$userData = array(
            'user_login' => $username,
            'user_pass' => $password,
            'user_email' => $email,
            'user_url' => '',
            'role' => $hakakses
        );
$user_id = username_exists( $username );
if ( !$user_id && email_exists($email) == false ) {
 wp_insert_user( $userData );
        try{
			$stmt = $db->prepare("INSERT INTO e_user (user_id, user_login, user_role, user_display, user_pass) VALUES (?, ?, ?, ?, ?)");
			$status=$stmt->execute(array($id, $username, $hakakses, $username, $password));
			$u = new WP_User($id);
			$u->set_role($hakakses);
			echo "berhasil";
		}
		catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}
else{
	echo "Username atau email sudah ada. Silahkan gunakan lainnya.";
}


}
