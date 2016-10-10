<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'konfig.php';

$admintitle = "Surat Keluar";

include 'header.php';
$nomor = isset($_GET['nomor-surat']) ? $_GET['nomor-surat'] : '';
$pilih = $db->query("SELECT * FROM e_surat_keluar where nomor_surat='$nomor'");
$row = $pilih->fetch(PDO::FETCH_BOTH);
?>
<div data-title="<?php echo $admintitle; ?>">
    <div class="tabs">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" ><i class="glyphicon glyphicon-eye-open"></i></a></li>
            <li class=""><a  href="#tab_2" ><i class='glyphicon glyphicon-file'></i></a></li>
            <li class=""><a  href="#tab_3" ><i class='fa fa-legal'></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class='text-center'><b><u><?php echo $row['perihal']; ?></u></b></div>
                <div class='text-center'><small><?php echo $row['nomor_surat']; ?></small></div><br/>
                <p><?php echo $row['keterangan']; ?></p><br/><br/>
                <div class="text-right">
                    <?php echo $row['tanggal']; ?><br/>
                    <b><?php echo $row['pengirim']; ?></b>
                </div>
            </div>
            <div class="tab-pane" id="tab_2">
                <img class="img-responsive" src="data/surat-keluar/file/<?php echo $row['gambar'] . '.jpg'; ?>"/>
            </div>
            <div class="tab-pane" id="tab_3">
                <div class="row edit">
                    <form id="form-disposisi" method="post" action="data/surat-keluar/disposisi.php">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="nosurat" class="">No. Surat</label>
                                <input type="text" name="nosurat" id="nosurat" value="<?php echo $row['nomor_surat']; ?>" class="form-control" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="tanggal-disposisi" class="">Tanggal Disposisi</label>
                                <input type="text" id="tanggal-disposisi" value="<?php echo $row['tanggal_disposisi']; ?>" name="tanggal-disposisi" class="form-control tanggal" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="tujuan-disposisi" class="">Tujuan Disposisi</label>
                                <input type="text" name="tujuan-disposisi" value="<?php echo $row['tujuan_disposisi']; ?>" id="tujuan-disposisi" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="isi-disposisi" class="">Isi Disposisi</label>
                                <textarea type="text" name="isi-disposisi" id="isi-disposisi" class="form-control"><?php echo $row['isi_disposisi']; ?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Disposisi Sekarang" id="submit" class="form-control btn btn-info"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(".tabs").tabs();
            $(".tanggal").datepicker({dateFormat: 'dd MM yy'});
            function split(val) {
                return val.split(/,\s*/);
            }
            function akhiran(term) {
                return split(term).pop();
            }
            $("#tujuan-disposisi").on("keydown", function (event) {
                if (event.keyCode == $.ui.TAB && $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            })
                    .autocomplete({
                        minLength: 0,
                        source: function (request, response) {
                            $.getJSON("form/surat-masuk/disposisi.php?term", {
                                term: akhiran(request.term)
                            }, response);
                        },
                        focus: function () {
                            return false;
                        },
                        select: function (event, ui) {
                            var terms = split(this.value);
                            terms.pop();
                            terms.push(ui.item.value);
                            terms.push("");
                            this.value = terms.join(", ");
                            return false;
                        }
                    });
        });
    </script>
    <?php include 'footer.php'; ?>



