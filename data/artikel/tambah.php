<?php

require_once('../../../wp-load.php' );
require_once('../../../wp-admin/includes/template.php' );
require_once('../../../wp-admin/includes/taxonomy.php' );
require_once('../../../wp-includes/post.php' );
if (isset($_GET['kategori'])) {
    wp_dropdown_categories(array(
        'hide_empty' => 0,
        'name' => 'daftar-kategori',
        'orderby' => 'name',
        'hierarchical' => true,
        'show_option_none' => __('None')
    ));
} elseif ($_GET['ambil-kategori']) {
    wp_category_checklist($_GET['ambil-kategori']);
} else if (isset($_GET['tambah-kategori'])) {
    $kategori = isset($_POST['cat']) ? $_POST['cat'] : '';
    $tambah_kategori = array('cat_name' => $kategori, 'category_description' => $kategori, 'category_nicename' => $kategori, 'category_parent' => '');
    $tambah = wp_insert_category($tambah_kategori);
    if ($tambah) {
        echo $tambah;
    }
} else if (isset($_GET['tambah-artikel'])) {
    global $user;
    $user = wp_get_current_user();
    $id = $user->id;
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $isi = isset($_POST['isi']) ? $_POST['isi'] : '';
    $tag = isset($_POST['tag']) ? $_POST['tag'] : '';
    $my_post = array(
        'post_title' => wp_strip_all_tags($judul),
        'post_content' => $isi,
        'post_status' => 'publish',
        'post_author' => $id,
        'post_category' => $kategori
    );
    $post_id = wp_insert_post($my_post, $wp_error);
    wp_set_post_tags($post_id, $tag, false);
    echo $post_id;
} elseif (isset($_GET['edit-artikel'])) {
    $id = $_GET['edit-artikel'];
    $user = wp_get_current_user();
    $id_user = $user->id;
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $isi = isset($_POST['isi']) ? $_POST['isi'] : '';
    $tag = isset($_POST['tag']) ? $_POST['tag'] : '';
    $my_post = array(
        'ID' => $id,
        'post_title' => $judul,
        'post_content' => $isi,
        'post_status' => 'publish',
        'post_author' => $id_user
    );

    $post_id = wp_update_post($my_post);
    $update = wp_set_post_terms($post_id, $kategori, 'category');
    wp_set_post_tags($post_id, $tag, false);
    if (is_wp_error($update)) {
        echo "gagal Update";
    } else {
        echo $post_id;
    }
}