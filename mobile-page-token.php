<?php include 'mobile-header.php'; ?>
<div role="main" class="ui-content">
    <form data-ajax="false" method="post" action="mobile-page-inbox-exec.php?token">
        <input type="hidden" value="<?php echo $user->id; ?>" name="user_id" readonly/>
        <textarea name="token"></textarea>
        <input type="submit" value="Simpan Token" data-ajax="false"/>
    </form>


</div><!-- /content -->
<script>
    $(function () {
        $("title").text("Konfigurasi Token");
    });
</script>
<?php include 'mobile-footer.php'; ?>