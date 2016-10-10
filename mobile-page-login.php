<?php include 'include/koneksi.php';
require_once('../wp-load.php' );
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
        <script src="include/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
    </head>
    <body>

        <div data-role="page">
<div data-theme="b" role="banner" data-role="header">
    <h1>Login E-Office</h1>

</div><!-- /header -->
<div role="main" class="ui-content">

        <form data-ajax="false" method="post" action="mobile-page-cek.php?login">
            <label for="user_login">Username Atau Email</label>
            <input name="user_login" id="user_login" value="" type="text">
            <label for="user_pass">Password</label>
            <input name="user_pass" id="user_pass" value="" type="password">
            <input data-ajax="false" type="submit" value="Masuk" data-theme="b" class="ui-btn"/>
        </form>
</div><!-- /content -->

<div data-role="footer" data-theme="b" data-position="fixed">	
    <center><i>Indomedia Network</i></center>
</div><!-- /footer -->
</div><!-- /page -->
</body>
</html>