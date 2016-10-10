<?php

require('../../../wp-load.php' );
require '../../include/koneksi.php';
$id = isset($_POST['id']) ? $_POST['id'] : '';
$hakakses = isset($_POST['hakakses']) ? $_POST['hakakses'] : '';

function role($uid) {
    $users = new WP_User($uid);
    return $users->roles[0];
}

$u = new WP_User($id);
if (role($id) == "administrator") {
    exit("<span><i class='glyphicon glyphicon-info-sign'></i> Maaf, hak akses admin tidak bisa diganti.");
} else {
    $user = new WP_User($id);
    $user->remove_cap('pimpinan');
    $user->remove_cap('pegawai');
    if ($hakakses == "pimpinan") {

        add_role($hakakses, "Pimpinan");
    } else {
        add_role($hakakses, "Pegawai");
    }
    $u->set_role($hakakses);
    try {
        $edit = $db->prepare("UPDATE e_user set user_role=? where user_id=?");
        $edit->execute(array($hakakses, $id));
        echo 'berhasil';
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }

    
}