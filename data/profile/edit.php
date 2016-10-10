<?php
require '../../include/koneksi.php';
require('../../../wp-load.php' );
global $user;
$user = wp_get_current_user();
$id = $user->id;
$bio = isset($_POST['bio']) ? $_POST['bio'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$pendidikan = isset($_POST['pendidikan']) ? $_POST['pendidikan'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$namatampilan = isset($_POST['nama-tampilan']) ? $_POST['nama-tampilan'] : '';
$jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';
$telpon = isset($_POST['telpon']) ? $_POST['telpon'] : '';
$website = isset($_POST['website']) ? $_POST['website'] : '';
$token = isset($_POST['token']) ? $_POST['token'] : '';

update_user_meta($id, 'alamat', $alamat);
update_user_meta($id, 'description', $bio);
update_user_meta($id, 'pendidikan', $pendidikan);
update_user_meta($id, 'telpon', $telpon);
update_user_meta($id, 'jabatan', $jabatan);
$id = wp_update_user(array('ID' => $id, 'user_email' => $email));
$id = wp_update_user(array('ID' => $id, 'user_url' => $website));
$id = wp_update_user(array('ID' => $id, 'display_name' => $namatampilan));
if (is_wp_error($id)) {
    echo "Gagal update email";
} else {
    try {
        $edit = $db->prepare("UPDATE e_user set user_display=?, user_token=? where user_id=?");
        $edit->execute(array($namatampilan, $token, $id));
        echo 'berhasil';
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}