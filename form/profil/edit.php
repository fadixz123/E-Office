<?php
require('../../../wp-load.php' );
require '../../include/koneksi.php';
global $user;
$user = wp_get_current_user();
$id = $user->id;

try {
    $pilih = $db->prepare('SELECT user_token FROM e_user where user_id=?');
    $pilih->execute(array($id));
    $row = $pilih->fetch(PDO::FETCH_BOTH);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
?>
<div class="tabs">
    <ul>
        <li><a href="#menu1">Data Login</a></li>
        <li><a href="#menu2">Data Diri</a></li>
        <li><a href="#menu3">Data Kontak</a></li>
    </ul>
    <div class="row" style="width:600px;">
        <form id="form-edit-profil">
            <div id="menu1">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="<?php echo $user->user_login; ?>" type="text" class="form-control" id="username" name='username' readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?php echo $user->user_email; ?>" type="text" class="form-control" id="email" name='email'>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Nama Tampilan</label>
                        <input value="<?php echo $user->display_name; ?>" type="text" class="form-control" id="nama-tampilan" name='nama-tampilan'>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Jabatan</label>
                        <input value="<?php echo get_user_meta($id, 'jabatan', true); ?>" type="text" class="form-control" id="jabatan" name='jabatan'>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="token">Token</label>
                        <textarea class="form-control" id="token" name='token'><?php echo $row['user_token']; ?></textarea>
                    </div>
                </div>
            </div>
            <div id="menu3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="telpon">Telpon</label>
                        <input value="<?php echo get_user_meta($id, 'telpon', true); ?>" type="text" class="form-control" id="telpon" name='telpon'>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input value="<?php echo $user->user_url; ?>" type="text" class="form-control" id="website" name='website'>
                    </div>
                </div>
            </div>
            <div id="menu2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="bio">Bio Singkat</label>
                        <textarea name="bio" class="form-control" id="bio"><?php echo get_user_meta($id, 'description', true); ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" value="<?php echo get_user_meta($id, 'alamat', true); ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan</label>
                        <input value="<?php echo get_user_meta($id, 'pendidikan', true); ?>" type="text" class="form-control" id="pendidikan" name='pendidikan'>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="alamat">Gambar profil</label>
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    <form id="import-csv">
                                        Pilih&hellip; <input id="csv" name='csv' type="file" style="display: none;" enctype="multipart/form-data">
                                    </form>
                                </span>
                            </label>
                            <input type="text" class="form-control" value="asg" readonly>
                        </div>
                        <i class="error text-danger"></i>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>	

<script>
    $(function () {
        $(".tabs").tabs();
        $(document).on('change', ':file', function () {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
            var file_data = $('#csv').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $(".error").html("<span class='text-info'><i class='fa fa-spinner fa-spin'></i> Sedang diproses</span>");
            $.ajax({
                url: 'data/profile/upload.php',
                method: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function (msg) {
                    if (msg.toLowerCase().indexOf("berhasil") >= 0) {
                        $(".error").html(msg);
                    } else {
                        $(".error").html(msg);
                    }
                },
                error: function (er) {
                    alert(er.responseText)
                }
            });
        });
        $(':file').on('fileselect', function (event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;
            if (input.length) {
                input.val(log);
            } else {
                if (log)
                    alert(log);
            }
        });
    });
</script>