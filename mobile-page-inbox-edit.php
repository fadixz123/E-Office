<?php include 'mobile-header.php'; ?>
<div role="main" class="ui-content">
    <?php
    $kode = isset($_GET['kode']) ? $_GET['kode'] : '';
    $pilih = $db->prepare('SELECT * FROM e_surat_masuk where nomor_surat=?');
    $pilih->execute(array($kode));
    $row = $pilih->fetch(PDO::FETCH_BOTH);
    ?>
    <div class="row edit">
        <form id="form-edit" data-ajax="false" method="get" name="edit" action="mobile-page-inbox-exec.php">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="nosurat" class="">No. Surat</label>
                    <input type="text" name="nosurat" id="nosurat" value="<?php echo $row['nomor_surat']; ?>" class="form-control" readonly="readonly"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="tanggal" class="">Tanggal Masuk</label>
                    <input type="text" id="tanggal" value="<?php echo $row['tanggal_masuk']; ?>" name="tanggal" class="form-control" />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="pengirim" class="">Pengirim</label>
                    <input type="text" name="pengirim" value="<?php echo $row['pengirim']; ?>" id="pengirim" class="form-control"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="perihal" class="">Perihal</label>
                    <input type="text" name="perihal" id="perihal" value="<?php echo $row['perihal']; ?>" class="form-control"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="penjelasan" class="">Penjelasan</label>
                    <textarea type="text" name="penjelasan" id="penjelasan" class="form-control"><?php echo $row['keterangan']; ?></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="masuk" class="">Penerima</label>
                    <input type="text" name="masuk" id="masuk" value="<?php echo $row['penerima']; ?>" class="form-control"/>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="masuk" class="">Salinan</label>
                    <input type="file" name="file" id="file" value="<?php echo "data/surat-masuk/file/".md5($row['nomor_surat']).".jpg";  ?>" selected="selected" class="ui-input-text"/>
                    <input type="submit" value="Update"  name="edit"class="ui-btn"/> 
                </div>
            </div>
        </form>
    </div>

</div><!-- /content -->
<script>
    $(function () {
        $("title").text("Edit Surat Masuk");
    });
</script>

<?php include 'mobile-footer.php'; ?>