<?php

require('../../../wp-load.php' );
require('../../../wp-admin/includes/user.php' );
require '../../include/koneksi.php';
$id = isset($_GET['id']) ? $_GET['id'] : '';

function role($uid) {
    $users = new WP_User($uid);
    return $users->roles[0];
}

if (role($id) == "administrator") {
    echo "Admin tidak bisa dihapus!";
} else {
    wp_delete_user($id);
    try {
        $stmt = $db->prepare("DELETE FROM e_user WHERE user_id=?");
        $stmt->execute(array($id));
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}