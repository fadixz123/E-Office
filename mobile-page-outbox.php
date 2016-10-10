<?php include 'mobile-header.php'; ?>
<script src="js/surat-masuk.js"></script>
<div role="main" class="ui-content">

    <table id="tabel-inbox" data-role="table" data-mode="columntoggle" data-column-btn-theme="b" data-column-btn-text="Kolom..." data-column-popup-theme="b" class="ui-responsive table-stroke">
        <thead>
            <tr>
                <th data-priority="5">TANGGAL</th>
                <th data-priority="4">NO. SURAT</th>
                <th data-priority="1">PERIHAL</th>
                <th data-priority="6">PENGIRIM</th>
                <th data-priority="2">STATUS DISPOSISI</th>
                <th data-priority="3">TINDAKAN</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $menu = "";
            $lihat = $db->query("select * from e_surat_keluar limit 20");
            while ($row = $lihat->fetch(PDO::FETCH_BOTH)) {
                $menu = '<center>';
                $gambar = md5($row['nomor_surat']) . '.jpg';

                if (is_file('file/' . $gambar)) {
                    $menu .= "<a data-lihat='"
                            . $row['gambar']
                            . "' title='Surat Nomor "
                            . $row['nomor_surat']
                            . "' rel='gallery' href='data/surat-masuk/file/"
                            . $gambar
                            . "' id='lihat'><i class='glyphicon glyphicon-eye-open'></i> </a>";
                }
                $disposisi_kadin = $row['disposisi_kadin'] ? unserialize($row['disposisi_kadin']) : null;
                $disposisi_kabid = $row['disposisi_kabid'] ? unserialize($row['disposisi_kabid']) : null;
                $ds_kadin = $disposisi_kadin && $disposisi_kadin['status'] !== 'tinjau';
                $ds_kabid = $disposisi_kabid && $disposisi_kabid['status'] !== 'tinjau';
                if ($akses == 'pegawai') {

                    // Menu ditampilkan jika belum diterima Kadin/Kabid atau distatuskan lain
                    if (!($ds_kadin || $ds_kabid)) {
                        $menu .= " <a data-edit='"
                                . $row['nomor_surat']
                                . "' href='mobile-page-outbox-edit.php?edit&kode="
                                . urlencode($row['nomor_surat'])
                                . "' id='edit'><i class='glyphicon glyphicon-edit'></i></a>";
                    }

                    // Menu ditampilkan jika belum diterima Kadin/Kabid
                    if (!($disposisi_kadin || $disposisi_kabid)) {
                        $menu .= " <a href='#hapus' "
                                . "data-position-to='window' "
                                . "data-rel='popup' data-transition='flip' "
                                . "id='hapuss' "
                                . "data-hapus='"
                                . $row['nomor_surat']
                                . "'><i class='glyphicon glyphicon-trash'></i></a>";
                    }
                } else if ($akses == 'kadin' || ('kabid' === $akses && $row['disposisi_kadin'])) {
                    $menu .= " <a data-disposisi='" . $row['nomor_surat'] . "' href='data/surat-masuk/edit.php?disposisi=" . $row['nomor_surat'] . "' id='disposisi'><i class='fa fa-legal'></i></a>";
                }
                $menu .= '</center>';

                $status = '';
                $keterangan = "== Detail Disposisi ==";
                if ($disposisi_kadin) {
                    $status = 'Telah di' . $disposisi_kadin['status'] . ' Kadin';
                    $keterangan .= "\n[Kadin, " . $disposisi_kadin['tanggal'] . "] \n" . $disposisi_kadin['keterangan'];
                }

                if ($disposisi_kabid) {
                    $status .= ($status ? ' dan ' : 'Telah ') . 'di' . $disposisi_kabid['status'] . ' Kabid';
                    $keterangan .= "\n[Kabid, " . $disposisi_kabid['tanggal'] . "] \n" . $disposisi_kabid['keterangan'];
                }
                if ($status) {
                    $status = '<span style="cursor:pointer" title="' . htmlspecialchars($keterangan . "\n") . '" onclick="alert(this.title)">' . $status . '</span>';
                }
                ?>
                <tr>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['nomor_surat']; ?></td>
                    <td><?php echo $row['perihal']; ?></td>
                    <td><?php echo $row['pengirim']; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $menu; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <div data-role="popup" id="hapus">
        <div data-role="header" data-theme="a">
            <h1>Hapus Arsip?</h1>
        </div>
        <div role="main" class="ui-content">
            <h3 class="ui-title">Apakah Anda Akan Menghapus Arsip Surat No <no></no>?</h3>
            <p>Aksi ini tidak bisa dibatalkan (undo)</p>
            <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Batal</a>
            <a href="#" id="tombol-hapus" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-ajax="false" data-transition="flow">Hapus</a>
        </div>
    </div>
</div><!-- /content -->
<script>
    $(function () {
        $("no").text($("#hapuss").attr("data-hapus"));
        $("#tombol-hapus").attr("href", "mobile-page-inbox-exec.php?hapus&kode=" + $("#hapuss").attr("data-hapus"));
    });
</script>
<script>
    $(function () {
        $("title").text("Surat Keluar");
    });
</script>
<?php include 'mobile-footer.php'; ?>