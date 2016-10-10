<?php
include 'include/koneksi.php';
require('../wp-load.php' );
 if (!is_user_logged_in()) { 
 header("location: mobile-page-login.php");
 }
global $user;
$user = wp_get_current_user();
$akses = $user->roles[0];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>E-Office</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="include/jquery.mobile/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <script src="js/jQuery-2.1.4.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="include/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
    </head>
    <body>

        <div data-role="page">

