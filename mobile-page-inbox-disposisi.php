<?php include 'mobile-header.php'; ?>

<div role="main" class="ui-content">
    <?php
    $kode = isset($_GET['nomor-surat']) ? $_GET['nomor-surat'] : '';
    $pilih = $db->prepare('SELECT * FROM e_surat_masuk where nomor_surat=?');
    $pilih->execute(array($kode));
    $row = $pilih->fetch(PDO::FETCH_BOTH);

// Cek peranan
    $user_role = $db->query('select user_role from e_user where user_id="' . (int) get_current_user_id() . '" limit 1');
    $user_role = $user_role ? $user_role->fetchObject()->user_role : null;
    $dispo = array(
        'status' => '',
        'tanggal' => '',
        'keterangan' => ''
    );

    if ($user_role === 'kadin') {
        if ($row['disposisi_kadin'])
            $dispo = array_merge($dispo, unserialize($row['disposisi_kadin']));
    }
    else if ($user_role === 'kabid') {
        if ($row['disposisi_kabid'])
            $dispo = array_merge($dispo, unserialize($row['disposisi_kabid']));
    } else
        exit("Pastikan Anda memiliki hak untuk tindakan ini");
    ?>

  
    <div data-role="tabs" id="tabs">
        <div data-role="navbar">
            <ul>
                <li><a href="#one" data-ajax="false">Ringkasan</a></li>
                <li><a href="#two" data-ajax="false">Lampiran</a></li>
                <li><a href="#three" data-ajax="false">Disposisi</a></li>
            </ul>
        </div>
        <div id="one" class="ui-body-d ui-content">
            <div class='text-center'><b><u><?php echo $row['perihal']; ?></u></b></div>
            <div class='text-center'><small><?php echo $row['nomor_surat']; ?></small></div><br/>
            <p><?php echo $row['keterangan']; ?></p><br/><br/>
            <div class="text-right">
                <?php echo $row['tanggal']; ?><br/>
                <b><?php echo $row['pengirim']; ?></b>
            </div>
        </div>
        <div id="two">
            <img style="max-width: 100%;height: auto; padding:5px 20px" class="img-responsive" src="data/surat-masuk/file/<?php echo md5($row['nomor_surat']) . '.jpg'; ?>"/>
        </div>
        <div id="three">
            <div class="row edit">
                <form data-ajax="false" id="form-disposisi" method="post" action="data/surat-masuk/disposisi.php">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="nosurat" class="">No. Surat</label>
                            <input type="text" name="nosurat" id="nosurat" value="<?php echo @$row['nomor_surat']; ?>" class="form-control" readonly="readonly"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="tanggal-disposisi" class="">Tanggal Disposisi</label>
                            <input type="text" data-provide="datepicker" id="tanggal-disposisi" value="<?php echo $dispo['tanggal']; ?>" name="tanggal-disposisi" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <fieldset  data-role="controlgroup" data-type="horizontal">
                            <label for="disposisi-status-terima">
                                <input id="disposisi-status-terima" type="radio" name="disposisi_status"  value="terima" <?php
                                echo $dispo['status'] === 'terima' ? 'checked' : ''
                                ?>>
                                Terima
                            </label>
                            <label for="disposisi-status-tolak">
                                <input id="disposisi-status-tolak" type="radio" name="disposisi_status"  value="tolak" <?php
                                echo $dispo['status'] === 'tolak' ? 'checked' : ''
                                ?>>
                                Tolak
                            </label>
                            <label for="tanggal-disposisi-lain" class="">
                                <input type="radio" name="disposisi_status"  value="tinjau" <?php
                                echo $dispo['status'] === 'tinjau' ? 'checked' : ''
                                ?>>
                                Lainnya
                            </label>
                        </fieldset>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="keterangan" class="">Keterangan</label>
                            <textarea type="text" name="keterangan" id="keterangan" class="form-control"><?php echo $dispo['keterangan']; ?></textarea>
                        </div>
                        <input data-ajax="false" type="submit" value="Disposisi" class="btn btn-info"/>
                    </div>
                    <input type="hidden" name="form-data-disposisi" value="1"/>

                </form>
            </div>
        </div>
    </div>

</div><!-- /content -->
<link href="plugins/datepicker/datepicker3.css"/>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
    $(function () {
        $("title").text("Disposisi Surat Masuk");
        $("#tanggal-disposisi").datepicker({
           format: 'yyyy-mm-dd' 
        });
    });
</script>

<?php include 'mobile-footer.php'; ?>