<div data-role="footer" data-theme="b" >	
    <center style="padding:5px;">
        <i class="fa fa-user"> Masuk sebagai </i> <?php echo $user->display_name.", "; ?>
        <a data-ajax="false" href="<?php echo wp_logout_url("e-office/mobile-page-login.php"); ?>">Logout</a>
    </center>
</div><!-- /footer -->
</div><!-- /page -->
</body>
</html>